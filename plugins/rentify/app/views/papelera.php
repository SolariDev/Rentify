<?php
defined('ABSPATH') || exit;

$usuario   = $GLOBALS['rfy_usuario'] ?? null;
$contratos = $GLOBALS['rfy_contratos_papelera'] ?? [];
?>

<div class="rfy-header">
  <div class="rfy-nav">
    <a href="<?php echo home_url('/panel'); ?>" class="rfy-btn">⚙️ Panel</a>
    <a href="<?php echo home_url('/historial'); ?>" class="rfy-btn">📂 Historial</a>
  </div>

  <div class="rfy-encabezado">
    <img src="<?php echo RENTIFY_URL . 'assets/img/isotipo.png'; ?>" alt="Logo Rentify" class="rfy-logo-pequeno" />
    <h2>Papelera</h2>
  </div>

  <div class="rfy-usuario">
    <?php echo $usuario ? esc_html($usuario->nombre . ' ' . $usuario->apellido) : 'No hay usuario registrado'; ?>
  </div>
</div>

<div class="rfy-papelera-acciones">
  <form method="post" class="rfy-form-vaciar" onsubmit="return confirm('⚠️ ¿Seguro que querés vaciar toda la papelera? Esta acción no se puede deshacer.');">
    <?php wp_nonce_field('rfy_papelera', 'rfy_nonce'); ?>
    <input type="hidden" name="accion" value="vaciar_papelera">
    <button type="submit" class="rfy-btn rfy-btn-peligro">🗑️ Vaciar papelera</button>
  </form>
</div>

<div class="rfy-historial">
  <?php if (!empty($GLOBALS['rfy_mensaje_error'])): ?>
    <div class="rfy-error"><?php echo esc_html($GLOBALS['rfy_mensaje_error']); ?></div>
  <?php endif; ?>

  <?php if (!empty($GLOBALS['rfy_mensaje_exito'])): ?>
    <div class="rfy-exito"><?php echo esc_html($GLOBALS['rfy_mensaje_exito']); ?></div>
  <?php endif; ?>

  <?php if (!empty($contratos)): ?>
    
    <table class="rfy-historial-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Dirección</th>
          <th>Propietario</th>
          <th>Inquilino</th>
          <th>Monto</th>
          <th>Reajuste</th>
          <th>Garantía</th>
          <th>Inicio</th>
          <th>Fin</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($contratos as $c): 
          $direccionCompleta = $c->calle;
          if (!empty($c->numero)) $direccionCompleta .= ' Nº ' . $c->numero;
          if (!empty($c->manzana)) $direccionCompleta .= ' M.' . $c->manzana;
          if (!empty($c->solar)) $direccionCompleta .= ' S.' . $c->solar;
          $direccionCompleta .= ', ' . $c->barrio . ', ' . $c->departamento;
          if (!empty($c->apartamento)) $direccionCompleta .= ' - Apto: ' . $c->apartamento;
          if (!empty($c->garage)) $direccionCompleta .= ' - Garage ' . $c->garage;

          $monto = number_format($c->precio_alquiler, 0, ',', '.');
          $monto = ($c->moneda === 'UYU') ? '$U ' . $monto : (($c->moneda === 'USD') ? '$USD ' . $monto : $monto);
        ?>
          <tr>
            <td><?php echo esc_html($c->id); ?></td>
            <td class="td-direccion" title="<?php echo esc_html($direccionCompleta); ?>">
              <?php 
                $direccionResumida = mb_substr($direccionCompleta, 0, 40);
                $direccionResumida = preg_replace('/\s+\S*$/u', '', $direccionResumida);
                echo esc_html($direccionResumida . '...');
              ?>
            </td>
            <td><?php echo esc_html($c->prop_nombre . ' ' . $c->prop_apellido); ?></td>
            <td><?php echo esc_html($c->inq_nombre . ' ' . $c->inq_apellido); ?></td>
            <td class="td-monto"><?php echo esc_html($monto); ?></td>
            <td><?php echo esc_html($c->tipo_reajuste); ?></td>
            <td><?php echo esc_html($c->garantia); ?></td>
            <td><?php echo date('d/m/Y', strtotime($c->inicio)); ?></td>
            <td><?php echo date('d/m/Y', strtotime($c->fin)); ?></td>
            <td>
              <div class="rfy-acciones">
                <a href="?accion=restaurar&id=<?php echo intval($c->id); ?>"
                   title="Restaurar contrato">
                  <img src="<?php echo esc_url(RENTIFY_URL . 'assets/img/restaurar.png'); ?>" alt="Restaurar">
                </a>
                <a href="?accion=eliminar&id=<?php echo intval($c->id); ?>"
                   onclick="return confirm('⚠️ ¿Querés eliminar permanentemente el contrato <?php echo addslashes($c->id); ?>? Esta acción no se puede deshacer.');"
                   title="Eliminar permanentemente">
                  <img src="<?php echo esc_url(RENTIFY_URL . 'assets/img/eliminar.png'); ?>" alt="Eliminar">
                </a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="rfy-papelera-vacia">
      <p>La papelera está vacía.</p>      
    </div>
  <?php endif; ?>
</div>