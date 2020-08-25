<?php 
/*
Plugin Name: MMC High Bar
Description: Displays an announcement bar across the top of the website
Version: 0.1
Author Name: Melissa Cabral
License: GPLv3
*/

//HTML Output
add_action( 'wp_footer', 'mmc_highbar_html' );
function mmc_highbar_html(){
	//get the custom options for the content
	$values = get_option('high_bar'); 
	?>
	<div id="high-bar">
		<span class="high-message"><?php echo stripslashes($values['bar_text']); ?></span>
		<a class="high-button" href="<?php echo stripslashes($values['button_url']); ?>">
			<?php echo stripslashes($values['button_text']); ?>
		</a>

		<a class="high-dismiss" href="javascript:;">&times;</a>
	</div>
	<?php
}

//Attach CSS & JS
add_action( 'wp_enqueue_scripts', 'mmc_high_scripts' );
function mmc_high_scripts(){
	//get the url of the stylesheet
	$css_url = plugins_url( 'css/highbar.css', __FILE__ );
	//register it & put it on the page
	wp_enqueue_style( 'highbar_style', $css_url );

	//attach jquery (built-in to wordpress)
	wp_enqueue_script( 'jquery' );

	//attach our custom js file
	$js_url = plugins_url( 'js/highbar.js', __FILE__ );
	wp_enqueue_script( 'highbar_script', $js_url );
}

//add a page to the admin panel
add_action( 'admin_menu', 'mmc_high_admin_page' );
function mmc_high_admin_page(){
	add_options_page( 'High Bar Settings', 'High Bar', 'manage_options', 'high-bar-settings', 'mmc_high_admin_content' );
}

function mmc_high_admin_content(){
	//how to include another file asset (use plugin_dir_path)
	require( plugin_dir_path( __FILE__ ) . 'mmc-high-bar-settings-page.php' );
}

//register the settings we need (allows them into the database)
add_action( 'admin_init', 'mmc_high_setting' );
function mmc_high_setting(){
	register_setting( 'high_bar_setting_group', 'high_bar', array(
		'sanitize_callback' => 'mmc_high_bar_sanitize',
		'type'				=> 'array'
	) );
}


//sanitize all fields
function mmc_high_bar_sanitize($input){
	//kses = "KSES strips evil scripts"
	//clean each field. $input is an array containing all dirty fields
	$input['bar_text'] 		= wp_filter_nohtml_kses( $input['bar_text'] );
	$input['button_text'] 	= wp_filter_nohtml_kses( $input['button_text'] );
	$input['button_url'] 	= wp_filter_nohtml_kses( $input['button_url'] );

	//$input is an aray contining the cleaned fields!
	return $input;
}

//no close PHP