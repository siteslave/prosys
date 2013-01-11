<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Owner_model extends CI_Model
{

    public function get_list($start, $limit)
    {
        $result = $this->db->limit($limit, $start)->order_by('name')->get('owners')->result();
        return $result;
    }
    public function get_list_total(){
    	$rs = $this->db->count_all_results('owners');
    	return $rs;
    }
    public function get_all()
    {
        $result = $this->db->order_by('name')->get('owners')->result();
        return $result;
    }

    public function save($name){
        $result = $this->db->set('name', $name)->insert('owners');
        return $result;
    }

    public function check_duplicate($name){
        $result = $this->db->where('name', $name)->count_all_results('owners');

        return $result > 0 ? TRUE : FALSE;
    }

    public function update($data){
        $result = $this->db->where('id', $data['owner_id'])
            ->set('name', $data['name'])
            ->update('owners');
        return $result;
    }

    public function remove($id){
        $result = $this->db->where('id', $id)->delete('owners');
        return $result;
    }

    public function search($query){
        $result = $this->db->like('name', $query, 'both')->limit(20)->get('owners')->result();
        return $result;
    }
}