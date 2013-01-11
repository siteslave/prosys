<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a> <span class="divider">/</span></li>
    <li class="active">รายการครุภัณฑ์</li>
</ul>

<div class="tabbable">
    <ul class="nav nav-pills">
        <li class="active"><a href="#tab1" id="tab_main" data-toggle="tab"><i class="icon-th-list"></i> รายการครุภัณฑ์</a></li>
        <li><a href="#tab2" id="tab_new_edit_product" data-toggle="tab"><i class="icon-plus-sign"></i> เพิ่ม/แก้ไข ครุภัณฑ์</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <blockquote>
                <p>จัดการข้อมูลครุภัณฑ์ทั้งหมดที่มีในฐานข้อมูล</p>
            </blockquote>
            <form action="#" class="form-inline form-actions">

                <label for="txt_query_product">ค้นหา</label>
                <div class="input-append">
                    <input class="input-xlarge" id="txt_query_product" type="text" placeholder="เลขครุภัณฑ์...">
                    <button class="btn btn-info" type="button" id="btn_search_product">
                        <i class="icon-search icon-white"></i> ค้นหา
                    </button>
                </div>
                <select name="sl_filter_by_type" id="sl_type">
                    <?php
                    foreach($types as $t)
                        echo '<option value="'.$t->id.'">' . $t->name . '</option>';
                    ?>
                </select>
                <select name="sl_filter_by_owner" id="sl_owner">
                    <?php
                        foreach($owners as $o)
                            echo '<option value="'.$o->id.'">' . $o->name . '</option>';
                    ?>
                </select>
                <button type="button" class="btn btn-info" id="btn_do_filter">
                    <i class="icon-search icon-white"></i> แสดงรายการ
                </button>
                <button type="button" class="btn btn-primary" id="btn_get_all">
                    <i class="icon-th-list icon-white"></i> ทั้งหมด
                </button>
            </form>
            <table class="table table-striped" id="table_product_list">
                <thead>
                <tr>
                    <th>เลขครุภัณฑ์</th>
                    <th>ชื่อครุภัณฑ์</th>
                    <th>ยี่ห้อ</th>
                    <th>หน่วยงาน</th>
                    <th>วันที่ซื้อ</th>
                    <th>ราคา</th>
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
            
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>หมายเหตุ!</strong> เนื่องจากรายการครุภัณฑ์มีจำนวนมาก ไม่สามารถแสดงรายการได้หมด กรุณาค้นหา หรือเลือกจากเงื่อนไขที่กำหนด
            </div>
        </div>
        <div class="tab-pane" id="tab2">
            <blockquote>
                เพิ่มครุภัณฑ์ใหม่เข้าในระบบ
            </blockquote>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>หมายเหตุ!</strong> กรุณากรอกข้อมูลของครุภัณฑ์ให้ถูกต้อง และสมบูรณ์ที่สุด
            </div>
            <form class="form-horizontal">
                <input type="hidden" id="product_id">
                <input type="hidden" id="old_code">
                <div class="control-group">
                    <label class="control-label" for="txt_product_code">เลขครุภัณฑ์</label>
                    <div class="controls">
                        <input type="text" id="txt_product_code" placeholder="xx-xx/xx">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_product_name">ชื่อครุภัณฑ์</label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge" id="txt_product_name" placeholder="ชื่อครุภัณฑ์">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sl_owners">หน่วยงาน</label>
                    <div class="controls">
                        <select id="sl_owners">
                            <?php
                            foreach($owners as $t)
                                echo '<option value="'.$t->id.'">' . $t->name . '</option>';
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sl_new_type">ประเภท</label>
                    <div class="controls">
                        <select id="sl_new_type">
                            <?php
                            foreach($types as $t)
                                echo '<option value="'.$t->id.'">' . $t->name . '</option>';
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sl_new_brand">ยี่ห้อ</label>
                    <div class="controls">
                        <select id="sl_new_brand">
                            <?php
                            foreach($brands as $b)
                                echo '<option value="'.$b->id.'">' . $b->name . '</option>';
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="sl_new_model">รุ่น</label>
                    <div class="controls">
                        <select id="sl_new_model">
                            <?php
                            foreach($models as $m)
                                echo '<option value="'.$m->id.'">' . $m->name . '</option>';
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_product_serial">Serial no.</label>
                    <div class="controls">
                        <input type="text" class="" id="txt_product_serial" placeholder="Serial no.">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_product_name">ปีที่จัดซื้อ</label>
                    <div class="controls">
                        <div class='input-append date' id='datepicker'>
                            <input class='input-small' disabled id='txt_purchase_date' type='text'>
                            <span class='add-on'>
                              <i class='icon-th'></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txt_purchase_price">ราคาซื้อ</label>
                    <div class="controls">
                        <input type="text" class="input-small" id="txt_purchase_price" data-type="number">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="sl_new_supplier">ได้รับ/ซื้อจาก</label>
                    <div class="controls">
                        <select id="sl_new_supplier">
                            <?php
                            foreach($suppliers as $s)
                                echo '<option value="'.$s->id.'">' . $s->name . '</option>';
                            ?>
                        </select>
                    </div>
                </div>


            </form>

            <form action="#" class="form-actions">
                <button class="btn btn-large btn-success" type="button" id="btn_do_register">
                    <i class="icon-plus-sign icon-white"></i> บันทึกข้อมูล
                </button>
            </form>
        </div>
    </div>
</div>

<div class="modal hide fade" id="mdl_service_history">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>ประวัติการแจ้งซ่อม</h3>
    </div>
    <div class="modal-body">
        <table class="table table-striped table-hover" id="tbl_service_history">
        	<thead>
        		<tr>
        			<th>วันที่</th>
        			<th>เลขที่แจ้งซ่อม</th>
        			<th>อาการแจ้งซ่อม</th>
        			<th>ช่างผู้รับผิดชอบ</th>
        			<th>สถานะปัจจุบัน</th>
        		</tr>
        	</thead>
        	<tbody></tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>

    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/products.js"></script>