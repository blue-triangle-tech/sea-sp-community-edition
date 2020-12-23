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

    $siteID = get_current_blog_id();
    $BTT_CSP_FREE_CSP_MODE= sanitize_text_field($_REQUEST['BTT_CSP_FREE_CSP_MODE']);
    $BTT_CSP_FREE_CSP_MODE=($BTT_CSP_FREE_CSP_MODE=="true")?true:false;
    Blue_Triangle_Automated_CSP_Free_Build_CSP($siteID,"default",$BTT_CSP_FREE_CSP_MODE,false);
    $cspData = Blue_Triangle_Automated_CSP_Free_Get_Latest_CSP($siteID);
    $CSP = $cspData[0];
    wp_send_json($CSP,200);
}

add_action("wp_ajax_Blue_Triangle_Automated_CSP_Free_Csp_Delay", "Blue_Triangle_Automated_CSP_Free_Csp_Delay");
function Blue_Triangle_Automated_CSP_Free_Csp_Delay(){
    if ( !wp_verify_nonce( $_REQUEST['nonce'], "Blue_Triangle_Automated_CSP_Free_Approve_Nonce")) {
        exit("No naughty business please");
    }  
    if(!isset($_REQUEST['BTT_CSP_FREE_CSP_Delay'])){
        wp_send_json("no delay sent",400);
        exit;
    }

    $siteID = get_current_blog_id();
    $BTT_CSP_FREE_CSP_MODE= sanitize_text_field($_REQUEST['BTT_CSP_FREE_CSP_Delay']);
    Blue_Triangle_Automated_CSP_Free_Update_Setting("post_load_delay",$BTT_CSP_FREE_CSP_MODE,$siteID);
    wp_send_json("updated",200);
}


