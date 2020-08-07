<?php
if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
$directives = get_site_option('Blue_Triangle_Automated_CSP_Free_Directives');
$directiveOptions = get_site_option('Blue_Triangle_Automated_CSP_Free_Directive_Options');
$reportMode = get_site_option('Blue_Triangle_Automated_CSP_Free_Report_Mode');
$Blue_Triangle_Automated_CSP_Free_Errors = get_site_option('Blue_Triangle_Automated_CSP_Free_Errors');
$nonce = wp_create_nonce("Blue_Triangle_Automated_CSP_Free_Directive_Nonce");
$adminURL= esc_url( admin_url( 'admin-ajax.php?nonce='.$nonce) );
$plusSVG = '
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="20" height="20" viewBox="0 0 266.514 266.514" style="enable-background:new 0 0 266.514 266.514;" xml:space="preserve">
	<g>
		<g>
			<path style="fill:#010002;" d="M133.257,266.514C59.775,266.514,0,206.733,0,133.257S59.775,0,133.257,0     s133.257,59.781,133.257,133.257S206.739,266.514,133.257,266.514z M133.257,10.878c-67.477,0-122.379,54.896-122.379,122.379     S65.78,255.636,133.257,255.636s122.379-54.896,122.379-122.379S200.734,10.878,133.257,10.878z"/>
		</g>
		<path style="fill:#010002;" d="M210.35,127.818h-71.654V56.164c0-3.002-2.431-5.439-5.439-5.439c-3.008,0-5.439,2.437-5.439,5.439    v71.654H56.164c-3.002,0-5.439,2.437-5.439,5.439c0,3.002,2.437,5.439,5.439,5.439h71.654v71.649c0,3.002,2.431,5.439,5.439,5.439    c3.008,0,5.439-2.437,5.439-5.439v-71.649h71.654c3.002,0,5.439-2.437,5.439-5.439    C215.789,130.255,213.353,127.818,210.35,127.818z"/>
	</g>
</svg>
';
$directiveCardMarkUp='
<script>
var adminURL= "'.$adminURL.'";
var CSP_Directives = '.json_encode($directives).'
</script>
<div class="row">
    <div class="col-md-3">
        <div class="card bg-dark text-white">
            <img class="card-img" alt="Blue Triangle Logo" src="'.$pluginDirectory.'img/Blue-Triangle-Avatar-Logo-blue-500x500.png" >
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
<div id="accordion">
';

$cardCount = 0;
foreach($directives as $directive=>$info){
    if($info["options"] ==false){
        continue;
    }
    $showClass = ($cardCount==0)?"show":'';
    $currentDirectiveOptions = $Blue_Triangle_Automated_CSP_Free_Errors["csp"][$directive]["options"];
    $directiveCardMarkUp.='
        <div class="card">
            <div class="card-header" id="heading'.$cardCount.'">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse'.$cardCount.'" aria-expanded="false" aria-controls="collapse-'.$cardCount.'">
                    '.$plusSVG.$directive.'
                    </button>
                </h5>
            </div>
            <div id="collapse'.$cardCount.'" class="collapse '.$showClass.' aria-labelledby="heading'.$cardCount.'" data-parent="#accordion">
                <div class="card-body">
                    <p class="card-text">'.$info["desc"].'</p>
                    <div class="row">
                    ';
                    foreach($directiveOptions as $category=>$directiveOpts){
                        $directiveCardMarkUp.='
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">'.$category.'</h5>
                        ';

                        foreach($directiveOpts as $optName=>$optInfo){
                            $optNameCheck = str_replace("'","\'",$optName);
                            $optionValue = (in_array($optNameCheck,$currentDirectiveOptions))?"checked":"";
                            $directiveCardMarkUp.='
                            <div class="form-check mt-2 mb-2">
                            <input type="checkbox" '.$optionValue.' 
                            id="dir-opt-'.$directive.'-'.$optName.'"
                            class="add-directive-option"
                            data-directive="'.$directive.'"
                            data-value="'.$optName.'"
                            data-toggle="toggle"
                            data-on="on" 
                            data-off="off" 
                            data-onstyle="success" 
                            data-offstyle="danger"
                            data-size="small"
                            >
                            <label class="form-check-label" for="dir-opt-'.$directive.'-'.$optName.'" data-toggle="tooltip" data-placement="right" title="'.$optInfo["desc"].'">
                                '.$optName.'
                            </label>
                            </div>
                            ';
                        }
                        $directiveCardMarkUp.='
                                </div>
                            </div>
                        </div>
                        ';
                    }
                    $directiveCardMarkUp.='</div>';//this end the row 
                
    $directiveCardMarkUp.='

                </div>
            </div>
        </div>
';

    $cardCount++;
}
$directiveCardMarkUp.='</div>';
echo $directiveCardMarkUp;