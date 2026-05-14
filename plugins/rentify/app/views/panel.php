<?php
defined('ABSPATH') || exit;
?>

<!-- shortcode: [rfy_panel] -->

<div class="rfy-panel">

  <!-- Nombre y apellido arriba a la derecha -->
  <div class="rfy-usuario">
    <?php echo esc_html($nombre_apellido); ?>
  </div>

  <!-- Bloque centrado: logo y botones -->
  <div class="rfy-botones-centrados">
    <img src="<?php echo plugins_url( 'assets/img/logoct.png', __DIR__ . '/../../rentify.php' ); ?>" alt="Logo Rentify" class="rfy-logo" />

    <div class="grupo-botones">
      <a href="<?php echo home_url('/nuevocontrato'); ?>" class="rfy-btn">Nuevo contrato</a>
      <a href="<?php echo home_url('/historial'); ?>" class="rfy-btn">Historial</a>
    </div>

    <!-- Botón de cerrar sesión centrado debajo -->
    <div class="cerrar-sesion">
      <a href="<?php echo home_url('/inicio'); ?>" class="rfy-btn rfy-btn-cerrar">
        🔒 Cerrar sesión
      </a>
    </div>
  </div>
</div>