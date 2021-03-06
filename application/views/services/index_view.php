<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a> <span class="divider">/</span></li>
    <li class="active"></li>  บริการ
</ul>

<input type="hidden" id="txt_regcode_view_by" value="1">
<input type="hidden" id="txt_other_view_by" value="1">
<div class="tabbable">
    <ul class="nav nav-pills">
        <li class="active"><a href="#tab1" id="tab_service_by_code" data-toggle="tab"><i class="icon-th-list"></i> รายการแจ้งซ่อมครุภัณฑ์</a></li>
        <li class=""><a href="#tab2" id="tab_service_by_other" data-toggle="tab"><i class="icon-th"></i> รายการแจ้งซ่อมทั่วไป</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <blockquote>
                <p>ข้อมูลการแจ้งซ่อม</p>
            </blockquote>
            <form action="#" class="form-inline form-actions">

                <label for="txt_query_product">ค้นหา</label>
                <div class="input-append">
                    <input class="input-xlarge" id="txt_query_product" type="text" placeholder="เลขครุภัณฑ์ หรือ เลขที่ใบแจ้งซ่อม...">
                    <button class="btn btn-info" type="button" id="btn_search_product">
                        <i class="icon-search icon-white"></i> ค้นหา
                    </button>
                </div>
                <div class="btn-group pull-right">
                    <button class="btn btn-success" type="button"><i class="icon-th-list icon-white"></i> สถานะซ่อม</button>
                    <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                    <?php
                        $status = get_status_list();

                        foreach($status as $s){
                            echo '<li><a href="javascript:void(0);" data-name="btn_regcode_get_status_list" data-id="'.$s->id.'">'.$s->name.'</a></li>';
                        }
                    ?>
                    </ul>
                </div>
            </form>
            <table class="table table-striped table-hover" id="tbl_code_service_list">
                <thead>
                <tr>
                    <th>เลขที่ใบรับซ่อม</th>
                    <th>วันที่แจ้ง</th>
                    <th>เลขที่ครุภัณฑ์</th>
                    <th>รายการ</th>
                    <th>หน่วยงาน</th>
                    <th>อาการแจ้ง</th>
                    <th>เจ้าหน้าที่รับผิดชอบ</th>
                    <th>สถานะ</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                </tr>
                </tbody>
            </table>

            <div id="main_paging" class="pagination pagination-centered">
                <ul></ul>
            </div>

        </div>
        <div class="tab-pane" id="tab2">
            <blockquote>
                <p>ข้อมูลการแจ้งซ่อมโดยไม่ได้ระบุเลขทะเบียนครุภัณฑ์</p>
            </blockquote>
            <form action="#" class="form-inline form-actions">

                <label for="txt_query_product">ค้นหา</label>
                <div class="input-append">
                    <input class="input-xlarge" id="txt_other_query_product" type="text" placeholder="เลขที่ใบแจ้งซ่อม...">
                    <button class="btn btn-info" type="button" id="btn_other_search_product">
                        <i class="icon-search icon-white"></i> ค้นหา
                    </button>
                </div>

                <div class="btn-group pull-right">
                    <button class="btn btn-success" type="button"><i class="icon-th-list icon-white"></i> สถานะซ่อม</button>
                    <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                    <?php
                        $status = get_status_list();

                        foreach($status as $s){
                            echo '<li><a href="javascript:void(0);" data-name="btn_other_get_status_list" data-id="'.$s->id.'">'.$s->name.'</a></li>';
                        }
                    ?>
                    </ul>
                </div>
            </form>
            <table class="table table-striped table-hover" id="tbl_other_service_list">
                <thead>
                <tr>
                    <th>เลขที่ใบรับซ่อม</th>
                    <th>วันที่แจ้ง</th>
                    <th>หน่วยงาน</th>
                    <th>รายการ</th>
                    <th>อาการแจ้ง</th>
                   <th>เจ้าหน้าที่รับผิดชอบ</th>
                    <th>สถานะ</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                </tr>
                </tbody>
            </table>

            <div id="main_paging_other" class="pagination pagination-centered">
                <ul></ul>
            </div>

        </div>
    </div>
