<ul class="breadcrumb">
    <li><a href="<?php echo site_url(); ?>">หน้าหลัก</a> <span class="divider">/</span></li>
    <li class="active">Dashboard</li>
</ul>

<div class="row-fluid">
  <div class="span6">

    <form action="#" class="form-actions form-inline">
    <legend>สถิติการให้บริการของช่าง</legend>
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

  <div class="span6">
    <legend>สถานะรับซ่อม</legend>
        <form action="#" class="form-actions form-inline">
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

    <div id="div_chart" style="height: 280px;">

    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/reports.js"></script>