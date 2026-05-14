<?php
defined('ABSPATH') || exit;
?>

<!-- shortcode: [rfy_inicio] -->

<div class="rfy-botones-centrados rfy-noscroll">
  
  <?php
  $logo_url = plugins_url( 'assets/img/logoct.png', __DIR__ . '/../../rentify.php' );
  $gaia_logo_url = plugins_url( 'assets/img/gsisotipo.png', __DIR__ . '/../../rentify.php' );
?>

  <img src="<?php echo esc_url( $logo_url ); ?>"
       alt="Logo Rentify"
       class="rfy-logo"/>

  <!-- Misión institucional -->
  <p class="rfy-intro">
    <strong>Rentify</strong> es un producto de <strong>Gaia Synapse</strong>.<br>
    Conectando soluciones para la organización.
  </p>

  <!-- Botones de acción -->
  <div class="grupo-botones">
    <a href="<?php echo home_url('/registro'); ?>" class="rfy-btn">Registro</a>
    <a href="<?php echo home_url('/ingresar'); ?>" class="rfy-btn">Iniciar sesión</a>
  </div>
    <!-- Logo Gaia Synapse institucional -->
  <img src="<?php echo esc_url( $gaia_logo_url ); ?>"
       alt="Logo Gaia Synapse"
       class="rfy-gaia-logo"/>
</div>