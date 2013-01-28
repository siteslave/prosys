<?php
if ( ! function_exists('render_json'))
{
    function render_json($json)
    {
        ini_set('display_errors', 0);
        header('Content-Type: application/json');
        echo $json;
    }

}

if ( ! function_exists('get_fullname') ) {
    function get_fullname( $username ) {
        $ci =& get_instance();

        $result = $ci->db->select('fullname')
            ->where('username', $username)
            ->get('users')
            ->row();
        return $result ? $result->fullname : '-';
    }
}
if ( ! function_exists('get_type_name') ) {
	function get_type_name( $id ) {
		$ci =& get_instance();

		$result = $ci->db->select('name')
		->where('id', $id)
		->get('service_types')
		->row();
		return $result ? $result->name : '-';
	}
}

if ( ! function_exists('get_technician_type_name') ) {
	function get_technician_type_name( $id ) {
		$ci =& get_instance();

		$result = $ci->db->select('name')
		->where('id', $id)
		->get('technician_types')
		->row();
		return $result ? $result->name : '-';
	}
}

if ( ! function_exists('get_type_service_name') ) {
	function get_type_service_name( $id ) {
		$ci =& get_instance();

		$result = $ci->db->select('name')
		->where('id', $id)
		->get('type_services')
		->row();

		return $result ? $result->name : '-';
	}
}


if ( ! function_exists('get_user_fullname_by_id') ) {
    function get_user_fullname_by_id( $id ) {
        $ci =& get_instance();

        $result = $ci->db->select('fullname')
            ->where('id', $id)
            ->get('users')
            ->row();
        return $result ? $result->fullname : '';
    }
}

if ( ! function_exists('get_item_name') ) {
    function get_item_name( $id ) {
        $ci =& get_instance();

        $result = $ci->db->select('name')
            ->where('id', $id)
            ->get('items')
            ->row();
        return $result ? $result->name : '-';
    }
}

if ( ! function_exists('get_company_name') ) {
    function get_company_name( $id ) {
        $ci =& get_instance();

        $result = $ci->db->select('name')
            ->where('id', $id)
            ->get('suppliers')
            ->row();
        return $result ? $result->name : '-';
    }
}
if ( ! function_exists('get_service_item_id') ) {
    function get_service_item_id( $id ) {
        $ci =& get_instance();

        $result = $ci->db->select('item_id')
            ->where('id', $id)
            ->get('service_items')
            ->row();
        return $result ? $result->item_id : NULL;
    }
}

if ( ! function_exists('get_user_type') ) {
    function get_user_type( $username ) {
        $ci =& get_instance();

        $result = $ci->db->select('user_type')
            ->where('username', $username)
            ->get('users')
            ->row();
        return $result ? $result->user_type : NULL;
    }
}

if ( ! function_exists('get_user_status') ) {
    function get_user_status( $username ) {
        $ci =& get_instance();

        $result = $ci->db->select('user_status')
            ->where('username', $username)
            ->get('users')
            ->row();
        return $result ? $result->user_status : NULL;
    }
}
if ( ! function_exists('get_user_id') ) {
    function get_user_id( $username ) {
        $ci =& get_instance();

        $result = $ci->db->select('id')
            ->where('username', $username)
            ->get('users')
            ->row();
        return $result ? $result->id : NULL;
    }
}

if(!function_exists('get_current_name'))
{
    function get_current_name()
    {
        $ci =& get_instance();

        return $ci->session->userdata('fullname');
    }
}


/**
 * Get user agent
 *
 * @return string User agent
 **/
if ( ! function_exists( 'get_user_agent' ) )
{
    function get_user_agent()
    {
        $ci =& get_instance();
        if ( $ci->agent->is_browser() )
        {
            $agent = $ci->agent->browser() . ' ' . $ci->agent->version() . ' ' . $ci->agent->platform();
        }
        elseif( $ci->agent->is_robot() )
        {
            $agent = $ci->agent->robot();
        }
        elseif( $ci->agent->is_mobile() )
        {
            $agent = $this->agent->mobile();
        }
        else
        {
            $agent = 'Unknow agent';
        }

        return $agent;
    }
}

/**
 * Create logging
 *
 * @param string $log_level Log level 'info', 'warning', 'error'
 * @param string $log_message
 * @param string $log_ip User ip address
 * @param string $log_agent User agent
 **/
if ( ! function_exists( 'logging' ) )
{
    function logging( $logs )
    {
        $ci =& get_instance();

        date_default_timezone_set('Asia/Bangkok');

        $logs['log_date'] = date("Y-m-d");
        $logs['log_time'] = date("H:i:s");
        $logs['log_user'] = $ci->session->userdata('user_name');

        $ci->db->insert( 'logs', $logs );
    }
}
/**
 * Generate serial
 *
 * @param   string  $sr_type Type of serial
 * @param   boolean $gen_date Add 2 digits of year to serial
 * @return  string
 */
