<?php

class Sends extends CI_Controller{

	public $user_id;

	public function __construct()
    {
        parent::__construct();

        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));

        $user_type = $this->session->userdata('user_type');

        if($user_type != '3') redirect(site_url('errors/access_denied'));

		$this->user_id = $this->session->userdata('user_id');

        $this->load->model('Product_model', 'product');
		$this->load->model('Send_model', 'send');
		$this->load->model('Service_model', 'service');
    }

	public function index(){
		$this->layout->view('sends/index_view');
	}
	//------------------------------------------------------------------------------------------------------------------
	/*
	 * Search service
	 *
	 * @param	string	The query string for search
	 */
	public function search_service(){
		$query = $this->input->post('query');
		if(empty($query)){
			$json = '{"success": false, "msg": "No query found."}';
		}else{
			$rs = $this->send->search_service($query);

			if($rs){
				$rows = json_encode($rs);
				$json = '{"success": true, "rows": '.$rows.'}';
			}else{
				$json = '{"success": false, "msg": "No result."}';
			}
		}

		render_json($json);
	}

	//------------------------------------------------------------------------------------------------------------------
	/*
	 * Search company
	 *
	 * @param	string	The query string for search
	 */
	public function search_company(){
		$query = $this->input->post('query');
		if(empty($query)){
			$json = '{"success": false, "msg": "No query found."}';
		}else{
			$rs = $this->send->search_company($query);

			if($rs){
				$rows = json_encode($rs);
				$json = '{"success": true, "rows": '.$rows.'}';
			}else{
				$json = '{"success": false, "msg": "No result."}';
			}
		}

		render_json($json);
	}
	//------------------------------------------------------------------------------------------------------------------
	/*
	 * Save send data
	 *
	 * @param	array	The array of data for save.
	 */
	public function save(){
		$data = $this->input->post('data');
		if(!empty($data['id'])){
			$rs = $this->send->update($data);
			if($rs){
				$this->service->user_id = $this->user_id;
				$detail = '	แก้ไขข้อมูล -> ส่งซ่อม';
				$this->service->save_activities($data['service_code'], $detail);
				$json = '{"success": true}';
			}else{
				$json = '{"success": false, "msg": "Can\t update data."}';
			}
		}else{
			//check send exist
			$ready = $this->send->check_ready($data['service_code']);
			if(!$ready){
				$json = '{"success": false, "msg": "รายการนี้ยังไม่มีการรับกลับคืน กรุณาตรวจสอบ"}';
			}else{
				$data['send_code'] = generate_serial('SEND_SERVICE', TRUE);
				$data['send_date'] = to_mysql_date($data['send_date']);
				$data['user_id'] = $this->session->userdata('user_id');

				$rs = $this->send->save($data);
				if($rs){
					$this->service->user_id = $this->user_id;
					$detail = 'ส่งซ่อม -> ' . get_company_name($data['company_id']);
					$this->service->save_activities($data['service_code'], $detail);

					if($data['change_status'] == '1'){
						$detail = '	เปลี่ยนสถานะซ่อม -> ส่งซ่อม';
						$this->service->save_activities($data['service_code'], $detail);
						$this->service->change_service_status($data['service_code'], '5');
					}
					$json = '{"success": true}';
				}else{
					$json = '{"success": false, "msg": "Can\'t save service."}';
				}
			}
		}

		render_json($json);
	}

	public function get_list_status(){
		$start = $this->input->post('start');
        $stop = $this->input->post('stop');
        $status = $this->input->post('status');

        $this->status = empty($status) ? '0' : $status;

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

		$rs = $this->send->get_list_status($status, $limit, $start);
		if($rs){
			$rows = json_encode($rs);
			$json = '{"success": true, "rows": '. $rows .'}';
		}else{
			$json = '{"success": false, "msg": "No result."}';
		}

		render_json($json);
	}

	public function get_list_status_total(){
		$status = $this->input->post('status');
		$status = empty($status) || isset($status) ? '-1' : $status;
		//-1 = all
		$rs = $this->send->get_list_status_total($status);
		if($rs){
			$json = '{"success": true, "total": '. $rs .'}';
		}else{
			$json = '{"success": true, "total": 0}';
		}

		render_json($json);
	}

	public function search_total(){
		$query = $this->input->post('query');
		$rs = $this->send->search_total($query);
		if($rs){
			$json = '{"success": true, "total": '. $rs .'}';
		}else{
			$json = '{"success": true, "total": 0}';
		}

		render_json($json);
	}
 	public function search(){
		$query = $this->input->post('query');
		$start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

		if(empty($query)){
			$json = '{"success": false, "msg": "No query found."}';
		}else{
			$rs = $this->send->search($query, $limit, $start);

			if($rs){
				$rows = json_encode($rs);
				$json = '{"success": true, "rows": '.$rows.'}';
			}else{
				$json = '{"success": false, "msg": "No result."}';
			}
		}

		render_json($json);
	}

	public function update($data){

		if(empty($data)){
			$json = '{"success": false, "msg": "No data for save."}';
		}else{
			$rs = $this->send->update($data);
			if($rs){
				$this->service->user_id = $this->user_id;
				$detail = '	แก้ไขข้อมูล -> ส่งซ่อม';
            	$this->service->save_activities($data['service_code'], $detail);
				$json = '{"success": true}';
			}else{
				$json = '{"success": false, "msg": "Can\t update data."}';
			}
		}

		render_json($json);
	}

	public function save_get(){
		$data = $this->input->post('data');

		if(empty($data)){
			$json = '{"success": false, "msg": "No data for save."}';
		}else{
			$data['user_id'] = $this->user_id;
			$rs = $this->send->save_get($data);
			if($rs){
                $this->service->user_id = $this->user_id;
				$detail = 'รับกลับ -> ส่งซ่อม';
            	$this->service->save_activities($data['sv'], $detail);
				$json = '{"success": true}';
			}else{
				$json = '{"success": false, "msg": "Can\t update data."}';
			}
		}

		render_json($json);
	}

	public function remove_get(){

		$data = $this->input->post('data');

		if(empty($data)){

			$json = '{"success": false, "msg": "No data for save."}';

		}else{

			$data['user_id'] = $this->user_id;

			$rs = $this->send->remove_get($data);

			if($rs){
                $this->service->user_id = $this->user_id;
				$detail = 'รับกลับ -> ลบข้อมูล';
            	$this->service->save_activities($data['sv'], $detail);
				$json = '{"success": true}';
			}else{
				$json = '{"success": false, "msg": "Can\t remove data."}';
			}
		}

		render_json($json);
	}

	public function remove(){

		$id = $this->input->post('id');
		$sv = $this->input->post('sv');

		if(empty($id)){

			$json = '{"success": false, "msg": "No id found."}';

		}else{

			$data['user_id'] = $this->user_id;

			$rs = $this->send->remove($id);

			if($rs){
                $this->service->user_id = $this->user_id;
				$detail = 'รับกลับ -> ลบรายการ';
            	$this->service->save_activities($sv, $detail);
				$json = '{"success": true}';
			}else{
				$json = '{"success": false, "msg": "Can\t remove data."}';
			}
		}

		render_json($json);
	}

}
