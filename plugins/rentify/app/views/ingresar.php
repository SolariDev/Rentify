<?php
defined('ABSPATH') || exit;
?>

<!-- shortcode: [rfy_ingresar] -->

<div class="rfy-ingreso">
    <div class="rfy-logo">
        <img src="<?php echo plugins_url('assets/img/logoct.png', dirname(__FILE__, 2)); ?>" alt="Logo Rentify" />
    </div>

    <h2>Ingresar</h2>

    <!-- Formulario de ingreso -->
    <form method="post" action="">
        <?php wp_nonce_field('rfy_ingresar_action', 'rfy_ingresar_nonce'); ?>

        <div class="rfy-campo">
            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" required
                   autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false">
        </div>

        <div class="rfy-campo">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required
                   autocomplete="new-password" autocorrect="off" autocapitalize="none" spellcheck="false">
        </div>

        <button type="submit" class="rfy-btn">Iniciar sesión</button>

        <div class="rfy-link">
            <a href="<?php echo esc_url(home_url('/cambiar-password')); ?>" class="rfy-link">
                ¿Olvidaste tu contraseña?
            </a>
        </div>
    </form>
</div>