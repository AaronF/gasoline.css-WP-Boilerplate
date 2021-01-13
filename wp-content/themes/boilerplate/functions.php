<?php
/**
 * Initial Theme Setup
 */
function gas_setup() {
	// Make theme available for translation
	load_theme_textdomain('gasoline', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head
	add_theme_support('automatic-feed-links');

	// Let WordPress manage the document title
	add_theme_support('title-tag');

	// Enable support for Post Thumbnails on posts and pages
	add_theme_support('post-thumbnails');

	// Register menus
	register_nav_menus(array(
		'main-menu' => esc_html__('Main Menu', 'gasoline')
	));
}
add_action('after_setup_theme', 'gas_setup');

/**
 * Register JS
 */
function gas_scripts(){
	wp_register_script('tinyslider', get_template_directory_uri() . '/assets/node_modules/tiny-slider/dist/min/tiny-slider.js', array('jquery'), '1.0.0');
	wp_enqueue_script('tinyslider', null, null, null, true);

	wp_register_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0');
	wp_enqueue_script('main', null, null, null, true);

	// -- Optional: Make PHP variables available in the JS file (such as the ajax endpoint) --
	// wp_localize_script('main', 'WP_Settings', array(
	// 	'siteurl'	=> get_option('siteurl'), 
	// 	'themeurl'	=> get_template_directory_uri(),
	// 	'ajaxurl'	=> admin_url('admin-ajax.php')
	// ));
}
add_action('wp_enqueue_scripts', 'gas_scripts');

/**
 * Register CSS
 */
function gas_styles(){
	wp_register_style('tinyslider', get_template_directory_uri() . '/assets/node_modules/tiny-slider/dist/tiny-slider.css', array(), '1.0', 'all');
	wp_enqueue_style('tinyslider');

	// Main project CSS file
	wp_register_style('main', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0', 'all');
	wp_enqueue_style('main');

	// Theme style
	wp_register_style('gasoline', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
	wp_enqueue_style('gasoline');
}
add_action('wp_enqueue_scripts', 'gas_styles');

/**
 * Register Custom Post Types
 */
function gas_register_cpt(){
	// register_post_type(
	// 	'example', 
	// 	array(
	// 		'labels' => array(
	// 			'name'			=> __('Example Custom Posts'),
	// 			'singular_name'	=> __('Example')
	// 		),
	// 		'public'				=> true,
	// 		'has_archive'			=> true,
	// 		'publicly_queryable'	=> true,
	// 		'show_in_rest'			=> false, //Disables Gutenberg
	// 		'menu_icon'				=> 'dashicons-admin-customizer',
	// 		'supports'				=> array('title', 'editor')
	// 	)
	// );
}
add_action('init', 'gas_register_cpt');

/**
 * ACF Specific Options
 */
// Add acf option pages
function gas_register_options_pages(){
	if(!function_exists('acf_add_options_page'))
		return;

	// -- Main options page --
	// acf_add_options_page(array(
	// 	'page_title' 	=> 'Theme Settings',
	// 	'menu_title' 	=> 'Theme Settings',
	// 	'menu_slug'		=> 'theme-settings',
	// 	'capability'	=> 'edit_posts',
	// 	'redirect'		=> false
	// ));
	
	// -- Sub page to main options page above --
	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Theme Header Settings',
	// 	'menu_title'	=> 'Header',
	// 	'parent_slug'	=> 'theme-settings',
	// ));
}
add_action('acf/init', 'gas_register_options_pages');

// Register blocks (Gutenberg editor only)
function gas_register_blocks(){
	if(!function_exists('acf_register_block_type'))
		return;

	// acf_register_block_type(array(
	// 	'name'				=> 'example_block',
	// 	'title'				=> 'Example Block',
	// 	'description'		=> 'This is an example block',
	// 	'category'			=> 'formatting',
	// 	'mode'				=> 'edit', // 'edit' or 'preview'
	// 	'supports'			=> array(
	// 		'mode' => false, // Disabled previewing
	// 	),
	// 	'render_template'	=> 'page-blocks/example-block.php',
	// 	'enqueue_assets'	=> function(){
	// 		// Optional - Register JS/CSS only when this block is present on a page, this can help keep page load times down
	// 		wp_register_script('example-block', get_template_directory_uri() . '/assets/path/to/js', array('jquery'), '1.0.0');
	// 		wp_enqueue_script('example-block', null, null, null, true);

	// 		wp_register_style('example-block', get_template_directory_uri() . '/assets/path/to/css', array(), '1.0', 'all');
	// 		wp_enqueue_style('example-block');
	// 	}
	// ));
}
add_action('acf/init', 've_register_blocks');
?>