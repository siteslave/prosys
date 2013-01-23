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
}