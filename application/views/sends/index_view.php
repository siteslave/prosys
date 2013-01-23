<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url('services'); ?>">การให้บริการ</a> <span class="divider">/</span></li>
    <li class="active">ส่งซ่อมสินค้า</li>
</ul>

<div class="tabbable">
    <ul class="nav nav-pills">
        <li class="active"><a href="#tab1" id="tab_main" data-toggle="tab"><i class="icon-th-list"></i> รายการส่งซ่อม</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <blockquote>
                <p>บันทึกรายการส่งซ่อมสินค้า (กรณีส่งซ่อมที่อื่น)</p>
            </blockquote>
            <form action="#" class="form-inline form-actions">

            	<input type="hidden" id="txt_status" value="-1">

                <label for="txt_query">ค้นหา</label>
                <div class="input-append">
                    <input class="input-xlarge" id="txt_query" type="text" placeholder="เลขที่ใบรับซ่อม, เลขที่ใบส่งซ่อม...">
                    <button class="btn btn-info" type="button" id="btn_search">
                        <i class="icon-search icon-white"></i> ค้นหา
                    </button>
                </div>

                <button class="btn btn-success" type="button" id="btn_new">
                    <i class="icon-plus-sign icon-white"></i> เพิ่มรายการ
                </button>

                <div class="btn-group pull-right">
                	<a href="javascript:void(0);" class="btn" data-name="btn_set_status" data-status="-1"><i class="icon-refresh"></i>ทั้งหมด</a>
                	<a href="javascript:void(0);" class="btn" data-name="btn_set_status" data-status="1"><i class="icon-share-alt"></i>รับคืนแล้ว</a>
                	<a href="javascript:void(0);" class="btn" data-name="btn_set_status" data-status="0"><i class="icon-share"></i>ยังไม่รับคืน</a>
                </div>

            </form>
            <table class="table table-striped" id="tbl_list">
                <thead>
                <tr>
                	<th>วันที่</th>
                    <th>เลขที่ส่งซ่อม</th>
                    <th>เลขที่รับซ่อม</th>
                    <th>เลขครุภัณฑ์</th>
                    <th>ชื่อครุภัณฑ์</th>
                    <th>สถานที่ส่งซ่อม</th>
                    <th>ผู้ส่งซ่อม</th>
                    <th>สถานะ</th>
                    <th>#</th>
                </tr>
                </thead>

                <tbody>
                </tbody>
            </table>

            <div id="main_paging" class="pagination pagination-centered">
                <ul></ul>
            </div>

        </div>
    </div>
</div>

<div class="modal hide fade" id="mdl_new">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>เพิ่มรายการ</h3>
    </div>
    <div class="modal-body">
        <form action="#" class="form-horizontal">
            <input type="hidden" id="txt_id">
            <div class="control-group">
                    <label class="control-label" for="txt_send_date">วันที่ส่งซ่อม</label>
                    <div class="controls">
                        <div class='input-append date' id='datepicker'>
                            <input class='input-small' disabled id='txt_send_date' type='text'>
                            <span class='add-on'>
                              <i class='icon-th'></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="control-group">
	                <label class="control-label" for="btn_new_search_service">เลขที่ใบรับซ่อม</label>
	                <div class="controls">
	                    <div class="input-append">
	                    <input class="input-xlarge uneditable-input" disabled="disabled" id="txt_new_service_code" type="text" placeholder="เลขที่ใบรับซ่อม">
	                    <button class="btn btn-info" type="button" id="btn_new_search_service">
	                        <i class="icon-search icon-white"></i> ค้นหา
	                    </button>
	                </div>
	                </div>
	            </div>
                <div class="control-group">
	                <label class="control-label" for="txt_new_service_company_name">สถานที่ส่งซ่อม</label>
	                <div class="controls">
	                    <div class="input-append">
	                   	<input type="hidden" id="txt_new_service_company_id">
	                    <input class="input-xlarge uneditable-input" disabled="disabled" id="txt_new_service_company_name" type="text" placeholder="สถานที่ส่งซ่อม">
	                    <button class="btn btn-info" type="button" id="btn_search_company">
	                        <i class="icon-search icon-white"></i> ค้นหา
	                    </button>
	                </div>
	                </div>
	            </div>
                <div class="control-group">
	                <label class="control-label" for="txt_new_send_comment">หมายเหตุ</label>
	                <div class="controls">
	                    <textarea class="input-xxlarge" rows="4" id="txt_new_send_comment"></textarea>
	                </div>
	            </div>
	            <div class="control-group">
				  <label class="control-label" for="sl_new_send_place">ประเภท</label>
				  <div class="controls">
					<select>
						<option value="1">ในจังหวัด</option>
						<option value="2">นอกจังหวัด</option>
					</select>
				  </div>
				</div>
	            <div class="control-group">
				  <label class="control-label" for="chk_new_send_change_status">เปลี่ยนสถานะ</label>
				  <div class="controls">
					<input type="checkbox" id="chk_new_send_change_status">
				  </div>
				</div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success" id="btn_save"><i class="icon-plus-sign icon-white"></i> บันทึกรายการ</a>
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
    </div>
