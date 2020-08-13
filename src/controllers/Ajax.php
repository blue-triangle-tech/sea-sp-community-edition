<?php
add_action("wp_ajax_Blue_Triangle_Automated_CSP_Free_Csp_Mode", "Blue_Triangle_Automated_CSP_Free_Csp_Mode");
function Blue_Triangle_Automated_CSP_Free_Csp_Mode(){
      if ( !wp_verify_nonce( $_REQUEST['nonce'], "Blue_Triangle_Automated_CSP_Free_Approve_Nonce")) {
        exit("No naughty business please");
    }  
    if(!isset($_REQUEST['BTT_CSP_FREE_CSP_MODE'])){
        wp_send_json("no mode sent",400);
        exit;
    }
    $BTT_CSP_FREE_CSP_MODE= $_REQUEST['BTT_CSP_FREE_CSP_MODE'];
    update_option( 'Blue_Triangle_Automated_CSP_Free_Report_Mode', $BTT_CSP_FREE_CSP_MODE);
    Blue_Triangle_Automated_CSP_Free_Build_CSP();
}

add_action("wp_ajax_Blue_Triangle_Automated_CSP_Free_Approve", "Blue_Triangle_Automated_CSP_Free_Approve");
function Blue_Triangle_Automated_CSP_Free_Approve(){
     if ( !wp_verify_nonce( $_REQUEST['nonce'], "Blue_Triangle_Automated_CSP_Free_Approve_Nonce")) {
        exit("No naughty business please");
    }  
    if(!isset($_REQUEST['BTT_CSP_FREE_DOMAIN'])){
        wp_send_json("no domain sent",400);
        exit;
    }
    if(!isset($_REQUEST['BTT_CSP_FREE_DIRECTIVE'])){
        wp_send_json("no directive sent",400);
        exit;
    }
    if(!isset($_REQUEST['BTT_CSP_FREE_VALUE'])){
        wp_send_json("no subdomain sent",400);
        exit;
    }
    if(!isset($_REQUEST['BTT_CSP_FREE_IS_SUB'])){
        wp_send_json("no isSubdomain sent",400);
        exit;
    }
    $Blue_Triangle_Automated_CSP_Free_Errors = get_site_option('Blue_Triangle_Automated_CSP_Free_Errors');
    $Blue_Triangle_Automated_CSP_Free_Directives = get_site_option('Blue_Triangle_Automated_CSP_Free_Directives');
    
    if(in_array($_REQUEST['BTT_CSP_FREE_DIRECTIVE'],$Blue_Triangle_Automated_CSP_Free_Directives)){
        $BTT_CSP_FREE_DIRECTIVE = $_REQUEST['BTT_CSP_FREE_DIRECTIVE'];
    }
    $BTT_CSP_FREE_DOMAIN= sanitize_text_field($_REQUEST['BTT_CSP_FREE_DOMAIN']);
    $BTT_CSP_FREE_VALUE = sanitize_text_field($_REQUEST['BTT_CSP_FREE_VALUE']);
    $approvalType = (sanitize_text_field($_REQUEST['BTT_CSP_FREE_IS_SUB'])=="true")?"subDomain":"approved";

    
    $Blue_Triangle_Automated_CSP_Free_Errors["csp"][$BTT_CSP_FREE_DIRECTIVE]["domains"][$BTT_CSP_FREE_DOMAIN][$approvalType]= $BTT_CSP_FREE_VALUE;
    
    update_option( 'Blue_Triangle_Automated_CSP_Free_Errors', $Blue_Triangle_Automated_CSP_Free_Errors);
    Blue_Triangle_Automated_CSP_Free_Build_CSP();
    wp_send_json("approved",200);
}

