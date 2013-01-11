$(function(){
    var Products = {};
	Products.show_history = function(){
        $('#mdl_service_history').modal({backdrop: 'static'}).css({
            width: 880,
            'margin-left': function () {
                return -($(this).width() / 2);
            }
        });
    };
    Products.clear_register_form = function(){
        $('#txt_product_code').val('');
        $('#txt_product_name').val('');
        $('#txt_product_serial').val('');
        $('#txt_purchase_price').val('');
        $('#txt_purchase_date').val('');
        //$('#sl_new_brand').val('');
        //$('#sl_new_model').val('');
        //$('#sl_owners').val('');
        //$('#sl_new_type').val('');
        //$('#sl_new_supplier').val('');
        $('#product_id').val('');
        $('#old_code').val('');
    };
    Products.set_product_detail = function(items){
        $('#txt_product_code').val(items.code);
        $('#old_code').val(items.code);
        $('#txt_product_name').val(items.name);
        $('#txt_product_serial').val(items.product_serial);
        $('#txt_purchase_price').val(items.purchase_price);
        $('#txt_purchase_date').val(toJSDate(items.purchase_date));
        $('#sl_new_brand').val(items.brand_id);
        $('#sl_new_model').val(items.model_id);
        $('#sl_owners').val(items.owner_id);
        $('#sl_new_type').val(items.type_id);
        $('#sl_new_supplier').val(items.supplier_id);
        $('#product_id').val(items.id);
    };
    Products.get_detail = function(id, cb){
        var url = '/products/detail',
            params = { id: id };
        App.ajax(url, params, function(err, data){
            if(err){
                cb(err);
            }else{
                cb(null, data);
            }
        });
    };

    Products.remove = function(id, cb){
        var url = '/products/remove',
            params = { id: id };
        App.ajax(url, params, function(err, data){
            if(err){
                cb(err);
            }else{
                cb(null);
            }
        });
    };

    Products.search = function(query, cb){


        var url = '/products/search',
            params = {
                query: query
            };

        App.ajax(url, params, function(err, data){
            if(err){
                cb(err);
            }else{
                cb(null, data);
            }
        });
    };
    
    Products.search_list = function(query, start, stop, cb){


        var url = '/products/search_list',
            params = {
                query: query,
                start: start,
                stop: stop
            };

        App.ajax(url, params, function(err, data){
            if(err){
                cb(err);
            }else{
                cb(null, data);
            }
        });
    };
    
    
//

    Products.service_history = function(id, cb){


        var url = '/services/search_service_by_code_history',
            params = {
                id: id
            };

        App.ajax(url, params, function(err, data){
            if(err){
                cb(err);
            }else{
                cb(null, data);
            }
        });
    };
    
    Products.filter = function(type_id, owner_id, start, limit, cb){
        var url = '/products/search_filter',
            params = {
                type_id: type_id,
                owner_id: owner_id,
                start: start,
                limit: limit
            };
        App.ajax(url, params, function(err, data){
            if(err){
                cb(err);
            }else{
                cb(null, data);
            }
        });
    };
    Products.filter_total = function(type_id, owner_id, cb){
        var url = '/products/search_filter_total',
            params = {
                type_id: type_id,
                owner_id: owner_id
            };
        App.ajax(url, params, function(err, data){
            if(err){
                cb(err);
            }else{
                cb(null, data);
            }
        });
    }; 
    Products.get_list = function(start, stop, cb){
        var url = '/products/get_list',
            params = {
                start: start,
                stop: stop
            };

        App.ajax(url, params, function(err, data){
            err ? cb(err) : cb(null, data);
        });
    };
    Products.get_list_total = function(cb){
        var url = '/products/get_list_total',
            params = {

            };

        App.ajax(url, params, function(err, data){
            err ? cb(err) : cb(null, data);
        });
    };
    
    
    Products.search_total = function(query, cb){
        var url = '/products/search_total',
            params = {
				query: query
            };

        App.ajax(url, params, function(err, data){
            err ? cb(err) : cb(null, data);
        });
    };
    
    Products.set_list = function(data){
        $('#table_product_list tbody').empty();
        _.each(data.rows, function(v){
            var brand_name = v.brand_name == null ? '-' : v.brand_name;

            $('#table_product_list tbody').append(
                '<tr>' +
                    '<td>'+ v.code +'</td>' +
                    '<td>'+ v.product_name +'</td>' +
                    '<td>'+ brand_name +'</td>' +
                    '<td>'+ v.owner_name +'</td>' +
                    '<td>'+ toThaiDate(v.purchase_date) +'</td>' +
                    '<td>'+ numeral(v.purchase_price).format('0,0') +'</td>' +
                    '<td>' +
                    '<div class="btn-group">' +
                    '<a href="javascript:void(0);" data-name="edit_product" ' +
                    'class="btn" data-id="'+ v.id +'" title="แก้ไข"> ' +
                    '<i class="icon-edit"></i></a> ' +
                    '<a href="javascript:void(0);" data-name="remove_product" ' +
                    'class="btn btn-danger" data-id="'+ v.id +'" title="ลบ"> ' +
                    '<i class="icon-trash icon-white"></i></a> ' +
                    '<a href="javascript:void(0);" data-name="service_history" ' +
                    'class="btn btn-success" data-id="'+ v.id +'" title="ประวัติการซ่อมบำรุง"> ' +
                    '<i class="icon-info-sign icon-white"></i></a> ' +
                    '</div>' +
                    '</td>' +
                '</tr>'
            );
        });
    };
    Products.do_filter = function(type_id, owner_id){
		Products.filter_total(type_id, owner_id, function(err, data){
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
	
	                    Products.filter(type_id, owner_id, this.slice[0], this.slice[1], function(err, data){
	                        if(err){
	                            App.alert(err);
	                            $('#table_product_list tbody').empty();
	                        }else{
	                            Products.set_list(data);
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
    Products.do_get_list = function(){
		Products.get_list_total(function(err, data){
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
	
	                    Products.get_list(this.slice[0], this.slice[1], function(err, data){
	                        if(err){
	                            App.alert(err);
	                            $('#table_product_list tbody').empty();
	                        }else{
	                            Products.set_list(data);
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
	
    Products.do_search = function(query){
		Products.search_total(query, function(err, data){
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
	
	                    Products.search_list(query, this.slice[0], this.slice[1], function(err, data){
	                        if(err){
	                            App.alert(err);
	                            $('#table_product_list tbody').empty();
	                        }else{
	                            Products.set_list(data);
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
	
	
    $('#btn_search_product').click(function(){
        var query = $('#txt_query_product').val();

        $('#table_product_list tbody').empty();

        if(!query){
            App.alert('กรุณากรอกคำที่ต้องการค้นหา');
        }else{
           Products.do_search(query);
        }
    });

    $('#btn_do_filter').click(function(){
        var owner_id = $('#sl_owner').val(),
            type_id = $('#sl_type').val();

        Products.do_filter(type_id, owner_id);
    });

    //register new product
    $('#btn_do_register').click(function(){
        var params = {};

        params.id = $('#product_id').val();
        params.code = $('#txt_product_code').val();
        params.old_code = $('#old_code').val();
        params.name = $('#txt_product_name').val();
        params.product_serial = $('#txt_product_serial').val();
        params.purchase_price = $('#txt_purchase_price').val();
        params.purchase_date = toMySQLDate($('#txt_purchase_date').val());
        params.brand_id = $('#sl_new_brand').val();
        params.model_id = $('#sl_new_model').val();
        params.owner_id = $('#sl_owners').val();
        params.type_id = $('#sl_new_type').val();
        params.supplier_id = $('#sl_new_supplier').val();

        if(!params.code){
            App.alert('กรุณาระบุเลขที่ครุภัณฑ์');
        }else if(!params.name){
            App.alert('กรุณาระบุชื่อ ครุภัณฑ์');
        }else{
            //update product
            if(params.id){
                var url = '/products/update';

                App.ajax(url, params, function(err, data){
                    if(err){
                        App.alert(err);
                    }else{
                        App.alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');
                        //clear form
                        Products.clear_register_form();
                        $('#tab_main').tab('show');
                    }
                });
            }else{//new product
                var url = '/products/save';
                App.ajax(url, params, function(err, data){
                    if(err){
                        App.alert(err);
                    }else{
                        App.alert('บันทึกข้อมูลเสร็จเรียบร้อยแล้ว');
                        //clear form
                        Products.clear_register_form();
                        $('#tab_main').tab('show');
                    }
                });

            }

        }
    });

    //click for edit product
    $('a[data-name="edit_product"]').live('click', function(){
        var id = $(this).attr('data-id');
        //get product detail
        Products.get_detail(id, function(err, data){
            if(err){
                App.alert(err);
            }else{
                Products.set_product_detail(data.rows);
                $('#tab_new_edit_product').tab('show');
            }
        });
    });

    $('#tab_new_edit_product').click(function(){
        Products.clear_register_form();
    });
    //remove product
    $('a[data-name="remove_product"]').live('click', function(){
        var id = $(this).attr('data-id');

        //a.div.td.tr
        var t = $(this).parent().parent().parent();

        if(confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?')){
            Products.remove(id, function(err){
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
    
    //get service history
    $('a[data-name="service_history"]').live('click', function(){
    	var id = $(this).attr('data-id');
    	Products.service_history(id, function(err, data){
    		/*
    			    $obj->service_code = $r->service_code;
	                $obj->date_serv = to_thai_date($r->date_serv);
	                $obj->tech_name = empty($r->tech_name) ? '-' : $r->tech_name;
	                $obj->cause = $r->cause;
	                $obj->service_status = $r->service_status;
	                $obj->status = get_status_name($r->service_status);
	        */ 
	        
	        if(err){
	        	App.alert(err);
	        }else{
	        	$('#tbl_service_history > tbody').empty();
	        	if(_.size(data.rows)){
	        		_.each(data.rows, function(v){
		        		$('#tbl_service_history > tbody').append(
		        			'<tr>' +
		        			'<td>' + v.date_serv + '</td>' +
		        			'<td>' + v.service_code + '</td>' +
		        			'<td>' + v.cause + '</td>' +
		        			'<td>' + v.tech_name + '</td>' +
		        			'<td>' + v.status + '</td>' +
		        			'</tr>'
		        		);	
		        	});
	        	}else{
	        		$('#tbl_service_history > tbody').append(
		        			'<tr>' +
		        			'<td colspan="5">ไม่พบรายการ</td>' +
		        			'</tr>'
		        		);	
	        	}
	        	
	        	Products.show_history();
	        }       
    	});
    });
    
    $('#btn_get_all').click(function(){
    	Products.do_get_list();
    });
    
    Products.do_get_list();
});