<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function do_login($username, $password)
    {
        $result = $this->db->where('username', $username)
                            ->where('password', md5($password))
                            ->where('user_status', '1')
                            ->count_all_results('users');
        return $result > 0 ? TRUE : FALSE;
    }
    
    public function check_login_technician($user_id, $password)
    {
        $result = $this->db->where('id', $user_id)
                            ->where('password', md5($password))
                            ->where('user_status', '1')
                            ->count_all_results('users');
        return $result > 0 ? TRUE : FALSE;
    }
    public function change_password($username, $password){
        $rs = $this->db->where('username', $username)
                        ->set('password', md5($password))
                        ->update('users');
        return $rs;
    }
    
    public function get_technician_list(){
    	$rs = $this->db->where_in('user_type', array('2', '3'))
    					->get('users')
		    			->result();
		return $rs;
    }
}
