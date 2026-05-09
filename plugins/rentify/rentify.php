<?php
/*
Plugin Name: Rentify
Description: Aplicación para la gestión de contratos de alquiler.
Version: 1.0.0
Author: Gabriel Solari
License: GPL2
*/
if (!defined('ABSPATH')) exit;

// Definir constantes del plugin
define( 'RENTIFY_URL', plugin_dir_url( __FILE__ ) );
define( 'RENTIFY_PATH', plugin_dir_path( __FILE__ ) );

register_activation_hook(__FILE__, 'rentify_install');
require_once plugin_dir_path(__FILE__) . 'config/install.php';

add_shortcode('rfy_inicio', function () {
	ob_start();
	include RENTIFY_PATH . 'app/views/inicio.php';
	return ob_get_clean();
});
?>