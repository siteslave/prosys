<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));

        $user_type = $this->session->userdata('user_type');

        if($user_type != '3') redirect(site_url('errors/access_denied'));


        $this->load->model('Product_model', 'product');
    }

    public function get_list(){

        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $rs = $this->product->get_list($start, $limit);

        if($rs){

            $rows = json_encode($rs);
            //$total = $this->client->get_service_by_code_total();

            $json = '{"success": true, "rows": '.$rows.'}';

        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }


    public function get_list_total(){

        $total = $this->product->get_total();
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function index()
    {
        //$data['products'] = $this->product->get_list();
        //$data['total'] = $this->product->get_total();
        $data['owners'] = $this->product->get_owner();
        $data['types'] = $this->product->get_type();
        $data['brands'] = $this->product->get_brand();
        $data['models'] = $this->product->get_model();
        $data['suppliers'] = $this->product->get_supplier();

        $this->layout->view('products/index_view', $data);
    }

    public function search_list(){
        $query = $this->input->post('query');

        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        if(empty($query)){
            $json = '{"success": false, "msg": "No query found."}';
        }else{
            $result = $this->product->search($query, $start, $limit);
            if($result){
                $rows = json_encode($result);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }

    public function search_total(){
		$query = $this->input->post('query');
        $total = $this->product->search_total($query);
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function search_filter(){
        $type_id = $this->input->post('type_id');
        $owner_id = $this->input->post('owner_id');

		$start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        if(empty($owner_id)){
            $json = '{"success": false, "msg": "No owner found."}';
        }else{
            $result = $this->product->search_filter($type_id, $owner_id, $start, $limit);
            if($result){
                $rows = json_encode($result);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }

    public function search_filter_total(){
		$type_id = $this->input->post('type_id');
        $owner_id = $this->input->post('owner_id');

        $total = $this->product->search_filter_total($type_id, $owner_id);
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function save(){

        $data['code'] = $this->input->post('code');
        $data['name'] = $this->input->post('name');
        $data['product_serial'] = $this->input->post('product_serial');
        $data['purchase_price'] = $this->input->post('purchase_price');
        $data['purchase_date'] = $this->input->post('purchase_date');
        $data['brand_id'] = $this->input->post('brand_id');
        $data['owner_id'] = $this->input->post('owner_id');
        $data['model_id'] = $this->input->post('model_id');
        $data['type_id'] = $this->input->post('type_id');
        $data['supplier_id'] = $this->input->post('supplier_id');

        if(empty($data)){
            $json = '{"success": false, "msg": "No data for save."}';
        }else{
            //check duplicate product code
            if(!empty($data['code'])){
            	$duplicated = $this->product->check_duplicate($data['code']);
            }else{
            	$duplicated = FALSE;
            }

            if($duplicated){
                $json = '{"success": false, "msg": "รายการนี้มีอยู่แล้วกรุณาตรวจสอบทะเบียนครุภัณฑ์"}';
            }else{
                //do save
                if(empty($data['code'])){
                	$data['code'] = generate_serial('PRODUCT');
                }

                $result = $this->product->save($data);

                if($result){
                    $json = '{"success": true}';
                }else{
                    $json = '{"success": false, "Database error, please check your data and try again."}';
                }
            }
        }

        render_json($json);
    }

    public function update(){

        $data['id'] = $this->input->post('id');
        $data['code'] = $this->input->post('code');
        $data['old_code'] = $this->input->post('old_code');
        $data['name'] = $this->input->post('name');
        $data['product_serial'] = $this->input->post('product_serial');
        $data['purchase_price'] = $this->input->post('purchase_price');
        $data['purchase_date'] = $this->input->post('purchase_date');
        $data['brand_id'] = $this->input->post('brand_id');
        $data['owner_id'] = $this->input->post('owner_id');
        $data['model_id'] = $this->input->post('model_id');
        $data['type_id'] = $this->input->post('type_id');
        $data['supplier_id'] = $this->input->post('supplier_id');

        if(empty($data)){
            $json = '{"success": false, "msg": "No data for save."}';
        }else{
            if($data['old_code'] == $data['code']){
                //do save
                $result = $this->product->update($data);
                if($result){
                    $json = '{"success": true}';
                }else{
                    $json = '{"success": false, "Database error, please check your data and try again."}';
                }
            }else{
                //check duplicate product code
                $duplicated = $this->product->check_duplicate($data['code']);
                if($duplicated){
                    $json = '{"success": false, "msg": "รายการนี้มีอยู่แล้วกรุณาตรวจสอบทะเบียนครุภัณฑ์"}';
                }else{
                    //do save
                    $result = $this->product->update($data);
                    if($result){
                        $json = '{"success": true}';
                    }else{
                        $json = '{"success": false, "Database error, please check your data and try again."}';
                    }
                }
            }

        }

        render_json($json);
    }

    public function detail(){
        $id = $this->input->post('id');
        if(empty($id)){
            $json = '{"success": false, "msg": "No id defined."}';
        }else{
            $result = $this->product->detail($id);
            if($result){
                $rows = json_encode($result);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No data."}';
            }
        }

        render_json($json);
    }
    public function remove(){
        $id = $this->input->post('id');
        if(empty($id)){
            $json = '{"success": false, "msg": "No id defined."}';
        }else{
            $result = $this->product->remove($id);
            if($result){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false, "msg": "No data."}';
            }
        }

        render_json($json);
    }


}