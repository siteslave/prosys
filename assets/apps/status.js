$(function(){
    var status = {};

    status.modal = {
        show_new: function(){
            $('#mdl_new').modal({backdrop: 'static'}).css({
                width: 600,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        }
    };

    status.ajax = {
        save: function(data, cb){
            var url = '/status/save',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        remove: function(id, cb){
            var url = '/status/remove',
                params = {
                    id: id
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_list: function(cb){
            var url = '/status/get_list',
                params = {};

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },

        get_list_total: function(cb){
            var url = '/status/get_list_total',
                params = {};

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        search: function(query, cb){
            var url = '/status/search',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }

    };
	status.set_list = function(data){
		if(_.size(data.rows) > 0){
            _.each(data.rows, function(v){
                $('#tbl_list tbody').append(
                    '<tr><td>' + v.name + '</td>' +
                        '<td>' +
                            '<div class="btn-group">' +
                            '<a href="javascript:void(0);" class="btn" data-name="edit" data-vname="' + v.name + '" data-id="' + v.id + '"><i class="icon-edit"></i></a>' +
                            '<a href="javascript:void(0);" class="btn" data-name="remove" data-id="' + v.id + '"><i class="icon-trash"></i></a>' +
                            '</div>' +
                        '</td>' +
                    '</tr>'
                );
            });
        }else{
            $('#tbl_list tbody').append(
                '<tr><td colspan="2">ไม่พบรายการ</td></tr>'
            );
        }
	};
	status.get_list = function(){
        status.ajax.get_list(function(err, data){
        	$('#tbl_list tbody').empty();
            if(err){
                App.alert(err);
            }else{
                status.set_list(data);
            }

        });
	};
    //show new modal
    $('#btn_new').click(function(){
        status.modal.show_new();
    });

    $('#btn_save').click(function(){
        var items = {};
        items.name = $.trim($('#txt_name').val());
        items.id = $('#txt_id').val();
        items.old_name = $('#txt_old_name').val();

        if(!items.name){
            App.alert('กรุณาระบุชื่อ');
        }else{
            status.ajax.save(items, function(err){
                if(err){
                    App.alert(err);
                }else{
                    $('#txt_name').val('');
                    $('#txt_id').val('');
                    $('#txt_old_name').val('');
                    $('#mdl_new').modal('hide');
                    //load list
                    status.get_list();
                }
            });
        }
    });

    $('a[data-name="edit"]').live('click', function(){
        var id = $(this).attr('data-id'),
            name = $.trim($(this).attr('data-vname'));

        $('#txt_id').val(id);
        $('#txt_name').val(name);
        $('#txt_old_name').val(name);

        status.modal.show_new();
    });

    $('#mdl_new').on('hidden', function(){
        $('#txt_name').val('');
        $('#txt_id').val('');
        $('#txt_old_name').val('');
    });

    $('a[data-name="remove"]').live('click', function(){
        var id = $(this).attr('data-id');
        var t = $(this).parent().parent().parent();

        if(confirm('คุณต้องการลบรายการนี้ใช่หรือไม่? \n การลบรายการนี้จะมีผลให้การรายงานเกี่ยวกับสถานะงานซ่อมไม่ถูกต้องได้')){
            status.ajax.remove(id, function(err){
                if(err){
                    App.alert(err);
                }else{
                    //remove row
                    App.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
                    $(t).fadeOut('slow');
                }
            });
        }
    });

    //search
    $('#btn_search').click(function(){
        var query = $.trim($('#txt_query').val());
		$('#main_paging').fadeOut('slow');
        $('#tbl_list tbody').empty();

        if(query && query.length > 2){
            //do search
            status.ajax.search(query, function(err, data){
                if(err){
                    App.alert(err);
                    $('#tbl_list tbody').append(
                        '<tr><td colspan="2">ไม่พบรายการ</td></tr>'
                    );
                }else{
                    if(_.size(data.rows) > 0){
                        _.each(data.rows, function(v){
                            $('#tbl_list tbody').append(
                                '<tr><td>' + v.name + '</td>' +
                                    '<td>' +
                                    '<div class="btn-group">' +
                                    '<a href="javascript:void(0);" class="btn" data-name="edit" data-vname="' + v.name + '" data-id="' + v.id + '"><i class="icon-edit"></i></a>' +
                                    '<a href="javascript:void(0);" class="btn" data-name="remove" data-id="' + v.id + '"><i class="icon-trash"></i></a>' +
                                    '</div>' +
                                    '</td>' +
                                    '</tr>'
                            );
                        });
                    }else{
                        $('#tbl_list tbody').append(
                            '<tr><td colspan="2">ไม่พบรายการ</td></tr>'
                        );
                    }
                }
            });
        }else{
            //App.alert('กรุณาระบุคำค้นหา ต้องมากกว่า 2 ตัวอักษรขึ้นไป');
            status.get_list();
        }
    });
    status.get_list();
});
