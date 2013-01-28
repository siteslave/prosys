<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends CI_Model
{
    public $user_id;

    public function search_reg_product($query)
    {
        $rs = $this->db
            ->select(array(
                        'p.code', 'p.name', 'p.id', 'p.product_serial', 'p.purchase_date', 'o.name as owner_name',
                        'b.name as brand_name', 'm.name as model_name', 't.name as type_name'
                    ))
            ->join('product_brands b', 'b.id=p.brand_id', 'left')
            ->join('product_models m', 'm.id=p.model_id', 'left')
            ->join('product_types t', 't.id=p.type_id', 'left')
            ->join('owners o', 'o.id=p.owner_id', 'left')
            ->like('p.name', $query, 'both')
            ->or_like('p.code', $query, 'both')
            ->limit(20)
            ->order_by('p.name', 'DESC')
            ->get('products p')
            ->result();
        return $rs;
    }



    public function save_reg_product($data){

        date_default_timezone_set('Asia/Bangkok');

        $rs = $this->db
            ->set('service_code', $data['service_code'])
            ->set('product_id', $data['product_id'])
            ->set('report_user_id', $data['user_id'])
            ->set('date_serv', date('Y-m-d'))
            ->set('time_serv', date('H:i:s'))
            ->set('cause', $data['cause'])
            ->set('comment', $data['comment'])
            ->set('contact_name', $data['contact_name'])
            ->set('service_status', '1')
            ->set('priority_id', $data['priority'])
            ->insert('main_services');

        return $rs;

    }


    public function save_other_product($data){

        date_default_timezone_set('Asia/Bangkok');

        $rs = $this->db
            ->set('service_code', $data['service_code'])
            ->set('product_name', $data['product_name'])
			->set('owner_id', $data['owner_id'])
            ->set('report_user_id', $data['user_id'])
            ->set('date_serv', date('Y-m-d'))
            ->set('time_serv', date('H:i:s'))
            ->set('cause', $data['cause'])
            ->set('comment', $data['comment'])
            ->set('contact_name', $data['contact_name'])
            ->set('service_status', '1')
			->set('priority_id', $data['priority_id'])
			->set('product_desc', $data['product_desc'])
            ->insert('other_services');

        return $rs;

    }

	public function update_other_product($data){

		date_default_timezone_set('Asia/Bangkok');

		$rs = $this->db
			->where('id', $data['id'])
            ->set('product_name', $data['product_name'])
			->set('owner_id', $data['owner_id'])
            ->set('cause', $data['cause'])
            ->set('comment', $data['comment'])
			->set('priority_id', $data['priority_id'])
			->set('last_update', date('Y-m-d H:i:s'))
            ->update('other_services');

		return $rs;
	}

    public function get_current_product_status($product_id){
        //SELECT id, service_status FROM `main_services` where product_id=6452 order by id desc limit 1;
        $rs = $this->db
            ->select(array('service_status'))
            ->where('product_id', $product_id)
            //->order_by('id', 'DESC')
            ->limit(1)
            ->get('main_services')
            ->row();

        return $rs ? $rs->service_status : '0';

    }

    public function get_current_product_other_status($id){
        //SELECT id, service_status FROM `main_services` where product_id=6452 order by id desc limit 1;
        $rs = $this->db
            ->select(array('service_status'))
            ->where('id', $id)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get('other_services')
            ->row();

        return $rs ? $rs->service_status : '0';

    }


    public function get_service_by_code_list($status, $start, $limit)
    {
        if($status == '0'){
        	$rs = $this->db
	            ->select(array(
	            'p.code as product_code', 'p.name as product_name', 'p.id as product_id', 'p.product_serial', 'p.purchase_date', 'o.name as owner_name',
	            'b.name as brand_name', 'm.name as model_name', 't.name as type_name', 's.*'
	        		))
	            ->join('products p', 'p.id=s.product_id', 'left')
	            ->join('product_brands b', 'b.id=p.brand_id', 'left')
	            ->join('product_models m', 'm.id=p.model_id', 'left')
	            ->join('product_types t', 't.id=p.type_id', 'left')
	            ->join('owners o', 'o.id=p.owner_id', 'left')
	            ->where('s.report_user_id', $this->user_id)
	            ->limit($limit, $start)
	            ->order_by('s.date_serv', 'DESC')
	            ->get('main_services s')
	            ->result();
	        return $rs;
        }else{
        	$rs = $this->db
	            ->select(array(
	            'p.code as product_code', 'p.name as product_name', 'p.id as product_id', 'p.product_serial', 'p.purchase_date', 'o.name as owner_name',
	            'b.name as brand_name', 'm.name as model_name', 't.name as type_name', 's.*'
	        		))
	            ->join('products p', 'p.id=s.product_id', 'left')
	            ->join('product_brands b', 'b.id=p.brand_id', 'left')
	            ->join('product_models m', 'm.id=p.model_id', 'left')
	            ->join('product_types t', 't.id=p.type_id', 'left')
	            ->join('owners o', 'o.id=p.owner_id', 'left')
	            ->where('s.report_user_id', $this->user_id)
				->where('s.service_status', $status)
	            ->limit($limit, $start)
	            ->order_by('s.date_serv', 'DESC')
	            ->get('main_services s')
	            ->result();
	        return $rs;
        }
    }


    public function get_service_by_other_list($status, $start, $limit)
    {
     	if($status == '0'){
     		$rs = $this->db
	            ->select(array(
	            		'o.name as owner_name', 's.*'
	        		))
	            ->join('owners o', 'o.id=s.owner_id', 'left')
	            ->where('s.report_user_id', $this->user_id)
	            ->limit($limit, $start)
	            ->order_by('s.date_serv', 'DESC')
	            ->get('other_services s')
	            ->result();
	        return $rs;
     	}else{
     		$rs = $this->db
	            ->select(array(
	            		'o.name as owner_name', 's.*'
	        		))
	            ->join('owners o', 'o.id=s.owner_id', 'left')
	            ->where('s.report_user_id', $this->user_id)
				->where('s.service_status', $status)
	            ->limit($limit, $start)
	            ->order_by('s.date_serv', 'DESC')
	            ->get('other_services s')
	            ->result();
	        return $rs;
     	}
    }


    public function get_service_by_code_total($status){
    	if($status == '0'){
    		$rs = $this->db
	        	->where('report_user_id', $this->user_id)
	        	->count_all_results('main_services');
        	return $rs;
    	}else{
    		$rs = $this->db
	        	->where('report_user_id', $this->user_id)
				->where('service_status', $status)
	        	->count_all_results('main_services');
	        return $rs;
    	}

    }

	public function get_service_by_other_total($status){
        if($status == '0'){
    		$rs = $this->db
	        	->where('report_user_id', $this->user_id)
	        	->count_all_results('other_services');
        	return $rs;
    	}else{
    		$rs = $this->db
	        	->where('report_user_id', $this->user_id)
				->where('service_status', $status)
	        	->count_all_results('other_services');
	        return $rs;
    	}
    }



	public function get_search_service_by_other_list($query, $start, $limit)
    {
        $rs = $this->db
            ->select(array(
            		'o.name as owner_name', 's.*'
        		))
            ->join('owners o', 'o.id=s.owner_id', 'left')
			->where('s.service_code', $query)
            ->where('s.report_user_id', $this->user_id)
            ->limit($limit, $start)
            ->order_by('s.date_serv', 'DESC')
            ->get('other_services s')
            ->result();
        return $rs;
    }

    public function get_search_service_by_other_total($query){
        $rs = $this->db
            ->where('s.service_code', $query)
			->where('s.report_user_id', $this->user_id)
            ->count_all_results('other_services s');
        return $rs;
    }



	public function get_search_service_by_code_list($query, $start, $limit)
    {
        	$rs = $this->db
	            ->select(array(
	            'p.code as product_code', 'p.name as product_name', 'p.id as product_id', 'p.product_serial', 'p.purchase_date', 'o.name as owner_name',
	            'b.name as brand_name', 'm.name as model_name', 't.name as type_name', 's.*'
	        		))
	            ->join('products p', 'p.id=s.product_id', 'left')
	            ->join('product_brands b', 'b.id=p.brand_id', 'left')
	            ->join('product_models m', 'm.id=p.model_id', 'left')
	            ->join('product_types t', 't.id=p.type_id', 'left')
	            ->join('owners o', 'o.id=p.owner_id', 'left')
	            ->where('s.report_user_id', $this->user_id)
				->where('s.service_code', $query)
				->or_where('p.code', $query)
	            ->limit($limit, $start)
	            ->order_by('s.date_serv', 'DESC')
	            ->get('main_services s')
	            ->result();
	        return $rs;
    }

    public function get_search_service_by_code_total($query){

        $rs = $this->db
        	->join('products p', 'p.id=s.product_id', 'left')
			->where('s.report_user_id', $this->user_id)
            ->where('s.service_code', $query)
			->or_where('p.code', $query)
            ->count_all_results('main_services s');
        return $rs;
    }

    public function check_discharged($id){
    	$rs = $this->db->where('discharge_status', '0')
    					->where('product_id', $id)
    					->count_all_results('main_services');

    	return $rs > 0 ? FALSE : TRUE;
    }
}