add_action("wp_ajax_Blue_Triangle_Automated_CSP_Free_Directive_Options", "Blue_Triangle_Automated_CSP_Free_Directive_Options");
function Blue_Triangle_Automated_CSP_Free_Directive_Options(){
     if ( !wp_verify_nonce( $_REQUEST['nonce'], "Blue_Triangle_Automated_CSP_Free_Directive_Nonce")) {
        exit("No naughty business please");
    }  
    if(!isset($_REQUEST['BTT_CSP_FREE_DIRECTIVE_OPTION_TOGGLE'])){
        wp_send_json("no toggle sent",400);
        exit;
    }
    if(!isset($_REQUEST['BTT_CSP_FREE_DIRECTIVE'])){
        wp_send_json("no directive sent",400);
        exit;
    }
    if(!isset($_REQUEST['BTT_CSP_FREE_DIRECTIVE_OPTION'])){
        wp_send_json("no option sent",400);
        exit;
    }
   
    $BTT_CSP_FREE_OPT_TOG = sanitize_text_field($_REQUEST['BTT_CSP_FREE_DIRECTIVE_OPTION_TOGGLE']);
    $BTT_CSP_FREE_DIRECTIVE = sanitize_text_field($_REQUEST['BTT_CSP_FREE_DIRECTIVE']);
    $BTT_CSP_FREE_VALUE = sanitize_text_field($_REQUEST['BTT_CSP_FREE_DIRECTIVE_OPTION']);
   
    $Blue_Triangle_Automated_CSP_Free_Errors = get_site_option('Blue_Triangle_Automated_CSP_Free_Errors');
    if($BTT_CSP_FREE_OPT_TOG =="true"){
        $Blue_Triangle_Automated_CSP_Free_Errors["csp"][$BTT_CSP_FREE_DIRECTIVE]["options"][]= $BTT_CSP_FREE_VALUE;
        update_option( 'Blue_Triangle_Automated_CSP_Free_Errors', $Blue_Triangle_Automated_CSP_Free_Errors);
    }else{
        $updatedOptions = [];
        
        foreach ($Blue_Triangle_Automated_CSP_Free_Errors["csp"][$BTT_CSP_FREE_DIRECTIVE]["options"] as $index=>$opt){
            if($opt ==$BTT_CSP_FREE_VALUE){
                continue;
            }
            $updatedOptions[] = $opt;

        }
        $Blue_Triangle_Automated_CSP_Free_Errors["csp"][$BTT_CSP_FREE_DIRECTIVE]["options"]=$updatedOptions;
        update_option('Blue_Triangle_Automated_CSP_Free_Errors', $Blue_Triangle_Automated_CSP_Free_Errors);
    }
    Blue_Triangle_Automated_CSP_Free_Build_CSP();
    wp_send_json(json_encode("Updated"),200);

}

add_action("wp_ajax_Blue_Triangle_Automated_CSP_Free_Send_CSP", "Blue_Triangle_Automated_CSP_Free_Send_CSP");
add_action("wp_ajax_nopriv_Blue_Triangle_Automated_CSP_Free_Send_CSP", "Blue_Triangle_Automated_CSP_Free_Send_CSP");
function Blue_Triangle_Automated_CSP_Free_Send_CSP(){
     if ( !wp_verify_nonce( $_REQUEST['nonce'], "Blue_Triangle_Automated_CSP_Free_Nonce")) {
        exit("No naughty business please");
    }  
    if(!isset($_REQUEST['BTT_CSP_FREE_ERROR'])){
        wp_send_json("no data sent",400);
        exit;
    }

    $incomingErrors = json_decode(stripslashes ($_REQUEST['BTT_CSP_FREE_ERROR']),true);
    $errorType = "";
    $directives = get_site_option('Blue_Triangle_Automated_CSP_Free_Directives');
    $existingErrors = get_site_option('Blue_Triangle_Automated_CSP_Free_Errors');

    foreach($incomingErrors as $errorData){
        $errorType = $errorData["type"];
        $extension = $directives[$errorData["violatedDirective"]]["fileType"];
        if($errorType=="jsError"){
            continue;
        }

        $domain = $errorData["domain"];
        switch ($domain) {
            case "blob":
                $domain = (empty($errorData["sourceFile"]))?
                $errorData["documentURI"]:$errorData["sourceFile"];
                break;
            case "inline":
                $domain = $errorData["sourceFile"];
                break;
            case "data":
                $domain = $errorData["documentURI"];
                break;
            default:
                $domain = $errorData["domain"];
            break;
        }
        $domainParts = explode("/",$domain);
        $domain = $domainParts[2];
        $domainParts = explode(".",$domain);
        $domain = $domainParts[count($domainParts)-2].".".$domainParts[count($domainParts)-1];        

        $current_time = new DateTime();
        $timeStamp = $current_time->format('U');
        if(isset($existingErrors["csp"][$errorData["violatedDirective"]]["domains"][$domain])){
            continue;
        }

        $existingErrors["csp"][$errorData["violatedDirective"]]["domains"][$domain]= [
            "extension"=>$extension,
            "referrer"=>$errorData["referrer"],
            "fileName"=>$fileString,
            "reportEpoch"=>$timeStamp,
            "violatedDirective"=>$errorData["violatedDirective"],
            "approved"=>"false",
            "subDomain"=>"false",
        ];
    }
    
    update_option( 'Blue_Triangle_Automated_CSP_Free_Errors', $existingErrors);
}