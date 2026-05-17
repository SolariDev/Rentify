<?php
defined('ABSPATH') || exit;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rfy_ingresar_nonce'])) {
        if (!wp_verify_nonce($_POST['rfy_ingresar_nonce'], 'rfy_ingresar_action')) {
            echo "<div class='rfy-error'>Acción no permitida.</div>";
        } else {
            global $wpdb;
            $tabla = $wpdb->prefix . 'rentify_usuarios';

            $correo   = sanitize_email($_POST['correo'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($correo && $password) {
                $usuario = $wpdb->get_row(
                    $wpdb->prepare("SELECT * FROM $tabla WHERE correo = %s", $correo)
                );

                if ($usuario && password_verify($password, $usuario->password)) {
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