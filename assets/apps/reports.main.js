$(function(){
	var rm = {};
	
	rm.modal = {
		show_rpt_by_technician_service_type_code: function(){
            $('#mdl_rpt_service_type').modal({backdrop: 'static'}).css({
                width: 880,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },
        show_rpt_by_technician_service_type_other: function(){
            $('#mdl_rpt_service_type_other').modal({backdrop: 'static'}).css({
                width: 880,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        },
        show_rpt_by_place: function(){
            $('#mdl_rpt_by_place').modal({backdrop: 'static'}).css({
                width: 880,
                'margin-left': function () {
                    return -($(this).width() / 2);
                }
            });
        }
	};
	
	rm.ajax = {
		get_by_service_type: function(user_id, s, e, cb){
            var url = '/reports/get_service_type_by_technician_main',
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
        }
	};
	
	$('a[data-name="btn_rpt_technician_by_service_type_main"]').click(function(){
		rm.modal.show_rpt_by_technician_service_type_code();
	});
	
	
	$('a[data-name="btn_rpt_technician_by_service_type_other"]').click(function(){
		rm.modal.show_rpt_by_technician_service_type_other();
	});
	
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
						'<td colspan="2">ไม่พบรายการ</td>' +
						'</tr>'
						);
				}else{
					_.each(data.rows, function(v){
						$('#tbl_rpt_by_service_type > tbody').append(
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
	
});