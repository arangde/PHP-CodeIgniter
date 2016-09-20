
jQuery(document).ready(function() {

	var form = $('#frm_corporation_info');
    var error = $('.alert-error', form);
    var success = $('.alert-success', form);
    
    $("#btn_change_request").on('click', function(){
    	location.href = base_url + "acorporation/update";
    });
});
