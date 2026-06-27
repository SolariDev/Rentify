<?php
defined('ABSPATH') || exit;

$usuario   = $GLOBALS['rfy_usuario'] ?? null;
$contratos = $GLOBALS['rfy_contratos'] ?? [];
?>

<div class="rfy-header">
  <div class="rfy-nav">
    <a href="<?php echo home_url('/panel'); ?>" class="rfy-btn">⚙️ Panel</a>
    <a href="<?php echo home_url('/papelera'); ?>" class="rfy-btn">🗑️ Papelera</a>
  </div>

  <div class="rfy-encabezado">
    <img src="<?php echo RENTIFY_URL . 'assets/img/isotipo.png'; ?>" alt="Logo Rentify" class="rfy-logo-pequeno" />
    <h2>Historial de Contratos</h2>
  </div>

  <div class="rfy-usuario">
    <?php echo $usuario ? esc_html($usuario->nombre . ' ' . $usuario->apellido) : 'No hay usuario registrado'; ?>
  </div>
</div>

<div class="rfy-historial">
    <div class="rfy-historial-search">
        <form method="get" action="">
        <input type="text" name="q" placeholder="Buscar por..." />
        <button type="submit" class="rfy-btn">🔍</button>
        <a href="<?php echo site_url('/historial'); ?>" class="rfy-btn">📁 Ver todos</a>
        </form>
    </div>
</div>

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
        <th>Notas</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($contratos as $c): 
        $hoy = new DateTime();
        $fin = new DateTime($c->fin);
        $diff = $hoy->diff($fin)->days;
        $color = ($fin < $hoy) ? 'rojo' : (($diff <= 90) ? 'amarillo' : 'verde');

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
        <tr class="rfy-estado-<?php echo $color; ?>">
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
              <a href="<?php echo home_url('/editarcontrato?id=' . $c->id); ?>" title="Editar contrato">
                <img src="<?php echo esc_url(RENTIFY_URL . 'assets/img/edit.png'); ?>" alt="Editar">
              </a>
              <a href="?accion=papelera&id=<?php echo intval($c->id); ?>"
                 onclick="return confirm('🗑️ ¿Querés enviar el contrato <?php echo addslashes($c->id);?> a la papelera?');"
                 class="rfy-papelera" title="Enviar a papelera">
                <img src="<?php echo esc_url(RENTIFY_URL . 'assets/img/papelera.png'); ?>" alt="Papelera">
              </a>
            </div>
          </td>
          <td>
            <a href="<?php echo add_query_arg(['accion' => 'notas', 'id'=> $c->id]); ?>" title="Notas">
              <img src="<?php echo esc_url(RENTIFY_URL . 'assets/img/notas.png'); ?>" alt="Notas">
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <?php if (empty($contratos)): ?>
    <div class="rfy-papelera-vacia">
    <p>No hay contratos registrados.</p>
    </div>
  <?php else: ?>
    <p>No se encontraron resultados para la búsqueda.</p>
  <?php endif; ?>
<?php endif; ?>
</div>

<?php
// Modal de notas
if (!empty($GLOBALS['rfy_contrato_modal'])) {
    $contrato = $GLOBALS['rfy_contrato_modal'];
    ?>
    <div id="modalNotas" class="modal">
      <div class="modal-contenido">
        <h2>Notas del contrato #<?php echo $contrato->id; ?></h2>
        <form method="post">
          <textarea name="notas"><?php echo esc_textarea($contrato->notas); ?></textarea>
          <br>
          <button type="submit" name="guardar_nota">Guardar</button>
          <button type="button" onclick="cerrarModal()">Cerrar</button>
        </form>
      </div>
    </div>
    <script>
      function cerrarModal() {
        document.getElementById('modalNotas').style.display = 'none';
      }
      document.getElementById('modalNotas').style.display = 'block';
    </script>
    <?php
}
?>