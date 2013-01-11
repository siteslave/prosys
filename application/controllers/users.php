<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('login_layout');

        $this->load->model('User_model', 'user');
    }

    public function index(){
        $this->login();
    }
    public function login()
    {
        $this->layout->view('users/login_view');
    }
	
    
    public function do_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $validated = $this->user->do_login($username, $password);

        if($validated){
            $user_type = get_user_type($username);
            if($user_type == '1'){ //client
                $data = array(
                    'client_name' => $username,
                    'fullname' => get_fullname($username),
                    'user_type' => get_user_type($username),
                    'user_id' => get_user_id($username)
                );
                $this->session->set_userdata($data);

                $json = '{"success": true, "user_type": "1"}';
            }else{
                $data = array(
                    'username' => $username,
                    'fullname' => get_fullname($username),
                    'user_type' => get_user_type($username),
                    'user_id' => get_user_id($username)
                );
                $this->session->set_userdata($data);

                $json = '{"success": true, "user_type": "0"}';
            }
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function logout(){
        $this->session->sess_destroy();
        $this->login();
    }
}