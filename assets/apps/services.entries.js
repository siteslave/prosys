$(function(){
    var entries = {};

    entries.modal = {
        show_new_activities: function(){
            $('#mdl_new_activities').modal({backdrop: 'static'}).css({
                width: 780,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },hide_activities: function(){
            $('#mdl_new_activities').modal('hide');
        },
        show_new_item: function(){
            $('#mdl_new_item').modal({backdrop: 'static'}).css({
                width: 780,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },hide_item: function(){
            $('#mdl_new_item').modal('hide');
        },
        show_search_item: function(){
            $('#mdl_search_item').modal({backdrop: 'static'}).css({
                width: 780,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },
        hide_search_item: function(){
            $('#mdl_search_item').modal('hide');
        }
    };

    entries.ajax = {
        save_activities: function(sv, detail, cb){
            var url = '/services/save_activities',
                params = {
                    sv: sv,
                    detail: detail
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },save_item: function(data, cb){
            var url = '/services/save_item',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_activities: function(sv, cb){
            var url = '/services/get_activities',
                params = {
                    sv: sv
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        search_item: function(query, cb){
            var url = '/services/search_item',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_item: function(sv, cb){
            var url = '/services/get_item',
                params = {
                    sv: sv
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        remove_item: function(id, sv, cb){
            var url = '/services/remove_item',
                params = {
                    id: id,
                    sv: sv
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }

    };

    entries.clear_act_form = function(){
        $('#txt_act_detail').val('');
    };

    entries.get_activities = function(){

        var sv = $('#service_code').val();

        $('#tbl_act_list > tbody').empty();

        entries.ajax.get_activities(sv, function(err, data){
            if(err){
                App.alert(err);
                $('#tbl_act_list > tbody').append(
                    '<tr><td colspan="4">ไม่พบรายการ</td></tr>'
                );
            }else{
                if(_.size(data.rows)){
                    _.each(data.rows, function(v){
                        $('#tbl_act_list > tbody').append(
                            '<tr>' +
                                '<td>' + toThaiDate(v.act_date) + '</td>' +
                                '<td>' + v.act_time + '</td>' +
                                '<td>' + v.fullname + '</td>' +
                                '<td>' + v.detail + '</td>' +
                                '</tr>'
                        );
                    });
                }else{
                    $('#tbl_act_list > tbody').append(
                        '<tr><td colspan="4">ไม่พบรายการ</td></tr>'
                    );
                }
            }
        });
    };

    entries.search_item = function(query){

        $('#tbl_item_search_result > tbody').empty();

        entries.ajax.search_item(query, function(err, data){
            if(err){
                App.alert(err);
                $('#tbl_item_search_result > tbody').append(
                    '<tr><td colspan="3">ไม่พบรายการ</td></tr>'
                );
            }else{
                if(_.size(data.rows)){
                    _.each(data.rows, function(v){
                        $('#tbl_item_search_result > tbody').append(
                            '<tr>' +
                                '<td>' + v.name + '</td>' +
                                '<td>' + addCommas(v.price) + '</td>' +
                                '<td><a href="javascript:void(0);" class="btn" data-name="btn_selected_item" ' +
                                'data-price="'+ v.price +'" data-vname="'+ v.name +'" data-id="'+ v.id +'">' +
                                '<i class="icon-ok"></i>' +
                                '</a></td>' +
                                '</tr>'
                        );

                    });
                }else{
                    $('#tbl_item_search_result > tbody').append(
                        '<tr><td colspan="3">ไม่พบรายการ</td></tr>'
                    );
                }
            }
        });
    };


    $('#mdl_search_item').on('hidden', function(){
        entries.modal.show_new_item();
    });

    $('#btn_new_activities').click(function(){
        entries.modal.show_new_activities();
    });

    $('#mdl_new_activities').on('hidden', function(){
        entries.clear_act_form();
    });
    //save activities
    $('#btn_act_do_save').click(function(){
        var sv = $('#txt_act_service_code').val(),
            detail = $('#txt_act_detail').val();

        if(!sv){
            App.alert('กรุณาระบุ รหัสรับซ่อม');
        }else if(!detail){
            App.alert('กรุณาระบุ การให้บริการ');
        }else{
            entries.ajax.save_activities(sv, detail, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');
                    entries.modal.hide_activities();
                    entries.get_activities();
                }
            });
        }

    });

    $('a[href="#tab2"]').click(function(){
        entries.get_activities();
    });

    $('#btn_new_item').click(function(){
        entries.clear_item_form();
        entries.modal.show_new_item();
    });

    //show search
    $('#btn_item_show_search').click(function(){
        entries.modal.show_search_item();
        entries.modal.hide_item();
    });

    $('#btn_item_do_search').click(function(){
        var query = $('#txt_item_query_search').val();
        if(!query || query.length < 2){
            App.alert('กรุณาระบุคำที่ต้องการค้นหา');
        }else{
            entries.search_item(query);
        }
    });

    //select item
    $('a[data-name="btn_selected_item"]').live('click', function(){
        var item_id = $(this).attr('data-id'),
            price = $(this).attr('data-price'),
            name = $(this).attr('data-vname');
        $('#txt_item_name').val(name);
        $('#txt_item_id').val(item_id);
        $('#txt_item_price').val(price);
        $('#txt_item_qty').val(0);

        entries.modal.hide_search_item();
    });

    entries.clear_item_form = function(){
        $('#txt_item_name').val('');
        $('#txt_item_id').val('');
        $('#txt_item_price').val('');
        $('#txt_item_qty').val('');
        $('#txt_item_isupdate').val('');
        $('#btn_item_show_search').removeAttr('disabled');
    };

    entries.get_item = function(){
        var sv = $('#txt_service_code').val();

        $('#tbl_item_list > tbody').empty();

        entries.ajax.get_item(sv, function(err, data){
            if(err){
                App.alert(err);
                $('#tbl_item_list > tbody').append(
                    '<tr><td colspan="5">ไม่พบรายการ</td></tr>'
                );
            }else{
                if(_.size(data.rows)){
                var sum_total = 0;
                    _.each(data.rows, function(v){
                        var total = v.qty * v.price;

                        $('#tbl_item_list > tbody').append(
                            '<tr>' +
                                '<td>' + v.name + '</td>' +
                                '<td>' + addCommas(v.price) + '</td>' +
                                '<td>' + v.qty + '</td>' +
                                '<td>' + addCommas(total) + '</td>' +
                                '<td><div class="btn-group">' +
                                '<a href="javascript:void(0);" class="btn" data-name="btn_edit_item" ' +
                                'data-price="'+ v.price +'" data-qty="'+ v.qty +'" data-vname="'+ v.name +'" data-id="'+ v.id +'" title="แก้ไขรายการ">' +
                                '<i class="icon-edit"></i>' +
                                '</a>' +
                                '<a href="javascript:void(0);" data-name="btn_remove_item" class="btn" data-id="'+ v.id +'" data-sv="'+sv+'" title="ลบรายการ"><i class="icon-trash"></i></a> ' +
                                '</div></td>' +
                                '</tr>'
                        );

                        sum_total += total;
                    });

                    $('#txt_bath_total').html(addCommas(sum_total));

                }else{
                    $('#tbl_item_list > tbody').append(
                        '<tr><td colspan="5">ไม่พบรายการ</td></tr>'
                    );
                }
            }
        })
    };

    //save item
    $('#btn_item_do_save').click(function(){
        var items = {};
        items.id = $('#txt_item_id').val();
        items.price = $('#txt_item_price').val();
        items.qty = $('#txt_item_qty').val();

        if(!items.id){
            App.alert('กรุณาระบุ รายการค่าใช้จ่าย/อุปกรณ์');
        }else if(!items.price){
            App.alert('กรุณาระบุ ราคา');
        }else if(!items.qty || items.qty <= 0){
            App.alert('กรุณาระบุ จำนวน');
        }else{
            items.sv = $('#txt_service_code').val();
            items.isupdate = $('#txt_item_isupdate').val();

            entries.ajax.save_item(items, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');
                    entries.modal.hide_item();
                    entries.clear_item_form();
                    entries.get_item();
                }
            });
        }
    });

    $('a[href="#tab3"]').click(function(){
        entries.get_item();
    });

    //edit item
    $('a[data-name="btn_edit_item"]').live('click', function(){
        var name = $(this).attr('data-vname'),
            id = $(this).attr('data-id'),
            price = $(this).attr('data-price'),
            qty = $(this).attr('data-qty');

        $('#txt_item_isupdate').val('1');

        $('#txt_item_id').val(id);
        $('#txt_item_price').val(price);
        $('#txt_item_qty').val(qty);
        $('#txt_item_name').val(name);

        $('#btn_item_show_search').attr('disabled', 'disabled');

        entries.modal.show_new_item();
    });

    //remove
    $('a[data-name="btn_remove_item"]').live('click', function(){
        var id = $(this).attr('data-id'),
            sv = $(this).attr('data-sv'),
            obj = $(this).parent().parent().parent();

        if(confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?')){
            entries.ajax.remove_item(id, sv, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
                    obj.fadeOut('slow');
                }
            });
        }
    });
});
