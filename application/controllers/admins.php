<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));

        $user_type = $this->session->userdata('user_type');

        if($user_type != '3') redirect(site_url('errors/access_denied'));


        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['user_types'] = $this->admin->get_user_type();
        $data['owners'] = $this->admin->get_owner();
        $this->layout->view('admins/index_view', $data);
    }

    public function get_list(){

    	$start = $this->input->post('start');
    	$stop = $this->input->post('stop');

    	$start = empty($start) ? 0 : $start;
    	$stop = empty($stop) ? 25 : $stop;

    	$limit = (int) $stop - (int) $start;

        $rs = $this->admin->get_list($start, $limit);
        if($rs){
            $rows = json_encode($rs);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false, "msg": "Database error, please check your data"}';
        }

        render_json($json);
    }

    public function save(){
        $data = $this->input->post('data');
        if(empty($data)){
            $json = '{"success": false, "msg": "No data for save."}';
        }else{
            //update
            if($data['id']){
                $rs = $this->admin->update($data);
                if($rs){
                    $json = '{"success": true, "msg": "updated"}';
                }else{
                    $json = '{"success": false, "msg": "Can\'t save data, please check your data and try again."}';
                }
            }else{
                $duplicated = $this->admin->check_duplicate($data['username']);
                if($duplicated){
                    $json = '{"success": false, "msg": "Username duplicate, please use another."}';
                }else{
                    $rs = $this->admin->insert($data);
                    if($rs){
                        $json = '{"success": true, "msg": "inserted"}';
                    }else{
                        $json = '{"success": false, "msg": "Can\'t save data, please check your data and try again."}';
                    }
                }
            }
        }

        render_json($json);
    }

    public function get_detail(){
        $id = $this->input->post('id');
        if(empty($id)){
            $json = '{"success": false, "msg": "User id not found."}';
        }else{
            $rs = $this->admin->get_detail($id);
            if($rs){
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No data."}';
            }
        }

        render_json($json);
    }

    public function change_password(){
        $id = $this->input->post('id');
        $password = $this->input->post('password');

        if(empty($id)){
            $json = '{"success": false, "msg": "No user id found."}';
        }else if(empty($password)){
            $json = '{"success": false, "msg": "No new password found."}';
        }else{
            $rs = $this->admin->change_password($id, $password);
            if($rs){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false, "msg": "Can\'t change your password please check your data and try again."}';
            }
        }

        render_json($json);

    }

    public function remove(){
        $id = $this->input->post('id');
        if(empty($id)){
            $json = '{"success": false, "msg": "No user id found."}';
        }else{
            //remove
            $rs = $this->admin->remove($id);
            if($rs){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false, "msg": "Can\'t remove user please check your data and try again."}';
            }
        }

        render_json($json);
    }

    public function get_list_total(){
    	$total = $this->admin->get_list_total();
    	$json = '{"success": true, "total": '.$total.'}';

    	render_json($json);
    }
}