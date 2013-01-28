<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a> <span class="divider">/</span></li>
    <li class="active">ระบบรายงาน</li>
</ul>

<div class="tabbable">
    <ul class="nav nav-pills">
        <li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-th-list"></i> สถิติการให้บริการ</a></li>
        <li class=""><a href="#tab2" data-toggle="tab"><i class="icon-print"></i> รายงานอื่นๆ</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <blockquote>
                <p>แสดงข้อมูลรายงานการให้บริการ</p>
            </blockquote>
            <form action="#" class="form-inline well">

                <label for="txt_idx_rpt_date_s">ตั้งแต่</label>
                <div class="input-append date" data-name="datepicker">
             		<input class="input-small" id="txt_idx_rpt_date_s" size="16" type="text" disabled>
           			<span class="add-on"><i class="icon-th"></i></span>
        		</div>
            	<label for="txt_idx_rpt_date_e">ถึง</label>
                <div class="input-append date" data-name="datepicker">
					<input class="input-small" id="txt_idx_rpt_date_e" size="16" type="text" disabled>
   					<span class="add-on"><i class="icon-th"></i></span>
				</div>
				<select id="sl_idx_rpt_type" class="input-medium">
					<option value="1">ซ่อมครุภัณฑ์</option>
					<option value="2">ซ่อมทั่วไป</option>
				</select>
				<select id="sl_idx_rpt_tos" class="input-medium">
					<option value="0">ทั้งหมด</option>
					<?php
					$t = get_type_of_service();
					foreach($t as $r) echo '<option value="'.$r->id.'">' . $r->name . '</option>';
					?>
				</select>
				<select id="sl_idx_rpt_discharge" class="input-medium">
					<option value="0">ทั้งหมด</option>
					<option value="1">ซ่อมเสร็จแล้ว</option>
					<option value="2">ซ่อมยังไม่เสร็จ</option>
				</select>

            	<a href="javascript:void(0);" class="btn btn-info" id="btn_idx_rpt_do_get"><i class="icon-search icon-white"></i> แสดง</a>
            	<a href="javascript:void(0);" class="btn" id="btn_print_report"><i class="icon-print"></i> พิมพ์</a>

            </form>
            <table class="table" id="tbl_idx_rpt_main_list">
                <thead>
                <tr>
                    <th>#</th>
                    <th>วันที่แจ้ง</th>
                    <th>เวลา</th>
                    <th>ความสำคัญ</th>
                    <th>ครุภัณฑ์</th>
                    <th>รายการ</th>
                    <th>แผนก/หน่วยงาน</th>
                    <th>อาการแจ้ง</th>
                    <th>ประเภทงานซ่อม</th>
                    <th>วันที่จำหน่าย</th>
                    <th>จำนวนวัน</th>
                </tr>
                </thead>

                <tbody>
                	<tr>
                		<td colspan="9">ไม่พบรายการ</td>
                	</tr>

                </tbody>
            </table>
        </div>

        <div class="tab-pane" id="tab2">
		    <div class="tabbable tabs-left">
			    <ul class="nav nav-tabs">
			    <li class="active"><a href="#tab_sub_rpt1" data-toggle="tab"><i class="icon-print"></i> แยกตามประเภทงาน</a></li>
			    <li><a href="#tab_sub_rpt2" data-toggle="tab"><i class="icon-print"></i> แยกตามประเภทงานซ่อม</a></li>
        		<li><a href="#tab_sub_rpt3" data-toggle="tab"><i class="icon-print"></i> แยกตามสถานที่ส่งซ่อม</a></li>
        		<li><a href="#tab_sub_rpt4" data-toggle="tab"><i class="icon-print"></i> แยกตามเจ้าหน้าที่ (ช่าง)</a></li>
        		<li><a href="#tab_sub_rpt5" data-toggle="tab"><i class="icon-print"></i> แยกตามสถานะซ่อม</a></li>
			    </ul>
			    <div class="tab-content">
					<div class="tab-pane active" id="tab_sub_rpt1">
                        <legend>สถิติการให้บริการแยกตามประเภทงาน</legend>
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

			            <table class="table table-striped" id="tbl_rpt_by_service_type" style="width: 680px;">
			            <thead>
			            	<tr>
			            		<th>ประเภทงาน</th>
			            		<th>ครุภัณฑ์</th>
			            		<th>ทั่วไป</th>
			            		<th>รวม</th>
			            	</tr>
			            </thead>
			            <tbody>
			            	<tr>
			            		<td colspan="4">กรุณาเลือกเงื่อนไขการค้นหา</td>
			            	</tr>
			            </tbody>
			            </table>
					</div>

					<div class="tab-pane" id="tab_sub_rpt2">
                        <legend>สถิติการให้บริการแยกตามประเภทงานซ่อม</legend>
			            <form class="form-inline well">
			                <label for="txt_discharge_date">ตั้งแต่</label>
			                <div class="input-append date" data-name="datepicker">
			             		<input class="input-small" id="txt_rpt_by_tos_date_s" size="16" type="text" disabled>
			           			<span class="add-on"><i class="icon-th"></i></span>
			        		</div>
			            	<label for="txt_discharge_date">ถึง</label>
			                <div class="input-append date" data-name="datepicker">
								<input class="input-small" id="txt_rpt_by_tos_date_e" size="16" type="text" disabled>
			   					<span class="add-on"><i class="icon-th"></i></span>
							</div>
			            	<a href="javascript:void(0);" class="btn btn-info" id="btn_rpt_do_by_tos"><i class="icon-search icon-white"></i> แสดงรายงาน</a>
			            </form>

						<div class="row-fluid">
							<div class="span6">
							<table class="table table-striped" id="tbl_rpt_by_tos" >
					            <thead>
					            	<tr>
					            		<th>ประเภทงานซ่อม</th>
					            		<th>ครุภัณฑ์</th>
					            		<th>ทั่วไป</th>
					            		<th>จำนวน</th>
					            		<th>#</th>
					            	</tr>
					            </thead>
					            <tbody>
					            <tr>
			            			<td colspan="5">กรุณาเลือกเงื่อนไขการค้นหา</td>
			            		</tr>
					            </tbody>
					            </table>
							</div>
							<div class="span6">
							<table class="table table-striped" id="tbl_rpt_by_tos_sub" style="display: none;">
					            <thead>
					            	<tr>
					            		<th>รายการ</th>
					            		<th>ครุภัณฑ์</th>
					            		<th>ทั่วไป</th>
					            		<th>จำนวน</th>
					            	</tr>
					            </thead>
					            <tbody>
					            	<tr>
					            		<td colspan="4">กรุณาเลือกเงื่อนไขการค้นหา</td>
					            	</tr>
					            </tbody>
					            </table>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="tab_sub_rpt3">
                        <legend>สถิติการให้บริการแยกตามช่าง/ผู้ปฏิบัติงาน</legend>
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
			            <tbody>
			            	<tr>
			            		<td colspan="2">กรุณาเลือกเงื่อนไขการค้นหา</td>
			            	</tr>
			            </tbody>
			            </table>
					</div>

			    	<div class="tab-pane" id="tab_sub_rpt4">
			    		<legend>สถิติการให้บริการแยกตามช่าง/ผู้ปฏิบัติงาน</legend>
					    <form action="#" class="well form-inline">
					        <label for="txt_send_date">ตั้งแต่วันที่</label>
					        <div class='input-append date' id='datepicker'>
					            <input class='input-small' disabled id='txt_rpt_tech_sdate' type='text'>
					            <span class='add-on'>
					              <i class='icon-th'></i>
					            </span>
					        </div>
					        <label for="txt_send_date">ถึงวันที่</label>
					        <div class='input-append date' id='datepicker'>
					            <input class='input-small' disabled id='txt_rpt_tech_edate' type='text'>
					            <span class='add-on'>
					              <i class='icon-th'></i>
					            </span>
					        </div>
					        <a href="javascript:void(0);" class="btn btn-info" id="btn_rpt_tech_get"><i class="icon-search icon-white"></i></a>
					    </form>
					    <table class="table table-striped table-hover" id="tbl_tech_service_count">
					        <thead>
					            <tr>
					                <th>ชื่อช่าง</th>
					                <th>ซ่อมครุภัณฑ์</th>
					                <th>ซ่อมทั่วไป</th>
					                <th>ซ่อมร่วม</th>
					                <th>รวม</th>
					            </tr>
					        </thead>
					        <tbody></tbody>
					    </table>
			    	</div>

                    <div class="tab-pane" id="tab_sub_rpt5">
                        <legend>สถิการให้บริการแยกตามสถานะรับซ่อม</legend>
                        <form action="#" class="well form-inline">
                            <label for="txt_rpt_status_sdate">ตั้งแต่วันที่</label>
                            <div class='input-append date' id='datepicker'>
                                <input class='input-small' disabled id='txt_rpt_status_sdate' type='text'>
                                <span class='add-on'>
                                  <i class='icon-th'></i>
                                </span>
                            </div>
                            <label for="txt_rpt_status_edate">ถึงวันที่</label>
                            <div class='input-append date' id='datepicker'>
                                <input class='input-small' disabled id='txt_rpt_status_edate' type='text'>
                                <span class='add-on'>
                                  <i class='icon-th'></i>
                                </span>
                            </div>
                            <a href="javascript:void(0);" class="btn btn-info" id="btn_rpt_status_get"><i class="icon-search icon-white"></i></a>
                        </form>
                        <table class="table table-striped table-hover" id="tbl_status_count">
                            <thead>
                            <tr>
                                <th>สถานะ</th>
                                <th>ซ่อมครุภัณฑ์</th>
                                <th>ซ่อมทั่วไป</th>
                                <th>รวม</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
			    </div>
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
            <input type="hidden" id="txt_old_name">
            <div class="control-group">
                <label class="control-label" for="txt_name">ชื่อ</label>
                <div class="controls">
                    <input type="text" id="txt_name" class="input-xlarge" placeholder="...">
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success" id="btn_save"><i class="icon-plus-sign icon-white"></i> บันทึกรายการ</a>
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/reports.index.js"></script>