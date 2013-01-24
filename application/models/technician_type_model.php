<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Technician_type_model extends CI_Model
{

    public function get_list()
    {
        $result = $this->db->order_by('name')->get('technician_types')->result();
        return $result;
    }
	public function get_list_total(){
    	$rs = $this->db->count_all_results('technician_types');
    	return $rs;
    }

    public function save($name){
        $result = $this->db->set('name', $name)->insert('technician_types');
        return $result;
    }

    public function check_duplicate($name){
        $result = $this->db->where('name', $name)->count_all_results('technician_types');

        return $result > 0 ? TRUE : FALSE;
    }

    public function update($data){
        $result = $this->db->where('id', $data['id'])
            ->set('name', $data['name'])
            ->update('technician_types');
        return $result;
    }

    public function remove($id){
        $result = $this->db->where('id', $id)->delete('technician_types');
        return $result;
    }

    public function search($query){
        $result = $this->db->like('name', $query, 'both')->limit(20)->get('technician_types')->result();
        return $result;
    }
}