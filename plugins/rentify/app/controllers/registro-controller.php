<?php
defined('ABSPATH') || exit;

class RegistroController {

    public static function procesar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        global $wpdb;
        $tabla = $wpdb->prefix . 'rentify_usuarios';

        // Sanitización de entradas
        $nombre   = sanitize_text_field($_POST['nombre'] ?? '');
        $apellido = sanitize_text_field($_POST['apellido'] ?? '');
        $correo   = sanitize_email($_POST['correo'] ?? '');
        $password = $_POST['password'] ?? '';

        // Validación básica
        if (empty($nombre) || empty($apellido) || empty($correo) || empty($password)) {
            self::mensajeError('Faltan campos obligatorios en el formulario.');
            return;
        }

        // Verificar si el correo ya existe
        $existe = $wpdb->get_var(
            $wpdb->prepare("SELECT COUNT(*) FROM $tabla WHERE correo = %s", $correo)
        );

        if ($existe > 0) {
            self::mensajeError('El correo ya está registrado.');
            return;
        }

        // Hash seguro de contraseña
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Inserción segura
        $insertado = $wpdb->insert(
            $tabla,
            [
                'nombre'   => $nombre,
                'apellido' => $apellido,
                'correo'   => $correo,
                'password' => $hash
            ],
            ['%s','%s','%s','%s']
        );

        if ($insertado) {
            $id_usuario = $wpdb->insert_id;

            // Iniciar sesión segura
            if (!session_id()) {
                session_start();
            }
            $_SESSION['rentify_usuario'] = $id_usuario;
            session_write_close();

            self::mensajeExito('Usuario registrado correctamente. Redirigiendo a iniciar sesión...');
            echo "<script>
                    setTimeout(function(){
                        window.location.href = '" . esc_url(home_url('/ingresar')) . "';
                    }, 3000);
                  </script>";
        } else {
            self::mensajeError('Error al registrar el usuario. Intente nuevamente.');
        }
    }

    private static function mensajeExito($texto) {
        echo "<div class='rfy-exito'>" . esc_html($texto) . "</div>";
    }

    private static function mensajeError($texto) {
        echo "<div class='rfy-error'>" . esc_html($texto) . "</div>";
    }
}