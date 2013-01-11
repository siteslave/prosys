<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ระบบงานซ่อมบำรุง</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <style>
        body {
            padding-top: 40px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/apps/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/freeow/freeow.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/underscore.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/jquery.numeric.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/taffy.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/bootstrap-datepicker.th.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/numeral.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/jquery.freeow.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libs/jquery.paging.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/apps.js"></script>

    <script type="text/javascript">
        base_url = '<?php echo base_url(); ?>';
    </script>
</head>

<body>
<div id="freeow" class="freeow freeow-bottom-right"></div>
<div class="navbar navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">E-Service</a>

            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li>
                        <a href="<?php echo site_url('clients'); ?>">
                            <i class="icon-home"></i> หน้าหลัก
                        </a>
                    </li>
                </ul>
                <?php
                if( get_current_name() ) {
                    ?>
                    <div class="btn-group pull-right">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user"></i> <?php echo get_current_name(); ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">

                            <li><a href="#" id="chk-pass" data-toggle="modal"><i class="icon-edit"></i> เปลี่ยนรหัสผ่าน (Change password)</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url('users/logout'); ?>"><i class="icon-off"></i>  ออกจากระบบ (Logout)</a></li>
                        </ul>
                    </div>

                    <?php
                }
                ?>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container">
    <?php echo $content_for_layout; ?>
</div> <!-- /container -->


<div class="modal hide fade" id="mdl_change_password">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>เปลี่ยนรหัสผ่าน</h3>
    </div>
    <div class="modal-body">
        <form action="#" class="form-horizontal">
            <input type="hidden" id="txt_id">
            <input type="hidden" id="txt_old_name">
            <div class="control-group">
                <label class="control-label" for="txt_password">รหัสผ่านใหม่</label>
                <div class="controls">
                    <input type="password" id="txt_password" class="input-xlarge">
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success" id="btn_do_change_password"><i class="icon-plus-sign icon-white"></i> เปลี่ยนรหัสผ่าน</a>
        <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="icon-off icon-white"></i> ปิดหน้าต่าง</a>
    </div>
</div>
</body>
</html>
