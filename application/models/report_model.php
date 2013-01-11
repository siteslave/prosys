<?php
class Report_model extends CI_Model {
    public function get_mservice_total($id){
        $rs = $this->db
                ->where('tech_user_id', $id)
                //->where('date_serv >=', $s)
                //->where('date_serv <=', $e)
                ->count_all_results('main_services');
               
        return $rs;
    }
    
    public function get_oservice_total($id){
        $rs = $this->db
                ->where('tech_user_id', $id)
                //->where('date_serv >=', $s)
                //->where('date_serv <=', $e)
                ->count_all_results('other_services');
               
        return $rs;
    }
    public function get_mservice_total_by_date($id, $s, $e){
        $rs = $this->db
                ->where('tech_user_id', $id)
                ->where('date_serv >=', $s)
                ->where('date_serv <=', $e)
                ->count_all_results('main_services');
               
        return $rs;
    }
    
    public function get_oservice_total_by_date($id, $s, $e){
        $rs = $this->db
                ->where('tech_user_id', $id)
                ->where('date_serv >=', $s)
                ->where('date_serv <=', $e)
                ->count_all_results('other_services');
               
        return $rs;
    }
    public function get_user_list(){
        $rs = $this->db
                ->where_in('user_type', array('2', '3'))
                ->get('users')
                ->result();
        return $rs;
    }
    
    public function get_mstatus_total($status){
        $rs = $this->db
                ->where('service_status', $status)
                //->where('date_serv >=', $s)
                //->where('date_serv <=', $e)
                ->count_all_results('main_services');
               
        return $rs;
    }
    
    
        
    public function get_ostatus_total($status){
        $rs = $this->db
                ->where('service_status', $status)
                //->where('date_serv >=', $s)
                //->where('date_serv <=', $e)
                ->count_all_results('other_services');
               
        return $rs;
    }

    public function get_mstatus_total_by_date($status, $s, $e){
        $rs = $this->db
                ->where('service_status', $status)
                ->where('date_serv >=', $s)
                ->where('date_serv <=', $e)
                ->count_all_results('main_services');
               
        return $rs;
    }
    
    
        
    public function get_ostatus_total_by_date($status, $s, $e){
        $rs = $this->db
                ->where('service_status', $status)
                ->where('date_serv >=', $s)
                ->where('date_serv <=', $e)
                ->count_all_results('other_services');
               
        return $rs;
    }
      
    
    public function get_main_service_detail($sv){
        $rs = $this->db->where('s.service_code', $sv)
                ->select(array(
                	's.*', 'p.product_serial','p.code as product_code', 
                	'p.name as product_name', 'o.name as owner_name', 
                	'u.fullname as request_name', 'b.name as brand_name', 'm.name as model_name',
                	'sp.name as supplier_name', 'year(current_date()) - year(p.purchase_date) as age'))
                ->join('products p', 'p.id=s.product_id', 'left')
                ->join('product_brands b', 'b.id=p.brand_id', 'left')
            	->join('product_models m', 'm.id=p.model_id', 'left')
            	->join('product_types t', 't.id=p.type_id', 'left')
            	->join('suppliers sp', 'sp.id=p.supplier_id', 'left')
                ->join('owners o', 'o.id=p.owner_id', 'left')
                ->join('users u', 'u.id=s.report_user_id', 'left')
                ->get('main_services s')
                ->row();
        return $rs;
    }
    
    public function get_other_service_detail($sv){
        $rs = $this->db
                ->select(array(
                        'o.name as owner_name', 's.*'
                    ))
                ->join('owners o', 'o.id=s.owner_id', 'left')
                ->where('s.service_code', $sv)
                ->order_by('s.date_serv', 'DESC')
                ->get('other_services s')
                ->row();
        return $rs; 
    }
}
