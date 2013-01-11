<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Statuses_model extends CI_Model
{

    public function get_list()
    {
        $result = $this->db->order_by('id')->get('service_status')->result();
        return $result;
    }
    public function get_name($status)
    {
        $result = $this->db->where('id', $status)->get('service_status')->row();
        return $result;
    }

    public function get_list_total(){
    	$rs = $this->db->count_all_results('service_status');
    	return $rs;
    }

    public function save($name){
        $result = $this->db->set('name', $name)->insert('service_status');
        return $result;
    }

    public function check_duplicate($name){
        $result = $this->db->where('name', $name)->count_all_results('service_status');

        return $result > 0 ? TRUE : FALSE;
    }

    public function update($data){
        $result = $this->db->where('id', $data['id'])
            ->set('name', $data['name'])
            ->update('service_status');
        return $result;
    }

    public function remove($id){
        $result = $this->db->where('id', $id)->delete('service_status');
        return $result;
    }

    public function search($query){
        $result = $this->db->like('name', $query, 'both')->limit(20)->get('service_status')->result();
        return $result;
    }
}
