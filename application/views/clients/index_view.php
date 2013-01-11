<ul class="breadcrumb">
    <li class="active">หน้าหลัก</li>
</ul>

<div class="tabbable">
    <ul class="nav nav-pills">
        <li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-th-list"></i> รายการแจ้งซ่อมครุภัณฑ์</a></li>
        <li class=""><a href="#tab2" data-toggle="tab"><i class="icon-th"></i> รายการแจ้งซ่อมทั่วไป</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <blockquote>
                รายการครุภัณฑ์ที่แจ้งซ่อมทั้งหมด
            </blockquote>
            <form action="#" class="form-actions form-search">
            	<input type="hidden" value="0" id="txt_code_status"/>
                <div class="row-fluid">
                    <div class="span4">
                        <div class="input-append">
                            <input type="text" id="txt_code_query_service" placeholder="หมายเลขรับซ่อม/เลขครุภัณฑ์..." class="input-xlarge search-query">
                            <button type="button" id="btn_code_search" class="btn btn-info"><i class="icon-search icon-white"></i> ค้นหา</button>
                        </div>

                    </div>
                    <div class="offset5 span3">
                        <button class="btn btn-primary" type="button" id="btn_regcode_new">
                            <i class="icon-plus-sign icon-white"></i> เพิ่มรายการ
                        </button>
                        
                        <div class="btn-group pull-right">
		                    <button class="btn btn-success" type="button"><i class="icon-th-large icon-white"></i> สถานะซ่อม</button>
		                    <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">
		                        <span class="caret"></span>
		                    </button>
		                    <ul class="dropdown-menu">
		                    	<?php
			                        $status = get_status_list();
			
			                        foreach($status as $s){
			                            echo '<li><a href="javascript:void(0);" data-name="btn_code_get_status_list" data-id="'.$s->id.'">'.$s->name.'</a></li>';
			                        }
			                    ?>
		                    </ul>
	                    </div><br />
                    </div>
                </div>
            </form>
            <table class="table table-striped table-hover" id="tbl_code_service_list">
                <thead>
                <tr>
                    <th>เลขที่ใบรับซ่อม</th>
                    <th>วันที่แจ้ง</th>
                    <th>เลขที่ครุภัณฑ์</th>
                    <th>รายการ</th>
                    <th>อาการแจ้ง</th>
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
                </tr>
                </tbody>
            </table>
            <div id="main_paging" class="pagination pagination-centered">
                <ul></ul>
            </div>
        </div>
        
        <div class="tab-pane" id="tab2">
            <blockquote>
                รายการที่แจ้งซ่อมทั้งหมด
            </blockquote>
            <form action="#" class="form-actions form-search">
            	<input type="hidden" value="0" id="txt_other_status"/>
                <div class="row-fluid">
                    <div class="span4">
                        <div class="input-append">
                            <input type="text" id="txt_other_query_service" placeholder="เลขที่ใบรับซ่อม เช่น SROxxx" class="input-xlarge search-query">
                            <button type="button" class="btn btn-info" id="btn_other_search"><i class="icon-search icon-white"></i> ค้นหา</button>
                        </div>
                    </div>
                    <div class="offset5 span3">
                        <button class="btn btn-primary" type="button" id="btn_other_new">
                            <i class="icon-plus-sign icon-white"></i> เพิ่มรายการ
                        </button>
                        
                        <div class="btn-group pull-right">
		                    <button class="btn btn-success" type="button"><i class="icon-th-large icon-white"></i> สถานะซ่อม</button>
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
                    
                    </div>
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
                </tr>
                </tbody>
            </table>
            <div id="main_paging_other" class="pagination pagination-centered">
                <ul></ul>
            </div>
        </div>
    </div>
</div>

<div class="modal hide fade" id="mdl_new_by_code">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>ค้นหารายการสินค้า</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="txt_regcode_product_code">รายการ</label>
                <div class="controls">
                    <div class="input-append">
                        <input type="hidden" id="txt_regcode_product_id">
                        <input class="input-xlarge uneditable-input" disabled="disabled" id="txt_regcode_product_code" type="text">
                        <button class="btn btn-info" type="button" id="btn_regcode_search_product"><i class="icon-search icon-white"></i></button>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txt_regcode_cause">รายละเอียด/อาการเสีย</label>
                <div class="controls">
                    <textarea class="input-xxlarge" rows="3" id="txt_regcode_cause"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txt_regcode_comment">หมายเหตุ</label>
                <div class="controls">
                    <textarea class="input-xxlarge" rows="3" id="txt_regcode_comment"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="sl_regcode_priority">ความสำคัญ</label>
                <div class="controls">
                    <select id="sl_regcode_priority">
                        <?php
                        foreach($priority as $t)
                            echo '<option value="'.$t->id.'">' . $t->name . '</option>';
                        ?>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success" id="btn_save_regcode"><i class="icon-plus-sign icon-white"></i> บันทึกรายการ</a>
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
    </div>
</div>


<div class="modal hide fade" id="mdl_new_by_other">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>เพิ่มรายการ</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal">
        	<input type="hidden" id="txt_other_isupdate"/>
        	<input type="hidden" id="txt_other_id"/>
            <div class="control-group">
                <label class="control-label" for="txt_other_product_code">รายการ</label>
                <div class="controls">
                    <div class="input-append">
                        <input class="input-xlarge" id="txt_other_product_name" type="text">
                	</div>
               	</div>
            </div>
            <div class="control-group">
                <label class="control-label" for="sl_other_owners">หน่วยงาน</label>
                <div class="controls">
                    <select id="sl_other_owners">
                    	<option value="">-----</option>
                        <?php
                        foreach($owners as $t)
                            echo '<option value="'.$t->id.'">' . $t->name . '</option>';
                        ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txt_other_cause">รายละเอียด/อาการเสีย</label>
                <div class="controls">
                    <textarea class="input-xxlarge" rows="3" id="txt_other_cause"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="txt_regcode_cause">หมายเหตุ</label>
                <div class="controls">
                    <textarea class="input-xxlarge" rows="3" id="txt_other_comment"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="sl_other_priority">ความสำคัญ</label>
                <div class="controls">
                    <select id="sl_other_priority">
                        <?php
                        foreach($priority as $t)
                            echo '<option value="'.$t->id.'">' . $t->name . '</option>';
                        ?>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success" id="btn_save_other"><i class="icon-plus-sign icon-white"></i> บันทึกรายการ</a>
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
    </div>
</div>

<div class="modal hide fade" id="mdl_search_product">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>ค้นหารายการ</h3>
    </div>
    <div class="modal-body">
        <form action="#" class="form-actions form-search">
            <div class="input-append">
                <input type="text" id="txt_regcode_query_product" class="input-xxlarge search-query" placeholder="เลขครุภัณฑ์/ชื่อ... เช่น 6530-001-3110/00036, เสาน้ำเกลือ">
                <button type="button" id="btn_regcode_do_search" class="btn btn-info">ค้นหา</button>
            </div>
        </form>

        <table class="table table-striped table-hover" id="tbl_reg_search_product_result">
            <thead>
            <tr>
                <th>เลขครุภัณฑ์</th>
                <th>รายการ</th>
                <th>หน่วยงาน</th>
                <th>ยี่ห้อ</th>
                <th>รุ่น</th>
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
                <td>...</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/clients.js"></script>
