<?php
defined('ABSPATH') || exit;
?>

<div class="rfy-botones-centrados rfy-noscroll">
  
  <?php
  $logo_url = plugins_url( 'assets/img/logoct.png', __DIR__ . '/../../rentify.php' );
  $gs_logo_url = plugins_url( 'assets/img/logogs.png', __DIR__ . '/../../rentify.php' );
?>

  <img src="<?php echo esc_url( $logo_url ); ?>"
       alt="Logo Rentify"
       class="rfy-logo"/>

  <!-- Misión institucional -->
  <p class="rfy-intro">
    <strong>Optimiza la gestión de contratos.</strong><br>
    <strong>Conectando soluciones para la organización.</strong>
  </p>

  <!-- Botones de acción -->
  <div class="grupo-botones">
    <a href="<?php echo home_url('/registro'); ?>" class="rfy-btn">Registro</a>
    <a href="<?php echo home_url('/ingresar'); ?>" class="rfy-btn">Iniciar sesión</a>
  </div>
  
  <img src="<?php echo esc_url( $gs_logo_url ); ?>"
       alt="Logo Gabriel Solari"
       class="rfy-gs-logo"/>
</div>