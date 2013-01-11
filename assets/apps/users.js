$(function(){
    var Users = {};

    Users.do_login = function(username, password, cb){
        $.ajax({
            url: base_url + '/index.php/users/do_login',
            dataType: 'json',
            type: 'POST',
            data:
            {
                username: username,
                password: password
            },

            success: function(data)
            {
                if(data.success)
                {
                    cb(null, data.user_type);
                }
                else
                {
                    cb('ชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง');
                }
            },

            error: function(xhr, status, errorThrown)
            {
                cb('เกิดข้อผิดพลาด: ' + xhr.status + ': ' + xhr.statusText);
            }
        });
    };

    $('#btn_login').click(function(){
        var username = $('#username').val(),
            password = $('#password').val();

        if(!username){
            alert('กรุณากรอกชื่อผู้ใช้งาน');
        }else if(!password){
            alert('กรุณากรอกรหัสผ่าน');
        }else{
            //do login
            Users.do_login(username, password, function(err, user_type){
                if(err){
                    alert(err);
                }else{
                    if(user_type == '1'){
                        App.goto_url('/clients');
                    }else{
                        App.goto_url('/pages');
                    }
                }
            });
        }
    });
});
