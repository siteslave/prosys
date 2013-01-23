<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ระบบงานซ่อมบำรุง</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <style>
        body {
            padding-top: 40px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/apps/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/freeow/freeow.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/xcharts.min.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/underscore.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/jquery.numeric.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/taffy.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/bootstrap-datepicker.th.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/numeral.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/jquery.freeow.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/jquery.paging.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/d3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/xcharts.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/apps.js"></script>

    <script type="text/javascript">
        base_url = '<?php echo base_url(); ?>';
    </script>
</head>

<body>
<div id="freeow" class="freeow freeow-bottom-right"></div>
<div class="navbar navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">E-Service</a>

            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li>
                        <a href="<?php echo site_url(); ?>">
                            <i class="icon-home"></i> หน้าหลัก
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-th-list"></i> การให้บริการหลัก
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo site_url('services'); ?>"><i class="icon-list"></i> รายการซ่อมทั้งหมด</a>
                            </li>
                            <!--
                            <li>
                                <a href="#"><i class="icon-edit"></i> ลงทะเบียนรับซ่อม</a>
                            </li>
                            -->
                            <li>
                                <a href="<?php echo site_url('sends');?>"><i class="icon-share"></i> ทะเบียนส่งซ่อมที่อื่น</a>
                            </li>
                        </ul>
                    </li>
					<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-print"></i> ระบบรายงาน
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="javascript:void(0);" data-name="btn_rpt_technician_by_service_type_main"><i class="icon-print"></i> สถิติการซ่อมของช่างแยกตามประเภทงานซ่อม (ครุภัณฑ์)</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" data-name="btn_rpt_technician_by_service_type_other"><i class="icon-print"></i> สถิติการซ่อมของช่างแยกตามประเภทงานซ่อม (ทั่วไป)</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" data-name="btn_rpt_by_place"><i class="icon-print"></i> สถิติการส่งซ่อม (แยกตามสถานที่ส่งซ่อม)</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-folder-open"></i> ข้อมูลพื้นฐาน
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo site_url('products'); ?>"><i class="icon-list"></i> ทะเบียนครุภัณฑ์</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('owners'); ?>"><i class="icon-edit"></i> ทะเบียนหน่วยงาน</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admins'); ?>"><i class="icon-share"></i> ทะเบียนผู้ใช้งาน (Users)</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo site_url('types'); ?>"><i class="icon-share"></i> ประเภทครุภัณฑ์ (Types)</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('groups'); ?>"><i class="icon-share"></i> กลุ่มครุภัณฑ์ (Groups)</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('brands'); ?>"><i class="icon-refresh"></i> ยี่ห้อ (Brands)</a>
                            </li>

                            <li>
                                <a href="<?php echo site_url('models'); ?>"><i class="icon-search"></i> รุ่น (Models)</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo site_url('suppliers'); ?>"><i class="icon-search"></i> ทะเบียนบริษัท/ร้านค้า</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('parts'); ?>"><i class="icon-search"></i> รายการอะไหล่ (Spare parts) </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('status'); ?>"><i class="icon-search"></i> สถานะงานซ่อม (Service status) </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <?php
                if( get_current_name() ) {
                    ?>
                    <div class="btn-group pull-right">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user"></i> <?php echo get_current_name(); ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">

                            <li><a href="#" data-name="chk-pass"><i class="icon-edit"></i> เปลี่ยนรหัสผ่าน (Change password)</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url('users/logout'); ?>"><i class="icon-off"></i>  ออกจากระบบ (Logout)</a></li>
                        </ul>
                    </div>

                    <?php
                }
                ?>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container">
    <?php echo $content_for_layout; ?>
</div> <!-- /container -->


<div class="modal hide fade" id="mdl_change_password">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>เปลี่ยนรหัสผ่าน</h3>
    </div>
    <div class="modal-body">
        <form action="#" class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="txt_password">รหัสผ่านใหม่</label>
                <div class="controls">
                    <input type="password" id="txt_password" class="input-xlarge">
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success" id="btn_do_change_password"><i class="icon-plus-sign icon-white"></i> เปลี่ยนรหัสผ่าน</a>
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
    </div>
</div>

<!-- report by technician and service type -->
   <div class="modal hide fade" id="mdl_rpt_service_type">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>สถิติการให้บริการแยกตามประเภทงาน (ครุภัณฑ์)</h3>
        </div>
        <div class="modal-body">
            <form class="form-inline well">

                <label for="sl_rpt_by_service_type_user">ชื่อผู้ใช้งาน</label>
                <select id="sl_rpt_by_service_type_user">
                    <option value="">---</option>
	                    <?php
                        $users = get_technician_list();

                        foreach($users as $u){
                            echo '<option value="'.$u->id.'">'.$u->fullname.'</option>';
                        }
                        ?>
                </select>

                <label for="txt_discharge_date">ตั้งแต่</label>
                <div class="input-append date" data-name="datepicker">
             		<input class="input-small" id="txt_rpt_by_service_type_date_s" size="16" type="text" disabled>
           			<span class="add-on"><i class="icon-th"></i></span>
        		</div>
            	<label for="txt_discharge_date">ถึง</label>
                <div class="input-append date" data-name="datepicker">
					<input class="input-small" id="txt_rpt_by_service_type_date_e" size="16" type="text" disabled>
   					<span class="add-on"><i class="icon-th"></i></span>
				</div>
            	<a href="javascript:void(0);" class="btn btn-info" id="btn_rpt_do_by_service_type"><i class="icon-search icon-white"></i> แสดงรายงาน</a>
            </form>

            <table class="table table-striped" id="tbl_rpt_by_service_type">
            <thead>
            	<tr>
            		<th>ประเภทงาน</th>
            		<th>จำนวน</th>
            	</tr>
            </thead>
            <tbody></tbody>
            </table>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
        </div>
   </div>

   	<div class="modal hide fade" id="mdl_rpt_service_type_other">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>สถิติการให้บริการแยกตามประเภทงาน (ทั่วไป)</h3>
        </div>
        <div class="modal-body">
            <form class="form-inline well">

                <label for="sl_rpt_by_service_type_user_other">ชื่อผู้ใช้งาน</label>
                <select id="sl_rpt_by_service_type_user_other">
                    <option value="">---</option>
	                    <?php
                        $users = get_technician_list();

                        foreach($users as $u){
                            echo '<option value="'.$u->id.'">'.$u->fullname.'</option>';
                        }
                        ?>
                </select>

                <label for="txt_discharge_date">ตั้งแต่</label>
                <div class="input-append date" data-name="datepicker">
             		<input class="input-small" id="txt_rpt_by_service_type_date_s_other" size="16" type="text" disabled>
           			<span class="add-on"><i class="icon-th"></i></span>
        		</div>
            	<label for="txt_discharge_date">ถึง</label>
                <div class="input-append date" data-name="datepicker">
					<input class="input-small" id="txt_rpt_by_service_type_date_e_other" size="16" type="text" disabled>
   					<span class="add-on"><i class="icon-th"></i></span>
				</div>
            	<a href="javascript:void(0);" class="btn btn-info" id="btn_rpt_do_by_service_type_other"><i class="icon-search icon-white"></i> แสดงรายงาน</a>
            </form>

            <table class="table table-striped" id="tbl_rpt_by_service_type_other">
            <thead>
            	<tr>
            		<th>ประเภทงาน</th>
            		<th>จำนวน</th>
            	</tr>
            </thead>
            <tbody></tbody>
            </table>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
        </div>
   </div>

   	<div class="modal hide fade" id="mdl_rpt_by_place">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>สถิติการส่งซ่อมแยกตามสถานที่ส่ง</h3>
        </div>
        <div class="modal-body">
            <form class="form-inline well">
                <label for="txt_discharge_date">ตั้งแต่</label>
                <div class="input-append date" data-name="datepicker">
             		<input class="input-small" id="txt_rpt_by_place_date_s" size="16" type="text" disabled>
           			<span class="add-on"><i class="icon-th"></i></span>
        		</div>
            	<label for="txt_discharge_date">ถึง</label>
                <div class="input-append date" data-name="datepicker">
					<input class="input-small" id="txt_rpt_by_place_date_e" size="16" type="text" disabled>
   					<span class="add-on"><i class="icon-th"></i></span>
				</div>
            	<a href="javascript:void(0);" class="btn btn-info" id="btn_rpt_do_by_place"><i class="icon-search icon-white"></i> แสดงรายงาน</a>
            </form>

            <table class="table table-striped" id="tbl_rpt_by_place">
            <thead>
            	<tr>
            		<th>สถานที่ส่งซ่อม</th>
            		<th>จำนวน</th>
            	</tr>
            </thead>
            <tbody></tbody>
            </table>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
        </div>
   </div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/index.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/reports.main.js"></script>

</body>
</html>
