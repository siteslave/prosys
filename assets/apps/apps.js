var addCommas = function (str){
    var my_str = numeral(str).format('0,0.00');

    return my_str;
};

var clear_null = function(s){
    return s == null ? '<i class="icon-minus"></i>' : s;
};
// convert mysql date to thai date
var toThaiDate = function( d ){
    if(!d)
    {
        return '-';
    }
    else
    {
        var _d = d.split('-'),
            _y = parseInt(_d[0]) + 543,
            _m = _d[1],
            _d = _d[2],

            _date = _d + '/' + _m + '/' + _y ;

        return _date;
    }
}
var toJSDate = function( d ){
    if(!d || d.length < 5)
    {
        return '';
    }
    else
    {
        var _d = d.split('-'),
            _y = _d[0],
            _m = _d[1],
            _d = _d[2],

            _date = _d + '/' + _m + '/' + _y ;

        return _date;
    }
};
var toMySQLDate = function(d){
    if(!d){
        return null;
    }else{
        var _d = d.split('/'),
            _y = _d[2],
            _m = _d[1],
            _d = _d[0],

            _date = _y + '-' + _m + '-' + _d ;

        return _date;
    }
};

var set_first_selected = function(obj){
    $(obj).removeAttr('selected').find('option:first').attr('selected', 'selected');
};


var App = {};

/**
 * Ajax function
 *
 * @param url       URL without index.php
 * @param params    Array of parameters
 * @param cb        Callback function
 */
App.ajax = function(url, params, cb){

    App.loading();

    try{
        $.ajax({
            url: base_url + 'index.php' + url,
            dataType: 'json',
            type: 'POST',
            data: params,

            success: function(data)
            {
                if(data.success)
                {
                    data ? cb(null, data) : cb('ไม่พบรายการ');
                    App.unloading();
                }
                else
                {
                    cb(data.msg);
                    App.unloading();
                }
            },

            error: function(xhr, status, errorThrown)
            {
                cb('เกิดข้อผิดพลาด: ' + xhr.status + ': ' + xhr.statusText);

                App.unloading();

            }

        });

    }catch(ex){
        cb(ex);
        App.unloading();
    }

};

App.alert = function(msg, title){
    title = 'Message';

    $("#freeow").freeow(title, msg, {
        classes: ["gray"],
        autoHide: true,
        prepend: true
    });
};

App.loading = function(){
    $.blockUI({
        css: {
        border: 'none',
        padding: '15px',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: 1,
        color: '#fff'
    },
    message: '<h4><img src="' + base_url + 'assets/apps/img/ajax-loader.gif"> Loading...</h4>'

    });
};

App.unloading = function(){
    $.unblockUI();
};

App.goto_url = function(url){
    location.href = base_url + 'index.php' + url;
};

App.record_perpage = 15;

$(function(){
    // Setting datepicker
    $('div#datepicker').datepicker({
        language: 'th'
        , format: 'dd/mm/yyyy'
    });

    $('input[data-type="number"]').numeric();
    $('input[disabled]').css('background-color', 'white');
    $('textarea[disabled]').css('background-color', 'white');
});