</div>

<!-- update -->
<div class="modal hide fade" id="mdl_update">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>แก้ไขรายการ</h3>
    </div>
    <div class="modal-body">
        <form action="#" class="form-horizontal">
            <input type="hidden" id="txt_update_id">
            <div class="control-group">
                    <label class="control-label" for="txt_edit_send_date">วันที่ส่งซ่อม</label>
                    <div class="controls">
                        <div class='input-append date'>
                            <input class='input-small' disabled id='txt_edit_send_date' type='text'>
                            <span class='add-on'>
                              <i class='icon-th'></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
	                <label class="control-label" for="txt_edit_send_code">เลขที่ใบส่งซ่อม</label>
	                <div class="controls">
	                    <div class="input-append">
	                    <input class="input-xlarge uneditable-input" disabled="disabled" id="txt_edit_send_code" type="text" placeholder="...">
	                </div>
	                </div>
	            </div>
                <div class="control-group">
	                <label class="control-label" for="txt_edit_service_code">เลขที่ใบรับซ่อม</label>
	                <div class="controls">
	                    <div class="input-append">
	                    <input class="input-xlarge uneditable-input" disabled="disabled" id="txt_edit_service_code" type="text" placeholder="...">
	                </div>
	                </div>
	            </div>

                <div class="control-group">
	                <label class="control-label" for="txt_edit_username">เจ้าหน้าที่</label>
	                <div class="controls">
	                    <div class="input-append">
	                    <input class="input-xlarge uneditable-input" disabled="disabled" id="txt_edit_username" type="text" placeholder="...">
	                </div>
	                </div>
	            </div>
                <div class="control-group">
	                <label class="control-label" for="txt_edit_service_company_name">สถานที่ส่งซ่อม</label>
	                <div class="controls">
	                    <div class="input-append">
	                   	<input type="hidden" id="txt_edit_service_company_id">
	                    <input class="input-xlarge uneditable-input" disabled="disabled" id="txt_edit_service_company_name" type="text" placeholder="สถานที่ส่งซ่อม">
	                    <button class="btn btn-info" type="button" id="btn_edit_search_company">
	                        <i class="icon-search icon-white"></i> ค้นหา
	                    </button>
	                </div>
	                </div>
	            </div>
                <div class="control-group">
	                <label class="control-label" for="txt_edit_send_comment">หมายเหตุ</label>
	                <div class="controls">
	                    <textarea class="input-xxlarge" rows="4" id="txt_edit_send_comment"></textarea>
	                </div>
	            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success" id="btn_edit_save"><i class="icon-plus-sign icon-white"></i> บันทึกรายการ</a>
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
    </div>
</div>

<!-- end update -->

<!-- get -->
<div class="modal hide fade" id="mdl_get">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>รับกลับครุภัณฑ์</h3>
    </div>
    <div class="modal-body">
        <form action="#" class="form-horizontal">
            <input type="hidden" id="txt_send_id">
            <div class="control-group">
                    <label class="control-label" for="txt_get_date">วันที่รับ</label>
                    <div class="controls">
                        <div class='input-append date' id='datepicker'>
                            <input class='input-small' disabled id='txt_get_date' type='text'>
                            <span class='add-on'>
                              <i class='icon-th'></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
	                <label class="control-label" for="txt_get_send_code">เลขที่ใบส่งซ่อม</label>
	                <div class="controls">
	                    <div class="input-append">
	                    <input class="input-xlarge uneditable-input" disabled="disabled" id="txt_get_send_code" type="text" placeholder="...">
	                </div>
	                </div>
	            </div>
                <div class="control-group">
	                <label class="control-label" for="txt_get_service_code">เลขที่ใบรับซ่อม</label>
	                <div class="controls">
	                    <div class="input-append">
	                    <input class="input-xlarge uneditable-input" disabled="disabled" id="txt_get_service_code" type="text" placeholder="...">
	                </div>
	                </div>
	            </div>
                <div class="control-group">
	                <label class="control-label" for="txt_get_comment">หมายเหตุ</label>
	                <div class="controls">
	                    <textarea class="input-xxlarge" rows="4" id="txt_get_comment"></textarea>
	                </div>
	            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success" id="btn_get_save"><i class="icon-plus-sign icon-white"></i> บันทึกรายการ</a>
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
    </div>
