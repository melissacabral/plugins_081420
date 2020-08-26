<?php
/*
Plugin Name: MMC Portfolio CPT
Description: Adds the custom post type support for our Portfolio Pieces (work)
Author: Melissa Cabral
Version: 0.1
License: GPLv3
*/

//register any needed post types
add_action( 'init', 'mmc_cpt' );
function mmc_cpt(){
	register_post_type( 'work', array(
		'public' 		=> true,
		'label'			=> 'Portfolio',
		'has_archive' 	=> true,
		'menu_position' => 5,
		'menu_icon'		=> 'dashicons-art',
		'show_in_rest'	=> true, //use the block editor
		'supports'		=> array('title', 'editor', 'thumbnail', 'revisions', 'excerpt', 'custom-fields'),
		'rewrite'		=> array( 'slug' => 'portfolio' ), //mysite.com/portfolio
	) );
}

//no close php