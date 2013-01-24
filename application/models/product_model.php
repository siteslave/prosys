<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model
{

    public function get_list($start, $limit)
    {
        $result = $this->db
                        ->select(array(
                            'p.id', 'p.code', 'p.name as product_name', 'p.product_serial', 'p.purchase_price', 'p.purchase_date',
                            'b.name as brand_name', 't.name as type_name', 'g.name as group_name', 'o.name as owner_name',
                            's.name as supplier_name'
                        ))
                        ->join('product_brands b', 'b.id=p.brand_id', 'left')
                        ->join('product_models m', 'm.id=p.model_id', 'left')
                        ->join('product_types t', 't.id=p.type_id', 'left')
                        ->join('product_groups g', 'g.id=t.group_id', 'left')
                        ->join('owners o', 'o.id=p.owner_id', 'left')
                        ->join('suppliers s', 's.id=p.supplier_id', 'left')
                        ->order_by('p.name', 'DESC')
                        ->limit($limit, $start)
                        ->get('products p')
                        ->result();
        return $result;
    }

    public function get_total(){
        $result = $this->db->count_all_results('products');
        return $result;
    }

    public function get_owner(){
        $result = $this->db->order_by('name')->get('owners')->result();
        return $result;
    }
    public function get_type(){
        $result = $this->db->order_by('name')->get('product_types')->result();
        return $result;
    }

    public function get_brand(){
        $result = $this->db->order_by('name')->get('product_brands')->result();
        return $result;
    }

    public function get_model(){
        $result = $this->db->order_by('name')->get('product_models')->result();
        return $result;
    }
    public function get_supplier(){
        $result = $this->db->order_by('name')->get('suppliers')->result();
        return $result;
    }

    public function search($query, $start, $limit){
/*
    	$sql = '
    			select p.id, p.code, p.name as product_name, p.product_serial, p.purchase_price, p.purchase_date,
    			b.name as brand_name, t.name as type_name, g.name as group_name, o.name as owner_name, s.name as supplier_name
    			from products p
    			left join product_brands b on b.id=p.brand_id
    			left join product_models m on m.id=p.model_id
    			left join product_types t on t.id=p.type_id
    			left join product_groups g on g.id=t.group_id
    			left join owners o on o.id=p.owner_id
    			left join suppliers s on s.id=p.supplier_id
    			where (p.code="'.$query.'" or p.name like "%'.$query.'%")
    			order by p.name DESC';

    	$rs = $this->db->query($sql)->result();
    	return $rs;
    	*/

        $result = $this->db
            ->select(array(
            'p.id', 'p.code', 'p.name as product_name', 'p.product_serial', 'p.purchase_price', 'p.purchase_date',
            'b.name as brand_name', 't.name as type_name', 'g.name as group_name', 'o.name as owner_name',
            's.name as supplier_name'
        ))
            ->join('product_brands b', 'b.id=p.brand_id', 'left')
            ->join('product_models m', 'm.id=p.model_id', 'left')
            ->join('product_types t', 't.id=p.type_id', 'left')
            ->join('product_groups g', 'g.id=t.group_id', 'left')
            ->join('owners o', 'o.id=p.owner_id', 'left')
            ->join('suppliers s', 's.id=p.supplier_id', 'left')
    	 	->where('(p.name LIKE "%'.$query.'%" OR p.code="'.$query.'")', null, false)
            ->order_by('p.name', 'DESC')
            ->limit($limit, $start)
            ->get('products p')
            ->result();
        return $result;

    }
    public function search_total($query){
    	$rs = $this->db->where('(name LIKE "%'.$query.'%" OR code="'.$query.'")', null, false)->count_all_results('products');
    	return $rs;
    }
    public function search_filter($type_id, $owner_id, $start, $limit){
        $result = $this->db
            ->select(array(
            'p.id', 'p.code', 'p.name as product_name', 'p.product_serial', 'p.purchase_price', 'p.purchase_date',
            'b.name as brand_name', 't.name as type_name', 'g.name as group_name', 'o.name as owner_name',
            's.name as supplier_name'
        ))
            ->join('product_brands b', 'b.id=p.brand_id', 'left')
            ->join('product_models m', 'm.id=p.model_id', 'left')
            ->join('product_types t', 't.id=p.type_id', 'left')
            ->join('product_groups g', 'g.id=t.group_id', 'left')
            ->join('owners o', 'o.id=p.owner_id', 'left')
            ->join('suppliers s', 's.id=p.supplier_id', 'left')
            ->where('p.type_id', $type_id)
            ->where('p.owner_id', $owner_id)
            ->order_by('p.name', 'DESC')
            ->limit($limit, $start)
            ->get('products p')
            ->result();
        return $result;
    }

    public function search_filter_total($type_id, $owner_id){
    	$rs = $this->db
    		->where('type_id', $type_id)
            ->where('owner_id', $owner_id)
            ->count_all_results('products');
    	return $rs;
    }


    public function check_duplicate($code){
        $result = $this->db->where('code', $code)->count_all_results('products');
        return $result > 0 ? TRUE : FALSE;
    }

    public function save($data){
        $result = $this->db->set('code', $data['code'])
                            ->set('name', $data['name'])
                            ->set('product_serial', $data['product_serial'])
                            ->set('purchase_price', $data['purchase_price'])
                            ->set('purchase_date', $data['purchase_date'])
                            ->set('brand_id', $data['brand_id'])
                            ->set('model_id', $data['model_id'])
                            ->set('owner_id', $data['owner_id'])
                            ->set('type_id', $data['type_id'])
                            ->set('supplier_id', $data['supplier_id'])
                            ->insert('products');
        return $result;
    }

    public function update($data){
        $result = $this->db->set('code', $data['code'])
                            ->set('name', $data['name'])
                            ->set('product_serial', $data['product_serial'])
                            ->set('purchase_price', $data['purchase_price'])
                            ->set('purchase_date', $data['purchase_date'])
                            ->set('brand_id', $data['brand_id'])
                            ->set('model_id', $data['model_id'])
                            ->set('owner_id', $data['owner_id'])
                            ->set('type_id', $data['type_id'])
                            ->set('supplier_id', $data['supplier_id'])
                            ->where('id', $data['id'])
                            ->update('products');
        return $result;
    }

    public function detail($id){
        $result = $this->db->where('id', $id)->get('products')->row();
        return $result;
    }

    public function remove($id){
        $result = $this->db->where('id', $id)->delete('products');
        return $result;
    }
}