</div>

<!-- end get -->

<!-- cancel get -->
<div class="modal hide fade" id="mdl_regemove_get">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>ยกเลิกรับกลับครุภัณฑ์</h3>
    </div>
    <div class="modal-body">
        <form action="#" class="form-horizontal">
            <input type="hidden" id="txt_remove_send_id">
            <div class="control-group">
                <label class="control-label" for="txt_get_send_code">เลขที่ใบส่งซ่อม</label>
                <div class="controls">
                    <div class="input-append">
                        <input class="input-xlarge uneditable-input" disabled="disabled" id="txt_remove_send_code" type="text" placeholder="...">
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txt_get_service_code">เลขที่ใบรับซ่อม</label>
                <div class="controls">
                    <div class="input-append">
                        <input class="input-xlarge uneditable-input" disabled="disabled" id="txt_remove_service_code" type="text" placeholder="...">
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txt_get_comment">เหตุผลการยกเลิก</label>
                <div class="controls">
                    <textarea class="input-xxlarge" rows="4" id="txt_remove_comment"></textarea>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success" id="btn_do_remove_get"><i class="icon-plus-sign icon-white"></i> บันทึกรายการ</a>
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
    </div>
</div>
<!-- end cancle get -->
<div class="modal hide fade" id="mdl_search_service">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>ค้นหาใบรับซ่อม</h3>
    </div>
    <div class="modal-body">
    	<blockquote>ค้นหาใบรับซ่อม</blockquote>
        <form action="#" class="form-horizontal form-actions">
            <div class="control-group">
                <label class="control-label" for="txt_search_service_query">เลขที่ใบรับซ่อม</label>
                <div class="controls">
                    <div class="input-append">
                    <input class="input-xlarge" id="txt_search_service_query" type="text" placeholder="เลขที่ใบรับซ่อม">
                    <button class="btn btn-info" type="button" id="btn_search_service">
                        <i class="icon-search icon-white"></i> ค้นหา
                    </button>
                </div>
                </div>
            </div>
        </form>

        <table class="table table-striped table-hover" id="tbl_service_result">
        	<thead>
        		<tr>
        			<th>วันที่ซ่อม</th>
        			<th>เลขที่ครุภัณฑ์</th>
        			<th>ชื่อสินค้า</th>
        			<th>หน่วยงาน</th>
        			<th></th>
        		</tr>
        	</thead>
        	<tbody></tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
    </div>
</div>

<div class="modal hide fade" id="mdl_search_company">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>ค้นหาร้านค้า/บริษัท</h3>
    </div>
    <div class="modal-body">
    	<blockquote>ค้นหาข้อมูลร้านค้า/บริษัทที่ต้องการส่งซ่อมครุภัณฑ์</blockquote>
        <form action="#" class="form-horizontal form-actions">
            <div class="control-group">
                <label class="control-label" for="txt_search_company_query">คำค้นหา</label>
                <div class="controls">
                    <div class="input-append">
                    <input class="input-xlarge" id="txt_search_company_query" type="text" placeholder="ชื่อร้านค้า...">
                    <button class="btn btn-info" type="button" id="btn_do_search_company">
                        <i class="icon-search icon-white"></i> ค้นหา
                    </button>
                </div>
                </div>
            </div>
        </form>

        <table class="table table-striped table-hover" id="tbl_company_result">
        	<thead>
        		<tr>
        			<th>ชื่อร้านค้า</th>
        			<th></th>
        		</tr>
        	</thead>
        	<tbody></tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/sends.js"></script>