$(function(){
    var admin = {};

    admin.modal = {
        show_new: function(){
            $('#mdl_new').modal({backdrop: 'static'}).css({
                width: 600,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },
        show_change_password: function(){
            $('#mdl_change_password').modal({backdrop: 'static'}).css({
                width: 600,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        }
    };

    admin.ajax = {
        get_list: function(start, stop, cb){
            var url = '/admins/get_list',
                params = {
            		start: start,
            		stop: stop
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_list_total: function(cb){
            var url = '/admins/get_list_total',
                params = { };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_detail: function(id, cb){
            var url = '/admins/get_detail',
                params = {
                      id: id
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save: function(data, cb){
            var url = '/admins/save',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        remove: function(id, cb){
            var url = '/admins/remove',
                params = {
                    id: id
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        change_password: function(data, cb){
            var url = '/admins/change_password',
                params = {
                    id: data.id,
                    password: data.password1
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        search: function(query, cb){
            var url = '/admins/search',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }
    };

    admin.get_list = function(){
        
        admin.ajax.get_list_total(function(err, data){
	        if(err){
	            App.alert(err);
	        }else{
	        	$('#main_paging').fadeIn('slow');
	        	
	            $('#main_paging > ul').paging(data.total, {
	                format: " < . (qq -) nnncnnn (- pp) . >",
	                perpage: App.record_perpage,
	                lapping: 1,
	                page: 1,
	                onSelect: function(page){
	                    //console.log('page: ' + page);
	                    //console.log(this.slice);      //this.slice[0] = start, this.slice[1] = stop
	
	                    admin.ajax.get_list(this.slice[0], this.slice[1], function(err, data){
	                    	$('#tbl_list tbody').empty();
	                    	if(err){
	                            App.alert(err);
	                            
	                            $('#tbl)list > tbody').append(
	                            		'<tr><td colspan="7">ไม่พบรายการ</td></tr>');
	                        }else{
	                            admin.set_list(data);
	                        }
	
	                    });
	
	                },
	                onFormat: function(type){
	                    switch (type) {
	
	                        case 'block':
	
	                            if (!this.active)
	                                return '<li class="disabled"><a href="">' + this.value + '</a></li>';
	                            else if (this.value != this.page)
	                                return '<li><a href="#' + this.value + '">' + this.value + '</a></li>';
	                            return '<li class="active"><a href="#">' + this.value + '</a></li>';
	
	                        case 'right':
	                        case 'left':
	
	                            if (!this.active) {
	                                return "";
	                            }
	                            return '<li><a href="#' + this.value + '">' + this.value + '</a></li>';
	
	                        case 'next':
	
	                            if (this.active) {
	                                return '<li><a href="#' + this.value + '">&raquo;</a></li>';
	                            }
	                            return '<li class="disabled"><a href="">&raquo;</a></li>';
	
	                        case 'prev':
	
	                            if (this.active) {
	                                return '<li><a href="#' + this.value + '">&laquo;</a></li>';
	                            }
	                            return '<li class="disabled"><a href="">&laquo;</a></li>';
	
	                        case 'first':
	
	                            if (this.active) {
	                                return '<li><a href="#' + this.value + '">&lt;</a></li>';
	                            }
	                            return '<li class="disabled"><a href="">&lt;</a></li>';
	
	                        case 'last':
	
	                            if (this.active) {
	                                return '<li><a href="#' + this.value + '">&gt;</a></li>';
	                            }
	                            return '<li class="disabled"><a href="">&gt;</a></li>';
	
	                        case 'fill':
	                            if (this.active) {
	                                return '<li class="disabled"><a href="#">...</a></li>';
	                            }
	                    }
	                    return ""; // return nothing for missing branches
	                }
	            });
	        }
	    });	
    };
    admin.set_list = function(data){
    	if(_.size(data.rows) > 0){
            _.each(data.rows, function(v){
                var status = v.user_status == '1' ? 'ปกติ' : 'ระงับสิทธิ';
                $('#tbl_list tbody').append(
                    '<tr>' +
                        '<td>' + v.username + '</td>' +
                        '<td>' + clear_null(v.fullname) + '</td>' +
                        '<td>' + clear_null(v.owner_name) + '</td>' +
                        '<td>' + clear_null(v.type_name) + '</td>' +
                        '<td>' + clear_null(v.technician_type_name) + '</td>' +
                        '<td>' + status + '</td>' +
                        '<td><div class="btn-group"> ' +
                        '<a href="javascript:void(0);" class="btn" title="แก้ไข" data-name="btn_edit" data-id="'+ v.id +'"><i class="icon-edit"></i> </a> ' +
                        '<a href="javascript:void(0);" class="btn" title="เปลี่ยนรหัสผ่าน" data-name="btn_change_pass" data-username="'+ v.username +'" data-id="'+ v.id +'"><i class="icon-refresh"></i> </a> ' +
                        '<a href="javascript:void(0);" class="btn" title="ลบ" data-name="btn_remove" data-id="'+ v.id +'"><i class="icon-trash"></i> </a> ' +
                        '</div></td>' +
                    '</tr>'
                );
            });
    	}
    };
    admin.clear_form = function(){
        $('#txt_id').val('');
        //$('#txt_old_fullname').val('');
        $('#txt_fullname').val('');
        $('#txt_username').val('');
        $('#txt_password').removeAttr('disabled');
        $('#txt_username').removeAttr('disabled');
        $('#txt_password').val('');
        set_first_selected($('#sl_tech_type'));
        set_first_selected($('#sl_user_type'));
        set_first_selected($('#sl_owner'));
    };

    admin.set_data = function(id){
        admin.ajax.get_detail(id, function(err, data){
            if(err){
                App.alert(err);
            }else{
                $('#txt_id').val(data.rows.id);
                $('#txt_fullname').val(data.rows.fullname);
                $('#txt_username').val(data.rows.username);
                $('#txt_password').attr('disabled', 'disabled').css('background-color', 'white');
                $('#txt_username').attr('disabled', 'disabled').css('background-color', 'white');
                $('#txt_password').val('######');
                $('#sl_user_type').val(data.rows.user_type);
                $('#sl_tech_type').val(data.rows.tech_type_id);

                if(data.rows.user_status == '1'){
                    $('#chk_active').attr('checked', 'checked');
                }else{
                    $('#chk_active').removeAttr('checked');
                }

                $('#sl_owner').val(data.rows.owner);

                admin.modal.show_new();
            }
        });
    };

    $('#mdl_new').on('hidden', function(){
        admin.clear_form();
    });

    $('#btn_new').click(function(){
        admin.modal.show_new();
    });

    $('#btn_save').click(function(){
        var items = {};
        items.id = $('#txt_id').val();
        items.fullname = $('#txt_old_fullname').val();
        items.fullname = $('#txt_fullname').val();
        items.username = $('#txt_username').val();
        items.password = $('#txt_password').val();
        items.user_type = $('#sl_user_type').val();
        items.user_status = $('#chk_active').attr('checked') ? '1' : '0';
        items.owner = $('#sl_owner').val();
        items.tech_type_id = $('#sl_tech_type').val();

        if(!items.fullname){
            App.alert('กรุณาระบุชื่อ - สกุล');
        }else if(!items.user_type){
        	App.alert('กรุณาระบุประเภทของผู้ใช้งาน');
        }else if(!items.tech_type_id){
        	App.alert('กรุณาระบุประเภทของช่าง');
        }else if(!items.username || items.username.length < 2){
            App.alert('กรุณาระบุชื่อผู้ใช้งาน อย่างน้อย 4 ตัวอักษรขึ้นไป');
        }else if(!items.password){
            App.alert('กรุณาระบุรหัสผ่าน');
        }else{
            //do save
            admin.ajax.save(items, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('บันทึกรายการเสร็จเรียบร้อยแล้ว');
                    admin.clear_form();
                    admin.get_list();
                    $('#mdl_new').modal('hide');
                }
            });
        }


    });

    $('a[data-name="btn_edit"]').live('click', function(){
        var id = $(this).attr('data-id');

        //set user detail
        admin.set_data(id);
    });

    $('a[data-name="btn_change_pass"]').live('click', function(){
        var id = $(this).attr('data-id'),
            username = $(this).attr('data-username');
        //set data
        $('#txt_change_username').val(username);
        $('#txt_change_id').val(id);

        admin.modal.show_change_password();
    });

    $('#mdl_change_password').on('hidden', function(){
        $('#txt_change_username').val('');
        $('#txt_change_id').val('');
        $('#txt_new_password').val(''),
        $('#txt_confirm_new_password').val('');
    });

    $('#btn_do_change_password').click(function(){
        var items = {};
        items.id = $('#txt_change_id').val(),
        items.password1 = $('#txt_new_password').val(),
        items.password2 = $('#txt_confirm_new_password').val();

        if(!items.password1){
            App.alert('กรุณาระบุรหัสผ่าน');
        }else if(!items.password2){
            App.alert('กรุณาระบุรหัสผ่าน (อีกครั้ง)');
        }else if(items.password1 != items.password2){
            App.alert('รหัสผ่านทั้งสอง ไม่เหมือนกัน กรุณาตรวจสอบ');
        }else{
            admin.ajax.change_password(items, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('เปลี่ยนรหัสผ่านเสร็จเรียบร้อยแล้ว');
                    $('#mdl_change_password').modal('hide');
                }
            });
        }
    });

    //remove
    $('a[data-name="btn_remove"]').live('click', function(){
        var id = $(this).attr('data-id'),
            obj = $(this).parent().parent().parent();

        if(confirm('คุณต้องการลบรายการนี้ใช่หรือไม่? \r\nหากผู้ใช้งานคนนี้ได้ทำการให้บริการไปแล้วจะไม่สามารถลบได้')){
            admin.ajax.remove(id, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
                    obj.fadeOut('slow');
                }
            });
        }
    });

    
    //search
    $('#btn_search').click(function(){
        var query = $.trim($('#txt_query').val());

        $('#tbl_list tbody').empty();

		$('#main_paging').fadeOut('slow');
		
        if(query && query.length >= 2){
            //do search
            admin.ajax.search(query, function(err, data){
                if(err){
                    App.alert(err);
                    $('#tbl_list tbody').append(
                        '<tr><td colspan="2">ไม่พบรายการ</td></tr>'
                    );
                }else{
                    admin.set_list(data);
                }
            });
        }else{
            admin.get_list();
        }
    });
    
    admin.get_list();
});
