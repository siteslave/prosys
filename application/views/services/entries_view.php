<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url('services'); ?>">การบริการ</a> <span class="divider">/</span></li>
    <li class="active"></li>  บันทึกข้อมูลการให้บริการ
</ul>

<input type="hidden" id="service_id" value="<?php echo $id; ?>">
<input type="hidden" id="service_code" value="<?php echo $sv; ?>">
<blockquote>
    บันทึกข้อมูลกิจกรรมการให้บริการ และ ค่าใช้จ่ายในการซ่อมบำรุง
</blockquote>
<div class="tabbable tabs-left">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-info-sign"></i> ข้อมูลการรับซ่อม</a></li>
        <li><a href="#tab2" data-toggle="tab"><i class="icon-th-list"></i> บันทึกข้อมูลการให้บริการ</a></li>
        <li><a href="#tab3" data-toggle="tab"><i class="icon-shopping-cart"></i> บันทึกข้อมูลค่าใช้จ่าย</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <form class="form-horizontal" action="#">
                <legend>ข้อมูลการแจ้งซ่อม</legend>
                <div class="control-group">
                    <label class="control-label" for="txt_service_code">เลขที่ใบรับซ่อม</label>
                    <div class="controls">
                        <input type="text" id="txt_service_code" disabled="disabled" class="uneditable-input" value="<?php echo $sv;?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_product_code">เลขที่ครุภัณฑ์</label>
                    <div class="controls">
                        <input type="text" id="txt_product_code" class="uneditable-input" disabled="disabled" value="<?php echo $product_code;?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_product_name">ชื่อสินค้า</label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge uneditable-input" disabled="disabled" id="txt_product_name" value="<?php echo $product_name;?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_owner_name">หน่วยงาน</label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge uneditable-input" disabled="disabled" id="txt_owner_name" value="<?php echo $owner_name;?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="txt_owner_name">ผู้แจ้ง</label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge uneditable-input" disabled="disabled" id="txt_owner_name" value="<?php echo $request_name;?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_service_cause">อาการแจ้งซ่อม</label>
                    <div class="controls">
                        <textarea id="txt_service_cause" rows="3" class="input-xxlarge uneditable-textarea" disabled="disabled">
                            <?php echo $cause;?>
                        </textarea>
                    </div>
                </div>

            </form>
        </div>
        <div class="tab-pane" id="tab2">
            <legend>ข้อมูลการให้บริการ</legend>
            <table class="table table-striped table-hover" id="tbl_act_list">
                <thead>
                <tr>
                    <th>วันที่</th>
                    <th>เวลา</th>
                    <th>เจ้าหน้าที่</th>
                    <th>กิจกรรมที่ทำ</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                </tr>
                </tbody>
            </table>
            <a href="javascript:void(0);" class="btn btn-success pull-right" id="btn_new_activities"><i class="icon-plus-sign icon-white"></i> เพิ่มกิจกรรม</a>
        </div>
        <div class="tab-pane" id="tab3">
            <legend>บันทึกค่าใช้จ่าย/อุปกรณ์</legend>
            <table class="table table-striped table-hover" id="tbl_item_list">
                <thead>
                <tr>
                    <th>ค่าใช้จ่าย/อุปกรณ์</th>
                    <th>ราคา</th>
                    <th>จำนวน</th>
                    <th>รวม (บาท)</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                </tr>
                </tbody>
            </table>
            <blockquote>
               รวมเป็นเงิน <strong><span id="txt_bath_total"></span></strong> บาท
            </blockquote>
            <a href="javascript:void(0);" class="btn btn-success pull-right" id="btn_new_item"><i class="icon-plus-sign icon-white"></i> เพิ่มรายการ</a>

        </div>
    </div>


</div>


