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
                ->where('date_serv >=', to_mysql_date($s))
                ->where('date_serv <=', to_mysql_date($e))
                ->count_all_results('main_services');

        return $rs;
    }

    public function get_oservice_total_by_date($id, $s, $e){
        $rs = $this->db
                ->where('tech_user_id', $id)
                ->where('date_serv >=', to_mysql_date($s))
                ->where('date_serv <=', to_mysql_date($e))
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
    	$sql = 'select count(*) as t from main_services where date_serv '.
    			'between "'.to_mysql_date($s).'" and "'.to_mysql_date($e).'" and service_status=' . $status;
		$rs = $this->db->query($sql)->row();

        return (int) $rs->t;
    }



    public function get_ostatus_total_by_date($status, $s, $e){
  		$sql = 'select count(*) as t from other_services where date_serv '.
    			'between "'.to_mysql_date($s).'" and "'.to_mysql_date($e).'" and service_status=' . $status;
		$rs = $this->db->query($sql)->row();

        return (int) $rs->t;
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

    public function get_service_type_by_technician_main($user_id, $start_date, $end_date){
    	$sql = '
    			select m.service_type_id, count(*) as t
				from main_services m
				where m.date_serv between "'.to_mysql_date($start_date).'" and "'.to_mysql_date($end_date).'"
				and m.tech_user_id='.$user_id . ' group by m.service_type_id ';

    	$rs = $this->db->query($sql)->result();

    	return $rs;
    }


    public function get_service_type_by_technician_other($user_id, $start_date, $end_date){
    	$sql = '
    			select o.service_type_id, count(*) as t
				from other_services o
				where o.date_serv between "'.to_mysql_date($start_date).'" and "'.to_mysql_date($end_date).'"
				and o.tech_user_id='.$user_id . ' group by o.service_type_id ';

    	$rs = $this->db->query($sql)->result();

    	return $rs;
    }

    public function get_send_place($start_date, $end_date){
    	$sql = '
    			select s.place, count(*) as t
				from send_services s
				where s.send_date between "'.to_mysql_date($start_date).'" and "'.to_mysql_date($end_date).'"
				group by s.place ';

    	$rs = $this->db->query($sql)->result();

    	return $rs;
    }

    public function get_total_more_technician($tech_user_id){
    	$rs = $this->db->where('tech_user_id', $tech_user_id)->count_all_results('service_technicians');
    	return (int) $rs;
    }

    public function get_total_more_technician_by_date($tech_user_id, $s, $e){
    	$sql = 'select count(*) as t
				from service_technicians st
				left join main_services s on s.service_code=st.service_code
				where st.tech_user_id=' . $tech_user_id .
				' and s.date_serv between "'.to_mysql_date($s).'" and "'.to_mysql_date($e).'"';
    	$rs = $this->db->query($sql)->row();

    	return (int) $rs->t;
    }


    public function get_tos_main($id, $s, $e){
    	$rs = $this->db->where('type_service_id', $id)
    					->where('date_serv >=', to_mysql_date($s))
    					->where('date_serv <=', to_mysql_date($e))
    					->count_all_results('main_services');
    	return $rs;
    }

    public function get_tos_other($id, $s, $e){
    	$rs = $this->db->where('type_service_id', $id)
    	->where('date_serv >=', to_mysql_date($s))
    	->where('date_serv <=', to_mysql_date($e))
    	->count_all_results('other_services');
    	return $rs;
    }

    public function get_tos_main_status($id, $status_id, $s, $e){
    	$rs = $this->db->where('type_service_id', $id)
    	->where('date_serv >=', to_mysql_date($s))
    	->where('date_serv <=', to_mysql_date($e))
    	->where('service_status', $status_id)
    	->count_all_results('main_services');
    	return $rs;
    }

    public function get_tos_other_status($id, $status_id, $s, $e){
    	$rs = $this->db->where('type_service_id', $id)
    	->where('date_serv >=', to_mysql_date($s))
    	->where('date_serv <=', to_mysql_date($e))
    	->where('service_status', $status_id)
    	->count_all_results('other_services');
    	return $rs;
    }

    public function get_tos_main_svt($id, $svt_id, $s, $e){
    	$rs = $this->db->where('type_service_id', $id)
    	->where('date_serv >=', to_mysql_date($s))
    	->where('date_serv <=', to_mysql_date($e))
    	->where('service_type_id', $svt_id)
    	->count_all_results('main_services');
    	return $rs;
    }

    public function get_tos_other_svt($id, $svt_id, $s, $e){
    	$rs = $this->db->where('type_service_id', $id)
    	->where('date_serv >=', to_mysql_date($s))
    	->where('date_serv <=', to_mysql_date($e))
    	->where('service_type_id', $svt_id)
    	->count_all_results('other_services');
    	return $rs;
    }

    public function get_total_svt_main($user_id, $id, $s, $e){
    	$rs = $this->db->where('type_service_id', $id)
    	->where('date_serv >=', to_mysql_date($s))
    	->where('date_serv <=', to_mysql_date($e))
    	->where('service_type_id', $id)
    	->where('tech_user_id', $user_id)
    	->count_all_results('main_services');
    	return $rs;
    }
    public function get_total_svt_other($user_id, $id, $s, $e){
    	$rs = $this->db->where('type_service_id', $id)
    	->where('date_serv >=', to_mysql_date($s))
    	->where('date_serv <=', to_mysql_date($e))
    	->where('service_type_id', $id)
    	->where('tech_user_id', $user_id)
    	->count_all_results('other_services');
    	return $rs;
    }

    public function get_total_list_all_main($s, $e, $d, $t)
    {

    	if($d == '0')
    	{
    		$sql = '
    			select s.service_code, p.name as product_name, p.code as product_code, s.cause, s.date_serv, d.discharge_date,
				DATEDIFF(d.discharge_date,s.date_serv) as count_date, o.name as owner_name,
				t.name as type_service_name, s.time_serv, pt.name as pri_name
				from main_services s
				left join products p on p.id=s.product_id
				left join service_discharges d on d.service_code=s.service_code
    			left join owners o on o.id=p.owner_id
    			left join type_services t on t.id=s.type_service_id
    			left join priorities pt on pt.id=s.priority_id
    			where s.date_serv between "'.$s.'" and "'.$e.'"
    			';
    		if($t != '0')
    		{
    			$sql .= ' and s.type_service_id=' . $t;
    		}
    	}
    	else if($d == '1')
    	{
    		$sql = '
    			select s.service_code, p.name as product_name, p.code as product_code, s.cause, s.date_serv, d.discharge_date,
				DATEDIFF(d.discharge_date,s.date_serv) as count_date, o.name as owner_name,
				t.name as type_service_name, s.time_serv, pt.name as pri_name
				from main_services s
				left join products p on p.id=s.product_id
				join service_discharges d on d.service_code=s.service_code
    			left join owners o on o.id=p.owner_id
    			left join type_services t on t.id=s.type_service_id
    			left join priorities pt on pt.id=s.priority_id
    			where s.date_serv between "'.$s.'" and "'.$e.'"
    			';
    		if($t != '0')
    		{
    			$sql .= ' and s.type_service_id=' . $t;
    		}
    	}
    	else
    	{
    		$sql = '
    			select s.service_code, p.name as product_name, p.code as product_code, s.cause, s.date_serv, d.discharge_date,
				DATEDIFF(d.discharge_date,s.date_serv) as count_date, o.name as owner_name,
				t.name as type_service_name, s.time_serv, pt.name as pri_name
				from main_services s
				left join products p on p.id=s.product_id
    			left join owners o on o.id=p.owner_id
    			left join service_discharges d on d.service_code=s.service_code
    			left join type_services t on t.id=s.type_service_id
    			left join priorities pt on pt.id=s.priority_id
    			where s.date_serv between "'.$s.'" and "'.$e.'"
    			and s.service_code not in(select service_code from service_discharges)
    			';
    		if($t != '0')
    		{
    			$sql .= ' and s.type_service_id=' . $t;
    		}
    	}

    	$rs = $this->db->query($sql)->result();
    	return $rs;
    }

    public function get_total_list_all_other($s, $e, $d, $t)
    {
    	if($d == '0')
    	{
    		$sql = '
				select s.service_code, s.product_name, o.name as owner_name,
				s.product_desc, s.cause, s.date_serv, d.discharge_date,
				DATEDIFF(d.discharge_date,s.date_serv) as count_date, t.name as type_service_name,
				s.time_serv, pt.name as pri_name
				from other_services s
				left join service_discharges d on d.service_code=s.service_code
				left join owners o on o.id=s.owner_id
    			left join type_services t on t.id=s.type_service_id
    			left join priorities pt on pt.id=s.priority_id
    			where s.date_serv between "'.$s.'" and "'.$e.'"
    			';
    		if($t != '0')
    		{
    			$sql .= ' and s.type_service_id=' . $t;
    		}
    	}
    	else if($d == '1')
    	{
    		$sql = '
				select s.service_code, s.product_name, o.name as owner_name,
				s.product_desc, s.cause, s.date_serv, d.discharge_date,
				DATEDIFF(d.discharge_date,s.date_serv) as count_date, t.name as type_service_name,
				s.time_serv, pt.name as pri_name
				from other_services s
				join service_discharges d on d.service_code=s.service_code
				left join owners o on o.id=s.owner_id
    			left join type_services t on t.id=s.type_service_id
    			left join priorities pt on pt.id=s.priority_id
    			where s.date_serv between "'.$s.'" and "'.$e.'"
    			';
    		if($t != '0')
    		{
    			$sql .= ' and s.type_service_id=' . $t;
    		}
    	}
    	else
    	{
    		$sql = '
				select s.service_code, s.product_name, o.name as owner_name,
				s.product_desc, s.cause, s.date_serv, d.discharge_date,
				DATEDIFF(d.discharge_date,s.date_serv) as count_date, t.name as type_service_name,
				s.time_serv, pt.name as pri_name
				from other_services s
				left join owners o on o.id=s.owner_id
    			left join service_discharges d on d.service_code=s.service_code
    			left join type_services t on t.id=s.type_service_id
    			left join priorities pt on pt.id=s.priority_id
    			where s.date_serv between "'.$s.'" and "'.$e.'"
    			and s.service_code not in(select service_code from service_discharges)
    			';
    		if($t != '0')
    		{
    			$sql .= ' and s.type_service_id=' . $t;
    		}
    	}


    	$rs = $this->db->query($sql)->result();
    	return $rs;
    }
}
