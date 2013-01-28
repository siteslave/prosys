$(function(){
	
	
    //register new product
    $('#btn_do_register').click(function(){
        var params = {};

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

        if(!params.name){
            App.alert('กรุณาระบุชื่อ ครุภัณฑ์');
        }else{
          
        	var url = '/clients/save_products';
            App.ajax(url, params, function(err, data){
                if(err){
                    App.alert(err);
                }else{
                    App.goto_url('/clients');
                }
            });

        }
    });
    
});