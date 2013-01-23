<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public function get_list($start, $limit)
    {
        $rs = $this->db
                ->select(array('u.*', 't.type_name', 'o.name as owner_name'))
                ->join('user_types t', 't.type_code=u.user_type')
                ->join('owners o', 'o.id=u.owner', 'left')
                ->limit($limit, $start)
                ->order_by('u.fullname', 'DESC')->get('users u')->result();
        return $rs;
    }

    public function get_list_total(){
    	$rs = $this->db->count_all_results('users');
    	return $rs;
    }

    public function get_user_type(){
        $rs = $this->db
                ->get('user_types')
                ->result();
        return $rs;
    }
    public function get_owner(){
        $rs = $this->db
                ->get('owners')
                ->result();
        return $rs;
    }

    public function insert($data){
        $rs = $this->db
                ->set('fullname', $data['fullname'])
                ->set('username', $data['username'])
                ->set('password', $data['password'])
                ->set('user_type', $data['user_type'])
                ->set('user_status', $data['user_status'])
                ->set('owner', $data['owner'])
                ->insert('users');
        return $rs;
    }

    public function update($data){
        $rs = $this->db
            ->where('id', $data['id'])
            ->set('fullname', $data['fullname'])
            //->set('username', $data['username'])
            //->set('password', $data['password'])
            ->set('user_type', $data['user_type'])
            ->set('user_status', $data['user_status'])
            ->set('owner', $data['owner'])
            ->update('users');
        return $rs;
    }

    public function check_duplicate($username){
        $rs = $this->db->where('username', $username)->count_all_results('users');
        return $rs > 0 ? TRUE : FALSE;
    }

    public function get_detail($id){
        $rs = $this->db->where('id', $id)->get('users')->row();
        return $rs;
    }

    public function change_password($id, $password){
        $rs = $this->db->where('id', $id)->set('password', md5($password))->update('users');
        return $rs;
    }

    public function remove($id){
        $rs = $this->db->where('id', $id)->delete('users');
        return $rs;
    }
}