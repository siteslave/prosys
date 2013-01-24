$(function(){
	var main = {};
	
	main.modal = {
		show_change_password: function(){
            $('#mdl_change_password').modal({backdrop: 'static'}).css({
                width: 680,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },hide_change_password: function(){
            $('#mdl_change_password').modal('hide');
        },show_remove_discharge: function(){
            $('#mdl_remove_discharge').modal({backdrop: 'static'}).css({
                width: 480,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },hide_change_password: function(){
            $('#mdl_remove_discharge').modal('hide');
        }
        //
	};
	
	main.ajax = {
		do_change_password: function(pwd, cb){
            var url = '/services/do_change_password',
                params = {
                    pwd: pwd
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        do_remove_discharge: function(data, cb){
            var url = '/services/remove_discharge',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }
	};
	
	//change password
	$('a[data-name="chk-pass"]').click(function(){
		main.modal.show_change_password();
	});
	
	$('#btn_do_change_password').click(function(){
		var password = $('#txt_password').val();
		
		if(!password){
			App.alert('กรุณาระบุรหัสผ่านที่ต้องการเปลี่ยน');
		}else{
			//do change
			main.ajax.do_change_password(password, function(err){
				if(err){
					App.alert(err);
				}else{
					App.alert('เปลี่ยนรหัสผ่านเสร็จเรียบร้อยแล้ว');
					main.modal.hide_change_password();
				}
			});
		}
	});
	
	//remove dischareg
	$('a[data-name="btn_show_remove_discharge"]').click(function(){
		main.modal.show_remove_discharge();
	});
	
	//do remove dischareg
	$('#btn_do_rmd').click(function(){
		var data = {};
		data.sv = $('#txt_rmd_service_code').val();
		data.user_id = $('#sl_rmd_user').val();
		data.password = $('#txt_rmd_password').val();
		
		if(!data.sv){
			App.alert('กรุณาระบุเลขที่ใบรับซ่อม');
		}else if(!data.user_id){
			App.alert('กรุณาระบุชื่อผู้ใช้งาน');
		}else if(!data.password){
			App.alert('กรุณาระบุรหัสผ่าน');
		}else{
			main.ajax.do_remove_discharge(data, function(err){
				if(err){
					App.alert(err);
				}else{
					App.alert('ลบข้อมูลการจำหน่ายเสร็จเรียบร้อยแล้ว');
					main.modal.hide_change_password();
				}
			});
		}
	});
});