$(function(){
	var rptidx = {};
	
	rptidx.ajax = {
		do_search: function(data, cb){
            var url = '/reports/idx_get_total',
                params = {
                    data: data
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },

        get_status_total_by_date: function(s, e, cb){
            var url = '/reports/get_status_total_by_date',
                params = {
                    s: s,
                    e: e
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },

        get_service_total_by_date: function(s, e, cb){
            var url = '/reports/get_service_total_by_date',
                params = {
                    s: s,
                    e: e
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }
	};
	
	$('#btn_idx_rpt_do_get').click(function(){
		var data = {};
		data.s = $('#txt_idx_rpt_date_s').val(),
		data.e = $('#txt_idx_rpt_date_e').val(),
		data.t = $('#sl_idx_rpt_type').val();
		data.d = $('#sl_idx_rpt_discharge').val();
		data.tos = $('#sl_idx_rpt_tos').val();
		
		if(!data.s)
		{
			App.alert('กรุณาระบุวันที่เริ่มต้น');
		}
		else if(!data.e)
		{
			App.alert('กรุณาระบุวันที่สิ้นสุด');
		}
		else
		{
			//do search
			
			rptidx.ajax.do_search(data, function(err, data){
				
				$('#tbl_idx_rpt_main_list > tbody').empty();
				
				if(err)
				{
					App.alert(err);
					$('#tbl_idx_rpt_main_list > tbody').append('<tr><td colspan="8">ไม่พบรายการ</td></tr>');
				}
				else 
				{
					var i = 0;
					_.each(data.rows, function(v){
						i++;
						$('#tbl_idx_rpt_main_list > tbody').append(
							'<tr>' +
							'<td>'+i+'</td>' +
							'<td>'+toThaiDate(v.date_serv)+'</td>' +
							'<td>'+App.clear_null(v.time_serv)+'</td>' +
							'<td>'+App.clear_null(v.pri_name)+'</td>' +
							'<td>'+App.clear_null(v.product_code)+'</td>' +
							'<td>'+App.clear_null(v.product_name)+'</td>' +
							'<td>'+App.clear_null(v.owner_name)+'</td>' +
							'<td>'+App.clear_null(v.cause)+'</td>' +
							'<td>'+App.clear_null(v.type_service_name)+'</td>' +
							'<td>'+toThaiDate(v.discharge_date)+'</td>' +
							'<td>'+App.clear_null(v.count_date)+'</td>' +
							'<tr>'
						);
					});
				}
			});
			
		}
	});



    rptidx.get_service_total_by_date = function(s, e){
        rptidx.ajax.get_service_total_by_date(s, e, function(err, data){

            //report.render_chart_tech(data);

            $('#tbl_tech_service_count > tbody').empty();
            if(err){
                $('#tbl_tech_service_count > tbody').append(
                    '<tr><td colspan="4">ไม่พบข้อมูล</td></tr>'
                );
            }else{
                _.each(data.rows, function(v){
                    var total = v.total_m + v.total_o + v.total_more;

                    $('#tbl_tech_service_count > tbody').append(
                        '<tr>' +
                            '<td>'+ v.fullname +' [ '+ v.username +' ] </td>' +
                            '<td>'+ v.total_m +'</td>' +
                            '<td>'+ v.total_o +'</td>' +
                            '<td>'+ v.total_more +'</td>' +
                            '<td>'+ total +'</td>' +
                            '</tr>'
                    );
                });
            }
        });
    };

    rptidx.get_status_total_by_date = function(s, e){
        rptidx.ajax.get_status_total_by_date(s, e, function(err, data){
            //chart
            $('#tbl_status_count > tbody').empty();
            if(err){
                $('#tbl_status_count > tbody').append(
                    '<tr><td colspan="4">ไม่พบข้อมูล</td></tr>'
                );
            }else{
                _.each(data.rows, function(v){
                    $('#tbl_status_count > tbody').append(
                        '<tr><td>'+ v.name +'</td><td>'+ v.mtotal +'</td><td>'+ v.ototal +'</td><td>'+ (v.mtotal + v.ototal) +'</td></tr>'
                    );
                });
            }
        });
    };


    $('#btn_rpt_tech_get').click(function(){
        var  s = $('#txt_rpt_tech_sdate').val(),
            e = $('#txt_rpt_tech_edate').val();

        if(!s || !e){
            App.alert('กรุณาระบุวันที่ เพื่อแสดงข้อมูล');
        }else{
            rptidx.get_service_total_by_date(s, e);
        }
    });

    $('#btn_rpt_status_get').click(function(){
        var  s = $('#txt_rpt_status_sdate').val(),
            e = $('#txt_rpt_status_edate').val();

        if(!s || !e){
            App.alert('กรุณาระบุวันที่ เพื่อแสดงข้อมูล');
        }else{
            rptidx.get_status_total_by_date(s, e);
        }
    });


    //RM
	
var rm = {};
	
	rm.ajax = {
		get_by_service_type: function(user_id, s, e, cb){
            var url = '/reports/get_service_type_by_technician',
                params = {
            		user_id: user_id,
            		s: s,
            		e: e
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_by_service_type_other: function(user_id, s, e, cb){
            var url = '/reports/get_service_type_by_technician_other',
                params = {
            		user_id: user_id,
            		s: s,
            		e: e
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_by_place: function(s, e, cb){
            var url = '/reports/get_send_place',
                params = {
            		s: s,
            		e: e
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_by_tos: function(s, e, cb){
            var url = '/reports/get_tos',
                params = {
            		s: s,
            		e: e
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_by_tos_status: function(id, s, e, cb){
            var url = '/reports/get_tos_status',
                params = {
            		id: id,
            		s: s,
            		e: e
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },
        get_by_tos_svt: function(id, s, e, cb){
            var url = '/reports/get_tos_svt',
                params = {
            		id: id,
            		s: s,
            		e: e
                };

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        }
	};
	
	$('#btn_rpt_do_by_service_type').click(function(){
		var user_id = $('#sl_rpt_by_service_type_user').val(),
			s = $('#txt_rpt_by_service_type_date_s').val(),
			e = $('#txt_rpt_by_service_type_date_e').val();
		
		if(!user_id){
			App.alert('กรุณาระบุชื่อผู้ปฏิบัติงาน');
		}else if(!s){
			App.alert('กรุณาระบุวันที่เริ่มต้น');
		}else if(!e){
			App.alert('กรุณาระบุวันที่สิ้นสุด');
		}else{
			rm.ajax.get_by_service_type(user_id, s, e, function(err, data){
				
				$('#tbl_rpt_by_service_type > tbody').empty();
				
				if(err){
					App.alert(err);
					$('#tbl_rpt_by_service_type > tbody').append(
						'<tr>' +
						'<td colspan="4">ไม่พบรายการ</td>' +
						'</tr>'
						);
				}else{
					_.each(data.rows, function(v){
						var total = v.total_m + v.total_o;
						$('#tbl_rpt_by_service_type > tbody').append(
								'<tr>' +
								'<td>'+ v.type_name +'</td>' +
								'<td>' + addCommasNoDecimal(v.total_m) + '</td>' +
								'<td>' + addCommasNoDecimal(v.total_o) + '</td>' +
								'<td>' + addCommasNoDecimal(total) + '</td>' +
								'</tr>'
								);
					});
				}
			});
		}
	});
	
	$('#btn_rpt_do_by_service_type_other').click(function(){
		var user_id = $('#sl_rpt_by_service_type_user_other').val(),
			s = $('#txt_rpt_by_service_type_date_s_other').val(),
			e = $('#txt_rpt_by_service_type_date_e_other').val();
		
		if(!user_id){
			App.alert('กรุณาระบุชื่อผู้ปฏิบัติงาน');
		}else if(!s){
			App.alert('กรุณาระบุวันที่เริ่มต้น');
		}else if(!e){
			App.alert('กรุณาระบุวันที่สิ้นสุด');
		}else{
			rm.ajax.get_by_service_type_other(user_id, s, e, function(err, data){
				
				$('#tbl_rpt_by_service_type_other > tbody').empty();
				
				if(err){
					App.alert(err);
					$('#tbl_rpt_by_service_type_other > tbody').append(
						'<tr>' +
						'<td colspan="2">ไม่พบรายการ</td>' +
						'</tr>'
						);
				}else{
					_.each(data.rows, function(v){
						$('#tbl_rpt_by_service_type_other > tbody').append(
								'<tr>' +
								'<td>'+ v.type_name +'</td>' +
								'<td>' + addCommasNoDecimal(v.total) + '</td>' +
								'</tr>'
								);
					});
				}
			});
		}
	});
	
	$('a[data-name="btn_rpt_by_place"]').click(function(){
		rm.modal.show_rpt_by_place();
	});
	
	$('#btn_rpt_do_by_place').click(function(){
		var s = $('#txt_rpt_by_place_date_s').val(),
			e = $('#txt_rpt_by_place_date_e').val();
	
		if(!s){
			App.alert('กรุณาระบุวันที่เริ่มต้น');
		}else if(!e){
			App.alert('กรุณาระบุวันที่สิ้นสุด');
		}else{
			rm.ajax.get_by_place(s, e, function(err, data){
				
				$('#tbl_rpt_by_place > tbody').empty();
				
				if(err){
					App.alert(err);
					$('#tbl_rpt_by_place > tbody').append(
						'<tr>' +
						'<td colspan="2">ไม่พบรายการ</td>' +
						'</tr>'
						);
				}else{
					_.each(data.rows, function(v){
						$('#tbl_rpt_by_place > tbody').append(
								'<tr>' +
								'<td>'+ v.place +'</td>' +
								'<td>' + addCommasNoDecimal(v.total) + '</td>' +
								'</tr>'
								);
					});
				}
			});
		}
	});
	
	$('a[data-name="btn_rpt_by_type_of_service"]').click(function(){
		rm.modal.show_rpt_by_type_of_service();
	});
	
	$('#btn_rpt_do_by_tos').click(function()
		{
			var s = $('#txt_rpt_by_tos_date_s').val(),
				e = $('#txt_rpt_by_tos_date_e').val();

			if(!s)
			{
				App.alert('กรุณาระบุวันที่เริ่มต้น');
			}
			else if(!e)
			{
				App.alert('กรุณาระบุวันที่สิ้นสุด');
			}
			else
			{
				rm.ajax.get_by_tos(s, e, function(err, data) {
					
					$('#tbl_rpt_by_tos_sub').fadeOut('slow');
					
					$('#tbl_rpt_by_tos > tbody').empty();
					
					if(err)
					{
						App.alert(err);
						$('#tbl_rpt_by_tos > tbody').append(
							'<tr>' +
							'<td colspan="5">ไม่พบรายการ</td>' +
							'</tr>'
							);
					}
					else
					{
						_.each(data.rows, function(v){
							
							var total = v.total_m + v.total_o;
							
							$('#tbl_rpt_by_tos > tbody').append(
									'<tr>' +
									'<td>'+ v.name +'</td>' +
									'<td>' + addCommasNoDecimal(v.total_m) + '</td>' +
									'<td>' + addCommasNoDecimal(v.total_o) + '</td>' +
									'<td>' + addCommasNoDecimal(total) + '</td>' +
									'<td>' +
									'<a href="javascript:void(0);" class="btn" data-name="btn_tos_get_status" ' +
									'data-id="'+v.id+'" title="แยกตามสถานะ"><i class="icon-th-list"></i></a> ' +
									'<a href="javascript:void(0);" class="btn" data-name="btn_tos_get_svt" ' +
									'data-id="'+v.id+'" title="แยกตามประเภทงาน"><i class="icon-share"></i></a>' +
									'</td>' +
									'</tr>'
									);
						});
					}
				});
			}
	});
	
	$('a[data-name="btn_tos_get_status"]').live('click', function(){
		var id = $(this).attr('data-id'),
			s = $('#txt_rpt_by_tos_date_s').val(),
			e = $('#txt_rpt_by_tos_date_e').val();
		
		$('#tbl_rpt_by_tos_sub').fadeIn('slow');
		rm.ajax.get_by_tos_status(id, s, e, function(err, data) {
			
			$('#tbl_rpt_by_tos_sub > tbody').empty();
			
			if(err)
			{
				App.alert(err);
				$('#tbl_rpt_by_tos_sub > tbody').append(
					'<tr>' +
					'<td colspan="4">ไม่พบรายการ</td>' +
					'</tr>'
					);
			}
			else
			{
				_.each(data.rows, function(v){
					
					var total = v.total_m + v.total_o;
					
					$('#tbl_rpt_by_tos_sub > tbody').append(
							'<tr>' +
							'<td>'+ v.name +'</td>' +
							'<td>' + addCommasNoDecimal(v.total_m) + '</td>' +
							'<td>' + addCommasNoDecimal(v.total_o) + '</td>' +
							'<td>' + addCommasNoDecimal(total) + '</td>' +
							'</tr>'
							);
				});
			}
		});
	});
	
	$('a[data-name="btn_tos_get_svt"]').live('click', function(){
		var id = $(this).attr('data-id'),
			s = $('#txt_rpt_by_tos_date_s').val(),
			e = $('#txt_rpt_by_tos_date_e').val();
		
		$('#tbl_rpt_by_tos_sub').fadeIn('slow');
		rm.ajax.get_by_tos_svt(id, s, e, function(err, data) {
			
			$('#tbl_rpt_by_tos_sub > tbody').empty();
			
			if(err)
			{
				App.alert(err);
				$('#tbl_rpt_by_tos_sub > tbody').append(
					'<tr>' +
					'<td colspan="4">ไม่พบรายการ</td>' +
					'</tr>'
					);
			}
			else
			{
				_.each(data.rows, function(v){
					
					var total = v.total_m + v.total_o;
					
					$('#tbl_rpt_by_tos_sub > tbody').append(
							'<tr>' +
							'<td>'+ v.name +'</td>' +
							'<td>' + addCommasNoDecimal(v.total_m) + '</td>' +
							'<td>' + addCommasNoDecimal(v.total_o) + '</td>' +
							'<td>' + addCommasNoDecimal(total) + '</td>' +
							'</tr>'
							);
				});
			}
		});
	});



});