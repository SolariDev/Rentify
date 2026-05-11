<?php
defined('ABSPATH') || exit;

class InicioController {
    public static function render() {
        include plugin_dir_path(__FILE__) . '../views/inicio.php';
    }
}