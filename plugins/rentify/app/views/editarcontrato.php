<?php
defined('ABSPATH') || exit;

/** @var object|null $contrato */
/** @var string $nombre_apellido */
/** @var string $mensaje */
?>

<div class="rfy-header">
  <div class="rfy-nav">
    <a href="<?php echo home_url('/panel'); ?>" class="rfy-btn">⚙️ Panel</a>
    <a href="<?php echo home_url('/historial'); ?>" class="rfy-btn">📂 Historial</a>
  </div>

  <div class="rfy-encabezado">
    <h2>Editar Contrato</h2>
    <img src="<?php echo plugins_url('assets/img/isotipo.png', dirname(__FILE__, 2)); ?>" alt="Logo Rentify" class="rfy-logo-pequeno" />
  </div>

  <div class="rfy-usuario">
    <?php echo esc_html($nombre_apellido); ?>
  </div>
</div>

<div class="rfy-contrato">
  <?php if (!empty($mensaje)) echo $mensaje; ?>

  <?php if ($contrato): ?>
    <form method="post" class="rfy-form" autocomplete="off">
      <?php wp_nonce_field('rfy_editarcontrato', 'rfy_nonce'); ?>

      <!-- Propiedad -->
      <fieldset>
        <div class="rfy-legend"><legend>Propiedad</legend></div>

        <div class="rfy-doble">
          <div class="rfy-doble-item">
            <label for="calle">Calle</label>
            <input type="text" id="calle" name="calle" value="<?php echo esc_attr($contrato->calle ?? ''); ?>" required>
          </div>
          <div class="rfy-doble-item">
            <label for="numero">N° de puerta</label>
            <input type="text" id="numero" name="numero" value="<?php echo esc_attr($contrato->numero ?? ''); ?>">
          </div>
        </div>

        <div class="rfy-doble">
          <div class="rfy-doble-item">
            <label for="manzana">Manzana</label>
            <input type="text" id="manzana" name="manzana" value="<?php echo esc_attr($contrato->manzana ?? ''); ?>">
          </div>
          <div class="rfy-doble-item">
            <label for="solar">Solar</label>
            <input type="text" id="solar" name="solar" value="<?php echo esc_attr($contrato->solar ?? ''); ?>">
          </div>
        </div>

        <div class="rfy-doble">
          <div class="rfy-doble-item">
            <label for="apartamento">Apartamento</label>
            <input type="text" id="apartamento" name="apartamento" value="<?php echo esc_attr($contrato->apartamento ?? ''); ?>">
          </div>
          <div class="rfy-doble-item">
            <label for="garage">Garage</label>
            <input type="text" id="garage" name="garage" value="<?php echo esc_attr($contrato->garage ?? ''); ?>">
          </div>
        </div>

        <div class="rfy-campo">
          <label for="barrio">Barrio / Localidad</label>
          <input type="text" id="barrio" name="barrio" value="<?php echo esc_attr($contrato->barrio ?? ''); ?>" required>
        </div>

        <div class="rfy-campo">
          <label for="departamento">Departamento</label>
          <select id="departamento" name="departamento" required>
            <?php
              $departamentos = ['Artigas','Canelones','Cerro Largo','Colonia','Durazno','Flores','Florida','Lavalleja','Maldonado','Montevideo','Paysandú','Río Negro','Rivera','Rocha','Salto','San José','Soriano','Tacuarembó','Treinta y Tres'];
              foreach ($departamentos as $d) {
                echo '<option value="'.esc_attr($d).'" '.selected(($contrato->departamento ?? ''), $d, false).'>'.$d.'</option>';
              }
            ?>
          </select>
        </div>
      </fieldset>

          <!-- Propietario -->
      <fieldset>
        <legend>Propietario/a</legend>
        <div class="rfy-doble">
          <input type="text" name="prop_nombre" value="<?php echo esc_attr($contrato->prop_nombre ?? ''); ?>" placeholder="Nombre" required>
          <input type="text" name="prop_apellido" value="<?php echo esc_attr($contrato->prop_apellido ?? ''); ?>" placeholder="Apellido" required>
        </div>
        <input type="tel" name="prop_telefono" value="<?php echo esc_attr($contrato->prop_telefono ?? ''); ?>" placeholder="Teléfono de contacto" required>
        <input type="email" name="prop_mail" value="<?php echo esc_attr($contrato->prop_mail ?? ''); ?>" placeholder="Mail" required>
      </fieldset>

    <!-- Inquilino -->
      <fieldset>
        <legend>Inquilino/a</legend>
        <div class="rfy-doble">
          <input type="text" name="inq_nombre" value="<?php echo esc_attr($contrato->inq_nombre ?? ''); ?>" placeholder="Nombre" required>
          <input type="text" name="inq_apellido" value="<?php echo esc_attr($contrato->inq_apellido ?? ''); ?>" placeholder="Apellido" required>
        </div>
        <input type="tel" name="inq_telefono" value="<?php echo esc_attr($contrato->inq_telefono ?? ''); ?>" placeholder="Teléfono de contacto" required>
        <input type="email" name="inq_mail" value="<?php echo esc_attr($contrato->inq_mail ?? ''); ?>" placeholder="Mail" required>
      </fieldset>

    <!-- Condiciones -->
    <fieldset>
      <legend>Condiciones del contrato</legend>
        <!-- Precio del alquiler -->
        <div class="rfy-fila">
          <label for="precio_alquiler">Precio del alquiler</label>
          <div class="rfy-opciones">
            <label><input type="radio" name="moneda" value="UYU" <?php checked($contrato->moneda ?? '', 'UYU'); ?> required> $U</label>
            <label><input type="radio" name="moneda" value="USD" <?php checked($contrato->moneda ?? '', 'USD'); ?>> $USD</label>
          </div>
        </div>
        <div class="rfy-campo">
          <input type="text" id="precio_alquiler" name="precio_alquiler" value="<?php echo esc_attr($contrato->precio_alquiler ?? '0'); ?>" required>
        </div>

      <!-- Tipo de reajuste -->
        <div class="rfy-fila">
          <label for="tipo_reajuste">Tipo de reajuste</label>
          <div class="rfy-opciones">
            <label><input type="radio" name="tipo_reajuste" value="IPC" <?php checked($contrato->tipo_reajuste ?? '', 'IPC'); ?> required> IPC</label>
            <label><input type="radio" name="tipo_reajuste" value="URA" <?php checked($contrato->tipo_reajuste ?? '', 'URA'); ?>> URA</label>
            <label><input type="radio" name="tipo_reajuste" value="Ley 14.219" <?php checked($contrato->tipo_reajuste ?? '', 'Ley 14.219'); ?>> Ley 14.219</label>
          </div>
        </div>

      <!-- Garantía -->
      <div class="rfy-campo">
        <label for="garantia">Garantía</label>
        <select id="garantia" name="garantia" required>
        <?php
          $garantias = ['SANCOR','PORTO SEGURO','MAPFRE','SURA','ZURICH','ANDA','CGM','DEPÓSITO EN BHU','PROPIEDAD'];
          foreach ($garantias as $g) {
            echo '<option value="'.esc_attr($g).'" '.selected(($contrato->garantia ?? ''), $g, false).'>'.$g.'</option>';
          }
        ?> 
        </select>
      </div>

        <!-- Duración -->
        <label for="duracion_anios" class="rfy-label">Duración del contrato</label>
        <div class="rfy-doble">
          <div class="rfy-doble-item">
            <label for="duracion_anios">Años</label>
            <select id="duracion_anios" name="duracion_anios">
              <?php for ($i=0;$i<=5;$i++) {
                echo '<option value="'.$i.'" '.selected(($contrato->duracion_anios ?? 0), $i, false).'>'.$i.' año(s)</option>';
              } ?>
            </select>
          </div>
          <div class="rfy-doble-item">
            <label for="duracion_meses">Meses</label>
            <select id="duracion_meses" name="duracion_meses">
              <?php for ($i=0;$i<=11;$i++) {
                echo '<option value="'.$i.'" '.selected(($contrato->duracion_meses ?? 0), $i, false).'>'.$i.' mes(es)</option>';
              } ?>
            </select>
          </div>
        </div>

        <!-- Fechas -->
      <div class="rfy-doble">
        <div class="rfy-doble-item">
          <label for="inicio">Fecha de inicio</label>
          <input type="date" id="inicio" name="inicio" value="<?php echo esc_attr($contrato->inicio ?? ''); ?>" required>
        </div>
        <div class="rfy-doble-item">
          <label for="fin">Fecha de término</label>
          <input type="date" id="fin" name="fin" value="<?php echo esc_attr($contrato->fin ?? ''); ?>" readonly>
        </div>
      </div>
      
      <!-- Link de carpeta Drive -->
      <div class="rfy-campo">
        <label for="link_drive">Link de carpeta Drive</label>
        <input type="url" name="link_drive" value="<?php echo esc_attr($contrato->link_drive ?? ''); ?>">
      </div>
    </fieldset>

      <?php if ($contrato && !empty($contrato->link_drive)): ?>
        <div class="rfy-link"> 
          <a href="<?php echo esc_url($contrato->link_drive); ?>" target="_blank" class="rfy-link">Abrir carpeta en Drive</a>
        </div>
        <?php endif; ?>
      
      <div class="rfy-boton-guardar">
        <button type="submit" class="rfy-btn">Guardar cambios</button>
      </div>
    </form>
  <?php else: ?>
    <div class="rfy-error">Contrato no encontrado.</div>
  <?php endif; ?>
</div>