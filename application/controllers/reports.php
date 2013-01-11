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

    public function get_service_total(){

        $users = $this->report->get_user_list();

        $arr_result = array();

        foreach($users as $r){
            $obj = new stdClass();
            $obj->username = $r->username;
            $obj->fullname = $r->fullname;
            $obj->total_m = $this->report->get_mservice_total($r->id);
            $obj->total_o = $this->report->get_oservice_total($r->id);

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

        $s = empty($s) ? date('Y-m-d') : to_mysql_date($s);
        $e = empty($e) ? date('Y-m-d') : to_mysql_date($e);


        $status = get_status_list();

        $arr_result = array();

        foreach($status as $s){
            $obj = new stdClass();

            $obj->name = $s->name;
            $obj->mtotal = $this->report->get_mstatus_total_by_date($s->id, $s, $e);
            $obj->ototal = $this->report->get_ostatus_total_by_date($s->id, $s, $e);

            array_push($arr_result, $obj);

        }

        $rows = json_encode($arr_result);

        $json = '{"success": true, "rows": '. $rows .'}';

        render_json($json);
    }

    public function get_service_total_by_date(){
        $s = $this->input->post('s');
        $e = $this->input->post('e');


        date_default_timezone_set('Asia/Bangkok');

        $s = empty($s) ? date('Y-m-d') : to_mysql_date($s);
        $e = empty($e) ? date('Y-m-d') : to_mysql_date($e);

        $users = $this->report->get_user_list();

        $arr_result = array();

        foreach($users as $r){
            $obj = new stdClass();
            $obj->username = $r->username;
            $obj->fullname = $r->fullname;
            $obj->total_m = $this->report->get_mservice_total_by_date($r->id, $s, $e);
            $obj->total_o = $this->report->get_oservice_total_by_date($r->id, $s, $e);

            array_push($arr_result, $obj);
        }

        $rows = json_encode($arr_result);

        $json = '{"success": true, "rows": '. $rows .'}';

        render_json($json);

    }


}
