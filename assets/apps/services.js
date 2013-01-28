$(function(){
    var service = {};

    service.modal = {
        show_edit_service: function(){
            $('#mdl_edit_service_main').modal({backdrop: 'static'}).css({
                width: 880,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },
        hide_edit_service: function(){
            $('#mdl_edit_service_main').modal('hide');
        },
        show_item: function(){
            $('#mdl_show_items').modal({backdrop: 'static'}).css({
                width: 880,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },
        show_edit_service_other: function(){
            $('#mdl_edit_service_other').modal({backdrop: 'static'}).css({
                width: 880,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },
        hide_edit_service_other: function(){
            $('#mdl_edit_service_other').modal('hide');
        },
        show_search_product: function(){
            $('#mdl_search_product').modal({backdrop: 'static'}).css({
                width: 880,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },
        hide_search_product: function(){
            $('#mdl_search_product').modal('hide');
        },
        show_change_status: function(){
            $('#mdl_regcode_change_status').modal({backdrop: 'static'}).css({
                width: 480,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },hide_change_status: function(){
            $('#mdl_regcode_change_status').modal('hide');
        },
        show_service_type: function(){
            $('#mdl_service_type').modal({backdrop: 'static'}).css({
                width: 480,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },hide_service_type: function(){
            $('#mdl_service_type').modal('hide');
        },
        show_service_type_other: function(){
            $('#mdl_service_type_other').modal({backdrop: 'static'}).css({
                width: 480,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },hide_service_type_other: function(){
            $('#mdl_service_type_other').modal('hide');
        },
        show_discharge: function(){
            $('#mdl_discharge').modal({backdrop: 'static'}).css({
                width: 480,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },hide_discharge: function(){
            $('#mdl_discharge').modal('hide');
        },
        show_result: function(){
            $('#mdl_result').modal({backdrop: 'static'}).css({
                width: 780,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },hide_result: function(){
            $('#mdl_result').modal('hide');
        },
        show_other_change_status: function(){
            $('#mdl_other_change_status').modal({backdrop: 'static'}).css({
                width: 480,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },
        hide_other_change_status: function(){
            $('#mdl_other_change_status').modal('hide');
        },
        show_assign_tech: function(){
            $('#mdl_regcode_assign_tech').modal({backdrop: 'static'}).css({
                width: 480,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },hide_assign_tech: function(){

            $('#mdl_regcode_assign_tech').modal('hide');
        },
        show_assign_tech_other: function(){
            $('#mdl_other_assign_tech').modal({backdrop: 'static'}).css({
                width: 480,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },
        hide_assign_tech_other: function(){

            $('#mdl_other_assign_tech').modal('hide');
        },
        show_more_technician: function(){
            $('#mdl_assign_more_technician').modal({backdrop: 'static'}).css({
                width: 480,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },
        show_list_technician: function(){
            $('#mdl_show_more_technician').modal({backdrop: 'static'}).css({
                width: 480,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },
        //mdl_show_more_technician
        hide_more_technician: function(){

            $('#mdl_assign_more_technician').modal('hide');
        }
        /*
         * mdl_assign_more_technician
         */
    };

    service.ajax = {
        save_regcode_change_status: function(data, cb){
            var url = '/services/save_regcode_change_status',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_edit_service_main: function(data, cb){
            var url = '/services/save_edit_service_main',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_edit_service_other: function(data, cb){
            var url = '/services/save_edit_service_other',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        search_reg_product: function(query, cb){
            var url = '/services/search_reg_product',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_more_technician: function(sv, cb){
            var url = '/services/get_more_technicians',
                params = {
                    sv: sv
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_more_technician: function(data, cb){
            var url = '/services/save_more_technician',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_main_type: function(data, cb){
            var url = '/services/save_main_type',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_other_type: function(data, cb){
            var url = '/services/save_other_type',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_discharge: function(data, cb){
            var url = '/services/save_discharge',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_result: function(id, type, cb){
            var url = '/services/get_result',
                params = {
                    id: id,
                    type: type
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        remove_code: function(sv, cb){
            var url = '/services/remove_service_code',
                params = {
                    sv: sv
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        remove_other: function(sv, cb){
            var url = '/services/remove_service_other',
                params = {
                    sv: sv
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_other_change_status: function(data, cb){
            var url = '/services/save_other_change_status',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_result: function(data, cb){
            var url = '/services/save_result',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_by_code_total: function(status, cb){
            var url = '/services/get_service_by_code_total',
                params = {
                    status: status
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_by_other_total: function(status, cb){
            var url = '/services/get_service_by_other_total',
                params = {
					status: status
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_by_other_list: function(status, start, stop, cb){
            var url = '/services/get_service_by_other_list',
                params = {
                    start: start,
                    stop: stop,
                    status: status
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_search_service_by_code_total: function(query, cb){
            var url = '/services/get_search_service_by_code_total',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_search_service_by_other_total: function(query, cb){
            var url = '/services/get_search_service_by_other_total',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_regcode_assign_tech: function(data, cb){
            var url = '/services/save_regcode_assign_tech',
                params = {
                    data:data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_other_assign_tech: function(data, cb){
            var url = '/services/save_other_assign_tech',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_reg_product: function(data, cb){
            var url = '/services/save_reg_product',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_by_code_list: function(status, start, stop, cb){
            var url = '/services/get_service_by_code_list',
                params = {
                    start: start,
                    stop: stop,
                    status: status
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_search_service_by_code_list: function(query, start, stop, cb){
            var url = '/services/search_service_by_code_list',
                params = {
                    start: start,
                    stop: stop,
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_search_service_by_other_list: function(query, start, stop, cb){
            var url = '/services/search_service_by_other_list',
                params = {
                    start: start,
                    stop: stop,
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_detail_main: function(sv, cb){
            var url = '/services/get_service_detail_main',
                params = {
                    sv: sv
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_detail_other: function(sv, cb){
            var url = '/services/get_service_detail_other',
                params = {
                    sv: sv
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
        }

    };

    service.get_item = function(sv)
    {
        $('#tbl_item_list > tbody').empty();
        service.ajax.get_item(sv, function(err, data){
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
                                '<td>' + clear_null(v.unit) + '</td>' +
                                '<td>' + addCommas(total) + '</td>' +
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

    service.get_result = function(id, type){
        service.ajax.get_result(id, type, function(err, data){
            if(err){
                App.alert(err);
                $('#txt_result').val('');
            }else{
                $('#txt_result').val(data.result);
            }
        });
    };

    service.set_list_other = function(data){
    	_.each(data.rows, function(v){
    		var tech_more = v.tech_more > 0 ? 
    				'<span class="badge badge-info">'+ v.tech_more +'</span> ' +
					'<a href="javascript:void(0);" class="" data-name="btn_get_more_tech" ' +
					'data-sv="'+v.service_code+'" title="รายชื่อช่างเพิ่มเติม"><i class="icon-user"></i></a>' 
					: '';
    		
            $('#tbl_other_service_list > tbody').append(
                '<tr>' +
                    '<td>' + v.service_code + '</td>' +
                    '<td>' + v.date_serv + '</td>' +
                    '<td>' + v.time_serv + '</td>' +
                    '<td>' + clear_null(v.pri_name) + '</td>' +
                    '<td>' + clear_null(v.owner_name) + '</td>' +
                    '<td>' + clear_null(v.product_name) + '</td>' +
                    '<td>' + clear_null(v.cause) + '</td>' +
                    '<td><span class="label label-info">' + clear_null(v.service_type) + '</span> <span class="label">' + clear_null(v.tech_type_name) + '</span> </td>' +
                    '<td>' + tech_more + ' ' + clear_null(v.tech_name) + '</td>' +
                    '<td>' + v.status + '</td>' +
                    '<td>'+
                    '<div class="btn-group dropup"> ' +
                    '<a href="javascript:void(0);" class="btn btn primary"><i class="icon-th-list"></i></a>' +
                    '<a class="btn btn primary dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"> ' +
                    '<span class="caret"></span> ' +
                    '</a>' +
                    '<ul class="dropdown-menu pull-right">' +

                    '<li><a href="javascript:void(0);" data-name="btn_other_print" data-sv="'+v.service_code+'"><i class="icon-print"></i> พิมพ์ใบแจ้งซ่อม</a></li>' +
                    '<li><a href="javascript:void(0);" data-name="btn_other_change_status" data-tech="'+ v.tech_name +'" data-sv="'+ v.service_code +'"><i class="icon-share"></i> เปลี่ยนสถานะการซ่อม</a></li>' +
                    '<li><a href="javascript:void(0);" data-name="btn_other_assign_tech" data-status="'+ v.service_status +'" data-sv="'+ v.service_code +'"><i class="icon-user"></i> กำหนดช่างรับผิดชอบ</a></li>' +

                    '<li><a href="javascript:void(0);" data-name="btn_other_do_service" data-id="'+ v.id +'"><i class="icon-edit"></i> บันทึกการซ่อม/อุปกรณ์</a></li>' +
                    '<li><a href="javascript:void(0);" data-name="btn_other_do_result" data-sv="'+v.service_code+'" data-id="'+ v.id +'"><i class="icon-ok-sign"></i> สรุปผลการให้บริการ</a></li>' +
                    '<li class="divider"></li>' +
                    '<li class="dropdown-submenu pull-left">' +
                    '<a tabindex="-1" href="#"><i class="icon-th-list"></i> ตัวเลือกอื่นๆ</a>' +
                    '<ul class="dropdown-menu">' +
                    '<li><a href="javascript:void(0);" data-name="btn_get_items" data-sv="'+v.service_code+'"><i class="icon-wrench"></i> ข้อมูลอะไหล่</a></li>' +
                    '<li><a href="javascript:void(0);" data-name="btn_other_edit_service" data-sv="'+v.service_code+'"><i class="icon-edit"></i> แก้ไขใบแจ้งซ่อม</a></li>' +
                    '<li><a href="javascript:void(0);" data-name="btn_show_assign_type_other" data-sv="'+v.service_code+'"><i class="icon-star"></i> กำหนดประเภทงาน</a></li>' +
                    '<li><a href="javascript:void(0);" data-name="btn_show_discharge" data-sv="'+v.service_code+'"><i class="icon-check"></i> จำหน่ายรายการ</a></li>' +
                    '<li><a href="javascript:void(0);" data-name="btn_show_addmore_technician" data-sv="'+v.service_code+'"><i class="icon-user"></i> เพิ่มช่างผู้รับผิดชอบงาน</a></li>' +
                    '<li><a href="javascript:void(0);" data-name="btn_other_remove" data-sv="'+v.service_code+'"><i class="icon-trash"></i> ลบรายการ</a></li>' +
                    '</ul>' +
                    '</li>' +
                    '</ul></div>' +
                    '</td>' +
                    '</tr>'
            );
        });
    };
    
    service.get_service_by_other_list = function(err, data){
        $('#tbl_other_service_list > tbody').empty();
        if(err){
            $('#tbl_other_service_list > tbody').append('<tr><td colspan="11">ไม่พบรายการ</td></tr>');
        }else{
            if(_.size(data.rows)){
                service.set_list_other(data);
            }else{
                $('#tbl_other_service_list > tbody').append('<tr><td colspan="11">ไม่พบรายการ</td></tr>');
            }
        }

    };

    service.get_search_by_other_list = function(err, data){
        $('#tbl_other_service_list > tbody').empty();
        if(err){
            $('#tbl_other_service_list > tbody').append('<tr><td colspan="10">ไม่พบรายการ</td></tr>');
        }else{
            if(_.size(data.rows)){
                service.set_list_other(data);
            }else{
                $('#tbl_other_service_list > tbody').append('<tr><td colspan="10">ไม่พบรายการ</td></tr>');
            }
        }

    };

    service.show_change_status = function(sv){
        $('#txt_regcode_service_code').val(sv);
        service.modal.show_change_status();
    };
    service.show_assign_tech = function(sv){
        $('#txt_regcode_assign_tech_service_code').val(sv);
        service.modal.show_assign_tech();
    };

    service.show_assign_tech_other = function(sv){
        $('#txt_other_assign_tech_service_code').val(sv);
        service.modal.show_assign_tech_other();
    };

    $('#mdl_regcode_change_status').on('hidden', function(){
        $('#txt_regcode_status_password').val('');
        set_first_selected($('#sl_regcode_status_user'));
    });


    $('#mdl_other_change_status').on('hidden', function(){
        $('#txt_other_status_password').val('');
        set_first_selected($('#sl_other_status_user'));
    });
    
    $('#mdl_regcode_assign_tech').on('hidden', function(){
        $('#txt_regcode_assign_tech_password').val('');
        set_first_selected($('#sl_regcode_assign_tech_user'));
    });
    
    $('#mdl_other_assign_tech').on('hidden', function(){
    	$('#txt_other_assign_tech_password').val('');
    	set_first_selected($('#sl_other_assign_tech_user'));
    });

    service.get_regcode_status_list = function(){
        var status = $('#txt_regcode_view_by').val();
        if(!status){
            status = '1';
        }

        service.ajax.get_service_by_code_total(status, function(err, data){
            if(err){
                App.alert(err);
            }else{
                $('#main_paging > ul').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: App.record_perpage,
                    lapping: 1,
                    page: 1,
                    onSelect: function(page){
                        //console.log('page: ' + page);
                        //console.log(this.slice);      //this.slice[0] = start, this.slice[1] = stop

                        service.ajax.get_service_by_code_list(status, this.slice[0], this.slice[1], function(err, data){
                            service.get_service_by_code_list(err, data);
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


    service.get_other_status_list = function(){
        var status = $('#txt_other_view_by').val();
        if(!status){
            status = '1';
        }

        service.ajax.get_service_by_other_total(status, function(err, data){
            if(err){
                App.alert(err);
            }else{
                $('#main_paging_other > ul').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: App.record_perpage,
                    lapping: 1,
                    page: 1,
                    onSelect: function(page){
                        //console.log('page: ' + page);

                        service.ajax.get_service_by_other_list(status, this.slice[0], this.slice[1], function(err, data){
                            service.get_service_by_other_list(err, data);
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

    service.get_regcode_search_list = function(query){

        service.ajax.get_search_service_by_code_total(query, function(err, data){
            if(err){
                App.alert(err);
            }else{
                $('#main_paging > ul').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: App.record_perpage,
                    lapping: 1,
                    page: 1,
                    onSelect: function(page){
                        //console.log('page: ' + page);
                        //console.log(this.slice);      //this.slice[0] = start, this.slice[1] = stop

                        service.ajax.get_search_service_by_code_list(query, this.slice[0], this.slice[1], function(err, data){
                            service.get_service_by_code_list(err, data);
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

    service.get_other_search_list = function(query){

        service.ajax.get_search_service_by_other_total(query, function(err, data){
            if(err){
                App.alert(err);
            }else{
                $('#main_paging > ul').paging(data.total, {
                    format: " < . (qq -) nnncnnn (- pp) . >",
                    perpage: App.record_perpage,
                    lapping: 1,
                    page: 1,
                    onSelect: function(page){
                        //console.log('page: ' + page);
                        //console.log(this.slice);      //this.slice[0] = start, this.slice[1] = stop

                        service.ajax.get_search_service_by_other_list(query, this.slice[0], this.slice[1], function(err, data){
                            service.get_service_by_other_list(err, data);
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

    service.set_list_main = function(data){
    	 _.each(data.rows, function(v){
    		 
     		var tech_more = v.tech_more > 0 ? 
    				'<span class="badge badge-info">'+ v.tech_more +'</span> ' +
					'<a href="javascript:void(0);" class="" data-name="btn_get_more_tech" ' +
					'data-sv="'+v.service_code+'" title="รายชื่อช่างเพิ่มเติม"><i class="icon-user"></i></a>' 
					: '';
     		
             $('#tbl_code_service_list > tbody').append(
                 '<tr>' +
                     '<td>' + v.service_code + '</td>' +
                     '<td>' + v.date_serv + '</td>' +
                     '<td>' + v.time_serv + '</td>' +
                     '<td>' + clear_null(v.pri_name) + '</td>' +
                     '<td>' + v.product_code + '</td>' +
                     '<td>' + v.product_name + '</td>' +
                     '<td>' + v.owner_name + '</td>' +
                     '<td>' + v.cause + '</td>' +
                     '<td><span class="label label-info">' + clear_null(v.service_type) + '</span> <span class="label">' + clear_null(v.tech_type_name) + '</span> </td>' +
                     '<td>' + tech_more + ' ' + v.tech_name + ' </td>' +
                     '<td>' + v.status + '</td>' +
                     '<td>' +
                     '<div class="btn-group dropup"> ' +
                     '<a href="javascript:void(0);" class="btn btn primary"><i class="icon-th-list"></i></a>' +
                     '<a class="btn btn primary dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"> ' +
                     '<span class="caret"></span> ' +
                     '</a>' +
                     '<ul class="dropdown-menu pull-right">' +

                     '<li><a href="javascript:void(0);" data-name="btn_code_print" data-sv="'+v.service_code+'"><i class="icon-print"></i> พิมพ์ใบแจ้งซ่อม</a></li>' +
                     '<li><a href="javascript:void(0);" data-name="btn_regcode_change_status" data-tech="'+ v.tech_user_id +'" data-sv="'+ v.service_code +'"><i class="icon-share"></i> เปลี่ยนสถานะการซ่อม</a></li>' +
                     '<li><a href="javascript:void(0);" data-name="btn_regcode_assign_tech" data-status="'+ v.service_status +'" data-sv="'+ v.service_code +'"><i class="icon-user"></i> กำหนดช่างรับผิดชอบ</a></li>' +
                     '<li><a href="javascript:void(0);" data-name="btn_do_service" data-id="'+ v.id +'"><i class="icon-edit"></i> บันทึกการซ่อม/อุปกรณ์</a></li>' +
                     '<li><a href="javascript:void(0);" data-name="btn_do_result" data-sv="'+v.service_code+'" data-id="'+ v.id +'"><i class="icon-ok-sign"></i> สรุปผลการให้บริการ</a></li>' +
                     '<li class="divider"></li>' +
                     '<li class="dropdown-submenu pull-left">' +
                     '<a tabindex="-1" href="#"><i class="icon-th-list"></i> ตัวเลือกอื่นๆ</a>' +
                     '<ul class="dropdown-menu">' +
                     '<li><a href="javascript:void(0);" data-name="btn_get_items" data-sv="'+v.service_code+'"><i class="icon-wrench"></i> ข้อมูลอะไหล่</a></li>' +
                     '<li><a href="javascript:void(0);" data-name="btn_edit_service" data-sv="'+v.service_code+'"><i class="icon-edit"></i> แก้ไขใบแจ้งซ่อม</a></li>' +
                     '<li><a href="javascript:void(0);" data-name="btn_show_assign_type_main" data-sv="'+v.service_code+'"><i class="icon-star"></i> กำหนดประเภทงาน</a></li>' +
                     '<li><a href="javascript:void(0);" data-name="btn_show_discharge" data-sv="'+v.service_code+'"><i class="icon-check"></i> จำหน่ายรายการ</a></li>' +
                     '<li><a href="javascript:void(0);" data-name="btn_show_addmore_technician" data-sv="'+v.service_code+'"><i class="icon-user"></i> เพิ่มช่างผู้รับผิดชอบงาน</a></li>' +
                     '<li><a href="javascript:void(0);" data-name="btn_do_remove" data-sv="'+v.service_code+'"><i class="icon-trash"></i> ลบรายการ</a></li>' +
                     '</ul>' +
                     '</li>' +
                     '</ul></div>' +
                     '</td>' +
                     '</tr>'
             );
         });
    };
    service.get_service_by_code_list = function(err, data){
        $('#tbl_code_service_list > tbody').empty();
        if(err){
            $('#tbl_code_service_list > tbody').append('<tr><td colspan="12">ไม่พบรายการ</td></tr>');
        }else{
            if(_.size(data.rows)){
               service.set_list_main(data);
            }else{
                $('#tbl_code_service_list > tbody').append('<tr><td colspan="12>ไม่พบรายการ</td></tr>');
            }
        }

    };

    //do service
    $('a[data-name="btn_do_service"]').live('click', function(){
        var sv = $(this).attr('data-id');
        App.goto_url('/services/entries/' + sv);
    });

    $('a[data-name="btn_regcode_change_status"]').live('click', function(){
        var sv = $(this).attr('data-sv'),
            tech_name = $(this).attr('data-tech');

        if(!tech_name){
            App.alert('กรุณากำหนดช่างผู้รับผิดชอบ');
        }else{
            service.show_change_status(sv);
        }

    });
    $('a[data-name="btn_regcode_assign_tech"]').live('click', function(){
        var sv = $(this).attr('data-sv'),
            status = $(this).attr('data-status');
        if(status != '1'){
            App.alert('ไม่สามารถกำหนดช่างผู้รับผิดชอบได้เนื่องจากสถานะไม่ได้ รอซ่อม');
        }else{
            service.show_assign_tech(sv);
        }

    });

    //do change status
    $('#btn_regcode_do_change_status').click(function(){
        var data = {};
        
        data.sv =  $('#txt_regcode_service_code').val();
        data.status = $('#sl_regcode_service_status').val();
        data.user_id = $('#sl_regcode_status_user').val();
        data.password = $('#txt_regcode_status_password').val();

        if(!data.sv){
            App.alert('กรุณาระบุเลขที่ใบแจ้งซ่อม');
        }else if(!data.status){
            App.alert('กรุณาระบุสถานะ');
        }else if(!data.user_id){
        	App.alert('กรุณาระบุชื่อผู้ใช้งาน');
        }else if(!data.password){
        	App.alert('กรุณากำหนดรหัสผ่าน');
        }else{
            //do change status
            service.ajax.save_regcode_change_status(data, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('เปลี่ยสถานะเรียบร้อยแล้ว');
                    service.modal.hide_change_status();
                    service.get_regcode_status_list();
                }
            });
        }
    });
    $('#btn_other_do_change_status').click(function(){
        var data = {};
        
        data.sv =  $('#txt_other_service_code').val();
    	data.status = $('#sl_other_service_status').val();
    	data.user_id = $('#sl_other_status_user').val();
    	data.password = $('#txt_other_status_password').val();

        if(!data.sv){
            App.alert('กรุณาระบุเลขที่ใบแจ้งซ่อม');
        }else if(!data.status){
            App.alert('กรุณาระบุสถานะ');
        }else if(!data.user_id){
        	App.alert('กรุณาระบุชื่อผู้ใช้งาน');
        }else if(!data.password){
        	App.alert('กรุณาระบุรหัสผ่าน');
        }else{
            //do change status
            service.ajax.save_other_change_status(data, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('เปลี่ยสถานะเรียบร้อยแล้ว');
                    service.modal.hide_other_change_status();
                    service.get_other_status_list();
                }
            });
        }
    });
    //get status list
    $('a[data-name="btn_regcode_get_status_list"]').click(function(){
        var status = $(this).attr('data-id');
        $('#txt_regcode_view_by').val(status);

        service.get_regcode_status_list();

    });
    $('a[data-name="btn_other_get_status_list"]').click(function(){
        var status = $(this).attr('data-id');
        $('#txt_other_view_by').val(status);

        service.get_other_status_list();

    });
    $('#btn_regcode_assign_tech_do_assign').click(function(){
        var data = {};
        
        data.sv = $('#txt_regcode_assign_tech_service_code').val();
        data.user_id = $('#sl_regcode_assign_tech_user').val();
        data.password = $('#txt_regcode_assign_tech_password').val();
        
        if(!data.sv){
            App.alert('กรุณาระบุเลขที่ใบแจ้งซ่อม');
        }else if(!data.user_id){
        	App.alert('กรุณาระบุชื่อผู้ใช้งาน');
        }else if(!data.password){
        	App.alert('กรุณาระบุรหัสผ่าน');
        }else{
            //do assign
            service.ajax.save_regcode_assign_tech(data, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('บันทึกข้อมูลเสร็จเรียบร้อย');
                    service.modal.hide_assign_tech();
                    service.get_regcode_status_list();
                }
            });
        }

    });

    $('#btn_search_product').click(function(){
        var query = $('#txt_query_product').val();
        if(!query){
            App.alert('กรุณาระบุ หมายเลขรับซ่อม หรือ เลขครุภัณฑ์');
        }else{
             service.get_regcode_search_list(query);
        }
    });

	//get other list
	$('#tab_service_by_other').click(function(){
	    service.get_other_status_list();
	});

    $('#tab_service_by_code').click(function(){
	    service.get_regcode_status_list();
	});

	//change other status

	$('a[data-name="btn_other_change_status"]').live('click', function(){
        var sv = $(this).attr('data-sv'),
            tech_name = $(this).attr('data-tech');

        if(!tech_name || tech_name == '-'){
            App.alert('กรุณากำหนดช่างผู้รับผิดชอบ');
        }else{
            $('#txt_other_service_code').val(sv);

            service.modal.show_other_change_status();
        }

    });

    //other assign technician
    $('a[data-name="btn_other_assign_tech"]').live('click', function(){
        var sv = $(this).attr('data-sv'),
            status = $(this).attr('data-status');
        if(status != '1'){
            App.alert('ไม่สามารถกำหนดช่างผู้รับผิดชอบได้เนื่องจากสถานะไม่ได้ รอซ่อม');
        }else{
            service.show_assign_tech_other(sv);
        }

    });

        $('#btn_other_assign_tech_do_assign').click(function(){
        	
        var data = {};
        
        data.sv = $('#txt_other_assign_tech_service_code').val();
        data.user_id = $('#sl_other_assign_tech_user').val();
        data.password = $('#txt_other_assign_tech_password').val();
        
        if(!data.sv){
            App.alert('กรุณาระบุเลขที่ใบแจ้งซ่อม');
        }else if(!data.user_id){
        	App.alert('กรุณาระบุชื่อผู้ใช้งาน');
        }else if(!data.password){
        	App.alert('กรุณาระบุรหัสผ่าน');
        }else{
            //do assign
            service.ajax.save_other_assign_tech(data, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('บันทึกข้อมูลเสร็จเรียบร้อย');
                    service.modal.hide_assign_tech_other();
                    service.get_other_status_list();
                }
            });
        }

    });

    $('a[data-name="btn_other_do_service"]').live('click', function(){
        var id = $(this).attr('data-id');
        App.goto_url('/services/entries_other/' + id);
    });

    $('a[data-name="btn_do_result"]').live('click', function(){
        var id = $(this).attr('data-id'),
            sv = $(this).attr('data-sv');

        $('#txt_result_id').val(id);
        $('#txt_result_type').val('code');
        $('#txt_result_service_code').val(sv);

        service.get_result(id, 'code');
        service.modal.show_result();
    });


    $('a[data-name="btn_other_do_result"]').live('click', function(){
        var id = $(this).attr('data-id'),
            sv = $(this).attr('data-sv');

        $('#txt_result_id').val(id);
        $('#txt_result_type').val('other');
        $('#txt_result_service_code').val(sv);

        service.get_result(id, 'other');
        service.modal.show_result();
    });

    $('#btn_do_result').click(function(){
        var items = {};
        items.id = $('#txt_result_id').val();
        items.type = $('#txt_result_type').val();
        items.detail = $('#txt_result').val();
        items.sv = $('#txt_result_service_code').val();

        if(!items.id && !items.sv){
            App.alert('กรุณาระบุรหัสใบรับซ่อม');
        }else if(!items.detail){
            App.alert('กรุณาระบุผลการให้บริการ');
        }else{
            service.ajax.save_result(items, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('บันทึกรายการเสร็จเรียบร้อยแล้ว');
                    service.modal.hide_result();
                }
            });
        }
    });

    $('#btn_other_search_product').click(function(){
    	var query = $('#txt_other_query_product').val();

    	if(!query){
    		App.alert('กรุณาระบุ เลขที่ใบแจ้งซ่อม');
    	}else{
    		//do search
    		service.get_other_search_list(query);
    	}
    });

    //remove code
    $('a[data-name="btn_do_remove"]').live('click', function(){
    	var sv = $(this).attr('data-sv'),
    		obj = $(this).parent().parent().parent().parent().parent();

    	if(confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?')){

    		service.ajax.remove_code(sv, function(err){
    			if(err){
    				App.alert(err);
    			}else{
    				App.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
    				obj.fadeOut('slow');
    			}
    		});
    	}
    });
   //remove other
    $('a[data-name="btn_other_remove"]').live('click', function(){
    	var sv = $(this).attr('data-sv'),
    		obj = $(this).parent().parent().parent().parent().parent();

    	if(confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?')){

    		service.ajax.remove_other(sv, function(err){
    			if(err){
    				App.alert(err);
    			}else{
    				App.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
    				obj.fadeOut('slow');
    			}
    		});
    	}
    });

    $('a[data-name="btn_code_print"]').live('click', function(){
    	var sv = $(this).attr('data-sv');
    	App.goto_url('/prints/print_main_service/' + sv);
    });

    $('a[data-name="btn_other_print"]').live('click', function(){
    	var sv = $(this).attr('data-sv');
    	App.goto_url('/prints/print_other_service/' + sv);
    });

    //------------------------------------------------------------------------------------------------------------------
    /*
     * Discharge
     */
    $('#btn_do_discharge').click(function(){
    	var data = {};
    	
    	data.sv = $('#txt_discharge_service_code').val();
    	data.user_id = $('#sl_discharge_user').val();
    	data.password = $('#txt_discharge_password').val();
    	data.discharge_date = $('#txt_discharge_date').val();
    	
    	if(!data.sv){
    		App.alert('กรุณาระบุเลขที่รับซ่อม');
    	}else if(!data.user_id){
    		App.alert('กรุณาระบุชื่อผู้ใช้งาน');
    	}else if(!data.password){
    		App.alert('กรุณาระบุรหัสผ่าน');
    	}else if(!data.discharge_date){
    		App.alert('กรุณาระบุวันที่จำหน่าย');
    	}else{
    		service.ajax.save_discharge(data, function(err){
    			if(err){
    				App.alert(err);
    			}else{
    				App.alert('บันทึกการจำหน่ายเสร็จเรียบร้อยแล้ว');
    				service.modal.hide_discharge();
    			}
    		});
    	}
    });
    
    $('a[data-name="btn_show_discharge"]').live('click', function(){
    	var sv = $(this).attr('data-sv');
    	$('#txt_discharge_service_code').val(sv);
    	service.modal.show_discharge();
    });
    
    $('a[data-name="btn_show_assign_type_main"]').live('click', function(){
    	var sv = $(this).attr('data-sv');
    	
    	$('#txt_type_service_code').val(sv);
    	
    	service.modal.show_service_type();
    });
    
    $('a[data-name="btn_show_assign_type_other"]').live('click', function(){
    	var sv = $(this).attr('data-sv');
    	
    	$('#txt_type_service_code_other').val(sv);
    	
    	service.modal.show_service_type_other();
    });
    
    $('#btn_do_main_type').click(function(){
    	var data = {};
    	
    	data.type = $('#sl_type').val();
    	data.type_service = $('#sl_type_service').val();
    	data.user_id = $('#sl_type_user').val();
    	data.password = $('#txt_type_password').val();
    	data.sv = $('#txt_type_service_code').val();
    	
    	if(!data.sv){
    		App.alert('ไม่พบรหัสรับซ่อม');
    	}else if(!data.type){
    		App.alert('กรุณาระบุประเภทงาน');
    	}else if(!data.type_service){
    		App.alert('กรุณาระบุประเภทงานซ่อม');
    	}else if(!data.user_id){
    		App.alert('กรุณาระบุชื่อผู้ใช้งาน');
    	}else if(!data.password){
    		App.alert('กรุณาระบุรหัสผ่าน');
    	}else{
    		service.ajax.save_main_type(data, function(err){
    			if(err){
    				App.alert(err);
    			}else{
    				App.alert('กำหนดประเภทงานเสร็จเรียบร้อยแล้ว');
    				service.modal.hide_service_type();
    				service.get_regcode_status_list();
    			}
    		});
    	}
    });
    
    $('#btn_do_other_type').click(function(){
    	var data = {};
    	
    	data.type = $('#sl_type_other').val();
    	data.type_service = $('#sl_type_service_other').val();
    	data.user_id = $('#sl_type_user_other').val();
    	data.password = $('#txt_type_password_other').val();
    	data.sv = $('#txt_type_service_code_other').val();
    	
    	if(!data.sv){
    		App.alert('ไม่พบรหัสรับซ่อม');
    	}else if(!data.type){
    		App.alert('กรุณาระบุประเภทงาน');
    	}else if(!data.type_service){
    		App.alert('กรุณาระบุประเภทงานซ่อม');
    	}else if(!data.user_id){
    		App.alert('กรุณาระบุชื่อผู้ใช้งาน');
    	}else if(!data.password){
    		App.alert('กรุณาระบุรหัสผ่าน');
    	}else{
    		service.ajax.save_other_type(data, function(err){
    			if(err){
    				App.alert(err);
    			}else{
    				App.alert('กำหนดประเภทงานเสร็จเรียบร้อยแล้ว');
    				service.modal.hide_service_type_other();
    				service.get_other_status_list();
    			}
    		});
    	}
    });
    
    //------------------------------------------------------------------------------------------------------------------
    $('a[data-name="btn_show_addmore_technician"]').live('click', function(){
    	var sv = $(this).attr('data-sv');
    	$('#txt_mot_service_code').val(sv);
    	
    	service.modal.show_more_technician();
    });
    
    $('#btn_do_mot').click(function(){
    	
    	var data = {};
    	data.sv = $('#txt_mot_service_code').val();
    	data.user_id = $('#sl_mot_user').val();
    	data.password = $('#txt_mot_password').val();
    	data.tech_user_id = $('#sl_mot_technician').val();
    	
    	if(!data.sv){
    		App.alert('กรุณาระบุเลขที่ใบรับซ่อม');
    	}else if(!data.tech_user_id){
    		App.alert('กรุณาระบุช่างผู้รับผิดชอบงาน');
    	}else if(!data.user_id){
    		App.alert('กรุณาระบุชื่อผู้ใช้งาน');
    	}else if(!data.password){
    		App.alert('กรุณาระบุรหัสผ่าน');
    	}else{
    		service.ajax.save_more_technician(data, function(err){
    			if(err){
    				App.alert(err);
    			}else{
    				App.alert('บันทึกรายการเสร็จเรียบร้อย');
    				service.modal.hide_more_technician();
    			}
    		});
    	}
    });
    
    $('a[data-name="btn_get_more_tech"]').live('click', function(){
    	var sv = $(this).attr('data-sv');
    	service.ajax.get_more_technician(sv, function(err, data){
    		$('#tbl_more_technician_list > tbody').empty();
    		
    		if(err){
    			App.alert('ไม่พบรายการ');
    		}else{
    			_.each(data.rows, function(v){
    				$('#tbl_more_technician_list > tbody').append(
        					'<tr>' +
        					'<td>' + v.username + '</td>' +
        					'<td>' + v.fullname + '</td>' +
        					'</tr>'
        			);
    			});
    			
    			service.modal.show_list_technician();
    		}
    	});
    	//show_list_technician
    });

    //edit service

    service.get_service_detail_main = function(sv)
    {
        service.ajax.get_service_detail_main(sv, function(err, data){
           if(err)
           {
               App.alert(err);
           }
           else
           {
                $('#txt_regcode_product_name').val(data.rows.product_name);
                $('#txt_regcode_product_id').val(data.rows.product_id);
                $('#txt_contact_name').val(data.rows.contact_name);
                $('#txt_regcode_cause').val(data.rows.cause);
                $('#txt_es_sv').val(sv);

                service.modal.show_edit_service();
           }
        });
    };

    service.get_service_detail_other = function(sv)
    {
        service.ajax.get_service_detail_other(sv, function(err, data){
            if(err)
            {
                App.alert(err);
            }
            else
            {
                $('#txt_est_product_name').val(data.rows.product_name);
                $('#txt_est_product_desc').val(data.rows.product_desc);
                $('#txt_est_contact_name').val(data.rows.contact_name);
                $('#txt_est_cause').val(data.rows.cause);
                $('#txt_est_sv').val(sv);
                $('#sl_est_owners').val(data.rows.owner_id);

                service.modal.show_edit_service_other();
            }
        });
    };


    service.clear_edit_service_main_form = function()
    {
        $('#txt_regcode_product_name').val('');
        $('#txt_regcode_product_id').val('');
        $('#txt_contact_name').val('');
        $('#txt_regcode_cause').val('');
        $('#txt_es_sv').val('');
    };

    service.clear_edit_service_other_form = function()
    {
        $('#txt_regcode_product_name').val('');
        $('#txt_regcode_product_desc').val('');
        $('#txt_contact_name').val('');
        $('#txt_regcode_cause').val('');
        $('#txt_es_sv').val('');
    };

    $('a[data-name="btn_edit_service"]').live('click', function(){
       var sv = $(this).attr('data-sv');

        //get detail

        service.get_service_detail_main(sv);
    });

    $('a[data-name="btn_other_edit_service"]').live('click', function(){
        var sv = $(this).attr('data-sv');
        service.get_service_detail_other(sv);
    });

    $('#btn_save_edit_service_main').click(function(){
        var data = {};

        data.product_id = $('#txt_regcode_product_id').val();
        data.product_name = $('#txt_regcode_product_name').val();
        data.cause = $('#txt_regcode_cause').val();
        data.contact_name = $('#txt_contact_name').val();
        data.user_id = $('#sl_es_user_main').val();
        data.password = $('#sl_es_password_main').val();
        data.sv = $('#txt_es_sv').val();

        if(!data.sv){
            App.alert('ไม่พบรหัสรับซ่อม');
        }else if(!data.product_id || !data.product_name){
            App.alert('กรุณาระบรายการสินค้า');
        }else if(!data.cause){
            App.alert('กรุณาระบุอาการแจ้งซ่อม');
        }else if(!data.contact_name){
            App.alert('กรุณาระบุชื่อผู้ติดต่อ');
        }else if(!data.user_id){
            App.alert('กรุณาระบุชื่อผู้ใช้งาน');
        }else if(!data.password){
            App.alert('กรุณาระบุรหัสผ่าน');
        }else{
            service.ajax.save_edit_service_main(data, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('แก้ไขข้อมูลเสร็จเรียบร้อยแล้ว');
                    service.clear_edit_service_main_form();
                    service.modal.hide_edit_service();
                    service.get_regcode_status_list();
                }
            });
        }
    });


    $('#btn_save_edit_service_other').click(function(){
        var data = {};
        data.product_desc = $('#txt_est_product_desc').val();
        data.product_name = $('#txt_est_product_name').val();
        data.cause = $('#txt_est_cause').val();
        data.contact_name = $('#txt_est_contact_name').val();
        data.owner_id = $('#sl_est_owners').val();
        data.user_id = $('#sl_est_user_main').val();
        data.password = $('#sl_est_password_main').val();
        data.sv = $('#txt_est_sv').val();

        if(!data.sv){
            App.alert('ไม่พบรหัสรับซ่อม');
        }else if(!data.product_name || !data.product_desc){
            App.alert('กรุณาระบุรายการส่งซ่อม');
        }else if(!data.cause){
            App.alert('กรุณาระบุอาการแจ้งซ่อม');
        }else if(!data.contact_name){
            App.alert('กรุณาระบุชื่อผู้ติดต่อ');
        }else if(!data.owner_id){
            App.alert('กรุณาระบุหน่วยงาน');
        }else if(!data.user_id){
            App.alert('กรุณาระบุชื่อผู้ใช้งาน');
        }else if(!data.password){
            App.alert('กรุณาระบุรหัสผ่าน');
        }else{
            service.ajax.save_edit_service_other(data, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('แก้ไขข้อมูลเสร็จเรียบร้อยแล้ว');
                    service.clear_edit_service_other_form();
                    service.modal.hide_edit_service_other();
                    service.get_other_status_list();
                }
            });
        }
    });

    $('#btn_regcode_search_product').click(function(){
        service.modal.show_search_product();
        service.modal.hide_edit_service();
    });

    $('#mdl_search_product').on('hidden', function(){
       service.modal.show_edit_service();
    });

    $('#btn_regcode_do_search').click(function(){
        var query = $('#txt_regcode_query_product').val();
        if(!query || $.trim(query).length <= 2){
            App.alert('กรุณาระบุคำที่ต้องการค้นหา มากกว่า 2 ตัวอักษรขึ้นไป');
        }else{
            //do search
            $('#tbl_reg_search_product_result > tbody').empty();

            service.ajax.search_reg_product(query, function(err, data){
                if(err){
                    App.alert(err);
                    $('#tbl_reg_search_product_result > tbody').append(
                        '<tr><td colspan="6">ไม่พบรายการ</td></tr>'
                    );
                }else{
                    if(_.size(data.rows)){
                        _.each(data.rows, function(v){
                            var owner_name = $.trim(v.owner_name).length == 0 ? '-' : v.owner_name;
                            var brand_name = $.trim(v.brand_name).length == 0 ? '-' : v.brand_name;
                            var model_name = $.trim(v.model_name).length == 0 ? '-' : v.model_name;
                            $('#tbl_reg_search_product_result > tbody').append(
                                '<tr>' +
                                    '<td>'+ v.code +'</td>' +
                                    '<td>'+ v.name +'</td>' +
                                    '<td>'+ owner_name +'</td>' +
                                    '<td>'+ brand_name+'</td>' +
                                    '<td>'+ model_name +'</td>' +
                                    '<td><a href="javascript:void(0);" title="เลือกรายการนี้" data-name="btn_regcode_selected_product" class="btn btn-info" ' +
                                    'data-id="'+ v.id +'" data-code="'+ v.code +'" data-product_name="'+v.name+'"> <i class="icon-ok icon-white"></i></a></td>' +
                                    '</tr>'
                            );
                        });
                    }else{
                        $('#tbl_reg_search_product_result > tbody').append(
                            '<tr><td colspan="6">ไม่พบรายการ</td></tr>'
                        );
                    }
                }
            });
        }
    });

    $('a[data-name="btn_regcode_selected_product"]').live('click', function(){
        var id = $(this).attr('data-id'),
            code = $(this).attr('data-code'),
            name = $(this).attr('data-product_name');

        $('#txt_regcode_product_id').val(id);
        //$('#txt_regcode_product_code').val(name);
        $('#txt_regcode_product_name').val(name);

        service.modal.hide_search_product();
    });

    $('a[data-name="btn_get_items"]').live('click', function(){
       var sv = $(this).attr('data-sv');
        $('#txt_items_sv').val(sv);
        service.get_item(sv);

        service.modal.show_item();
    });
    service.get_regcode_status_list();
});

//End file