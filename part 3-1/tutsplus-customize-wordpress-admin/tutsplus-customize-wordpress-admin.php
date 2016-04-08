<?php
/**
 * Plugin Name: Tutsplus Customize the WordPress Admin
 * Plugin URI: http://rachelmccollin.co.uk/tutsplus-customizing-wordpress-admin/
 * Description: Plugin to support envato tuts+ course on customizing the WordPress admin screens for easier content management.
 * Version: 3.1
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