$(function(){
	var sends = {};

	sends.modal = {
		show_new: function(){
            $('#mdl_new').modal({backdrop: 'static'}).css({
                width: 780,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
       },

       hide_new: function(){
       		$('#mdl_new').modal('hide');
       },

        show_remove: function(){
            $('#mdl_regemove_get').modal({backdrop: 'static'}).css({
                width: 780,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
       },

       hide_remove: function(){
       		$('#mdl_regemove_get').modal('hide');
       },

       show_update: function(){
            $('#mdl_update').modal({backdrop: 'static'}).css({
                width: 780,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
       },

       hide_update: function(){
       		$('#mdl_update').modal('hide');
       },

        show_get: function(){
            $('#mdl_get').modal({backdrop: 'static'}).css({
                width: 780,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
       },

       hide_get: function(){
       		$('#mdl_get').modal('hide');
       },


       show_search_service: function(){
            $('#mdl_search_service').modal({backdrop: 'static'}).css({
                width: 780,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
       },

       hide_search_service: function(){
       		$('#mdl_search_service').modal('hide');
       },

       show_search_company: function(){
            $('#mdl_search_company').modal({backdrop: 'static'}).css({
                width: 780,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
       },

       hide_search_company: function(){
       		$('#mdl_search_company').modal('hide');
       }
	};

	sends.ajax = {
		search_service: function(query, cb){
            var url = '/sends/search_service',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
       },
       search: function(query, start, stop, cb){
            var url = '/sends/search',
                params = {
                    query: query,
                    start: start,
                    stop: stop
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
       },
       search_total: function(query, cb){
            var url = '/sends/search_total',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
       },
       get_list_status_total: function(status, cb){
            var url = '/sends/get_list_status_total',
                params = {
                    status: status
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
       },
       get_list_status: function(status, start, stop, cb){
            var url = '/sends/get_list_status',
                params = {
                    status: status,
                    start: start,
                    stop: stop
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
       },
       save: function(data, cb){
       		var url = '/sends/save',
       			params = {
       				data: data
       			};

       			App.ajax(url, params, function(err, data){
	                err ? cb(err) : cb(null, data);
	            });
       },
       update: function(data, cb){
       		var url = '/sends/update',
       			params = {
       				data: data
       			};

       			App.ajax(url, params, function(err, data){
	                err ? cb(err) : cb(null, data);
	            });
       },
       save_get: function(data, cb){
       		var url = '/sends/save_get',
       			params = {
       				data: data
       			};

       			App.ajax(url, params, function(err, data){
	                err ? cb(err) : cb(null, data);
	            });
       },
       remove_get: function(data, cb){
       		var url = '/sends/remove_get',
       			params = {
       				data: data
       			};

       			App.ajax(url, params, function(err, data){
	                err ? cb(err) : cb(null, data);
	            });
       },
       remove: function(id, sv, cb){
       		var url = '/sends/remove',
       			params = {
       				id: id,
       				sv: sv
       			};

       			App.ajax(url, params, function(err, data){
	                err ? cb(err) : cb(null, data);
	            });
       },
       search_company: function(query, cb){
            var url = '/sends/search_company',
                params = {
                    query: query
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }
	};

	sends.clear_new = function(){
		$('#txt_send_date').val('');
		$('#txt_new_service_code').val('');
		$('#txt_new_service_company_name').val('');
		$('#txt_new_service_company_id').val('');
		$('#txt_new_send_comment').val('');
	}


	//get list status
	sends.set_list = function(err, data){
		$('#tbl_list > tbody').empty();
		if(err){
			App.alert(err);
			$('#tbl_list > tbody').append('<tr><td colspan="9">ไม่พบรายการ</td></tr>');
		}else{
			if(_.size(data.rows)){
				_.each(data.rows, function(v){
					var status = v.send_status == '1' ? '<i class="icon-ok"></i>' : '<i class="icon-minus"></i>';

					$('#tbl_list > tbody').append(
						'<tr>' +
						'<td>'+ toThaiDate(v.send_date) +'</td>' +
						'<td>'+ v.send_code +'</td>' +
						'<td>'+ v.service_code +'</td>' +
						'<td>'+ clear_null(v.product_code) +'</td>' +
						'<td>'+ clear_null(v.product_name) +'</td>' +
						'<td>'+ clear_null(v.company_name) +'</td>' +
						'<td>'+ clear_null(v.tech_name) +'</td>' +
						'<td>'+ status +'</td>' +
						'<td>'+
                            '<div class="btn-group dropup"> ' +
                            '<a href="javascript:void(0);" class="btn btn primary"><i class="icon-th-list"></i></a>' +
                            '<a class="btn btn primary dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"> ' +
                            '<span class="caret"></span> ' +
                            '</a>' +
                            '<ul class="dropdown-menu pull-right">' +
                            '<li><a href="javascript:void(0);" data-name="btn_edit" data-id="'+ v.id +'" ' +
                            'data-send_code="' + v.send_code + '" data-service_code="'+ v.service_code +'" ' +
                            'data-send_date="'+ v.send_date +'" data-company_id="'+ v.company_id +'" data-company_name="'+ v.company_name +'" ' +
                            'data-comment="'+ v.comment +'" data-product_code="'+ v.product_code +'" data-tech_name="'+v.tech_name+'"><i class="icon-edit"></i> แก้ไขข้อมูล</a></li>' +
                            '<li><a href="javascript:void(0);" data-name="btn_get" data-send_code="'+ v.send_code +'" ' +
                            'data-id="'+ v.id +'" data-sv="'+ v.service_code +'" data-get_comment="'+ v.get_comment+'" data-get_date="'+ v.get_date+'"><i class="icon-share"></i> รับคืน</a></li>' +
                            '<li><a href="javascript:void(0);" data-name="btn_remove_get" data-id="'+ v.id +'" data-send_code="'+ v.send_code +'" ' +
                            'data-remove_comment="'+v.remove_comment+'" data-sv="'+ v.service_code +'"><i class="icon-share"></i> ยกเลิกรับคืน</a></li>' +
                            '<li class="divider"></li>' +
                            '<li><a href="javascript:void(0);" data-name="btn_remove" data-id="'+ v.id +'" data-sv="'+ v.service_code +'"><i class="icon-trash"></i> ลบรายการ </a></li>' +
                            '</ul></div>' +
                            '</td>' +
						'</tr>'
					);
				});
			}else{
				$('#tbl_list > tbody').append('<tr><td colspan="9">ไม่พบรายการ</td></tr>');
			}
		}

	};

	$('#mdl_search_service').on('hidden', function(){
		sends.modal.show_new();
	});


	$('#btn_new').click(function(){
		sends.clear_new();
		sends.modal.show_new();
	});

	$('#btn_new_search_service').click(function(){
		sends.modal.hide_new();
		sends.modal.show_search_service();
	});

	//search service
	$('#btn_search_service').click(function(){
		var query = $('#txt_search_service_query').val();

		if(!query){
			App.alert('กรุณาระบุเลขที่ใบรับซ่อม');
		}else{
			sends.ajax.search_service(query, function(err, data){

				$('#tbl_service_result > tbody').empty();

				if(err){
					App.alert(err);
					$('#tbl_service_result > tbody').append('<tr><td colspan="5">ไม่พบรายการ</td></tr>');
				}else{
					if(_.size(data.rows)){
						_.each(data.rows, function(v){
							$('#tbl_service_result > tbody').append(
								'<tr>' +
								'<td>'+ toThaiDate(v.date_serv) +'</td>' +
								'<td>'+ v.product_code +'</td>' +
								'<td>'+ v.product_name +'</td>' +
								'<td>'+ v.owner_name +'</td>' +
								'<td><a href="javascript:void(0);" class="btn" data-name="btn_selected_service" data-sv="'+ v.service_code +'" title="เลือกรายการ"><i class="icon-share"></i></a></td>' +
								'</tr>'
							);
						});
					}else{
						$('#tbl_service_result > tbody').append('<tr><td colspan="5">ไม่พบรายการ</td></tr>');
					}
				}
			});
		}
	});

	//selected service
	$('a[data-name="btn_selected_service"]').live('click', function(){
		var sv = $(this).attr('data-sv');
		$('#txt_new_service_code').val(sv);

		sends.modal.hide_search_service();
	});

	$('#btn_search_company').click(function(){
		sends.modal.hide_new();
		sends.modal.show_search_company();
	});


		//search company
	$('#btn_do_search_company').click(function(){
		var query = $('#txt_search_company_query').val();

		if(!query){
			App.alert('กรุณาระบุคำที่ต้องการค้นหา');
		}else{
			sends.ajax.search_company(query, function(err, data){

				$('#tbl_company_result > tbody').empty();

				if(err){
					App.alert(err);
					$('#tbl_company_result > tbody').append('<tr><td colspan="5">ไม่พบรายการ</td></tr>');
				}else{
					if(_.size(data.rows)){
						_.each(data.rows, function(v){
							$('#tbl_company_result > tbody').append(
								'<tr>' +
								'<td>'+ v.name +'</td>' +
								'<td>' +
								'<a href="javascript:void(0);" class="btn" data-name="btn_selected_company" '+
								'data-code="'+ v.id +'" data-vname="'+v.name+'" title="เลือกรายการ"><i class="icon-share"></i></a></td>' +
								'</tr>'
							);
						});
					}else{
						$('#tbl_company_result > tbody').append('<tr><td colspan="5">ไม่พบรายการ</td></tr>');
					}
				}
			});
		}
	});

	//selected company
	$('a[data-name="btn_selected_company"]').live('click', function(){
		var code = $(this).attr('data-code'),
			name = $(this).attr('data-vname');

		$('#txt_new_service_company_id').val(code);
		$('#txt_new_service_company_name').val(name);

		sends.modal.hide_search_company();
		sends.modal.show_new();
	});

	$('#btn_save').click(function(){
		var items = {};

		items.change_status = $('#chk_new_send_change_status').attr('checked') ? '1' : '0',
		items.company_id = $('#txt_new_service_company_id').val(),
		items.service_code = $('#txt_new_service_code').val(),
		items.send_date = $('#txt_send_date').val(),
		items.comment = $('#txt_new_send_comment').val();

			if(!items.send_date){
				App.alert('กรุณาระบุวันที่ส่งซ่อม');
			}else if(!items.service_code){
				App.alert('กรุณาระบุเลขที่ใบรับซ่อม');
			}else if(!items.company_id){
				App.alert('กรุณาระบุร้านค้า/บริษัทที่ส่งซ่อม');
			}else{
				//do save
				sends.ajax.save(items, function(err){
					if(err){
						App.alert(err);
					}else{
						App.alert('บันทึกรายการเสร็จเรียบร้อยแล้ว');
						//get list
						sends.modal.hide_new();
					}
				});
			}

	});

	sends.do_search = function(query){
		sends.ajax.search_total(query, function(err, data){
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
	                        sends.ajax.search(query, this.slice[0], this.slice[1], function(err, data){
	                            sends.set_list(err, data);
	                            //console.log(data);
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
	sends.get_list_status = function(){
		var status = $('#txt_status').val();
		sends.ajax.get_list_status_total(status, function(err, data){
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
	                        sends.ajax.get_list_status(status, this.slice[0], this.slice[1], function(err, data){
	                            sends.set_list(err, data);
	                            //console.log(data);
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

	$('a[data-name="btn_set_status"]').click(function(){
		var status_id = $(this).attr('data-status');
		$('#txt_status').val(status_id);

		sends.get_list_status();
	});

	//search
	$('#btn_search').click(function(){
		var query = $('#txt_query').val();
		if(!query){
			App.alert('กรุณาระบุคำที่ต้องการค้นหา');
		}else{
			//do search
			sends.do_search(query);
		}
	});

	/*
	 * '<li><a href="javascript:void(0);" data-name="btn_edit" ' +
                            'data-send_code="' + v.send_code + '" data-service_code="'+ v.service_code +'" ' +
                            'data-send_date="'+v.send_date+'" data-company_id="'+ v.company_id +'" data-company_name="'+ v.company_name +'" ' +
                            'data-comment="'+ v.comment +'" data-product_code="'+ v.product_code +'"><i class="icon-edit"></i> แก้ไขข้อมูล</a></li>'
	 */
	$('a[data-name="btn_edit"]').live('click', function(){
		var items = {};
		items.id = $(this).attr('data-id');
		items.send_code = $(this).attr('data-send_code');
		items.service_code = $(this).attr('data-service_code');
		items.send_date = $(this).attr('data-send_date');
		items.company_id = $(this).attr('data-company_id');
		items.company_name = $(this).attr('data-company_name');
		items.comment = $(this).attr('data-comment') == 'null' ? '-' : $(this).attr('data-comment');
		items.product_code = $(this).attr('data-product_code');
		items.tech_name = $(this).attr('data-tech_name');

		//set data

		$('#txt_edit_send_date').val(toJSDate(items.send_date));
		$('#txt_edit_service_code').val(items.service_code);
		$('#txt_edit_service_company_id').val(items.company_id);
		$('#txt_edit_service_company_name').val(items.company_name);
		$('#txt_edit_send_comment').val(items.comment);
		$('#txt_update_id').val(items.id);
		$('#txt_edit_send_code').val(items.send_code);
		$('#txt_edit_username').val(items.tech_name);

		sends.modal.show_update();


	});


	$('#btn_edit_save').click(function(){
		var items = {};

		items.send_date = $('#txt_edit_send_date').val();
		items.service_code = $('#txt_edit_service_code').val();
		items.company_id = $('#txt_edit_service_company_id').val();
		//$('#txt_edit_service_company_name').val();
		items.comment = $('#txt_edit_send_comment').val();
		items.id = $('#txt_update_id').val();
		//$('#txt_edit_send_code').val();
		//$('#txt_edit_username').val();

		if(!items.send_date){
			App.alert('กรุณาระบุวันที่ส่งซ่อม');
		}else if(!items.company_id){
			App.alert('กรุณาระบุร้านค้า/บริษัทที่ส่งซ่อม');
		}else if(!items.id){
			App.alert('กรุณาเลือกรายการที่ต้องการแก้ไข (ไม่พบ ID)');
		}else{
			//do save
			sends.ajax.update(items, function(err){
				if(err){
					App.alert(err);
				}else{
					App.alert('บันทึกข้อมูลเสร็จเรียบร้อย');
					sends.modal.hide_update();
					sends.get_list_status();
				}
			})
		}
	});

	//get return
	$('a[data-name="btn_get"]').live('click', function(){
		var id = $(this).attr('data-id'),
			sv = $(this).attr('data-sv'),
			send_code = $(this).attr('data-send_code'),
            get_comment = $(this).attr('data-get_comment'),
            get_date = $(this).attr('data-get_date');

            $('#txt_get_date').val(toJSDate(get_date));
			$('#txt_get_send_code').val(send_code);
			$('#txt_get_service_code').val(sv);
			$('#txt_send_id').val(id);
            $('#txt_get_comment').val(get_comment);

			sends.modal.show_get();
	});

	$('#btn_get_save').click(function(){
		var items = {
			id: $('#txt_send_id').val(),
			get_date: $('#txt_get_date').val(),
			comment: $('#txt_get_comment').val(),
			sv: $('#txt_get_service_code').val()
		};

		if(!items.id){
			App.alert('กรุณาระบุรหัสส่งซ่อม');
		}else if(!items.get_date){
			App.alert('กรุณาระบุวันที่รับคืน');
		}else{
			sends.ajax.save_get(items, function(err){
				if(err){
					App.alert(err);
				}else{
					App.alert('บันทึกข้อมูลการรับเสร็จเรียบร้อยแล้ว');
					sends.modal.hide_get();
					sends.get_list_status();
				}
			});
		}
	});

    //remove get
    $('a[data-name="btn_remove_get"]').live('click', function(){
        var id = $(this).attr('data-id'),
            send_code = $(this).attr('data-send_code'),
            sv = $(this).attr('data-sv'),
            remove_comment = $(this).attr('data-remove_comment') == 'null' ? '-' : $(this).attr('data-remove_comment');


        $('#txt_remove_send_code').val(send_code);
        $('#txt_remove_service_code').val(sv);
        $('#txt_remove_send_id').val(id);
        $('#txt_remove_comment').val(remove_comment);

        sends.modal.show_remove();

    });

    //do remove
    $('#btn_do_remove_get').click(function(){
    	var items = {};
    	items.id = $('#txt_remove_send_id').val(),
    	items.comment = $('#txt_remove_comment').val();
    	items.sv = $('#txt_remove_service_code').val();

    	if(!items.id){
    		App.alert('กรุณาระบุข้อมูลรับซ่อม');
    	}else{
    		sends.ajax.remove_get(items, function(err){
    			App.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
    			sends.modal.hide_remove();

    			sends.get_list_status();
    		});
    	}
    });


	//data-name="btn_remove" data-id="'+ v.id +'"
	$('a[data-name="btn_remove"]').live('click', function(){

		if(confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?')){
			var id = $(this).attr('data-id'),
				sv = $(this).attr('data-sv');

			if(!id){
				App.alert('กรุณาระบุ ข้อมูลที่ต้องการลบ (ไม่พบ ID)');
			}else{
				//do remove
				sends.ajax.remove(id, sv, function(err){
					if(err){
						App.alert(err);
					}else{
						App.alert('ลบรายการเสร็จเรียบร้อยแล้ว');
						sends.get_list_status();
					}
				});
			}
		}

	});


	sends.get_list_status();

});
