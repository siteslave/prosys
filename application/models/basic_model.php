<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Basic_model extends CI_Model
{

    public function get_priority_list()
    {
        $rs = $this->db->get('priorities')->result();
        return $rs;
    }
}