<?php
if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
$directives = get_site_option('Blue_Triangle_Automated_CSP_Free_Directives');
$Blue_Triangle_Automated_CSP_Free_Errors = get_site_option('Blue_Triangle_Automated_CSP_Free_Errors');
$nonce = wp_create_nonce("Blue_Triangle_Automated_CSP_Free_Approve_Nonce");
$adminURL= esc_url( admin_url( 'admin-ajax.php?nonce='.$nonce) );
?>
<div class="row">
    <div class="col-md-3">
        <div class="card bg-dark text-white">
            <img class="card-img" alt="Blue Triangle Logo" src="<?=$pluginDirectory?>img/seaSPIcon.png">
            <div class="card-img-overlay" style="top: 80px;left: 50px;background-color: rgb(45 33 33 / 46%);width: 215px;height: 160px;">
                <h6 class="card-title">SeaSP - Community Edition</h6>
                <p class="card-text">Automated CSP Manger</p>
                <p class="card-text">Version 1.0 <br>Powered By: <a href="https://www.bluetriangle.com" class="text-warning">Blue Triangle</a></p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card bg-dark text-white">
            <img src="<?=$pluginDirectory?>img/seaSPBanner.png" class="card-img" alt="Upgrade your Arrr'senal to protect your booty! Upgrade Your SeaSP today!" style="height: 275px;">
            <div class="card-img-overlay" style="
            top: 180px;
            color: #ffffff;
            background-color: rgb(45 33 33 / 46%);
            ">
                <h5 class="card-title">SeaSP protects your hard earned riches.</h5>
                <h4 class="card-text">Upgrade your Arrr'senal to protect your booty!<a href="https://www.bluetriangle.com/blue-triangles-csp-wordpress-plugin-seasp/" class="btn btn-warning">Upgrade Your SeaSP today!</a></h4>
            </div>
        </div>
    </div>
</div>

<?php
$tableMarkUp = '
<script>
var adminURL= "'.$adminURL.'";
var CSP_Directives = '.json_encode($directives).'
</script>
<table class="table table-striped table-dark" id="domain-approval-table">
<thead>
<tr>
    <th scope="col">Domain</th>
    <th scope="col">Approved</th>
    <th scope="col">Include Subdomains</th>
    <th scope="col">Date Reported</th>
    <th scope="col">Directive</th>
    <th scope="col">File Type</th>
    <th scope="col">File Name</th>
</tr>
</thead>
<tbody>
';

foreach($Blue_Triangle_Automated_CSP_Free_Errors["csp"] as $directive =>$directiveData){
    $domainData = (isset($directiveData["domains"]))?
    $directiveData["domains"]:[];
    foreach($domainData as $domain => $violationData){

        
        $subDomainsEnabled = ($violationData["subDomain"]=="true")?"checked":"";
        $domainsEnabled = ($violationData["approved"]=="true")?"checked":"";
        $tableMarkUp .='<tr>';
        $tableMarkUp .='<td>'.$domain."</td>";
        $tableMarkUp .='<td><input type="checkbox" '.$domainsEnabled.' 
        class="approve-domain-toggle"
        id="domain-tog-'.str_replace (".","",$domain).'-'.$directive.'"
        data-domain="'.$domain.'" 
        data-directive="'.$directive.'" 
        data-toggle="toggle"
        data-on="Approved" 
        data-off="Blocked" 
        data-onstyle="success" 
        data-offstyle="danger"
        data-size="small"
        ></td>';
        $tableMarkUp .='<td><input type="checkbox" '.$subDomainsEnabled.' 
        class="approve-sub-domain-toggle"
        id="subdomain-tog-'.str_replace (".","",$domain).'-'.$directive.'"
        data-domain="'.$domain.'" 
        data-directive="'.$directive.'" 
        data-toggle="toggle"
        data-on="Enabled" 
        data-off="Disabled" 
        data-onstyle="success" 
        data-offstyle="danger"
        data-size="small"
        ></td>';
        $tableMarkUp .='<td>'.date('m/d/Y', $violationData["reportEpoch"])."</td>";
        $tableMarkUp .='<td><button type="button" class="btn btn-sm btn-info" data-toggle="popover" title="Directive Insights" data-content="'.$directives[$directive]["desc"].'">'.$directive.'</button></td>';
        $tableMarkUp .='<td>'.$violationData["extension"]."</td>";
        $tableMarkUp .='<td>'.$violationData["fileName"]."</td>";
        $tableMarkUp .='</tr>';
    }
    
}
$tableMarkUp .='</tbody>';
$tableMarkUp .='</table>';
echo $tableMarkUp;
?>