<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Basic_model extends CI_Model
{

    public function get_priority_list()
    {
        $rs = $this->db->get('priorities')->result();
        return $rs;
    }

    public function get_service_type(){
    	$rs = $this->db->get('service_types')->result();
    	return $rs;
    }
    public function get_technician_type_list(){
    	$rs = $this->db->get('technician_types')->result();
    	return $rs;
    }

    public function get_type_of_service(){
    	$rs = $this->db->get('type_services')->result();
    	return $rs;
    }

    public function count_technician_in_more($sv){
    	$rs = $this->db->where('service_code', $sv)->count_all_results('service_technicians');
    	return $rs;
    }

    public function get_owner_list(){
        $rs = $this->db->get('owners')->result();
        return $rs;
    }

}