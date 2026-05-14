<?php
defined('ABSPATH') || exit;

session_start();

$id_usuario = $_SESSION['rfy_usuario'] ?? 0;
$nombre_apellido = '';

if ($id_usuario > 0) {
    global $wpdb;
    $tabla = $wpdb->prefix . 'rfy_usuarios';
    $usuario = $wpdb->get_row(
        $wpdb->prepare("SELECT nombre, apellido FROM $tabla WHERE id_usuario = %d", $id_usuario)
    );

    if ($usuario) {
        $nombre_apellido = esc_html($usuario->nombre . ' ' . $usuario->apellido);
    } else {
        $nombre_apellido = 'Usuario no registrado';
    }
} else {
    $nombre_apellido = 'Sesión no iniciada';
}