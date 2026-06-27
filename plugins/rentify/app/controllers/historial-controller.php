<?php
defined('ABSPATH') || exit;

if (!session_id()) {
    session_start();
}

$id_usuario = $_SESSION['rfy_usuario'] ?? 0;
$contratosFiltrados = [];
$usuario = null;

if ($id_usuario > 0) {
    global $wpdb;
    $tabla_contratos = $wpdb->prefix . 'rentify_contratos';
    $tabla_usuarios  = $wpdb->prefix . 'rentify_usuarios';

    // Usuario activo
    $usuario = $wpdb->get_row(
        $wpdb->prepare("SELECT nombre, apellido FROM $tabla_usuarios WHERE id_usuario = %d", $id_usuario)
    );

    // Acción: enviar contrato a papelera
    if (isset($_GET['accion'], $_GET['id']) && $_GET['accion'] === 'papelera') {
        $id = intval($_GET['id']);
        $resultado = $wpdb->update(
            $tabla_contratos,
            ['papelera' => 1],
            ['id' => $id]
        );
        echo $resultado !== false
            ? "<div class='rfy-exito'>Contrato con ID $id enviado a papelera correctamente.</div>"
            : "<div class='rfy-error'>No se pudo enviar el contrato con ID $id a la papelera.</div>";
    }

    // Acción: notas
    if (isset($_GET['accion'], $_GET['id']) && $_GET['accion'] === 'notas') {
        $contrato_id = intval($_GET['id']);
        $contrato = $wpdb->get_row($wpdb->prepare("SELECT * FROM $tabla_contratos WHERE id = %d", $contrato_id));

        if (isset($_POST['guardar_nota'])) {
            $resultado = $wpdb->update(
                $tabla_contratos,
                ['notas' => sanitize_textarea_field($_POST['notas'])],
                ['id' => $contrato_id]
            );
            if ($resultado !== false) {
                echo "<script>alert('✅ Nota guardada correctamente');window.location='" . esc_url(site_url('/historial')) . "';</script>";
            } else {
                echo "<div class='rfy-error'>No se pudo guardar la nota.</div>";
            }
        }

        $GLOBALS['rfy_contrato_modal'] = $contrato;
    }

    // Obtener contratos activos
    $contratos = $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM $tabla_contratos WHERE id_usuario = %d AND papelera = 0 ORDER BY fin ASC", $id_usuario)
    );

    // Filtrado
    $q = isset($_GET['q']) ? trim($_GET['q']) : '';
    if (!empty($contratos)) {
        foreach ($contratos as $c) {
            $direccionCompleta = $c->calle;
            if (!empty($c->numero)) $direccionCompleta .= ' Nº ' . $c->numero;
            if (!empty($c->manzana)) $direccionCompleta .= ' M.' . $c->manzana;
            if (!empty($c->solar)) $direccionCompleta .= ' S.' . $c->solar;
            $direccionCompleta .= ', ' . $c->barrio . ', ' . $c->departamento;
            if (!empty($c->apartamento)) $direccionCompleta .= ' - Apto: ' . $c->apartamento;
            if (!empty($c->garage)) $direccionCompleta .= ' - Garage ' . $c->garage;

            $propietario = trim($c->prop_nombre . ' ' . $c->prop_apellido);
            $inquilino   = trim($c->inq_nombre . ' ' . $c->inq_apellido);

            if ($q === ''
                || stripos($direccionCompleta, $q) !== false
                || stripos($propietario, $q) !== false
                || stripos($inquilino, $q) !== false) {
                $contratosFiltrados[] = $c;
            }
        }
    }
}

// Variables disponibles para la vista
$GLOBALS['rfy_usuario']   = $usuario;
$GLOBALS['rfy_contratos'] = $contratosFiltrados;