add_action("wp_ajax_Blue_Triangle_Automated_CSP_Free_Csp_Error_Mode", "Blue_Triangle_Automated_CSP_Free_Csp_Error_Mode");
function Blue_Triangle_Automated_CSP_Free_Csp_Error_Mode(){
    if ( !wp_verify_nonce( $_REQUEST['nonce'], "Blue_Triangle_Automated_CSP_Free_Approve_Nonce")) {
        exit("No naughty business please");
    }  
    if(!isset($_REQUEST['BTT_CSP_ERROR_COLLECT'])){
        wp_send_json("no mode sent",400);
        exit;
    }

    $siteID = get_current_blog_id();
    $BTT_CSP_ERROR_COLLECT= sanitize_text_field($_REQUEST['BTT_CSP_ERROR_COLLECT']);
    $BTT_CSP_ERROR_COLLECT=($BTT_CSP_ERROR_COLLECT=="true")?"true":"false";
    Blue_Triangle_Automated_CSP_Free_Update_Setting("error_collection",$BTT_CSP_ERROR_COLLECT,$siteID);
    wp_send_json("updated",200);
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
    $Blue_Triangle_Automated_CSP_Free_Errors = get_option('Blue_Triangle_Automated_CSP_Free_Errors');

    $BTT_CSP_FREE_DIRECTIVE = sanitize_text_field($_REQUEST['BTT_CSP_FREE_DIRECTIVE']);
    $BTT_CSP_FREE_DOMAIN= sanitize_text_field($_REQUEST['BTT_CSP_FREE_DOMAIN']);
    $BTT_CSP_FREE_VALUE = sanitize_text_field($_REQUEST['BTT_CSP_FREE_VALUE']);
    $approvalType = (sanitize_text_field($_REQUEST['BTT_CSP_FREE_IS_SUB'])=="true")?"subdomain":"approved";
    $siteID = get_current_blog_id();
    $cspData = Blue_Triangle_Automated_CSP_Free_Get_Latest_CSP($siteID);
    $reportMode = ($cspData[1]=="0")?false:true;

    global $wpdb;
    $updateStatement = $wpdb->prepare("  
    UPDATE seasp_violation_log
    SET ".$approvalType." = %s
    WHERE  violating_directive = %s
    AND domain = %s
    AND site_id = %s;
    ",[
        $BTT_CSP_FREE_VALUE,
        $BTT_CSP_FREE_DIRECTIVE,
        $BTT_CSP_FREE_DOMAIN,
        $siteID
        ]
    );
    //execute the query
    $wpdb->query($updateStatement);
    if($wpdb->last_error !== '') {
        wp_send_json($wpdb->last_error,500);
    }
    Blue_Triangle_Automated_CSP_Free_Build_CSP($siteID,"default",$reportMode,false);
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
    $BTT_CSP_FREE_VALUE = str_replace("\'","'",$BTT_CSP_FREE_VALUE);
    $BTT_CSP_FREE_OPT_NAME = str_replace("'","",$BTT_CSP_FREE_VALUE);
    $siteID = get_current_blog_id();
    global $wpdb;
    $cspData = Blue_Triangle_Automated_CSP_Free_Get_Latest_CSP($siteID);
    $reportMode = ($cspData[1]=="0")?false:true;
    if($BTT_CSP_FREE_OPT_TOG == "true"){
        //insert into db
        $insertStatement = 'insert into `seasp_directive_settings`(`site_id`,`directive_name`,`option_name`,`option_value`) values ';
        $insertStatement .="(%s,%s,%s,%s)";
        $wpdb->query($wpdb->prepare($insertStatement, [
            $siteID,
            $BTT_CSP_FREE_DIRECTIVE,
            $BTT_CSP_FREE_OPT_NAME,
            $BTT_CSP_FREE_VALUE
        ]));
        if($wpdb->last_error !== '') {
            $report = $wpdb->last_error .' failed to insert into `seasp_directive_settings`' ;
            wp_send_json(json_encode($report),500);
        }
    }else{
        //remove from db
        $delteStatement = $wpdb->prepare("  
        DELETE FROM seasp_directive_settings 
        WHERE site_id = %s 
        AND directive_name = %s
        AND option_value = %s;
        ",[
            $siteID,
            $BTT_CSP_FREE_DIRECTIVE,
            $BTT_CSP_FREE_VALUE
            ]
        );
        $wpdb->query($delteStatement);
        if($wpdb->last_error !== '') {
            $report = $wpdb->last_error .' failed to delete from `seasp_directive_settings`' ;
            wp_send_json(json_encode($report),500);
        }
    }

    Blue_Triangle_Automated_CSP_Free_Build_CSP($siteID,"default",$reportMode,false);
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
    $siteID = get_current_blog_id();
    $incomingErrors = json_decode(stripslashes ($_REQUEST['BTT_CSP_FREE_ERROR']),true);
    $errorType = "";
    $directives = Blue_Triangle_Automated_CSP_Free_Get_Directives();
    $existingErrors = Blue_Triangle_Automated_CSP_Free_Get_Approved_Domains($siteID,false);
    $dataAdded = [];
    foreach($incomingErrors as $errorData){
        $errorType = $errorData["type"];
        $extension = $directives[$errorData["violatedDirective"]]["file_type"];
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
        if(count($domainParts)==1){
            $domain = $domainParts[0];
        }else{
            $domain = $domainParts[count($domainParts)-2].".".$domainParts[count($domainParts)-1];   
        }
             
        if($domain == "."){
            $foobar="baz";
        }
        $current_time = new DateTime();
        $timeStamp = $current_time->format('U');
        if($errorData["violatedDirective"] =="connect-src"){
            $foobar="baz";
        }
        if($errorData["violatedDirective"] =="worker-src"){
            $foobar="baz";
        }
        if(strpos($existingErrors[$errorData["violatedDirective"]],$domain)!==false){
            continue;
        }
        if(in_array($domain, $dataAdded[$errorData["violatedDirective"]])){
            continue;
        }
        $siteID = get_current_blog_id();
        global $wpdb;
        $insertStatement = 'insert into `seasp_violation_log`(`site_id`,`report_epoch`,`violating_directive`,`domain`,`extension`,`referrer`,`violating_file`,`approved`,`subdomain`) values ';
        $insertStatement .="(%d,%d,%s,%s,%s,%s,%s,%s,%s)";
        $wpdb->query($wpdb->prepare($insertStatement, [
            $siteID,
            $timeStamp,
            $errorData["violatedDirective"],
            $domain,
            $extension,
            $errorData["referrer"],
            $errorData["sourceFile"],
            "false",
            "false"
        ]));
        $dataAdded[$errorData["violatedDirective"]][]=$domain;

        if($wpdb->last_error !== '') {
            $report = $wpdb->last_error .' failed to insert into `seasp_violation_log`' ;
            wp_send_json(($report),500);
            exit;
        }
    }
    
}