<?php

// Define the version as a constant so we can easily replace it throughout the theme
define( 'LESS_VERSION', 1.1 );

/*-----------------------------------------------------------------------------------*/
/* Add Rss to Head
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );


/*-----------------------------------------------------------------------------------*/
/* register main menu
/*-----------------------------------------------------------------------------------*/
register_nav_menus(
	array(
		'primary'	=>	__( 'Primary Menu', 'less' ),
	)
);

/*-----------------------------------------------------------------------------------*/
/* Enque Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function less_scripts()  {

	// theme styles
	wp_enqueue_style( 'less-style', get_template_directory_uri() . '/style.css', '10000', 'all' );

	// add fitvid
	wp_enqueue_script( 'less-fitvid', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), LESS_VERSION, true );

	// add theme scripts
	wp_enqueue_script( 'less', get_template_directory_uri() . '/js/theme.min.js', array(), LESS_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'less_scripts' );

// translation
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('less', get_template_directory() . '/lang');
}

// Show top of article as default
function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );