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
        }
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
});