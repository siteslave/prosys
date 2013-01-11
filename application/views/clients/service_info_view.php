<ul class="breadcrumb">
    <li><a href="<?php echo site_url('clients'); ?>">หน้าหลัก</a> <span class="divider">/</span></li>
    <li class="active"></li>  ข้อมูลการให้บริการ
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
                รวมค่าใช้จ่าย <strong><span id="sv_total"></span></strong> บาท
            </blockquote>
        </div>
    </div>

</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/clients.getinfo.js"></script>
