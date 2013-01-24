<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public function get_list($start, $limit)
    {
        $rs = $this->db
                ->select(array('u.*', 't.type_name', 'o.name as owner_name', 'tt.name as technician_type_name'))
                ->join('user_types t', 't.type_code=u.user_type', 'left')
                ->join('owners o', 'o.id=u.owner', 'left')
                ->join('technician_types tt', 'tt.id=u.tech_type_id', 'left')
                ->limit($limit, $start)
                ->order_by('u.fullname', 'ASC')->get('users u')->result();
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
                ->set('password', md5($data['password']))
                ->set('user_type', $data['user_type'])
                ->set('user_status', $data['user_status'])
                ->set('tech_type_id', $data['tech_type_id'])
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
            ->set('tech_type_id', $data['tech_type_id'])
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

    public function search($query){
    	$sql = '
    			select u.*, t.type_name, o.name as owner_name, tt.name as technician_type_name
    			from users u
    			left join user_types t on t.type_code=u.user_type
    			left join owners o on o.id=u.owner
    			left join technician_types tt on tt.id=u.tech_type_id
    			where (u.fullname like "%'.$query.'%" or u.username="'.$query.'")
    			';
    	$rs = $this->db->query($sql)->result();
    	/*
    	$rs = $this->db
			    	->select(array('u.*', 't.type_name', 'o.name as owner_name', 'tt.name as technician_type_name'))
			    	->join('user_types t', 't.type_code=u.user_type', 'left')
			    	->join('owners o', 'o.id=u.owner', 'left')
			    	->join('technician_types tt', 'tt.id=u.tech_type_id', 'left')
			    	//->like('u.fullname', $query, 'both')
			    	->where('u.username', $query)
			    	->order_by('u.fullname', 'ASC')->get('users u')->result();
		*/
    	return $rs;
    }

}