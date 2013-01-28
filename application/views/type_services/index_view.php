<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a> <span class="divider">/</span></li>
    <li class="active">ประเภทงานซ่อม</li>
</ul>

<div class="tabbable">
    <ul class="nav nav-pills">
        <li class="active"><a href="#tab1" id="tab_main" data-toggle="tab"><i class="icon-th-list"></i> รายการ</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <blockquote>
                <p>จัดการข้อมูล ประเภทงานซ่อม ทั้งหมดที่มีในฐานข้อมูล</p>
            </blockquote>
                <button class="btn btn-success" type="button" id="btn_new">
                    <i class="icon-plus-sign icon-white"></i> เพิ่มรายการ
                </button>

            <table class="table table-striped" id="tbl_list" style="width: 480px">
                <thead>
                <tr>
                    <th>รายการ</th>
                    <th>#</th>
                </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
            <div id="main_paging" class="pagination">
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/type_services.js"></script>
