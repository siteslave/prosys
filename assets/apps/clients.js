$(function(){
    var client = {};

    client.modal = {
        show_new: function(){
            $('#mdl_new_by_code').modal({backdrop: 'static'}).css({
                width: 880,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },
        show_change_password: function(){
            $('#mdl_change_password').modal({backdrop: 'static'}).css({
                width: 680,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        }
        ,hide_change_password: function(){
            $('#mdl_change_password').modal('hide');
        },hide_new: function(){
            $('#mdl_new_by_code').modal('hide');
        },hide_search_product: function(){
            $('#mdl_search_product').modal('hide');
        },
        show_search_product: function(){
            $('#mdl_search_product').modal({backdrop: 'static'}).css({
                width: 880,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },
        show_new_other: function(){
            $('#mdl_new_by_other').modal({backdrop: 'static'}).css({
                width: 880,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },hide_new_other: function(){
            $('#mdl_new_by_other').modal('hide');
        }
    };

    client.ajax = {
        search_reg_product: function(query, cb){
            var url = '/clients/search_reg_product',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        change_password: function(pwd, cb){
            var url = '/clients/change_password',
                params = {
                    pwd: pwd
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        search_other_product: function(query, cb){
            var url = '/clients/search_other_product',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_by_code_total: function(status, cb){
            var url = '/clients/get_service_by_code_total',
                params = {
					status: status
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        //
        get_search_service_by_other_total: function(query, cb){
            var url = '/clients/get_search_service_by_other_total',
                params = {
					query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_search_service_by_code_total: function(query, cb){
            var url = '/clients/get_search_service_by_code_total',
                params = {
					query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_by_other_total: function(status, cb){
            var url = '/clients/get_service_by_other_total',
                params = {
					status: status
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_reg_product: function(data, cb){
            var url = '/clients/save_reg_product',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_by_code_list: function(status, start, stop, cb){
            var url = '/clients/get_service_by_code_list',
                params = {
                    start: start,
                    stop: stop,
                    status: status
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_service_by_other_list: function(status, start, stop, cb){
            var url = '/clients/get_service_by_other_list',
                params = {
                    start: start,
                    stop: stop,
                    status: status
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        
        get_search_service_by_other_list: function(query, start, stop, cb){
            var url = '/clients/get_search_service_by_other_list',
                params = {
                    start: start,
                    stop: stop,
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_search_service_by_code_list: function(query, start, stop, cb){
            var url = '/clients/get_search_service_by_code_list',
                params = {
                    start: start,
                    stop: stop,
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        save_other_product: function(data, cb){
            var url = '/clients/save_other_product',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }

    };

    client.get_service_by_code_list = function(err, data){
        $('#tbl_code_service_list > tbody').empty();
        if(err){
            $('#tbl_code_service_list > tbody').append('<tr><td colspan="7">ไม่พบรายการ</td></tr>');
        }else{
            if(_.size(data.rows)){
                _.each(data.rows, function(v){
                    $('#tbl_code_service_list > tbody').append(
                        '<tr>' +
                            '<td>' + v.service_code + '</td>' +
                            '<td>' + v.date_serv + '</td>' +
                            '<td>' + v.product_code + '</td>' +
                            '<td>' + v.product_name + '</td>' +
                            '<td>' + v.cause + '</td>' +
                            '<td>' + v.status + '</td>' +
                            '<td>' +
                            '<a href="javascript:void(0);" title="ดูสถานะงานซ่อม" class="btn" data-name="btn_code_get_info" data-id="'+ v.id +'"><i class="icon-edit"></i></a>' +
                            ' <a href="javascript:void(0);" title="พิมพ์ใบรับซ่อม" class="btn" data-name="btn_code_print" data-sv="'+ v.service_code +'"><i class="icon-print"></i></a>' +
                            '</td>' +
                            '</tr>'
                    );
                });
            }else{
                $('#tbl_code_service_list > tbody').append('<tr><td colspan="7">ไม่พบรายการ</td></tr>');
            }
        }

    };

	
  client.get_service_by_other_list = function(err, data){
        $('#tbl_other_service_list > tbody').empty();
        if(err){
            $('#tbl_other_service_list > tbody').append('<tr><td colspan="7">ไม่พบรายการ</td></tr>');
        }else{
            if(_.size(data.rows)){
                _.each(data.rows, function(v){
                    $('#tbl_other_service_list > tbody').append(
                        '<tr>' +
                            '<td>' + v.service_code + '</td>' +
                            '<td>' + v.date_serv + '</td>' +
                            '<td>' + v.owner_name + '</td>' +
                            '<td>' + v.product_name + '</td>' +
                            '<td>' + v.cause + '</td>' +
                            '<td>' + v.status + '</td>' +
                            '<td>' +
                            '<a href="javascript:void(0);" class="btn" title="ดูสถานะงานซ่อม" data-name="btn_other_get_info" data-id="'+ v.id +'"><i class="icon-edit"></i></a>' +
                            ' <a href="javascript:void(0);" class="btn" title="พิมพ์ใบรับซ่อม" data-name="btn_other_print" data-sv="'+ v.service_code +'"><i class="icon-print"></i></a>' +
                            '</td>' +
                            '</tr>'
                    );
                });
            }else{
                $('#tbl_other_service_list > tbody').append('<tr><td colspan="7">ไม่พบรายการ</td></tr>');
            }
        }

    };
    client.clear_register_by_code_form = function(){
        $('#txt_regcode_product_id').val('');
        $('#txt_regcode_product_code').val('');
        $('#txt_regcode_cause').val('');
        $('#txt_regcode_comment').val('');
    };

        
    client.clear_register_by_other_form = function(){
        $('#txt_other_product_name').val('');
		$('#txt_other_cause').val('');
		//$('#sl_other_priority').val();
		$('#txt_other_comment').val('');
		//$('#sl_other_owners').val();
		$('#txt_other_isupdate').val('');
		$('#txt_other_id').val('');
        
    };
    
    $('#btn_regcode_new').click(function(){
        client.modal.show_new();
    });
    
    $('#btn_other_new').click(function(){
    	client.clear_register_by_other_form();
    	client.modal.show_new_other();
    });
    //search product
    $('#btn_regcode_search_product').click(function(){
        client.modal.show_search_product();
        client.modal.hide_new();
    });

    $('#mdl_search_product').on('hidden', function(){
        client.modal.show_new();
    });
    
    $('#btn_other_new').on('hidden', function(){
    	client.clear_register_by_other_form();
    });

    //do search product
    $('#btn_regcode_do_search').click(function(){
        var query = $('#txt_regcode_query_product').val();
        if(!query || $.trim(query).length <= 2){
            App.alert('กรุณาระบุคำที่ต้องการค้นหา มากกว่า 2 ตัวอักษรขึ้นไป');
        }else{
            //do search
            $('#tbl_reg_search_product_result > tbody').empty();

            client.ajax.search_reg_product(query, function(err, data){
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
    
    
    $('#btn_other_search').click(function(){
        var query = $('#txt_other_query_service').val();
        if(!query){
            App.alert('กรุณาระบุ หมายเลขรับซ่อม');
        }else{
             client.search_other(query);
        }
    });
    
    
        
    $('#btn_code_search').click(function(){
        var query = $('#txt_code_query_service').val();
        if(!query){
        	$('#txt_code_status').val('0');
            client.get_code_list();
        }else{
             client.search_code(query);
        }
    });
    
    $('a[data-name="btn_regcode_selected_product"]').live('click', function(){
        var id = $(this).attr('data-id'),
            code = $(this).attr('data-code'),
            name = $(this).attr('data-product_name');

        $('#txt_regcode_product_id').val(id);
        $('#txt_regcode_product_code').val(name);
        //$('#txt_regcode_product_name').val(name);

        client.modal.hide_search_product();
    });

    $('#btn_save_regcode').click(function(){
        var items = {};
        items.product_id = $('#txt_regcode_product_id').val();
        items.code = $('#txt_regcode_product_code').val();
        items.cause = $('#txt_regcode_cause').val();
        items.priority = $('#sl_regcode_priority').val();
        items.comment = $('#txt_regcode_comment').val();

        if(!items.product_id || !items.code){
            App.alert('กรุณาเลือกครุภัณฑ์ที่ต้องการ');
        }else if(!items.cause){
            App.alert('กรุณาระบุอาการแจ้งซ่อม');
        }else{
            client.ajax.save_reg_product(items, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');
                    client.modal.hide_new();
                    client.clear_register_by_code_form();
                    
                    client.get_code_list();
                }
            });
        }
    });


    $('#btn_save_other').click(function(){
        var items = {};
        items.product_name = $('#txt_other_product_name').val();
        items.cause = $('#txt_other_cause').val();
        items.priority_id = $('#sl_other_priority').val();
        items.comment = $('#txt_other_comment').val();
        items.owner_id = $('#sl_other_owners').val();
        items.isupdate = $('#txt_other_isupdate').val();
        items.id = $('#txt_other_id').val();
        

        if(!items.product_name || !items.product_name){
            App.alert('กรุณาระบุ ชื่อของรายการที่แจ้งซ่อม');
        }else if(!items.cause){
            App.alert('กรุณาระบุอาการแจ้งซ่อม');
        }else if(items.owner){
        	App.alert('กรุณาเลือกหน่วยงาน');
        }else{
        	if(items.isupdate == '1'){
        		
        	}else{
        		client.ajax.save_other_product(items, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');
                    client.modal.hide_new_other();
                    client.clear_register_by_other_form();
                    
                    client.get_other_list();
                    
                }
            });
        	}
            
        }
    });

	client.search_code = function(query){
		client.ajax.get_search_service_by_code_total(query, function(err, data){
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

                        client.ajax.get_search_service_by_code_list(query, this.slice[0], this.slice[1], function(err, data){
                            client.get_service_by_code_list(err, data);
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
	

	client.search_other = function(query){
		client.ajax.get_search_service_by_other_total(query, function(err, data){
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
                        //console.log(this.slice);      //this.slice[0] = start, this.slice[1] = stop

                        client.ajax.get_search_service_by_other_list(query, this.slice[0], this.slice[1], function(err, data){
                            client.get_service_by_other_list(err, data);
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
	
	
	client.get_code_list = function(){
		    //paging
		var status = $('#txt_code_status').val();
		
	    client.ajax.get_service_by_code_total(status, function(err, data){
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
	
	                        client.ajax.get_service_by_code_list(status, this.slice[0], this.slice[1], function(err, data){
	                            client.get_service_by_code_list(err, data);
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

	client.get_other_list = function(){
		
		var status = $('#txt_other_status').val();
		
		client.ajax.get_service_by_other_total(status, function(err, data){
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
	                        //console.log(this.slice);      //this.slice[0] = start, this.slice[1] = stop
	
	                        client.ajax.get_service_by_other_list(status, this.slice[0], this.slice[1], function(err, data){
	                            client.get_service_by_other_list(err, data);
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

	$('a[data-name="btn_other_get_status_list"]').click(function(){
		var status = $(this).attr('data-id');
		$('#txt_other_status').val(status);

		client.get_other_list();
		
	});

	$('a[data-name="btn_code_get_status_list"]').click(function(){
		var status = $(this).attr('data-id');
		$('#txt_code_status').val(status);

		client.get_code_list();
		
	});
	
	$('a[href="#tab1"]').click(function(){
		
		client.get_code_list();
	});
	
	$('a[href="#tab2"]').click(function(){
		client.get_other_list();
	});
	
	//get service code info
	$('a[data-name="btn_code_get_info"]').live('click', function(){
	    var id = $(this).attr('data-id');
	    
	    App.goto_url('/clients/get_info/' + id);
	});
	
	$('a[data-name="btn_other_get_info"]').live('click', function(){
	    var id = $(this).attr('data-id');
	    App.goto_url('/clients/get_info_other/' + id);
	});


//chage pass
    $('#chk-pass').click(function(){
        client.modal.show_change_password();
    });
    
    $('#btn_do_change_password').click(function(){
        var new_pass = $('#txt_password').val();
        
        if(!new_pass){
            App.alert('กรุณาระบุรหัสผ่านใหม่');
        }else{
            //do change password
            client.ajax.change_password(new_pass, function(err){
                if(err){
                    App.alert(err);
                }else{
                    App.alert('เปลี่ยนรหัสผ่านเสร็จเรียบร้อยแล้ว');
                    client.modal.hide_change_password();
                }
            });
        }
    });
	
    
    //'<a href="javascript:void(0);" class="btn" data-name="btn_code_print" data-sv="'+ v.service_code +'"><i class="icon-print"></i></a>' +
    //print
    $('a[data-name="btn_code_print"]').live('click', function(){
    	var sv = $(this).attr('data-sv');
    	App.goto_url('/prints/print_main_service/' + sv);
    });
    
    $('a[data-name="btn_other_print"]').live('click', function(){
    	var sv = $(this).attr('data-sv');
    	App.goto_url('/prints/print_other_service/' + sv);
    });
    
	client.get_code_list();

    //client.get_service_by_code_list();
});
