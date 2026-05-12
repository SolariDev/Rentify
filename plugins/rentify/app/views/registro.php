<?php
defined('ABSPATH') || exit;
?>

<!-- shortcode: [rfy_registro] -->

<div class="rfy-registro rfy-noscroll">

    <?php
    $logo_url = plugins_url( 'assets/img/logoct.png', __DIR__ . '/../../rentify.php' );
    ?>
    <img src="<?php echo $logo_url; ?>" alt="Logo Rentify" class="rfy-logo" />  
    <h2 class="rfy-titulo">Crea tu cuenta</h2>

    <form method="post" action="">
        <div class="rfy-doble">
            <div class="rfy-doble-item">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="rfy-doble-item">
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" required>
            </div>
        </div>

        <div class="rfy-campo">
            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" required autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false">
        </div>

        <div class="rfy-campo">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required autocomplete="new-password">
        </div>

        <button type="submit" class="rfy-btn-registro">Registrate</button>
    </form>

    <div class="rfy-link">
        <a href="<?php echo home_url('/ingresar'); ?>" class="rfy-enlace-ingreso">¿Ya tenés cuenta? Inicia sesión</a>
    </div>
</div>