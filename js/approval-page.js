jQuery(document).ready(function(){
    jQuery('[data-toggle="popover"]').popover();
});
(function($) {
    $(document).on("change", ".approve-sub-domain-toggle", function(){
        var BTT_CSP_FREE_DOMAIN = $(this).attr("data-domain");
        var BTT_CSP_FREE_DIRECTIVE = $(this).attr("data-directive");
        var BTT_CSP_FREE_VALUE = ($(this).prop("checked")==true)?"true":"false";
        var BTT_CSP_FREE_IS_SUB = "true";
        sendApprovalData(BTT_CSP_FREE_DOMAIN, BTT_CSP_FREE_DIRECTIVE, BTT_CSP_FREE_VALUE, BTT_CSP_FREE_IS_SUB);
    });

    $(document).on("change", ".approve-domain-toggle", function(){
        var BTT_CSP_FREE_DOMAIN = $(this).attr("data-domain");
        var BTT_CSP_FREE_DIRECTIVE = $(this).attr("data-directive");
        var BTT_CSP_FREE_VALUE = ($(this).prop("checked")==true)?"true":"false";
        var BTT_CSP_FREE_IS_SUB = "false";
        sendApprovalData(BTT_CSP_FREE_DOMAIN, BTT_CSP_FREE_DIRECTIVE, BTT_CSP_FREE_VALUE, BTT_CSP_FREE_IS_SUB);
    });

    function sendApprovalData(BTT_CSP_FREE_DOMAIN, BTT_CSP_FREE_DIRECTIVE, BTT_CSP_FREE_VALUE, BTT_CSP_FREE_IS_SUB){
        jQuery.ajax({
            type : "post",
            dataType : "json",
            url : adminURL,
            data : {
                action:'Blue_Triangle_Automated_CSP_Free_Approve',
                BTT_CSP_FREE_DOMAIN:BTT_CSP_FREE_DOMAIN,
                BTT_CSP_FREE_DIRECTIVE:BTT_CSP_FREE_DIRECTIVE,
                BTT_CSP_FREE_VALUE:BTT_CSP_FREE_VALUE,
                BTT_CSP_FREE_IS_SUB:BTT_CSP_FREE_IS_SUB,
            },
            success: function(response) {

            }
        });
    }

})( jQuery );