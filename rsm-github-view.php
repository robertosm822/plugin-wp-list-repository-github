<?php
/*
    Plugin Name: RSM GitHub View Directories
    Author: Roberto Soares
    Description: Lista de Diretorios de um Desenvolvedor
    Version: 0.1
    Author URI: http://web.siswebmobile.com.br/
*/
// Reference: https://codex.wordpress.org/Widgets_API

// security
if(!defined('ABSPATH')){
    exit("Access not found");
}

require_once(plugin_dir_path(__FILE__).'GitHubWidget.php');

function rgv_register_widget(){
    register_widget('GitHubWidget');
}

add_action('widgets_init', 'rgv_register_widget');

function rsm_styles_css() {
    wp_enqueue_style( 'main-css', plugins_url( '/css/style.css', __FILE__ ), array(), '1.0', 'all' );
    
    //wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/main.js', array('jquery'), '1.5', true );
}
add_action( 'wp_enqueue_scripts', 'rsm_styles_css' );