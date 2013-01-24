<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends CI_Model
{

    public $service_status;
    public $user_id;

    public function get_service_by_code_list($start, $limit)
    {
        $rs = $this->db
            ->select(array(
            'p.code as product_code', 'p.name as product_name', 'p.id as product_id', 'p.product_serial', 'p.purchase_date', 'o.name as owner_name',
            'b.name as brand_name', 'm.name as model_name', 't.name as type_name', 's.*', 'u.fullname as tech_name'
        ))
            ->join('products p', 'p.id=s.product_id', 'left')
            ->join('product_brands b', 'b.id=p.brand_id', 'left')
            ->join('product_models m', 'm.id=p.model_id', 'left')
            ->join('product_types t', 't.id=p.type_id', 'left')
            ->join('owners o', 'o.id=p.owner_id', 'left')
            ->join('users u', 'u.id=s.tech_user_id', 'left')
            ->where('s.service_status', $this->service_status)
            ->limit($limit, $start)
            ->order_by('s.date_serv', 'DESC')
            ->get('main_services s')
            ->result();
        return $rs;
    }

    public function get_service_by_code_total(){
        $rs = $this->db->where('service_status', $this->service_status)->count_all_results('main_services');
        return $rs;
    }

    public function change_service_status($sv, $status){
        $rs = $this->db->where('service_code', $sv)
                ->set('service_status', $status)
                ->update('main_services');
        return $rs;
    }
    public function change_service_status_other($sv, $status){
        $rs = $this->db->where('service_code', $sv)
                ->set('service_status', $status)
                ->update('other_services');
        return $rs;
    }
    public function save_regcode_assign_tech($sv, $user_id){
        $rs = $this->db->where('service_code', $sv)
                ->set('tech_user_id', $user_id)
                ->update('main_services');
        return $rs;
    }
    public function save_other_assign_tech($sv, $user_id){
        $rs = $this->db->where('service_code', $sv)
                ->set('tech_user_id', $user_id)
                ->update('other_services');
        return $rs;
    }
    public function get_entries_detail($id){
        $rs = $this->db->where('s.id', $id)
                ->select(array('s.*', 'p.code as product_code', 'p.name as product_name', 'o.name as owner_name', 'u.fullname as request_name'))
                ->join('products p', 'p.id=s.product_id', 'left')
                ->join('owners o', 'o.id=p.owner_id', 'left')
                ->join('users u', 'u.id=s.report_user_id', 'left')
                ->get('main_services s')
                ->row();
        return $rs;
    }
    public function get_entries_other_detail($id){
        $rs = $this->db->where('s.id', $id)
                ->select(array('s.*', 'o.name as owner_name', 'u.fullname as request_name'))
                ->join('owners o', 'o.id=s.owner_id', 'left')
                ->join('users u', 'u.id=s.report_user_id', 'left')
                ->get('other_services s')
                ->row();
        return $rs;
    }
    public function service_exist($id){
        $rs = $this->db->where('id', $id)->count_all_results('main_services');

        return $rs > 0 ? TRUE : FALSE;
    }
    public function service_other_exist($id){
        $rs = $this->db->where('id', $id)->count_all_results('other_services');

        return $rs > 0 ? TRUE : FALSE;
    }
    public function save_activities($sv, $detail){
        date_default_timezone_set('Asia/Bangkok');

        $act_date = date("Y-m-d");
        $act_time = date("H:i:s");

        $rs = $this->db
                ->set('service_code', $sv)
                ->set('act_date', $act_date)
                ->set('act_time', $act_time)
                ->set('detail', $detail)
                ->set('user_id', $this->user_id)
                ->insert('activities_log');
        return $rs;
    }

    public function get_activities($sv){
        $rs = $this->db->where('a.service_code', $sv)
            ->select(array('a.act_date', 'a.act_time', 'a.detail', 'u.fullname'))
            ->join('users u', 'u.id=a.user_id', 'left')
            ->get('activities_log a')
            ->result();
        return $rs;
    }

    public function search_item($query){
        $rs = $this->db->like('name', $query, 'both')->limit(25)->get('items')->result();
        return $rs;
    }

    public function save_item($data){
        $rs = $this->db
            ->set('service_code', $data['sv'])
            ->set('item_id', $data['id'])
            ->set('qty', $data['qty'])
            ->set('price', $data['price'])
            ->insert('service_items');
        return $rs;
    }

    public function update_item($data){
        $rs = $this->db
            ->where('id', $data['id'])
            ->set('qty', $data['qty'])
            ->set('price', $data['price'])
            ->update('service_items');
        return $rs;
    }

    public function get_item($sv){
        $rs = $this->db->where('s.service_code', $sv)
            ->select(array('s.service_code', 's.price', 's.qty', 's.id', 'i.name'))
            ->join('items i', 'i.id=s.item_id', 'left')
            ->get('service_items s')
            ->result();
        return $rs;
    }

    public function remove_item($id){
        $rs = $this->db->where('id', $id)->delete('service_items');
        return $rs;
    }

    public function search_service_by_code_list($query, $start, $limit)
    {
        $rs = $this->db
            ->select(array(
            'p.code as product_code', 'p.name as product_name', 'p.id as product_id', 'p.product_serial', 'p.purchase_date', 'o.name as owner_name',
            'b.name as brand_name', 'm.name as model_name', 't.name as type_name', 's.*', 'u.fullname as tech_name'
        ))
            ->join('products p', 'p.id=s.product_id', 'left')
            ->join('product_brands b', 'b.id=p.brand_id', 'left')
            ->join('product_models m', 'm.id=p.model_id', 'left')
            ->join('product_types t', 't.id=p.type_id', 'left')
            ->join('owners o', 'o.id=p.owner_id', 'left')
            ->join('users u', 'u.id=s.tech_user_id', 'left')
            ->where('s.service_code', $query)
            ->or_where('p.code', $query)
            ->limit($limit, $start)
            ->order_by('s.date_serv', 'DESC')
            ->get('main_services s')
            ->result();
        return $rs;
    }

    public function search_service_by_code_history($product_id)
    {
        $rs = $this->db
            ->select(array('s.*', 'u.fullname as tech_name'))
            ->join('users u', 'u.id=s.tech_user_id', 'left')
            ->where('s.product_id', $product_id)
            ->order_by('s.date_serv', 'DESC')
            ->get('main_services s')
            ->result();
        return $rs;
    }
    public function get_search_service_by_code_total($query){
        $rs = $this->db
            ->where('s.service_code', $query)
            ->or_where('p.code', $query)
            ->join('products p', 'p.id=s.product_id', 'left')
            ->count_all_results('main_services s');
        return $rs;
    }
    //

    public function search_service_by_other_list($query, $start, $limit)
    {
        $rs = $this->db
                ->select(array(
                        'o.name as owner_name', 's.*', 'u.fullname as tech_name'
                    ))
                ->join('owners o', 'o.id=s.owner_id', 'left')
                ->join('users u', 'u.id=s.tech_user_id', 'left')
                ->where('s.service_code', $query)
                ->limit($limit, $start)
                ->order_by('s.date_serv', 'DESC')
                ->get('other_services s')
                ->result();
            return $rs;
    }
    /*
    * Get ohter list
    */
    public function get_service_by_other_list($status, $start, $limit)
    {
        if($status == '0'){
            $rs = $this->db
                ->select(array(
                        'o.name as owner_name', 's.*','u.fullname as tech_name'
                    ))
                ->join('owners o', 'o.id=s.owner_id', 'left')
                ->join('users u', 'u.id=s.tech_user_id', 'left')
                ->limit($limit, $start)
                ->order_by('s.date_serv', 'DESC')
                ->get('other_services s')
                ->result();
            return $rs;
        }else{
            $rs = $this->db
                ->select(array(
                        'o.name as owner_name', 's.*', 'u.fullname as tech_name'
                    ))
                ->join('owners o', 'o.id=s.owner_id', 'left')
                ->join('users u', 'u.id=s.tech_user_id', 'left')
                ->where('s.service_status', $status)
                ->limit($limit, $start)
                ->order_by('s.date_serv', 'DESC')
                ->get('other_services s')
                ->result();
            return $rs;
        }
    }

    public function get_service_by_other_total($status){
        if($status == '0'){
            $rs = $this->db->count_all_results('other_services');
            return $rs;
        }else{
            $rs = $this->db->where('service_status', $status)
                ->count_all_results('other_services');
            return $rs;
        }
    }

    public function save_code_result($id, $detail){
        $rs = $this->db->where('id', $id)
            ->set('service_result', $detail)
            ->update('main_services');
        return $rs;
    }
     public function save_other_result($id, $detail){
        $rs = $this->db->where('id', $id)
            ->set('service_result', $detail)
            ->update('other_services');
        return $rs;
    }

    public function get_code_result($id){
        $rs = $this->db->where('id', $id)->get('main_services')->row();
        return $rs->service_result;
    }

    public function get_other_result($id){
        $rs = $this->db->where('id', $id)->get('other_services')->row();
        return $rs->service_result;
    }

    public function get_search_service_by_other_total($query){
        $rs = $this->db->where('service_code', $query)->count_all_results('other_services');
        return $rs;
    }

    public function remove_service_code($service_code){
        $rs = $this->db->where('service_code', $service_code)->delete('main_services');
        return $rs;
    }
    public function remove_service_other($service_code){
        $rs = $this->db->where('service_code', $service_code)->delete('other_services');
        return $rs;
    }

    public function do_discharge_main($service_code){
    	$rs = $this->db->where('service_code', $service_code)
			->set('discharge_status', '1')
			->update('main_services');
		return $rs;
    }

    public function do_discharge_other($service_code){
    	$rs = $this->db->where('service_code', $service_code)
			->set('discharge_status', '1')
			->update('other_services');
		return $rs;
    }
    public function undo_discharge_main($service_code){
    	$rs = $this->db->where('service_code', $service_code)
			->set('discharge_status', '0')
			->update('main_services');
		return $rs;
    }

    public function undo_discharge_other($service_code){
    	$rs = $this->db->where('service_code', $service_code)
			->set('discharge_status', '0')
			->update('other_services');
		return $rs;
    }

    public function save_discharge($data){
    	$rs = $this->db
    				->set('service_code', $data['sv'])
    				->set('discharge_date', to_mysql_date($data['discharge_date']))
    				->set('user_id', $data['user_id'])
    				->insert('service_discharges');
    	return $rs;
    }

    public function update_discharge_status($sv, $status){
    	$rs = $this->db->where('service_code', $sv)
    					->set('discharge_status', $status)
    					->update('main_services');
    	return $rs;
    }

    public function remove_discharge($sv){
    	$rs = $this->db->where('service_code', $sv)->delete('service_discharges');
    	return $rs;
    }

    public function check_discharge_status($sv){
    	$rs = $this->db->where('service_code', $sv)->count_all_results('service_discharges');

    	return $rs > 0 ? TRUE : FALSE;
    }

    public function save_main_type($data){
    	$rs = $this->db->where('service_code', $data['sv'])
    					->set('service_type_id', $data['type'])
    					->set('type_service_id', $data['type_service'])
    					->update('main_services');
    	return $rs;
    }

    public function save_other_type($data){
    	$rs = $this->db->where('service_code', $data['sv'])
    	->set('service_type_id', $data['type'])
    	->set('type_service_id', $data['type_service'])
    	->update('other_services');
    	return $rs;
    }

    public function save_more_technician($data){
    	$rs = $this->db->set('tech_user_id', $data['tech_user_id'])
    					->set('service_code', $data['sv'])
    					->insert('service_technicians');
    	return $rs;
    }

    public function check_more_technician_exist($sv, $tech_user_id){
    	$rs = $this->db->where('tech_user_id', $tech_user_id)
    					->where('service_code', $sv)
    					->count_all_results('service_technicians');
    	return $rs > 0 ? TRUE : FALSE;
    }

    public function get_more_technicians($sv){
    	$rs = $this->db->select(array('u.id', 'u.username', 'u.fullname'))
    					->join('users u', 'u.id=t.tech_user_id', 'left')
    					->where('t.service_code', $sv)
    					->get('service_technicians t')
    					->result();
    	return $rs;
    }



}
