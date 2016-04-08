<?php
/**
 * Plugin Name: Tutsplus Customize the WordPress Admin
 * Plugin URI: http://rachelmccollin.co.uk/tutsplus-customizing-wordpress-admin/
 * Description: Plugin to support envato tuts+ course on customizing the WordPress admin screens for easier content management.
 * Version: 4.2
 * Author: Rachel McCollin
 * Author URI: http://rachelmccollin.com
 *
 * Text Domain: tutsplus
 * Domain Path: /languages
 *
 */
 
/**************************************************************
tutsplus_custom_logo - replaces WordPress logo with a custom one
**************************************************************/
function tutsplus_custom_logo() { ?>
	
	<style type = "text/css">
		
		body.login {
			background-color: #689F32;
		}
		
		.login h1 a {
			background-image: url(<?php echo plugins_url('images/envatotutsplus-logo.png', __FILE__ ); ?> );
			background-size: 200px 100px;
			height: 100px;
			width: 200px;
		}
		
		.login #backtoblog a, .login #nav a {
			color: #fff;
		}
		
		.login #backtoblog a:hover, .login #nav a:hover,
		.login #backtoblog a:active, .login #nav a:active {
			color: #000;
		}
		
	</style>
		
<?php }
add_action( 'login_enqueue_scripts', 'tutsplus_custom_logo' );

/**************************************************************
tutsplus_admin_footer - new admin footer text
**************************************************************/
function tutsplus_admin_footer() {
	
	echo '<p>For courses and tutorials to help you learn WordPress, visit <a href="http://tutsplus.com">envato tutsplus</a>.</p>';
	
}
add_filter( 'admin_footer_text', 'tutsplus_admin_footer', 20 );

/**************************************************************
tutsplus_admin_logo - add logo at top of admin screens
**************************************************************/
function tutsplus_admin_logo() {
	
	echo '<a href="http://tutsplus.com" title="Click for tutorials and courses"><img src="' . plugins_url( 'images/envatotutsplus-logo.png', __FILE__ ) . '" /></a>';
	
}
add_action( 'admin_notices', 'tutsplus_admin_logo' );

/**************************************************************
tutsplus_remove_dashboard_widgets - remove unwanted dashboard widgets
**************************************************************/
function tutsplus_remove_dashboard_widgets() {
	
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // quick draft
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WP news
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // Activity
		
}
add_action( 'wp_dashboard_setup', 'tutsplus_remove_dashboard_widgets' );
remove_action( 'welcome_panel', 'wp_welcome_panel' );

/**************************************************************
tutsplus_add_dashboard_widgets - add new dashboard widgets
**************************************************************/
// add metabox
function tutsplus_add_dashboard_widgets() {
	
	wp_add_dashboard_widget( 'tutsplus_welcome', 'Welcome to Your Website', 'tutsplus_welcome_widget_callback' );
	
}
add_action( 'wp_dashboard_setup', 'tutsplus_add_dashboard_widgets' );

// callback function
function tutsplus_welcome_widget_callback() {
	
	_e( '<p>This site supports an envato tutsplus course on customizing the WordPress dahsboard for easier content management.</p>', 'tutsplus' );
	_e ( '<p>For more information see the <a href="http://tutsplus.com">envato tutsplus website</a>.</p>', 'tutsplus' );
	
}
	
/**************************************************************
tutsplus_add_help_tab - add new help tab
**************************************************************/
// add the help tab
function tutsplus_add_help_tab() {
	
	$screen = get_current_screen();
	$screen->add_help_tab( array (
		'id' => 'tutsplus_admin_help_tab',
		'title' => 'Help with your site',
		'callback' => 'tutsplus_admin_help_callback'
	
	));
	
}
add_action( 'load-post.php', 'tutsplus_add_help_tab' );
add_action( 'load-post-new.php', 'tutsplus_add_help_tab' );

// callback function
function tutsplus_admin_help_callback() {
	
	echo'<h3>';
		_e( 'Editing and Creating Posts', 'tutsplus' );
	echo '</h3>';
	
	echo '<p>';
		_e( 'Help text goes here' , 'tutsplus' );
	echo '</p>';		
	
}

