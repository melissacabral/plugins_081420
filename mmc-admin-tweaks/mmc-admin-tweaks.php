<?php 
/*
Plugin Name: MMC Admin Tweaks
Description: Customize the login screens and admin panels
Author: Melissa Cabral
Version: 0.1
License: GPLv3
 */

//attach a stylesheet to the login form
add_action( 'login_enqueue_scripts', 'mmc_login_style' );
function mmc_login_style(){
	$url = plugins_url( 'css/login.css', __FILE__ );
	wp_enqueue_style( 'custom_login', $url );
}

//customize the login logo link
add_filter( 'login_headerurl', 'mmc_login_logo_link' );
function mmc_login_logo_link(){
	//return any valid URL here
	return get_home_url();
}

//customize login logo text (screen reader text)
add_filter( 'login_headertext', 'mmc_login_logo_text' );
function mmc_login_logo_text(){
	//return 'Go Home';
	return get_bloginfo('name');
}

//Customize the admin bar (tool bar)
add_action( 'admin_bar_menu', 'mmc_admin_bar', 999 );
function mmc_admin_bar( $wp_admin_bar ){
	//remove the wordpress logo menu
	$wp_admin_bar->remove_node('wp-logo');

	//add a "help" node
	$wp_admin_bar->add_node( array(
		'title' => 'Get Help',
		'href'	=> 'http://google.com',
		'id' 	=> 'mmc-help',
		//'parent' => 'site-name',
		'meta' => array( 'target' => '_blank' ),
	) );
}

//customize the dashboard experience
add_action( 'admin_menu', 'mmc_dashboard' );
function mmc_dashboard(){
						//widget id,    screen, 	'normal' or 'side'
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}


//custom dashboard widget
add_action( 'wp_dashboard_setup', 'mmc_dashboard_add' );
function mmc_dashboard_add(){
	global $wp_meta_boxes;
	wp_add_dashboard_widget( 'dashboard_mmc_help', 'Helpful Resources', 'mmc_dash_help_widget' );
}


//content of the widget
function mmc_dash_help_widget(){
	?>
	<iframe width="350" height="250" src="https://www.youtube.com/embed/x7R2HcTAyjI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	<?php
}