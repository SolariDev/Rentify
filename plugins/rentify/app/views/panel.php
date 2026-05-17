<?php
defined('ABSPATH') || exit;
?>

<div class="rfy-panel">

  <!-- Nombre y apellido arriba a la derecha -->
  <div class="rfy-usuario">
    <?php echo esc_html($nombre_apellido); ?>
    <a href="<?php echo home_url('/inicio'); ?>" class="rfy-btn rfy-btn-cerrar">🔒cerrar sesión</a>
  </div>

  <!-- Bloque centrado: logo y botones -->
  <div class="rfy-botones-centrados">
    <img src="<?php echo plugins_url( 'assets/img/logoct.png', __DIR__ . '/../../rentify.php' ); ?>" alt="Logo Rentify" class="rfy-logo" />

    <div class="grupo-botones">
      <a href="<?php echo home_url('/nuevocontrato'); ?>" class="rfy-btn">Nuevo Contrato</a>
      <a href="<?php echo home_url('/historial'); ?>" class="rfy-btn">Historial</a>
    </div>
  </div>
</div>