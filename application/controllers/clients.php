<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class clients extends CI_Controller
{

    public $user_id;

    public function __construct()
    {
        parent::__construct();

        $this->layout->setLayout('client_layout');

        $client_name = $this->session->userdata('client_name');
        $this->user_id = $this->session->userdata('user_id');

        if(empty($client_name)) redirect(site_url('users/login'));

        $this->load->model('Client_model', 'client');
        $this->load->model('Basic_model', 'basic');
        $this->load->model('Owner_model', 'owner');
        $this->load->model('Serial_model', 'serials');
        $this->load->model('Service_model', 'service');
        $this->load->model('User_model', 'user');
        $this->load->model('Product_model', 'product');
    }

    public function index()
    {
        $data['priority'] = $this->basic->get_priority_list();
        $data['owners'] = $this->owner->get_all();
        $this->layout->view('clients/index_view', $data);
    }

    public function search_reg_product()
    {
        $query = $this->input->post('query');

        if(empty($query))
        {
            $json = '{"success": false, "msg": "No query found."}';
        }
        else
        {
            //do search
            $rs = $this->client->search_reg_product($query);
            if($rs)
            {
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }
            else
            {
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }


    public function search_other_product()
    {
        $query = $this->input->post('query');

        if(empty($query))
        {
            $json = '{"success": false, "msg": "No query found."}';
        }
        else
        {
            //do search
            $rs = $this->client->search_other_product($query);

            if($rs)
            {
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }
            else
            {
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }

    public function save_reg_product()
    {
        $data = $this->input->post('data');

        if(empty($data))
        {
            $json = '{"success": false, "msg": "No data for save."}';
        }
        else
        {
            //check current status
            $discharged = $this->client->check_discharged($data['product_id']);

            if($discharged)
            {
                //generate serial
                $data['service_code'] = generate_serial('SERVICE', TRUE);
                $data['user_id'] = $this->session->userdata('user_id');

                $rs = $this->client->save_reg_product($data);

                if($rs)
                {
                    $json = '{"success": true}';
                }
                else
                {
                    $json = '{"success": false, "msg": "Save error."}';
                }
            }
            else
            {
                $json = '{"success": false, "msg": "รายการยังไม่ถูกจำหน่าย ไม่สามารถบันทึกรายการได้"}';
            }

        }

        render_json($json);
    }

     public function save_other_product()
     {
        $data = $this->input->post('data');

        if(empty($data))
        {
            $json = '{"success": false, "msg": "No data for save."}';
        }
        else
        {
        	if($data['isupdate'] == '1')
        	{
        		$rs = $this->client->update_other_product($data);

				if($rs)
				{
					$json = '{"success": true}';
				}
				else
				{
					$json = '{"success": false, "Can\'t update data."}';
				}
        	}
        	else
        	{
        		$data['service_code'] = generate_serial('SERVICE_OTHER', TRUE);
	            $data['user_id'] = $this->session->userdata('user_id');

	            $rs = $this->client->save_other_product($data);

                if($rs){
                    $json = '{"success": true}';
                }else{
                    $json = '{"success": false, "msg": "Save error."}';
                }
        	}
        }

        render_json($json);
    }
    public function get_service_by_code_list(){
        $this->client->user_id = $this->user_id;

        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

		$status = $this->input->post('status');

        $status = empty($status) ? '0' : $status;


        $rs = $this->client->get_service_by_code_list($status, $start, $limit);

        if($rs){
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->id = $r->id;
                $obj->service_code = $r->service_code;
                $obj->product_id = $r->product_id;
                $obj->date_serv = to_thai_date($r->date_serv);
                $obj->product_code = $r->product_code;
                $obj->product_name = $r->product_name;
                $obj->cause = $r->cause;
                $obj->status = get_status_name($r->service_status);

                array_push($arr_result, $obj);
            }

            $rows = json_encode($arr_result);
            //$total = $this->client->get_service_by_code_total();

            $json = '{"success": true, "rows": '.$rows.'}';

        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }


    public function get_service_by_other_list(){
        $this->client->user_id = $this->user_id;

        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

		$status = $this->input->post('status');

        $status = empty($status) ? '0' : $status;

        $limit = (int) $stop - (int) $start;

        $rs = $this->client->get_service_by_other_list($status, $start, $limit);

        if($rs){
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->service_code = $r->service_code;
                $obj->product_name = $r->product_name;
                $obj->date_serv = to_thai_date($r->date_serv);
                $obj->owner_name = $r->owner_name;
                $obj->id = $r->id;
                $obj->cause = $r->cause;
                $obj->status = get_status_name($r->service_status);

                array_push($arr_result, $obj);
            }

            $rows = json_encode($arr_result);
            //$total = $this->client->get_service_by_code_total();

            $json = '{"success": true, "rows": '.$rows.'}';

        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }


    public function get_service_by_code_total(){

		$status = $this->input->post('status');

        $status = empty($status) ? '0' : $status;
        $this->client->user_id = $this->user_id;

        $total = $this->client->get_service_by_code_total($status);
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function get_service_by_other_total(){

        $this->client->user_id = $this->user_id;
		$status = $this->input->post('status');

        $status = empty($status) ? '0' : $status;

        $total = $this->client->get_service_by_other_total($status);
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

	  public function get_search_service_by_other_list(){
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');
        $query = $this->input->post('query');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

		$this->client->user_id = $this->user_id;

        $rs = $this->client->get_search_service_by_other_list($query, $start, $limit);

        if($rs){
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->service_code = $r->service_code;
                $obj->product_name = $r->product_name;
                $obj->date_serv = to_thai_date($r->date_serv);
                $obj->owner_name = $r->owner_name;
                $obj->id = $r->id;
                $obj->cause = $r->cause;
                $obj->status = get_status_name($r->service_status);

                array_push($arr_result, $obj);
            }

            $rows = json_encode($arr_result);
            //$total = $this->client->get_service_by_code_total();

            $json = '{"success": true, "rows": '.$rows.'}';

        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }



    public function get_search_service_by_other_total(){

        $query = $this->input->post('query');

		$this->client->user_id = $this->user_id;

        $total = $this->client->get_search_service_by_other_total($query);
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }


	public function get_search_service_by_code_list(){
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');
        $query = $this->input->post('query');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

		$this->client->user_id = $this->user_id;

        $rs = $this->client->get_search_service_by_code_list($query, $start, $limit);

        if($rs){
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->service_code = $r->service_code;
                $obj->id = $r->id;
                $obj->product_id = $r->product_id;
                $obj->date_serv = to_thai_date($r->date_serv);
                $obj->product_code = $r->product_code;
                $obj->product_name = $r->product_name;
                $obj->cause = $r->cause;
                $obj->status = get_status_name($r->service_status);

                array_push($arr_result, $obj);
            }

            $rows = json_encode($arr_result);
            //$total = $this->client->get_service_by_code_total();

            $json = '{"success": true, "rows": '.$rows.'}';

        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }



    public function get_search_service_by_code_total(){

        $query = $this->input->post('query');

		$this->client->user_id = $this->user_id;

        $total = $this->client->get_search_service_by_code_total($query);
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function get_info($id=""){
        if(empty($id) || !isset($id)){
            show_error('No service found.', 404);
        }else{
            $exist = $this->service->service_exist($id);

            if($exist){
                $rs = $this->service->get_entries_detail($id);
                $data['sv'] = $rs->service_code;
                $data['id'] = $id;
                $data['date_serv'] = $rs->date_serv;
                $data['time_serv'] = $rs->time_serv;
                $data['cause'] = $rs->cause;
                $data['product_code'] = $rs->product_code;
                $data['product_name'] = $rs->product_name;
                $data['owner_name'] = $rs->owner_name;
                $data['contact_name'] = $rs->contact_name;

                $this->layout->view('clients/service_info_view', $data);
            }else{
                show_error('No service.', 404);
            }
        }
    }


     public function get_info_other($id=""){
        if(empty($id) || !isset($id)){
            show_error('No service.', 404);
        }else{
            $exist = $this->service->service_other_exist($id);

            if($exist){
                $rs = $this->service->get_entries_other_detail($id);
                $data['sv'] = $rs->service_code;
                $data['id'] = $id;
                $data['date_serv'] = $rs->date_serv;
                $data['time_serv'] = $rs->time_serv;
                $data['cause'] = $rs->cause;
                $data['product_name'] = $rs->product_name;
                $data['owner_name'] = $rs->owner_name;
                $data['contact_name'] = $rs->contact_name;
                $data['product_desc'] = $rs->product_desc;

                $this->layout->view('clients/service_info_other_view', $data);
            }else{
                show_error('No service.', 404);
            }
        }
    }
    public function get_activities(){
        $sv = $this->input->post('sv');
        if(empty($sv)){
            $json = '{"success": false, "msg": "No service code found."}';
        }else{
            $rs = $this->service->get_activities($sv);
            if($rs){
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }


    public function get_item(){
        $sv = $this->input->post('sv');
        if(empty($sv)){
            $json = '{"success": false, "msg": "No service code found."}';
        }else{
            $rs = $this->service->get_item($sv);
            if($rs){
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }

    public function change_password(){
        $username = $this->session->userdata('client_name');
        $password = $this->input->post('pwd');

        if(empty($password)){
            $json = '{"success": false, "msg": "Blank password."}';
        }else{
            $rs = $this->user->change_password($username, $password);
            if($rs){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false, "msg": "Can\'t change password."}';
            }
        }

        render_json($json);
    }

    public function register_products()
    {
    	$data['owners'] = $this->product->get_owner();
    	$data['types'] = $this->product->get_type();
    	$data['brands'] = $this->product->get_brand();
    	$data['models'] = $this->product->get_model();
    	$data['suppliers'] = $this->product->get_supplier();

    	$this->layout->view('clients/register_product_view', $data);
    }

    public function save_products(){

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

}