<div class="modal hide fade" id="mdl_new_activities">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>ข้อมูลกิจกรรม</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" action="#">
            <div class="control-group">
                <label class="control-label" for="txt_act_service_code">เลขที่ใบรับซ่อม</label>
                <div class="controls">
                    <input type="text" id="txt_act_service_code" disabled="disabled" class="uneditable-input" value="<?php echo $sv;?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txt_act_detail">ข้อมูลการให้บริการ</label>
                <div class="controls">
                    <textarea id="txt_act_detail" rows="4" class="input-xxlarge"></textarea>
                </div>
            </div>
            <legend>ยืนยัน (Confirmation)</legend>
				<div class="control-group">
                    <label class="control-label" for="sl_act_user">ชื่อผู้ใช้งาน</label>
                    <div class="controls">
                        <select id="sl_act_user">
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
                    <label class="control-label" for="txt_act_password">รหัสผ่าน</label>
                    <div class="controls">
                        <input type="password" id="txt_act_password">
                    </div>
            	</div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success" id="btn_act_do_save"><i class="icon-plus-sign icon-white"></i> บันทึกรายการ</a>
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>

    </div>
</div>

<div class="modal hide fade" id="mdl_new_item">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>เพิ่มรายการค่าใช้จ่าย/อถุปกรณ์</h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>คำแนะนำ</strong> คลิกปุ่มค้นหาเพื่อเลือกรายการ
        </div>
        <form class="form-horizontal" action="#">

            <input type="hidden" id="txt_item_isupdate">

            <div class="control-group">
                <label class="control-label" for="txt_act_service_code">เลขที่ใบรับซ่อม</label>
                <div class="controls">
                    <input type="text" id="txt_item_service_code" disabled="disabled" class="uneditable-input" value="<?php echo $sv;?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txt_item_name">ค่าใช้จ่าย/อุปกรณ์</label>
                <div class="controls">
                    <div class="input-append">
                        <input type="hidden" id="txt_item_id">
                        <input class="input-xlarge uneditable-input" id="txt_item_name" disabled="disabled" placeholder="คลิกปุ่มค้นหาเพื่อเลือกรายการ..." type="text">
                        <button class="btn btn-info" type="button" id="btn_item_show_search"><i class="icon-search icon-white"></i></button>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span4">
                    <div class="control-group">
                        <label class="control-label" for="txt_item_price">ราคา</label>
                        <div class="controls">
                            <input type="text" class="input-small" data-type="number" id="txt_item_price">
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="control-group">
                        <label class="control-label" for="txt_item_price">จำนวน</label>
                        <div class="controls">
                            <input type="text" class="input-mini" id="txt_item_qty" data-type="number">
                        </div>
                    </div>
                </div>
            </div>
            <legend>ยืนยัน (Confirmation)</legend>
				<div class="control-group">
                    <label class="control-label" for="sl_item_user">ชื่อผู้ใช้งาน</label>
                    <div class="controls">
                        <select id="sl_item_user">
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
                    <label class="control-label" for="txt_item_password">รหัสผ่าน</label>
                    <div class="controls">
                        <input type="password" id="txt_item_password">
                    </div>
            	</div>
        </form>

    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success" id="btn_item_do_save"><i class="icon-plus-sign icon-white"></i> บันทึกรายการ</a>
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>

    </div>
</div>

<div class="modal hide fade" id="mdl_search_item">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>ค้นหารายการ</h3>
    </div>
    <div class="modal-body">
        <blockquote>ค้นหารายการค่าใช้จ่าย และ อุปกรณ์</blockquote>
        <form class="form-inline form-actions" action="#">
            <label for="txt_item_query_search">ค้นหา</label>
            <div class="input-append">
                <input id="txt_item_query_search" class="input-xlarge" type="text" placeholder="พิมพ์ชื่อค่าใช้จ่าย หรือ อุปกรณ์...">
                <button class="btn btn-info" type="button" id="btn_item_do_search"><i class="icon-search icon-white"></i></button>
            </div>
        </form>
          <table class="table table-striped" id="tbl_item_search_result">
              <thead>
              <tr>
                  <th>รายการ</th>
                  <th>ราคา</th>
                  <th>#</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                  <td>...</td>
                  <td>...</td>
                  <td>...</td>
              </tr>
              </tbody>
          </table>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>

    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/services.entries.js"></script>
