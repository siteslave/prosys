<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller
{
    public $service_status;
    public $user_id;

    public function __construct()
    {
        parent::__construct();
        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));

        $this->user_id = $this->session->userdata('user_id');

        $this->load->model('Service_model', 'service');
        $this->load->model('User_model', 'user');
        $this->load->model('Client_model', 'client');
    }

    public function index()
    {
        $this->layout->view('services/index_view');
    }

	public function check_login(){
		$username = $this->input->post('username');
        $password = $this->input->post('password');
        $validated = $this->user->do_login($username, $password);

        //if($validate)
	}

    public function get_service_by_code_list(){

        $start = $this->input->post('start');
        $stop = $this->input->post('stop');
        $status = $this->input->post('status');

        $this->service_status = empty($status) ? '1' : $status;

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $this->service->service_status = $this->service_status;

        $rs = $this->service->get_service_by_code_list($start, $limit);

        if($rs){
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->id = $r->id;
                $obj->service_code = $r->service_code;
                $obj->product_id = $r->product_id;
                $obj->date_serv = to_thai_date($r->date_serv);
                $obj->time_serv = $r->time_serv;
                $obj->product_code = $r->product_code;
                $obj->product_name = $r->product_name;
                $obj->cause = $r->cause;
                $obj->status = get_status_name($r->service_status);
                $obj->service_status = $r->service_status;
                $obj->tech_user_id = empty($r->tech_user_id) ? '' : $r->tech_user_id;
                $obj->tech_name = empty($r->tech_name) ? '-' : $r->tech_name;
                $obj->owner_name = $r->owner_name;
                $obj->service_type = get_type_name($r->service_type_id);
                $obj->tech_type_name = get_type_service_name($r->type_service_id);
				$obj->tech_more = count_technician_in_more($r->service_code);
                $obj->pri_name = $r->pri_name;

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

        $this->service_status = empty($status) ? '1' : $status;

        $this->service->service_status = $this->service_status;
        $total = $this->service->get_service_by_code_total();
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function save_regcode_change_status(){
        $data = $this->input->post('data');

        if(!empty($data)){

        	//check discharge status
        	$discharged = $this->service->check_discharge_status($data['sv']);
        	if($discharged){
        		$json = '{"success": false, "msg": "รายการนี้ถูกจำหน่ายแล้วไม่สามารถแก้ไขรายการได้"}';
        	}else{
        		//check user
        		$validated = $this->user->check_login_technician($data['user_id'], $data['password']);

        		if($validated){
        			if(empty($data['sv'])){
        				$json = '{"success": false, "msg": "No service code found."}';
        			}else if(empty($data['status'])){
        				$json = '{"success": false, "msg": "No service status found."}';
        			}else{
        				//check password
        				$rs = $this->service->change_service_status($data['sv'], $data['status']);
        				if($rs){
        					$this->service->user_id = $data['user_id'];
        					$detail = 'เปลี่ยนสถานะซ่อม -> ' . get_status_name($data['status']);
        					$this->service->save_activities($data['sv'], $detail);

        					$json = '{"success": true}';
        				}else{
        					$json = '{"success": false, "msg": "Can\'t change status, please check your data and try again."}';
        				}
        			}
        		}else{
        			$json = '{"success": false, "msg": "Invalid username/password."}';
        		}
        	}

        }else{
        	$json = '{"success": fale, "msg": "No data found."}';
        }

        render_json($json);
    }

    public function save_other_change_status(){
        $data = $this->input->post('data');

        if(!empty($data)){
        	//check discharge status
        	$discharged = $this->service->check_discharge_status($data['sv']);
        	if($discharged){
        		$json = '{"success": false, "msg": "รายการนี้ถูกจำหน่ายแล้วไม่สามารถแก้ไขรายการได้"}';
        	}else{
        		//check user
        		$validated = $this->user->check_login_technician($data['user_id'], $data['password']);

        		if($validated){
        			if(empty($data['sv'])){
        				$json = '{"success": false, "msg": "No service code found."}';
        			}else if(empty($data['status'])){
        				$json = '{"success": false, "msg": "No service status found."}';
        			}else{
        				//check password
        				$rs = $this->service->change_service_status_other($data['sv'], $data['status']);
        				if($rs){
        					$this->service->user_id = $data['user_id'];
        					$detail = 'เปลี่ยนสถานะซ่อม -> ' . get_status_name($data['status']);
        					$this->service->save_activities($data['sv'], $detail);

        					$json = '{"success": true}';
        				}else{
        					$json = '{"success": false, "msg": "Can\'t change status, please check your data and try again."}';
        				}
        			}
        		}else{
        			$json = '{"success": false, "msg": "Invalid username/password."}';
        		}
        	}

        }else{
        	$json = '{"success": fale, "msg": "No data found."}';
        }

        render_json($json);
    }
    public function save_regcode_assign_tech(){
        $data = $this->input->post('data');

		if(!empty($data)){
			//check discharge status
			$discharged = $this->service->check_discharge_status($data['sv']);
			if($discharged){
				$json = '{"success": false, "msg": "รายการนี้ถูกจำหน่ายแล้วไม่สามารถแก้ไขรายการได้"}';
			}else{
				//check user
				$validated = $this->user->check_login_technician($data['user_id'], $data['password']);

				if($validated){
					if(empty($data['sv'])){
						$json = '{"success": false, "msg": "No service code found."}';
					}else{
						$rs = $this->service->save_regcode_assign_tech($data['sv'], $data['user_id']);
						if($rs){
							$this->service->user_id = $data['user_id'];
							$detail = 'กำหนดช่างผู้รับผิดชอบ -> ' . get_user_fullname_by_id($data['user_id']);
							$this->service->save_activities($data['sv'], $detail);

							$json = '{"success": true}';
						}else{
							$json = '{"success": false, "msg": "Can\'t change status, please check your data and try again."}';
						}
					}
				}else{
					$json = '{"success": false, "msg": "Invalid username/password."}';
				}
			}

        }else{
        	$json = '{"success": fale, "msg": "No data found."}';
        }

        render_json($json);
    }
    public function save_other_assign_tech(){
    	$data = $this->input->post('data');

		if(!empty($data)){
			//check discharge status
			$discharged = $this->service->check_discharge_status($data['sv']);
			if($discharged){
				$json = '{"success": false, "msg": "รายการนี้ถูกจำหน่ายแล้วไม่สามารถแก้ไขรายการได้"}';
			}else{
				//check user
				$validated = $this->user->check_login_technician($data['user_id'], $data['password']);

				if($validated){
					if(empty($data['sv'])){
						$json = '{"success": false, "msg": "No service code found."}';
					}else{
						$rs = $this->service->save_other_assign_tech($data['sv'], $data['user_id']);
						if($rs){
							$this->service->user_id = $data['user_id'];
							$detail = 'กำหนดช่างผู้รับผิดชอบ -> ' . get_user_fullname_by_id($data['user_id']);
							$this->service->save_activities($data['sv'], $detail);

							$json = '{"success": true}';
						}else{
							$json = '{"success": false, "msg": "Can\'t change status, please check your data and try again."}';
						}
					}
				}else{
					$json = '{"success": false, "msg": "Invalid username/password."}';
				}
			}

        }else{
        	$json = '{"success": fale, "msg": "No data found."}';
        }

        render_json($json);
    }
    public function entries($id){
        if(empty($id) || !isset($id)){
            show_error('No service.', 404);
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
                $data['request_name'] = $rs->request_name;
                $data['service_type'] = get_type_name($rs->service_type_id);

                $this->layout->view('services/entries_view', $data);
            }else{
                show_error('No service.', 404);
            }
        }
    }
    public function entries_other($id=''){
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
                $data['request_name'] = $rs->request_name;
                $data['service_type'] = get_type_name($rs->service_type_id);

                $this->layout->view('services/entries_other_view', $data);
            }else{
                show_error('No service.', 404);
            }
        }
    }

    public function save_activities(){
        $data = $this->input->post('data');
        if(empty($data)){
            $json = '{"success": false, "msg": "No data found."}';
        }else{
        	//check discharge status
        	$discharged = $this->service->check_discharge_status($data['sv']);
        	if($discharged){
        		$json = '{"success": false, "msg": "รายการนี้ถูกจำหน่ายแล้วไม่สามารถแก้ไขรายการได้"}';
        	}else{
        		$validated = $this->user->check_login_technician($data['user_id'], $data['password']);
        		if($validated){
        			$this->service->user_id = $data['user_id'];
        			$rs = $this->service->save_activities($data['sv'], $data['detail']);
        			if($rs){
        				$json = '{"success": true}';
        			}else{
        				$json = '{"success": false, "msg": "Can\'t save activities, please check your data and try again."}';
        			}
        		}else{
        			$json = '{"success": false, "msg": "ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง"}';
        		}

        	}

        }

        render_json($json);
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

    //search items
    public function search_item(){
        $query = $this->input->post('query');
        if(empty($query)){
            $json = '{"success": false, "msg": "No query found."}';
        }else{
            $rs = $this->service->search_item($query);
            if($rs){
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }

    public function save_item(){
        $data = $this->input->post('data');
        if(empty($data)){
            $json = '{"success": false, "msg": "No data for save."}';
        }else{
        	//check discharge status
        	$discharged = $this->service->check_discharge_status($data['sv']);
        	if($discharged){
        		$json = '{"success": false, "msg": "รายการนี้ถูกจำหน่ายแล้วไม่สามารถแก้ไขรายการได้"}';
        	}else{
                $validated = $this->user->check_login_technician($data['user_id'], $data['password']);
                if($validated)
                {
                    if($data['isupdate'] == '1'){
                        //update
                        $id = get_service_item_id($data['id']);
                        $detail = 'แก้ไขค่าใช้จ่าย --> ' . get_item_name($id) . ', จำนวน ' . $data['qty'] . ', ราคา ' . $data['price'] . ' บาท';
                        $rs = $this->service->update_item($data);
                    }else{
                        $id = (int) $data['id'];
                        $detail = 'เพิ่มค่าใช้จ่าย --> ' . get_item_name($id) . ', จำนวน ' . $data['qty'] . ', ราคา ' . $data['price'] . ' บาท';
                        $rs = $this->service->save_item($data);
                    }

                    if($rs){
                        $this->service->user_id = $data['user_id'];
                        $this->service->save_activities($data['sv'], $detail);
                        $json = '{"success": true}';
                    }else{
                        $json = '{"success": false, "msg": "Save/update data error."}';
                    }
                }
                else
                {
                    $json  = '{"success": false, "msg": "ชื่อผู้ใช้งาน/รหัสผ่านไม่ถูกต้อง"}';
                }

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
    public function remove_item(){
        $id = $this->input->post('id');
        $sv = $this->input->post('sv');
        if(empty($id)){
            $json = '{"success": false, "msg": "No ID found."}';
        }else{
        	//check discharge status
        	$discharged = $this->service->check_discharge_status($sv);
        	if($discharged){
        		$json = '{"success": false, "msg": "รายการนี้ถูกจำหน่ายแล้วไม่สามารถแก้ไขรายการได้"}';
        	}else{
        		$item_id = get_service_item_id($id);
        		$rs = $this->service->remove_item($id);
        		if($rs){

        			$this->service->user_id = $this->user_id;

        			$detail = 'ลบค่าใช้จ่าย --> ' . get_item_name($item_id);
        			$rs = $this->service->save_activities($sv, $detail);
        			$json = '{"success": true}';
        		}else{
        			$json = '{"success": false, "msg": "Cant\'t remove item."}';
        		}
        	}
        }

        render_json($json);
    }


    public function search_service_by_code_list(){
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');
        $query = $this->input->post('query');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $rs = $this->service->search_service_by_code_list($query, $start, $limit);

        if($rs){
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->id = $r->id;
                $obj->service_code = $r->service_code;
                $obj->product_id = $r->product_id;
                $obj->date_serv = to_thai_date($r->date_serv);
                $obj->time_serv = $r->time_serv;
                $obj->product_code = $r->product_code;
                $obj->product_name = $r->product_name;
                $obj->cause = $r->cause;
                $obj->status = get_status_name($r->service_status);
                $obj->service_status = $r->service_status;
                $obj->tech_user_id = empty($r->tech_user_id) ? '' : $r->tech_user_id;
                $obj->tech_name = empty($r->tech_name) ? '-' : $r->tech_name;
                $obj->owner_name = $r->owner_name;
                $obj->service_type = get_type_name($r->service_type_id);
                $obj->tech_type_name = get_type_service_name($r->type_service_id);
                $obj->tech_more = count_technician_in_more($r->service_code);
                $obj->pri_name = $r->pri_name;

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

        $this->service->service_status = $this->service_status;
        $total = $this->service->get_search_service_by_code_total($query);
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function get_service_by_other_total(){

		$status = $this->input->post('status');

        $this->service_status = empty($status) ? '0' : $status;

        $total = $this->service->get_service_by_other_total($status);
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }


    public function get_search_service_by_other_total(){

		$query = $this->input->post('query');

        $total = $this->service->get_search_service_by_other_total($query);
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function search_service_by_other_list(){
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

		$query = $this->input->post('query');

        $limit = (int) $stop - (int) $start;

        $rs = $this->service->search_service_by_other_list($query, $start, $limit);

        if($rs){
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->service_code = $r->service_code;
                $obj->product_name = $r->product_name;
                $obj->date_serv = to_thai_date($r->date_serv);
                $obj->time_serv = $r->time_serv;
                $obj->owner_name = $r->owner_name;
                $obj->tech_name = empty($r->tech_name) ? '-' : $r->tech_name;
                $obj->tech_user_id = $r->tech_user_id;
                $obj->id = $r->id;
                $obj->cause = $r->cause;
                $obj->service_status = $r->service_status;
                $obj->status = get_status_name($r->service_status);
                $obj->service_type = get_type_name($r->service_type_id);
                $obj->tech_type_name = get_type_service_name($r->type_service_id);
                $obj->tech_more = count_technician_in_more($r->service_code);
                $obj->pri_name = $r->pri_name;

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
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

		$status = $this->input->post('status');

        $this->service_status = empty($status) ? '0' : $status;

        $limit = (int) $stop - (int) $start;

        $rs = $this->service->get_service_by_other_list($status, $start, $limit);

        if($rs){
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->service_code = $r->service_code;
                $obj->product_name = $r->product_name;
                $obj->date_serv = to_thai_date($r->date_serv);
                $obj->time_serv = $r->time_serv;
                $obj->owner_name = $r->owner_name;
                $obj->tech_name = empty($r->tech_name) ? '-' : $r->tech_name;
                $obj->tech_user_id = $r->tech_user_id;
                $obj->id = $r->id;
                $obj->cause = $r->cause;
                $obj->service_status = $r->service_status;
                $obj->status = get_status_name($r->service_status);
                $obj->service_type = get_type_name($r->service_type_id);
                $obj->tech_type_name = get_type_service_name($r->type_service_id);
                $obj->tech_more = count_technician_in_more($r->service_code);
                $obj->pri_name = $r->pri_name;

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

    public function save_result(){
        $data = $this->input->post('data');

        if(empty($data['id'])){
            $json = '{"success": false, "msg": "No service id found."}';
        }else if(empty($data['detail'])){
            $json = '{"success": false, "msg": "No detail for save."}';
        }else{

        	//check discharge status
        	$discharged = $this->service->check_discharge_status($data['sv']);
        	if($discharged){
        		$json = '{"success": false, "msg": "รายการนี้ถูกจำหน่ายแล้วไม่สามารถแก้ไขรายการได้"}';
        	}else{
        		if($data['type'] == 'code'){
        			$rs = $this->service->save_code_result($data['id'], $data['detail']);
        		}else{
        			$rs = $this->service->save_other_result($data['id'], $data['detail']);
        		}

        		if($rs){
        			$this->service->user_id = $this->user_id;
        			$detail = 'สรุปผลการให้บริการ --> ' . $data['detail'];
        			$rs = $this->service->save_activities($data['sv'], $detail);
        			$json = '{"success": true}';
        		}else{
        			$json = '{"success": false, "msg": "Can\'t save result."}';
        		}
        	}

        }

        render_json($json);
    }

    public function get_result(){
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        if(empty($id)){
            $json = '{"success": false, "msg": "No service id found."}';
        }else{
            if($type == 'code'){
                $rs = $this->service->get_code_result($id);
            }else{
                $rs = $this->service->get_other_result($id);
            }

            if($rs){
                $json = '{"success": true, "result": "'.$rs.'"}';
            }else{
                $json = '{"success": false, "msg": "No service result."}';
            }
        }

        render_json($json);
    }

    public function search_service_by_code_history(){
    	$product_id = $this->input->post('id');
    	if(empty($product_id)){
    		$json = '{"success": false, "msg": "No service code found."}';
    	}else{
    		$rs = $this->service->search_service_by_code_history($product_id);
    		if($rs){
    			$arr_result = array();
	            foreach ($rs as $r) {
	                $obj = new stdClass();
	                $obj->service_code = $r->service_code;
	                $obj->date_serv = to_thai_date($r->date_serv);
                    $obj->time_serv = $r->time_serv;
	                $obj->tech_name = empty($r->tech_name) ? '-' : $r->tech_name;
	                $obj->cause = $r->cause;
	                $obj->service_status = $r->service_status;
	                $obj->status = get_status_name($r->service_status);
	                $obj->service_type = get_type_name($r->service_type_id);
	                $obj->tech_type_name = get_type_service_name($r->type_service_id);
	                $obj->tech_more = count_technician_in_more($r->service_code);
                    $obj->pri_name = $r->pri_name;

	                array_push($arr_result, $obj);
	            }

            	$rows = json_encode($arr_result);

    			$json = '{"success": true, "rows": ' . $rows . '}';
    		}else{
    			$json = '{"success": false, "msg": "No result."}';
    		}
    	}

    	render_json($json);
    }
	public function remove_service_code(){
		$service_code = $this->input->post('sv');
		if(empty($service_code)){
			$json = '{"success": false, "msg": "No service code found."}';
		}else{
			$user_type = $this->session->userdata('user_type');
			if($user_type == '3'){
				$rs = $this->service->remove_service_code($service_code);
				if($rs){
					$json = '{"success": true}';
				}else{
					$json = '{"success": false, "msg": "Can\'t remove service."}';
				}
			}else{
				$json = '{"success": false, "msg": "Permission denied."}';
			}
		}

		render_json($json);
	}
	public function remove_service_other(){
		$service_code = $this->input->post('sv');
		if(empty($service_code)){
			$json = '{"success": false, "msg": "No service code found."}';
		}else{
			$user_type = $this->session->userdata('user_type');
			if($user_type == '3'){
				$rs = $this->service->remove_service_other($service_code);
				if($rs){
					$json = '{"success": true}';
				}else{
					$json = '{"success": false, "msg": "Can\'t remove service."}';
				}
			}else{
				$json = '{"success": false, "msg": "Permission denied."}';
			}
		}

		render_json($json);
	}
    public function do_change_password(){
        $username = $this->session->userdata('username');
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

    public function do_discharge_main(){
    	$service_code = $this->input->post('service_code');
    	if(empty($service_code)){
    		$json = '{"success": false, "msg": "No service code."}';
    	}else{
    		$rs = $this->service->do_discharge_main($service_code);
    		if($rs){
    			$json = '{"success": true}';
    		}else{
    			$json = '{"success": false, "msg": "Can\'t discharge service, please check your data again."}';
    		}
    	}

    	render_json($json);
    }
    public function do_discharge_other(){
    	$service_code = $this->input->post('service_code');
    	if(empty($service_code)){
    		$json = '{"success": false, "msg": "No service code."}';
    	}else{
    		$rs = $this->service->do_discharge_other($service_code);
    		if($rs){
    			$json = '{"success": true}';
    		}else{
    			$json = '{"success": false, "msg": "Can\'t discharge service, please check your data again."}';
    		}
    	}

    	render_json($json);
    }

    public function undo_discharge_main(){
    	$service_code = $this->input->post('service_code');
    	if(empty($service_code)){
    		$json = '{"success": false, "msg": "No service code."}';
    	}else{
    		$rs = $this->service->undo_discharge_main($service_code);
    		if($rs){
    			$json = '{"success": true}';
    		}else{
    			$json = '{"success": false, "msg": "Can\'t discharge service, please check your data again."}';
    		}
    	}

    	render_json($json);
    }
    public function undo_discharge_other(){
    	$service_code = $this->input->post('service_code');
    	if(empty($service_code)){
    		$json = '{"success": false, "msg": "No service code."}';
    	}else{
    		$rs = $this->service->undo_discharge_other($service_code);
    		if($rs){
    			$json = '{"success": true}';
    		}else{
    			$json = '{"success": false, "msg": "Can\'t discharge service, please check your data again."}';
    		}
    	}

    	render_json($json);
    }

    public function save_discharge(){
    	$data = $this->input->post('data');
    	if(empty($data)){
    		$json = '{"success": false, "msg": "No data for save."}';
    	}else{
    		//check login
    		$auth = $this->user->check_login_technician($data['user_id'], $data['password']);
    		if($auth){
    			$rs = $this->service->save_discharge($data);
    			if($rs){
    				$this->service->update_discharge_status($data['sv'], '1');
    				$json = '{"success": true}';
    			}else{
    				$json = '{"success": false, "msg": "Can\'t discharge service, please check your data again."}';
    			}
    		}else{
    			$json = '{"success": false, "msg": "ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง"}';
    		}
    	}

    	render_json($json);
    }
    //------------------------------------------------------------------------------------------------------------------
    public function save_main_type(){
    	$data = $this->input->post('data');
    	if(empty($data)){
    		$json = '{"success": false, "msg": "ไม่พบข้อมูลที่ต้องการบันทึก"}';
    	}else{
    		//check user
    		$auth = $this->user->check_login_technician($data['user_id'], $data['password']);
    		if($auth){
    			$rs = $this->service->save_main_type($data);
    			if($rs){
    				$json = '{"success": true}';
    			}else{
    				$json = '{"success": false, "msg": "Can\'t assign service type, please check your data again."}';
    			}
    		}else{
    			$json = '{"success": false, "msg": "ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง"}';
    		}
    	}

    	render_json($json);
    }
    //------------------------------------------------------------------------------------------------------------------
    public function save_other_type(){
    	$data = $this->input->post('data');
    	if(empty($data)){
    		$json = '{"success": false, "msg": "ไม่พบข้อมูลที่ต้องการบันทึก"}';
    	}else{
    		//check user
    		$auth = $this->user->check_login_technician($data['user_id'], $data['password']);
    		if($auth){
    			$rs = $this->service->save_other_type($data);
    			if($rs){
    				$json = '{"success": true}';
    			}else{
    				$json = '{"success": false, "msg": "Can\'t assign service type, please check your data again."}';
    			}
    		}else{
    			$json = '{"success": false, "msg": "ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง"}';
    		}
    	}

    	render_json($json);
    }

    //------------------------------------------------------------------------------------------------------------------
    public function save_more_technician(){
    	$data = $this->input->post('data');
    	if(empty($data)){
    		$json = '{"success": false, "msg": "ไม่พบข้อมูลที่ต้องการบันทึก"}';
    	}else{
    		//check user
    		$auth = $this->user->check_login_technician($data['user_id'], $data['password']);
    		if($auth){
    			$duplicated = $this->service->check_more_technician_exist($data['sv'], $data['tech_user_id']);

    			if($duplicated){
    				$json = '{"success": false, "msg": "มีชื่อช่างคนนี้ในฐานข้อมูลแล้ว กรุณาเลือกรายการใหม่"}';
    			}else{
    				$rs = $this->service->save_more_technician($data);
    				if($rs){
    					$json = '{"success": true}';
    				}else{
    					$json = '{"success": false, "msg": "Can\'t assign more technician, please check your data again."}';
    				}
    			}

    		}else{
    			$json = '{"success": false, "msg": "ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง"}';
    		}
    	}

    	render_json($json);
    }

    public function get_more_technicians(){
    	$sv = $this->input->post('sv');
    	if(empty($sv)){
    		$json = '{"success": false, "msg": "ไม่พบรหัสรับบริการ"}';
    	}else{
    		$rs = $this->service->get_more_technicians($sv);
    		if($rs){
    			$rows = json_encode($rs);
    			$json = '{"success": true, "rows": '.$rows.'}';

    		}else{
    			$json = '{"success": false, "msg": "No result found."}';
    		}
    	}
    	render_json($json);
    }

    public function remove_discharge(){
    	$data = $this->input->post('data');

    	if(empty($data)){
    		$json = '{"success": false, "msg": "No data found."}';
    	}else{

    		$auth = $this->user->check_login_technician($data['user_id'], $data['password']);
    		if($auth){
    			$rs = $this->service->remove_discharge($data['sv']);
    			if($rs){
    				$this->service->update_discharge_status($data['sv'], '0');
    				$json = '{"success": true}';
    			}else{
    				$json = '{"success": false, "msg": "Can\'t remove discharge status"}';
    			}
    		}else{
    			$json = '{"success": false, "msg": "ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง"}';
    		}
    	}

    	render_json($json);
    }

    public function get_service_detail_main()
    {
        $sv = $this->input->post('sv');

        if(empty($sv))
        {
            $json = '{"success": true, "msg": "ไม่พบเลขที่รับบริการ (service code)"}';
        }
        else
        {
            $rs = $this->service->get_service_detail_main($sv);

            if($rs)
            {
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }
            else
            {
                $json = '{"success": false, "msg": "ไม่พบรายการ"}';
            }
        }

        render_json($json);
    }

    public function get_service_detail_other()
    {
        $sv = $this->input->post('sv');

        if(empty($sv))
        {
            $json = '{"success": true, "msg": "ไม่พบเลขที่รับบริการ (service code)"}';
        }
        else
        {
            $rs = $this->service->get_service_detail_other($sv);

            if($rs)
            {
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }
            else
            {
                $json = '{"success": false, "msg": "ไม่พบรายการ"}';
            }
        }

        render_json($json);
    }

    public function save_edit_service_main()
    {
        $data = $this->input->post('data');

        if(empty($data))
        {
            $json = '{"success": false, "msg": "ไม่พบข้อมูลที่ต้องการบันทึก"}';
        }
        else
        {
            $auth = $this->user->check_login_technician($data['user_id'], $data['password']);

            if($auth)
            {
                $rs = $this->service->save_edit_service_main($data);

                if($rs)
                {
                    $json = '{"success": true}';
                }
                else
                {
                    $json = '{"success": false, "msg": "ไม่สามารถแก้ไขรายการได้"}';
                }
            }
            else
            {
                $json = '{"success": false, "msg": "ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง"}';
            }
        }

        render_json($json);
    }

    public function save_edit_service_other()
    {
        $data = $this->input->post('data');

        if(empty($data))
        {
            $json = '{"success": false, "msg": "ไม่พบข้อมูลที่ต้องการบันทึก"}';
        }
        else
        {
            $auth = $this->user->check_login_technician($data['user_id'], $data['password']);

            if($auth)
            {
                $rs = $this->service->save_edit_service_other($data);

                if($rs)
                {
                    $json = '{"success": true}';
                }
                else
                {
                    $json = '{"success": false, "msg": "ไม่สามารถแก้ไขรายการได้"}';
                }
            }
            else
            {
                $json = '{"success": false, "msg": "ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง"}';
            }
        }

        render_json($json);
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
}
