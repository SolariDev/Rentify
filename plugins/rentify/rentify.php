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

// Encolar estilos del plugin
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'rfy-estilos',
        RENTIFY_URL . 'assets/rfy-estilos.css',
        [],
        '1.0.0'
    );
});

// Hook para controlar scroll en páginas principales
add_filter('body_class', function($classes) {
    if (is_page(array('inicio', 'registro', 'ingresar', 'panel'))) {
        $classes[] = 'rfy-noscroll';
    }
    return $classes;
});

register_activation_hook(__FILE__, 'rentify_install');
require_once plugin_dir_path(__FILE__) . 'config/install.php';

add_shortcode('rfy_inicio', function () {
	ob_start();
	include RENTIFY_PATH . 'app/views/inicio.php';
	return ob_get_clean();
});
?>