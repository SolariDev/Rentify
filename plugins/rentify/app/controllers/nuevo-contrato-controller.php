<?php
defined('ABSPATH') || exit;

session_start();

$id_usuario = $_SESSION['rfy_usuario'] ?? 0;
$nombre_apellido = '';

global $wpdb;
$tabla_usuarios  = $wpdb->prefix . 'rentify_usuarios';
$tabla_contratos = $wpdb->prefix . 'rentify_contratos';

if ($id_usuario > 0) {
    $usuario = $wpdb->get_row(
        $wpdb->prepare("SELECT nombre, apellido FROM $tabla_usuarios WHERE id_usuario = %d", $id_usuario)
    );
    $nombre_apellido = $usuario ? esc_html($usuario->nombre . ' ' . $usuario->apellido) : 'Usuario no registrado';
} else {
    $nombre_apellido = 'Sesión no iniciada';
}

    $mensaje = '';

    // Procesar POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['rfy_nonce']) || !wp_verify_nonce($_POST['rfy_nonce'], 'rfy_nuevocontrato')) {
            $mensaje = "<div class='rfy-error'>Solicitud inválida.</div>";
        }else {
            $anios = intval($_POST['duracion_anios'] ?? 0);
            $meses = intval($_POST['duracion_meses'] ?? 0);
            $tiempo_contrato = ($anios > 0 ? $anios . ' año' . ($anios > 1 ? 's' : '') : '');
            if ($meses > 0) {
                $tiempo_contrato .= ($tiempo_contrato ? ' ' : '') . $meses . ' mes' . ($meses > 1 ? 'es' : '');
            }
            if ($tiempo_contrato === '') $tiempo_contrato = '0 meses';

            $link_drive_input = $_POST['link_drive'] ?? '';
            $link_drive = !empty($link_drive_input) ? filter_var($link_drive_input, FILTER_VALIDATE_URL) : '';
            if (!empty($link_drive_input) && !$link_drive) {
                $mensaje = "<div class='rfy-error'>El link de Drive no es válido.</div>";
            } else {
                $precio_input = $_POST['precio_alquiler'] ?? '0';
                    $precio_input = str_replace('.', '', $precio_input);
                    $precio_input = str_replace(',', '.', $precio_input);
                    $precio_alquiler = floatval($precio_input);
                $datos = [
                    'id_usuario'      => $id_usuario,
                    'calle'           => sanitize_text_field($_POST['calle'] ?? ''),
                    'numero'          => sanitize_text_field($_POST['numero'] ?? ''),
                    'manzana'         => sanitize_text_field($_POST['manzana'] ?? ''),
                    'solar'           => sanitize_text_field($_POST['solar'] ?? ''),
                    'barrio'          => sanitize_text_field($_POST['barrio'] ?? ''),
                    'departamento'    => sanitize_text_field($_POST['departamento'] ?? ''),
                    'apartamento'     => sanitize_text_field($_POST['apartamento'] ?? ''),
                    'garage'          => sanitize_text_field($_POST['garage'] ?? ''),
                    'prop_nombre'     => sanitize_text_field($_POST['prop_nombre'] ?? ''),
                    'prop_apellido'   => sanitize_text_field($_POST['prop_apellido'] ?? ''),
                    'prop_telefono'   => sanitize_text_field($_POST['prop_telefono'] ?? ''),
                    'prop_mail'       => sanitize_email($_POST['prop_mail'] ?? ''),
                    'inq_nombre'      => sanitize_text_field($_POST['inq_nombre'] ?? ''),
                    'inq_apellido'    => sanitize_text_field($_POST['inq_apellido'] ?? ''),
                    'inq_telefono'    => sanitize_text_field($_POST['inq_telefono'] ?? ''),
                    'inq_mail'        => sanitize_email($_POST['inq_mail'] ?? ''),
                    'precio_alquiler' => $precio_alquiler,
                    'moneda'          => sanitize_text_field($_POST['moneda'] ?? ''),
                    'garantia'        => sanitize_text_field($_POST['garantia'] ?? ''),
                    'duracion_anios'  => $anios,
                    'duracion_meses'  => $meses,
                    'tiempo_contrato' => $tiempo_contrato,
                    'inicio'          => sanitize_text_field($_POST['inicio'] ?? ''),
                    'fin'             => sanitize_text_field($_POST['fin'] ?? ''),
                    'link_drive'      => $link_drive ? esc_url_raw($link_drive_input) : '',
                    'tipo_reajuste'   => sanitize_text_field($_POST['tipo_reajuste'] ?? ''),
                    'fecha_creacion'  => current_time('mysql')
                ];

                $resultado = $wpdb->insert($tabla_contratos, $datos);
                $mensaje = $resultado !== false ? "<div class='rfy-exito'>Contrato registrado correctamente.</div>" : "<div class='rfy-error'>Error al registrar el contrato: " . esc_html($wpdb->last_error) . "</div>";
                }
            }
        }