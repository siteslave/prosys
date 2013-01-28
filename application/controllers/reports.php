<?php

class Reports extends CI_Controller {

    var $user_id;

    public function __construct(){

        parent::__construct();

        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));

        $this->user_id = $this->session->userdata('user_id');

        $this->load->model('Report_model', 'report');
        $this->load->model('Service_model', 'service');

    }

    public function index()
    {
    	$this->layout->view('reports/index_view');
    }

    public function get_service_total(){

        $users = $this->report->get_user_list();

        $arr_result = array();

        foreach($users as $r){
            $obj = new stdClass();
            $obj->username = $r->username;
            $obj->fullname = $r->fullname;
            $obj->total_m = $this->report->get_mservice_total($r->id);
            $obj->total_o = $this->report->get_oservice_total($r->id);
            $obj->total_more = $this->report->get_total_more_technician($r->id);

            array_push($arr_result, $obj);
        }

        $rows = json_encode($arr_result);

        $json = '{"success": true, "rows": '. $rows .'}';

        render_json($json);
    }



    public function get_status_total(){

        $status = get_status_list();

        $arr_result = array();

        foreach($status as $s){
            $obj = new stdClass();

            $obj->name = $s->name;
            $obj->mtotal = $this->report->get_mstatus_total($s->id);
            $obj->ototal = $this->report->get_ostatus_total($s->id);

            array_push($arr_result, $obj);

        }

        $rows = json_encode($arr_result);

        $json = '{"success": true, "rows": '. $rows .'}';

        render_json($json);
    }


    public function get_status_total_by_date(){

        $s = $this->input->post('s');
        $e = $this->input->post('e');


        date_default_timezone_set('Asia/Bangkok');

        $s = empty($s) ? date('Y-m-d') : $s;
        $e = empty($e) ? date('Y-m-d') : $e;


        $status = get_status_list();

        $arr_result = array();

        foreach($status as $r){
            $obj = new stdClass();

            $obj->name = $r->name;
            $obj->mtotal = $this->report->get_mstatus_total_by_date($r->id, $s, $e);
            $obj->ototal = $this->report->get_ostatus_total_by_date($r->id, $s, $e);

            array_push($arr_result, $obj);

        }

        $rows = json_encode($arr_result);

        $json = '{"success": true, "rows": '. $rows .'}';

        render_json($json);
    }

    public function get_service_total_by_date(){
        $s = $this->input->post('s');
        $e = $this->input->post('e');


        //date_default_timezone_set('Asia/Bangkok');

        $s = empty($s) ? date('Y-m-d') : $s;
        $e = empty($e) ? date('Y-m-d') : $e;

        $users = $this->report->get_user_list();

        $arr_result = array();

        foreach($users as $r){
            $obj = new stdClass();
            $obj->username = $r->username;
            $obj->fullname = $r->fullname;
            $obj->total_m = $this->report->get_mservice_total_by_date($r->id, $s, $e);
            $obj->total_o = $this->report->get_oservice_total_by_date($r->id, $s, $e);
            $obj->total_more = $this->report->get_total_more_technician_by_date($r->id, $s, $e);

            array_push($arr_result, $obj);
        }

        $rows = json_encode($arr_result);

        $json = '{"success": true, "rows": '. $rows .'}';

        render_json($json);

    }

    public function get_service_type_by_technician(){
    	$user_id = $this->input->post('user_id');
    	$s = $this->input->post('s');
    	$e = $this->input->post('e');

    	if(empty($user_id)){
    		$json = '{"success": false, "msg": "No user id found."}';
    	}else if(empty($s)){
    		$json = '{"success": false, "msg": "กรุณาระบุวันที่เริ่มต้น"}';
    	}else if(empty($e)){
    		$json = '{"success": false, "msg": "กรุณาระบุวันที่สิ้นสุด"}';
    	}else{

    		$rec = get_type_of_service();
    		$arr_result = array();

    		foreach($rec as $r){
    			$obj = new stdClass();
    			$obj->type_name = get_type_name($r->id);
    			$obj->total_m = $this->report->get_total_svt_main($user_id, $r->id, $s, $e);
    			$obj->total_o = $this->report->get_total_svt_other($user_id, $r->id, $s, $e);

    			array_push($arr_result, $obj);

    		}

    		$rows = json_encode($arr_result);
    		$json = '{"success": true, "rows": '.$rows.'}';
    	}

    	render_json($json);
    }

    public function get_service_type_by_technician_main(){
    	$user_id = $this->input->post('user_id');
    	$s = $this->input->post('s');
    	$e = $this->input->post('e');

    	if(empty($user_id)){
    		$json = '{"success": false, "msg": "No user id found."}';
    	}else if(empty($s)){
    		$json = '{"success": false, "msg": "กรุณาระบุวันที่เริ่มต้น"}';
    	}else if(empty($e)){
    		$json = '{"success": false, "msg": "กรุณาระบุวันที่สิ้นสุด"}';
    	}else{
    		$rs = $this->report->get_service_type_by_technician_main($user_id, $s, $e);
    		if($rs){
    			$arr_result = array();
    			foreach($rs as $r){
    				$obj = new stdClass();
    				$obj->type_name = get_type_name($r->service_type_id);
    				$obj->total = $r->t;

    				array_push($arr_result, $obj);
    			}

    			$rows = json_encode($arr_result);
    			$json = '{"success": true, "rows": '.$rows.'}';

    		}else{
    			$json = '{"success": false, "msg": "No result."}';
    		}

    	}

    	render_json($json);
    }

    public function get_service_type_by_technician_other(){
    	$user_id = $this->input->post('user_id');
    	$s = $this->input->post('s');
    	$e = $this->input->post('e');

    	if(empty($user_id)){
    		$json = '{"success": false, "msg": "No user id found."}';
    	}else if(empty($s)){
    		$json = '{"success": false, "msg": "กรุณาระบุวันที่เริ่มต้น"}';
    	}else if(empty($e)){
    		$json = '{"success": false, "msg": "กรุณาระบุวันที่สิ้นสุด"}';
    	}else{
    		$rs = $this->report->get_service_type_by_technician_other($user_id, $s, $e);
    		if($rs){
    			$arr_result = array();
    			foreach($rs as $r){
    				$obj = new stdClass();
    				$obj->type_name = get_type_name($r->service_type_id);
    				$obj->total = $r->t;

    				array_push($arr_result, $obj);
    			}

    			$rows = json_encode($arr_result);
    			$json = '{"success": true, "rows": '.$rows.'}';

    		}else{
    			$json = '{"success": false, "msg": "No result."}';
    		}

    	}

    	render_json($json);
    }

    public function get_send_place(){
    	$s = $this->input->post('s');
    	$e = $this->input->post('e');

    	if(empty($s)){
    		$json = '{"success": false, "msg": "กรุณาระบุวันที่เริ่มต้น"}';
    	}else if(empty($e)){
    		$json = '{"success": false, "msg": "กรุณาระบุวันที่สิ้นสุด"}';
    	}else{
    		$rs = $this->report->get_send_place($s, $e);
    		if($rs){
    			$arr_result = array();
    			foreach($rs as $r){
    				$obj = new stdClass();
    				$obj->place = $r->place == '1' ? 'ในจังหวัด' : 'นอกจังหวัด';
    				$obj->total = $r->t;

    				array_push($arr_result, $obj);
    			}

    			$rows = json_encode($arr_result);
    			$json = '{"success": true, "rows": '.$rows.'}';

    		}else{
    			$json = '{"success": false, "msg": "No result."}';
    		}

    	}

    	render_json($json);
    }

    public function get_tos(){
    	$s = $this->input->post('s');
    	$e = $this->input->post('e');

    	if(empty($s))
    	{
    		$json = '{"success": false, "msg": "กรุณาระบุวันที่เริ่มต้น"}';
    	}
    	else if(empty($e))
    	{
    		$json = '{"success": false, "msg": "กรุณาระบุวันที่สิ้นสุด"}';
    	}
    	else
    	{
			$tos = get_type_of_service();

			$arr_result = array();

			foreach ($tos as $r)
			{
				$obj = new stdClass();
				$obj->name = $r->name;
				$obj->id = $r->id;
				$obj->total_m = $this->report->get_tos_main($r->id, $s, $e);
				$obj->total_o = $this->report->get_tos_other($r->id, $s, $e);
				array_push($arr_result, $obj);
			}

			$rows = json_encode($arr_result);
			$json = '{"success": true, "rows": '.$rows.'}';

    	}

    	render_json($json);
    }

    public function get_tos_status(){
    	$s = $this->input->post('s');
    	$e = $this->input->post('e');
    	$id = $this->input->post('id');

    	if(empty($s))
    	{
    		$json = '{"success": false, "msg": "กรุณาระบุวันที่เริ่มต้น"}';
    	}
    	else if(empty($e))
    	{
    		$json = '{"success": false, "msg": "กรุณาระบุวันที่สิ้นสุด"}';
    	}
    	else if(empty($id))
    	{
    		$json = '{"success": false, "msg": "ไม่พบรหัสประเภทงานซ่อม"}';
    	}
    	else
    	{
    		$status = get_status_list();

    		$arr_result = array();

    		foreach ($status as $r)
    		{
    			$obj = new stdClass();
    			$obj->name = $r->name;
    			$obj->total_m = $this->report->get_tos_main_status($id, $r->id, $s, $e);
    			$obj->total_o = $this->report->get_tos_other_status($id, $r->id, $s, $e);
    			array_push($arr_result, $obj);
    		}

    		$rows = json_encode($arr_result);
    		$json = '{"success": true, "rows": '.$rows.'}';

    	}

    	render_json($json);
    }

    public function get_tos_svt(){
    	$s = $this->input->post('s');
    	$e = $this->input->post('e');
    	$id = $this->input->post('id');

    	if(empty($s))
    	{
    		$json = '{"success": false, "msg": "กรุณาระบุวันที่เริ่มต้น"}';
    	}
    	else if(empty($e))
    	{
    		$json = '{"success": false, "msg": "กรุณาระบุวันที่สิ้นสุด"}';
    	}
    	else if(empty($id))
    	{
    		$json = '{"success": false, "msg": "ไม่พบรหัสประเภทงานซ่อม"}';
    	}
    	else
    	{
    		$svt = get_service_type_list();

    		$arr_result = array();

    		foreach ($svt as $r)
    		{
    			$obj = new stdClass();
    			$obj->name = $r->name;
    			$obj->total_m = $this->report->get_tos_main_svt($id, $r->id, $s, $e);
    			$obj->total_o = $this->report->get_tos_other_svt($id, $r->id, $s, $e);
    			array_push($arr_result, $obj);
    		}

    		$rows = json_encode($arr_result);
    		$json = '{"success": true, "rows": '.$rows.'}';

    	}

    	render_json($json);
    }

    public function idx_get_total()
    {
    	$data = $this->input->post('data');

    	if(empty($data))
    	{
    		$json = '{"success": false, "msg": "ไม่พบเงื่อนไขการค้นหา"}';
    	}
    	else
    	{
    		if(empty($data['s']))
    		{
    			$json = '{"success": false, "msg": "กรุณาระบุวันที่เริ่มต้น"}';
    		}
    		else if(empty($data['e']))
    		{
    			$json = '{"success": false, "msg": "กรุณาระบุวันที่สิ้นสุด"}';
    		}
    		else
    		{
    			if($data['t'] == '1')
    			{
    				$rs = $this->report->get_total_list_all_main(to_mysql_date($data['s']), to_mysql_date($data['e']), $data['d'], $data['tos']);
    			}
    			else
    			{
    				$rs = $this->report->get_total_list_all_other(to_mysql_date($data['s']), to_mysql_date($data['e']), $data['d'], $data['tos']);
    			}

    			if($rs)
    			{
    				$rows = json_encode($rs);
    				$json = '{"success": true, "rows": '.$rows.'}';
    			}
    			else
    			{
    				$json = '{"success": false, "msg": "ไม่พบข้อมูล"}';
    			}
    		}
    	}

    	render_json($json);
    }
}