</div>

    <!-- change status -->
    <div class="modal hide fade" id="mdl_regcode_change_status">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>เปลี่ยนสถานะซ่อม</h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal">

                <div class="control-group">
                    <label class="control-label" for="txt_regcode_service_code">เลขที่ใบแจ้งซ่อม</label>
                    <div class="controls">
                        <input type="text" id="txt_regcode_service_code" class="uneditable-input" disabled="disabled">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sl_regcode_service_status">สถานะซ่อม</label>
                    <div class="controls">
                        <select id="sl_regcode_service_status">
                        <?php
                        $status = get_status_list();

                            foreach($status as $s){
                                echo '<option value="'.$s->id.'">'.$s->name.'</option>';
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <legend>ยืนยัน (Confirmation)</legend>
                <div class="control-group">
                    <label class="control-label" for="sl_regcode_status_user">ชื่อผู้ใช้งาน</label>
                    <div class="controls">
                        <select id="sl_regcode_status_user">
	                        <?php
	                        $users = get_technician_list();
	
	                            foreach($users as $u){
	                                echo '<option value="'.$u->id.'">'.$u->fullname.'</option>';
	                            }
	                        ?>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="txt_regcode_status_password">รหัสผ่าน</label>
                    <div class="controls">
                        <input type="password" id="txt_regcode_status_password">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-success" id="btn_regcode_do_change_status"><i class="icon-share icon-white"></i> เปลี่ยนสถานะซ่อม</a>
            <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
        </div>
    </div>
    <!-- end change status -->

    <!-- change other status -->
    <div class="modal hide fade" id="mdl_other_change_status">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>เปลี่ยนสถานะซ่อม</h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal">

                <div class="control-group">
                    <label class="control-label" for="txt_other_service_code">เลขที่ใบแจ้งซ่อม</label>
                    <div class="controls">
                        <input type="text" id="txt_other_service_code" class="uneditable-input" disabled="disabled">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sl_other_service_status">สถานะซ่อม</label>
                    <div class="controls">
                        <select id="sl_other_service_status">
                            <?php
                            $status = get_status_list();

                                foreach($status as $s){
                                    echo '<option value="'.$s->id.'">'.$s->name.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <legend>ยืนยัน (Confirmation)</legend>
                <div class="control-group">
                    <label class="control-label" for="sl_other_status_user">ชื่อผู้ใช้งาน</label>
                    <div class="controls">
                        <select id="sl_other_status_user">
                        	<option value="">---</option>
	                        <?php
	                        $users = get_technician_list();
	
	                            foreach($users as $u){
	                                echo '<option value="'.$u->id.'">'.$u->fullname.'</option>';
	                            }
	                        ?>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="txt_other_status_password">รหัสผ่าน</label>
                    <div class="controls">
                        <input type="password" id="txt_other_status_password">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-success" id="btn_other_do_change_status"><i class="icon-share icon-white"></i> เปลี่ยนสถานะซ่อม</a>
            <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
        </div>
    </div>
    <!-- end change other status -->
    <!-- assign technician -->
    <div class="modal hide fade" id="mdl_regcode_assign_tech">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>กำหนดช่างผู้รับผิดชอบ</h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal">

                <div class="control-group">
                    <label class="control-label" for="txt_regcode_assign_tech_service_code">เลขที่ใบแจ้งซ่อม</label>
                    <div class="controls">
                        <input type="text" id="txt_regcode_assign_tech_service_code" class="uneditable-input" disabled="disabled">
                    </div>
                </div>
                <legend>ยืนยัน (Confirmation)</legend>
                <div class="control-group">
                    <label class="control-label" for="sl_regcode_assign_tech_user">ชื่อผู้ใช้งาน</label>
                    <div class="controls">
                        <select id="sl_regcode_assign_tech_user">
                        	<option value="">---</option>
	                        <?php
	                        $users = get_technician_list();
	
	                            foreach($users as $u){
	                                echo '<option value="'.$u->id.'">'.$u->fullname.'</option>';
	                            }
	                        ?>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="txt_regcode_assign_tech_password">รหัสผ่าน</label>
                    <div class="controls">
                        <input type="password" id="txt_regcode_assign_tech_password">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-success" id="btn_regcode_assign_tech_do_assign"><i class="icon-share icon-white"></i> ยืนยันการกำหนดผู้รับผิดชอบ</a>
            <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
        </div>
    </div>
    <!-- end assign technician -->

    <!-- assign technician other-->
    <div class="modal hide fade" id="mdl_other_assign_tech">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>กำหนดช่างผู้รับผิดชอบ</h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal">

                <div class="control-group">
                    <label class="control-label" for="txt_other_assign_tech_service_code">เลขที่ใบแจ้งซ่อม</label>
                    <div class="controls">
                        <input type="text" id="txt_other_assign_tech_service_code" class="uneditable-input" disabled="disabled">
                    </div>
                </div>
                
                <legend>ยืนยัน (Confirmation)</legend>
                <div class="control-group">
                    <label class="control-label" for="sl_other_assign_tech_user">ชื่อผู้ใช้งาน</label>
                    <div class="controls">
                        <select id="sl_other_assign_tech_user">
                        	<option value="">---</option>
	                        <?php
	                        $users = get_technician_list();
	
	                            foreach($users as $u){
	                                echo '<option value="'.$u->id.'">'.$u->fullname.'</option>';
	                            }
	                        ?>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="sl_regcode_service_status">รหัสผ่าน</label>
                    <div class="controls">
                        <input type="password" id="txt_other_assign_tech_password">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-success" id="btn_other_assign_tech_do_assign"><i class="icon-share icon-white"></i> ยืนยันการกำหนดผู้รับผิดชอบ</a>
            <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
        </div>
    </div>
    <!-- end assign technician -->

    <!-- save result code-->
    <div class="modal hide fade" id="mdl_result">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>บันทึกสรุปผลการให้บริการ</h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal">
                <input type="hidden" id="txt_result_type" />
                <input type="hidden" id="txt_result_id" />
                <div class="control-group">
                    <label class="control-label" for="txt_result_service_code">เลขที่ใบแจ้งซ่อม</label>
                    <div class="controls">
                        <input type="text" id="txt_result_service_code" class="uneditable-input" disabled="disabled">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="txt_result">สรุปผลการให้บริการ</label>
                    <div class="controls">
                        <textarea class="input-xxlarge" rows="4" id="txt_result"></textarea>
                    </div>
                </div>
                
                 <div class="control-group">
                    <label class="control-label" for="txt_result">จำหน่าย</label>
                    <div class="controls">
                        <input type="checkbox" id="chk_result_discharge">
                    </div>
                </div>
				<legend>ยืนยัน (Confirmation)</legend>
				<div class="control-group">
                    <label class="control-label" for="sl_result_user">ชื่อผู้ใช้งาน</label>
                    <div class="controls">
                        <select id="sl_result_user">
                        	<option value="">---</option>
	                        <?php
	                        $users = get_technician_list();
	
	                            foreach($users as $u){
	                                echo '<option value="'.$u->id.'">'.$u->fullname.'</option>';
	                            }
	                        ?>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="txt_result_password">รหัสผ่าน</label>
                    <div class="controls">
                        <input type="password" id="txt_result_password">
                    </div>
            	</div>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-success" id="btn_do_result"><i class="icon-share icon-white"></i> บันทึกข้อมูล</a>
            <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
        </div>
    <!-- end s
    </div>ave result code -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/services.js"></script>
