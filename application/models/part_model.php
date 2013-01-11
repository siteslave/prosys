<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Part_model extends CI_Model
{

    public function get_list($start, $limit)
    {
        $result = $this->db->limit($limit, $start)->order_by('name')->get('items')->result();
        return $result;
    }

    public function get_list_total(){
    	$rs = $this->db->count_all_results('items');
    	return $rs;
    }
    public function save($data){
        $result = $this->db
                    ->set('name', $data['name'])
                    ->set('price', $data['price'])
                    ->insert('items');
        return $result;
    }

    public function check_duplicate($name){
        $result = $this->db->where('name', $name)->count_all_results('items');

        return $result > 0 ? TRUE : FALSE;
    }

    public function update($data){
        $result = $this->db->where('id', $data['id'])
            ->set('name', $data['name'])
            ->set('price', $data['price'])
            ->update('items');
        return $result;
    }

    public function remove($id){
        $result = $this->db->where('id', $id)->delete('items');
        return $result;
    }

    public function search($query){
        $result = $this->db->like('name', $query, 'both')->limit(20)->get('items')->result();
        return $result;
    }
}
