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
            <img class="card-img" alt="Blue Triangle Logo" src="<?=$pluginDirectory?>img/Blue-Triangle-Avatar-Logo-blue-500x500.png" >
            <div class="card-img-overlay">
                <h4 class="card-title">Blue Triangle Automated CSP Free</h4>
                <p class="card-text">A fully automated CSP for a busy secure world.</p>
                <p class="card-text">Version 1.0</p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <h3> Check out our paid version</h3>

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