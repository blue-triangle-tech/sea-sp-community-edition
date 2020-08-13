<?php

function Blue_Triangle_Automated_CSP_Free_Dashboard(){
    $pluginDirectory = plugin_dir_url( "Bluetriangle-free-csp.php" ) .'SeaSP-Community-Edition/';
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_js', $pluginDirectory . 'bootstrap/bootstrap.bundle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_theme',  $pluginDirectory. 'bootstrap/bootstrap.min.css' );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_btt_css',  $pluginDirectory. 'css/btt.css' );
    require_once( SEASP_COMMUNITY_PLUGIN_DIR .'src/views/dashboard-view.php' );
}

function Blue_Triangle_Automated_CSP_Free_General_Page(){
    $pluginDirectory = plugin_dir_url( "Bluetriangle-free-csp.php" ) .'SeaSP-Community-Edition/';
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_js', $pluginDirectory . 'bootstrap/bootstrap.bundle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_theme',  $pluginDirectory. 'bootstrap/bootstrap.min.css' );
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_general_js', $pluginDirectory . 'js/general-page.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_toggle_js', $pluginDirectory . 'bootstrap/bootstrap-toggle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_btt_css',  $pluginDirectory. 'css/btt.css' );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_toggle',  $pluginDirectory. 'bootstrap/bootstrap-toggle.min.css' );
    require_once(  SEASP_COMMUNITY_PLUGIN_DIR.'src/views/general-view.php' );
}

function Blue_Triangle_Automated_CSP_Free_Violations(){
    $pluginDirectory = plugin_dir_url( "Bluetriangle-free-csp.php" ) .'SeaSP-Community-Edition/';
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_approval_js', $pluginDirectory . 'js/approval-page.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_js', $pluginDirectory . 'bootstrap/bootstrap.bundle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_toggle_js', $pluginDirectory . 'bootstrap/bootstrap-toggle.min.js', array( 'jquery' ), "1.0", false );
   
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_btt_css',  $pluginDirectory. 'css/btt.css' );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_theme',  $pluginDirectory. 'bootstrap/bootstrap.min.css' );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_toggle',  $pluginDirectory. 'bootstrap/bootstrap-toggle.min.css' );
    require_once( SEASP_COMMUNITY_PLUGIN_DIR.'src/views/violations-view.php' );
}

function Blue_Triangle_Automated_CSP_Free_Directives_Page(){
    $pluginDirectory = plugin_dir_url( "Bluetriangle-free-csp.php" ) .'SeaSP-Community-Edition/';
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_directives_js', $pluginDirectory . 'js/directives-page.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_btt_css',  $pluginDirectory. 'css/btt.css' );
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_toggle_js', $pluginDirectory . 'bootstrap/bootstrap-toggle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_toggle',  $pluginDirectory. 'bootstrap/bootstrap-toggle.min.css' );
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_js', $pluginDirectory . 'bootstrap/bootstrap.bundle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_theme',  $pluginDirectory. 'bootstrap/bootstrap.min.css' );
    require_once(  SEASP_COMMUNITY_PLUGIN_DIR.'src/views/directives-view.php' );
}

function Blue_Triangle_Automated_CSP_Free_Help_Center(){
    $pluginDirectory = plugin_dir_url( "Bluetriangle-free-csp.php" ) .'SeaSP-Community-Edition/';
    wp_enqueue_script( 'Blue_Triangle_Automated_CSP_free_bootstrap_js', $pluginDirectory . 'bootstrap/bootstrap.bundle.min.js', array( 'jquery' ), "1.0", false );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_bootstrap_theme',  $pluginDirectory. 'bootstrap/bootstrap.min.css' );
    wp_enqueue_style( 'Blue_Triangle_Automated_CSP_free_btt_css',  $pluginDirectory. 'css/btt.css' );
    require_once(  SEASP_COMMUNITY_PLUGIN_DIR.'src/views/help-view.php' );
}