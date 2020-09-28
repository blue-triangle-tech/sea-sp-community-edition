<?php
if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
$CSP = get_site_option('Blue_Triangle_Automated_CSP_Free_CSP');
$reportmode = get_site_option('Blue_Triangle_Automated_CSP_Free_Report_Mode');
$nonce = wp_create_nonce("Blue_Triangle_Automated_CSP_Free_Approve_Nonce");
$adminURL= esc_url( admin_url( 'admin-ajax.php?nonce='.$nonce) );
$cspActiveValue = ($reportmode =="true")?"":"checked";
$directiveCardMarkUp='
<script>
var adminURL= "'.$adminURL.'";
</script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">SeaSP</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp' ).'">Dashboard </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-general-settings' ).'">General Settings<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-csp-violations' ).'">Current Violations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-directive-settings' ).'">Directive Settings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="'.admin_url( 'admin.php?page=blue-triangle-free-csp-help-center' ).'">Help/Support</a>
      </li>
    </ul>
  </div>
</nav>
<div class="row">
    <div class="col-md-3">
        <div class="card bg-dark text-white">
            <img class="card-img" alt="Blue Triangle Logo" src="'.$pluginDirectory.'img/seaSPIcon.png">
            <div class="card-img-overlay" style="top: 80px;left: 50px;background-color: rgb(45 33 33 / 46%);width: 215px;height: 160px;">
                <h6 class="card-title">SeaSP - Community Edition</h6>
                <p class="card-text">Automated CSP Manger</p>
                <p class="card-text">Version 1.0 <br>Powered By: <a href="https://www.bluetriangle.com" class="text-warning">Blue Triangle</a></p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card bg-dark text-white">
            <img src="'.$pluginDirectory.'img/seaSPBanner.png" class="card-img" alt="Upgrade your Arrr\'senal to protect your booty! Upgrade Your SeaSP today!" style="height: 275px;">
            <div class="card-img-overlay" style="
            top: 180px;
            color: #ffffff;
            background-color: rgb(45 33 33 / 46%);
            ">
                <h5 class="card-title">SeaSP protects your hard earned riches.</h5>
                <h4 class="card-text">Upgrade your Arrr\'senal to protect your booty!<a href="https://www.bluetriangle.com/blue-triangles-csp-wordpress-plugin-seasp/" class="btn btn-warning">Upgrade Your SeaSP today!</a></h4>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row mt-3">
    <div class="col-md-12">
        <div class="form-check">
            <input type="checkbox" '.$cspActiveValue.' 
            id="cspActivation"
            class="activate-csp-button"
            data-toggle="toggle"
            data-on="Blocking" 
            data-off="Report only" 
            data-onstyle="success" 
            data-offstyle="info"
            data-size="large"
            >
            <label class="form-check-label" for="cspActivation" data-toggle="tooltip" data-placement="right" title="To Activate your CSP choose blocking mode. To collect more violation data choose report only.">
                Click This toggle when your ready to place your CSP in blocking mode or to change it back to report only 
            </label>
        </div>
        <br>
        <div class="form-group">
            <label for="cspOutPut"><h4>Current CSP</h4></label>
            <textarea class="form-control" id="cspOutPut" rows="10">
            '.$CSP.'
            </textarea>
        </div>
    </div>
</div>

';

echo $directiveCardMarkUp;