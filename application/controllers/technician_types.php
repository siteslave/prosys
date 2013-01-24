<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Technician_types extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));

        $user_type = $this->session->userdata('user_type');
        if($user_type != '3') redirect(site_url('errors/access_denied'));

        $this->load->model('Technician_type_model', 'ttm');
    }

    public function index()
    {
        $this->layout->view('technician_types/index_view');
    }

    public function get_list(){

        $result = $this->ttm->get_list();
        if($result){
            $rows = json_encode($result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }
    public function get_list_total(){

        $total = $this->ttm->get_list_total();
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function save(){
        $data = $this->input->post('data');

        if(empty($data['name'])){
            $json = '{"success": false, "msg": "No data for save."}';
        }else{
            if(empty($data['id'])){
                $duplicated = $this->ttm->check_duplicate($data['name']);
                if($duplicated){
                    $json = '{"success": false, "msg": "Name duplicated"}';
                }else{
                    $result = $this->ttm->save($data['name']);
                    if($result){
                        $json = '{"success": true, "msg": "inserted"}';
                    }else{
                        $json = '{"success": false, "msg": "Save error."}';
                    }
                }
            }else{
                if($data['name'] == $data['old_name']){
                    //update
                    $result = $this->ttm->update($data);
                    if($result){
                        $json = '{"success": true, "msg": "updated"}';
                    }else{
                        $json = '{"success": false, "msg": "Save error."}';
                    }
                }else{
                    //check duplicate
                    $duplicated = $this->ttm->check_duplicate($data['name']);
                    if($duplicated){
                        $json = '{"success": false, "msg": "Name duplicated"}';
                    }else{
                        $result = $this->ttm->update($data);
                        if($result){
                            $json = '{"success": true, "msg": "updated"}';
                        }else{
                            $json = '{"success": false, "msg": "Save error."}';
                        }
                    }
                }
            }

        }
        render_json($json);
    }

    public function remove(){
        $id = $this->input->post('id');
        if(empty($id)){
            $json = '{"success": false, "msg": "No id found."}';
        }else{
            $result = $this->ttm->remove($id);
            if($result){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false, "msg": "Database error, please check your data."}';
            }
        }
        render_json($json);
    }

    public function search(){
        $query = $this->input->post('query');
        if(empty($query)){
            $json = '{"success": false, "msg": "No query found."}';
        }else{
            $result = $this->ttm->search($query);

            if($result){
                $rows = json_encode($result);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }

}