<?php
class Send_model extends CI_Model{

	public function search_service($query){
		$rs = $this->db
				->select(array('p.name as product_name', 'p.code as product_code', 's.*', 'o.name as owner_name'))
				->join('products p', 'p.id=s.product_id', 'left')
				->join('owners o', 'o.id=p.owner_id', 'left')
				->where('s.service_code', $query)
				->limit(20)
				->get('main_services s')->result();
		return $rs;
	}

	public function search_company($query){
		$rs = $this->db
			->like('name', $query, 'both')
			->limit(20)
			->get('suppliers')
			->result();
		return $rs;
	}

	public function save($data){
		$rs = $this->db
			->set('service_code', $data['service_code'])
			->set('send_code', $data['send_code'])
			->set('send_date', $data['send_date'])
			->set('company_id', $data['company_id'])
			->set('tech_user_id', $data['user_id'])
			->set('comment', $data['comment'])
			->set('place', $data['place'])
			->insert('send_services');
		return $rs;
	}

	public function check_ready($sv){
		$rs = $this->db
				->where('service_code', $sv)
				->where('send_status', '0')
				->count_all_results('send_services');
		return $rs > 0 ? FALSE : TRUE;
	}


	public function get_list_status($status, $limit, $start){
		if($status == '-1'){
			$rs = $this->db
				->select(array(
					's.*', 'ms.date_serv', 'c.name as company_name',
					'p.code as product_code, p.name as product_name',
					'u.fullname as tech_name'
				))
				->join('suppliers c', 'c.id=s.company_id', 'left')
				->join('main_services ms', 'ms.service_code=s.service_code', 'left')
				->join('products p', 'p.id=ms.product_id', 'left')
				->join('users u', 'u.id=s.tech_user_id', 'left')
				->order_by('s.send_date')
				->limit($limit, $start)
				->get('send_services s')
				->result();
		}else{
			$rs = $this->db
				->select(array(
					's.*', 'ms.date_serv', 'c.name as company_name',
					'p.code as product_code, p.name as product_name',
					'u.fullname as tech_name'
				))
				->join('suppliers c', 'c.id=s.company_id', 'left')
				->join('main_services ms', 'ms.service_code=s.service_code', 'left')
				->join('products p', 'p.id=ms.product_id', 'left')
				->join('users u', 'u.id=s.tech_user_id', 'left')
				->where('s.send_status', $status)
				->order_by('s.send_date')
				->limit($limit, $start)
				->get('send_services s')
				->result();
		}
		return $rs;
	}

	public function get_list_status_total($status){
		if($status == '-1'){
			$rs = $this->db
				->count_all_results('send_services');
		}else{
			$rs = $this->db
				->where('send_status', $status)
				->count_all_results('send_services');
		}

		return $rs;
	}

	public function search($query, $limit, $start){
		$rs = $this->db
				->select(array(
					's.*', 'ms.date_serv', 'c.name as company_name',
					'p.code as product_code, p.name as product_name',
					'u.fullname as tech_name'
				))
				->join('suppliers c', 'c.id=s.company_id', 'left')
				->join('main_services ms', 'ms.service_code=s.service_code', 'left')
				->join('products p', 'p.id=ms.product_id', 'left')
				->join('users u', 'u.id=s.tech_user_id', 'left')
				->where('s.send_code', $query)
				->or_where('s.service_code', $query)
				->order_by('s.send_date')
				->limit($limit, $start)
				->get('send_services s')
				->result();

		return $rs;
	}


	public function search_total($query){
		$rs = $this->db
				->where('s.send_code', $query)
				->or_where('s.service_code', $query)
				->order_by('s.send_date')
				->count_all_results('send_services s');

		return $rs;
	}

	public function update($data){
		$rs = $this->db
				->where('id', $data['id'])
				->set('company_id', $data['company_id'])
				->set('send_date', to_mysql_date($data['send_date']))
				->set('comment', $data['comment'])
				->set('place', $data['place'])
				->update('send_services');
		return $rs;
	}

	public function save_get($data){
		$rs = $this->db
				->where('id', $data['id'])
				->set('get_date', to_mysql_date($data['get_date']))
				->set('get_user_id', $data['user_id'])
				->set('get_comment', $data['comment'])
				->set('send_status', '1')
				->update('send_services');

		return $rs;
	}

	public function remove_get($data){

		date_default_timezone_set('Asia/Bangkok');

		$rs = $this->db
				->where('id', $data['id'])
				->set('get_date', '')
				->set('get_user_id', '')
				->set('get_comment', '')
				->set('remove_date', date('Y-m-d'))
				->set('remove_comment', $data['comment'])
				->set('send_status', '0')
				->update('send_services');

		return $rs;
	}

	public function remove($id){
		$rs = $this->db->where('id', $id)->delete('send_services');
		return $rs;
	}
}
