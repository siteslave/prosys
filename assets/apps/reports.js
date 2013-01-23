$(function(){
   var report = {};

   report.ajax = {
       get_service_total: function(cb){
            var url = '/reports/get_service_total',
                params = {};

            App.ajax(url, params, function(err, data){
                err ? cb(err) : cb(null, data);
            });
        },

        get_status_total: function(cb){
            var url = '/reports/get_status_total',
                params = {};

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


   report.get_service_total = function(){
       report.ajax.get_service_total(function(err, data){

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


   report.get_service_total_by_date = function(s, e){
       report.ajax.get_service_total_by_date(s, e, function(err, data){

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


   report.get_status_total_by_date = function(s, e){
        report.ajax.get_status_total_by_date(s, e, function(err, data){
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


   report.render_chart_tech = function(data){

      var d = [];
      var i = 0;

      _.each(data.rows, function(v){
        var total = v.total_m + v.total_o;

        d[i] = {
            'x': v.username,
            'y': total
        };

        i++;
       });

      var data_chart = {
          "xScale": "ordinal",
          "yScale": "linear",
          "main": [
            {
              "className": ".pizza",
              "data": d
            }
          ]
        };

        var myChart = new xChart('bar', data_chart, '#div_chart');
   }

   report.get_status_total = function(){
       report.ajax.get_status_total(function(err, data){
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
           report.get_service_total_by_date(s, e);
       }
   });


   $('#btn_rpt_status_get').click(function(){
       var  s = $('#txt_rpt_status_sdate').val(),
            e = $('#txt_rpt_status_edate').val();

       if(!s || !e){
           App.alert('กรุณาระบุวันที่ เพื่อแสดงข้อมูล');
       }else{
           report.get_status_total_by_date(s, e);
       }
   });

   report.get_status_total();

   report.get_service_total();

});
