<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Suppliers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));
        

        $user_type = $this->session->userdata('user_type');
        
        if($user_type != '3') redirect(site_url('errors/access_denied'));
        
        
        $this->load->model('Supplier_model', 'supplier');
    }

    public function index()
    {
        $this->layout->view('suppliers/index_view');
    }

    public function get_list(){
    	$start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $result = $this->supplier->get_list($start, $limit);
        
        if($result){
            $rows = json_encode($result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }
    public function get_list_total(){
        
        $total = $this->supplier->get_list_total();
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }
    public function save(){
        $data = $this->input->post('data');

        if(empty($data['name'])){
            $json = '{"success": false, "msg": "No data for save."}';
        }else{
            if(empty($data['supplier_id'])){
                $duplicated = $this->supplier->check_duplicate($data['name']);
                if($duplicated){
                    $json = '{"success": false, "msg": "Name duplicated"}';
                }else{
                    $result = $this->supplier->save($data['name']);
                    if($result){
                        $json = '{"success": true, "msg": "inserted"}';
                    }else{
                        $json = '{"success": false, "msg": "Save error."}';
                    }
                }
            }else{
                if($data['name'] == $data['supplier_old_name']){
                    //update
                    $result = $this->supplier->update($data);
                    if($result){
                        $json = '{"success": true, "msg": "updated"}';
                    }else{
                        $json = '{"success": false, "msg": "Save error."}';
                    }
                }else{
                    //check duplicate
                    $duplicated = $this->supplier->check_duplicate($data['name']);
                    if($duplicated){
                        $json = '{"success": false, "msg": "Name duplicated"}';
                    }else{
                        $result = $this->supplier->update($data);
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
            $result = $this->supplier->remove($id);
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
            $result = $this->supplier->search($query);

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