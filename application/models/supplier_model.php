<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_model extends CI_Model
{

    public function get_list($start, $limit)
    {
        $result = $this->db->limit($limit, $start)->order_by('name')->get('suppliers')->result();
        return $result;
    }

	public function get_list_total(){
    	$rs = $this->db->count_all_results('suppliers');
    	return $rs;
    }
    public function save($name){
        $result = $this->db->set('name', $name)->insert('suppliers');
        return $result;
    }

    public function check_duplicate($name){
        $result = $this->db->where('name', $name)->count_all_results('suppliers');

        return $result > 0 ? TRUE : FALSE;
    }

    public function update($data){
        $result = $this->db->where('id', $data['supplier_id'])
            ->set('name', $data['name'])
            ->update('suppliers');
        return $result;
    }

    public function remove($id){
        $result = $this->db->where('id', $id)->delete('suppliers');
        return $result;
    }

    public function search($query){
        $result = $this->db->like('name', $query, 'both')->limit(20)->get('suppliers')->result();
        return $result;
    }
}