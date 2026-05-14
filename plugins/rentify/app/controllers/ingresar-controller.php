<?php
defined('ABSPATH') || exit;

function rfy_handle_ingresar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['rfy_ingresar_nonce']) || 
            !wp_verify_nonce($_POST['rfy_ingresar_nonce'], 'rfy_ingresar_action')) {
            echo "<div class='rfy-error'>Acción no permitida.</div>";
            return;
        }

        global $wpdb;
        $tabla = $wpdb->prefix . 'rentify_usuarios';

        $correo   = sanitize_email($_POST['correo'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($correo && $password) {
            $usuario = $wpdb->get_row(
                $wpdb->prepare("SELECT * FROM $tabla WHERE correo = %s", $correo)
            );

            if ($usuario && password_verify($password, $usuario->password)) {
                // Iniciar sesión segura (usuario exclusivo de la app)
                if (!session_id()) {
                    session_start();
                }
                $_SESSION['rfy_usuario'] = $usuario->id_usuario;
                session_write_close();

                echo "<div class='rfy-exito'>Sesión iniciada correctamente.</div>";
                echo "<script>
                        setTimeout(() => {
                            window.location.href='" . esc_url(home_url('/panel')) . "';
                        }, 1000);
                      </script>";
            } else {
                echo "<div class='rfy-error'>Credenciales incorrectas.</div>";
            }
        } else {
            echo "<div class='rfy-error'>Faltan campos obligatorios.</div>";
        }
    }
}
add_action('init', 'rfy_handle_ingresar');