if ( ! function_exists('generate_serial'))
{
    function generate_serial($sr_type, $gen_date = FALSE)
    {
        $ci =& get_instance();
        $ci->load->model('Serial_model', 'serial');
        //Generate serial with year and month digit.

        $prefix = $ci->serial->get_prefix($sr_type);
        //generate with year and month
        if($gen_date)
        {
            //formatted serial
            $sr_m = $ci->serial->get_month_prefix($sr_type);
            $sr_y = $ci->serial->get_year_prefix($sr_type);

            //for month prefix
            if($sr_m != date('m'))
            {
                //update month
                $ci->serial->update_month($sr_type, date('m'));
                //set to current month
                $sr_m = date('m');
                $ci->serial->reset_serial($sr_type);
            }

            //for year prefix
            $current_year = date('Y') + 543;
            $short_year = substr($current_year, -2) ;

            if($sr_y != $short_year)
            {
                //update year
                $ci->serial->update_year($sr_type, $short_year);
				$ci->serial->reset_serial($sr_type);
            }

            $new_sr = $prefix.'-'.$short_year.$sr_m;

        }
        else
        {//generate without year and month
            $new_sr = $prefix;
        }

        $sn = $ci->serial->get_serial($sr_type);
        $sn = get_string_length($sn);

        $a = $new_sr. '-' .$sn;

        //Update serials
        $ci->serial->update_serial($sr_type);

        return $a;
    }
}
//private function for serial
function get_string_length($sn)
{

    switch(strlen($sn))
    {
        case 1:
            $new_sn = '00000'.$sn;
            break;
        case 2:
            $new_sn = '0000'.$sn;
            break;
        case 3:
            $new_sn = '000'.$sn;
            break;
        case 4:
            $new_sn = '00'.$sn;
            break;
        case 5:
            $new_sn = '0'.$sn;
            break;
        case 6:
            $new_sn = $sn;
            break;
        default:
            $new_sn = '000001';
    }

    return $new_sn;
}

if( !function_exists('gen_unique'))
{
    function gen_unique()
    {
        $id = uniqid(hash("sha512",rand()), TRUE);
        $code = hash("sha512", $id);
        return substr($code, 0, 32);
    }
}

if(!function_exists('to_thai_date'))
{
    function to_thai_date($eng_date)
    {
        if(strlen($eng_date) != 10)
        {
            return null;
        }
        else
        {
            $new_date = explode('-', $eng_date);

            $new_y = (int) $new_date[0] + 543;
            $new_m = $new_date[1];
            $new_d = $new_date[2];

            $thai_date = $new_d . '/' . $new_m . '/' . $new_y;

            return $thai_date;
        }
    }
}

if(!function_exists('to_js_date'))
{
    function to_js_date($eng_date)
    {
        if(strlen($eng_date) != 10)
        {
            return null;
        }
        else
        {
            $new_date = explode('-', $eng_date);

            $new_y = $new_date[0];
            $new_m = $new_date[1];
            $new_d = $new_date[2];

            $thai_date = $new_d . '/' . $new_m . '/' . $new_y;

            return $js_date;
        }
    }
}

if(!function_exists('to_mysql_date'))
{
    function to_mysql_date($eng_date)
    {
        if(strlen($eng_date) != 10){
            return null;
        }
        else
        {
        	try {
        		$new_date = explode('/', $eng_date);

        		$new_y = $new_date[2];
        		$new_m = $new_date[1];
        		$new_d = $new_date[0];

        		$thai_date = $new_y . '-' . $new_m . '-' . $new_d;

        		return $thai_date;
        	} catch (Exception $e) {
        		return '0000-00-00';
        	}

        }
    }
}

if(!function_exists('get_technician_list'))
{
	function get_technician_list()
	{
		$ci =& get_instance();
		$ci->load->model('User_model', 'user');

		$users = $ci->user->get_technician_list();

		return $users;
	}
}


if(!function_exists('get_admin_list'))
{
	function get_admin_list()
	{
		$ci =& get_instance();
		$ci->load->model('User_model', 'user');

		$users = $ci->user->get_admin_list();

		return $users;
	}
}


if(!function_exists('get_service_type_list'))
{
	function get_service_type_list()
	{
		$ci =& get_instance();
		$ci->load->model('Basic_model', 'basic');

		$rs = $ci->basic->get_service_type();

		return $rs;
	}
}

if(!function_exists('get_technician_type_list'))
{
	function get_technician_type_list()
	{
		$ci =& get_instance();
		$ci->load->model('Basic_model', 'basic');

		$rs = $ci->basic->get_technician_type_list();

		return $rs;
	}
}

if(!function_exists('get_type_of_service'))
{
	function get_type_of_service(){
		$ci =& get_instance();
		$ci->load->model('Basic_model', 'basic');

		$rs = $ci->basic->get_type_of_service();

		return $rs;
	}
}

if(!function_exists('count_technician_in_more'))
{
	function count_technician_in_more($sv)
	{
		$ci =& get_instance();
		$ci->load->model('Basic_model', 'basic');

		$rs = $ci->basic->count_technician_in_more($sv);

		return $rs;
	}
}


if(!function_exists('get_owner_list'))
{
    function get_owner_list()
    {
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');

        $rs = $ci->basic->get_owner_list();

        return $rs;
    }
}

if(!function_exists('get_status_list'))
{
    function get_status_list()
    {

        $ci =& get_instance();
        $ci->load->model('Statuses_model', 'statuses');

        $rs = $ci->statuses->get_list();

        return $rs;
    }
}

if(!function_exists('get_status_name'))
{
    function get_status_name($status)
    {

        $ci =& get_instance();
        $ci->load->model('Statuses_model', 'statuses');

        $rs = $ci->statuses->get_name($status);

        return empty($rs->name) ? '-' : $rs->name;
    }
}

if(!function_exists('get_discharge_status_list'))
{
    function get_discharge_status_list()
    {
        $data = array(
            array('name' =>'ส่งพัสดุซื้อวัสดุ', 'code' => 1),
            array('name' =>'ส่งพัสดุซื้อทดแทน', 'code' => 1),
            array('name' =>'ส่งพัสดุจัดจ้างช่างข้างนอก', 'code' => 1)
        );

        return $data;
    }

}
