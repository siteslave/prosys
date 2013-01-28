<ul class="breadcrumb">
    <li><a href="<?php echo site_url('clients'); ?>">หน้าหลัก</a> <span class="divider">/</span></li>
    <li class="active"></li> เพิ่มรายการครุภัณฑ์
</ul>

                <div class="alert alert-info alert-block">
				    <button type="button" class="close" data-dismiss="alert">&times;</button>
				    <h4>คำแนะนำ!</h4>
				   <p> ก่อนทำการเพิ่มรายการครุภัณฑ์ กรุณาตรวจสอบข้อมูลของครุภัณฑ์ก่อนว่ามีในรายการหรือไม่ โดยการค้นหาชื่อ หรือ เลขครุภัณฑ์ จากหน้าจอส่งซ่อม
				    หากไม่พบจึงทำการเพิ่มรายการ และ หลังจากเพิ่มรายการแล้ว ควรแจ้งให้พัสดุทราบว่าได้มีการเพิ่มรายการครุภัณฑ์ในหน่วยงานของคุณ
				    </p>
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

            <script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/clients.register.products.js"></script>
