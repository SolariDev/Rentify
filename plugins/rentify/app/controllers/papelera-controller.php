<?php
defined('ABSPATH') || exit;

if (!session_id()) {
    session_start();
}

$id_usuario = $_SESSION['rfy_usuario'] ?? 0;
$contratos_papelera = [];
$usuario = null;

if ($id_usuario > 0) {
    global $wpdb;
    $tabla_contratos = $wpdb->prefix . 'rentify_contratos';
    $tabla_usuarios  = $wpdb->prefix . 'rentify_usuarios';

    $usuario = $wpdb->get_row(
        $wpdb->prepare("SELECT nombre, apellido FROM $tabla_usuarios WHERE id_usuario = %d", $id_usuario)
    );

    // Acción: restaurar contrato
    if (isset($_GET['accion'], $_GET['id']) && $_GET['accion'] === 'restaurar') {
        $id = intval($_GET['id']);
        $resultado = $wpdb->update(
            $tabla_contratos,
            ['papelera' => 0],
            ['id' => $id, 'id_usuario' => $id_usuario]
        );
        if ($resultado > 0) {
            wp_safe_redirect(home_url('/papelera'));
            exit;
        } else {
            $GLOBALS['rfy_mensaje_error'] = "No se pudo restaurar el contrato con ID $id.";
        }
    }

    // Acción: eliminar permanentemente
    if (isset($_GET['accion'], $_GET['id']) && $_GET['accion'] === 'eliminar') {
        $id = intval($_GET['id']);
        $resultado = $wpdb->delete(
            $tabla_contratos,
            ['id' => $id, 'id_usuario' => $id_usuario]
        );
        if ($resultado > 0) {
            wp_safe_redirect(home_url('/papelera'));
            exit;
        } else {
            $GLOBALS['rfy_mensaje_error'] = "No se pudo eliminar el contrato con ID $id.";
        }
    }

    // Acción: vaciar papelera
    if (isset($_POST['accion']) && $_POST['accion'] === 'vaciar_papelera') {
        if (!isset($_POST['rfy_nonce']) || !wp_verify_nonce($_POST['rfy_nonce'], 'rfy_papelera')) {
            $GLOBALS['rfy_mensaje_error'] = "Solicitud inválida.";
        } else {
            $resultado = $wpdb->delete(
                $tabla_contratos,
                ['papelera' => 1, 'id_usuario' => $id_usuario]
            );
            if ($resultado > 0) {
                wp_safe_redirect(home_url('/papelera'));
                exit;
            } else {
                $GLOBALS['rfy_mensaje_error'] = "No se pudo vaciar la papelera.";
            }
        }
    }

    // Obtener contratos en papelera
    $contratos_papelera = $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM $tabla_contratos WHERE id_usuario = %d AND papelera = 1 ORDER BY fin DESC", $id_usuario)
    );
}

// Variables disponibles para la vista
$GLOBALS['rfy_usuario']            = $usuario;
$GLOBALS['rfy_contratos_papelera'] = $contratos_papelera;