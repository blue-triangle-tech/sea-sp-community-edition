jQuery(document).ready(function(){
    jQuery('[data-toggle="popover"]').popover();
    jQuery('[data-toggle="tooltip"]').tooltip();
});

(function($) {
    $(document).on("change", ".activate-csp-button", function(){
        var BTT_CSP_FREE_CSP_MODE = ($(this).prop("checked")==true)?"false":"true";
        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : adminURL,
            data : {
                action:'Blue_Triangle_Automated_CSP_Free_Csp_Mode',
                BTT_CSP_FREE_CSP_MODE:BTT_CSP_FREE_CSP_MODE,
            },
            success: function(response) {

            }
        });
    });

})( jQuery );