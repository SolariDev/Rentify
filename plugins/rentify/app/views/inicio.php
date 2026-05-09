<!-- shortcode: [rfy_inicio] -->

<div>
    <!-- Logo institucional -->
    <?php
    // Construir la URL del logo desde la raíz del plugin
    $logo_url = plugin_dir_url( dirname(__DIR__) ) . 'assets/logoct.png';
    ?>
    <img src="<?php echo esc_url( $logo_url ); ?>"
         alt="Logo Rentify"
         style="max-width:280px; margin-bottom:0px;"/>

    <!-- Misión institucional -->
    <p>El plugin está activo</p>
</div>