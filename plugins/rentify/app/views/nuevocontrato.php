<?php
defined('ABSPATH') || exit;
?>

<div class="rfy-header">
  <div class="rfy-nav">
    <a href="<?php echo home_url('/panel'); ?>" class="rfy-btn">⚙️ Panel</a>
    <a href="<?php echo home_url('/historial'); ?>" class="rfy-btn">📂 Historial</a>
  </div>

  <div class="rfy-encabezado">
        <img src="<?php echo plugins_url('assets/img/isotipo.png',  dirname(__FILE__, 2)); ?>" alt="Logo Rentify" class="rfy-logo-pequeno" />
        <h2>Nuevo Contrato</h2>
  </div>

  <div class="rfy-usuario">
    <?php echo $nombre_apellido; ?>
  </div>
</div>

<div class="rfy-contrato">

<?php if (!empty($mensaje)) echo $mensaje; ?>

  <form method="post" class="rfy-form" autocomplete="off">
    <?php wp_nonce_field('rfy_nuevocontrato', 'rfy_nonce'); ?>

    <!-- Propiedad -->
    <fieldset>
      <legend>Propiedad</legend>
      <div class="rfy-doble">
        <div class="rfy-doble-item">
          <label for="calle">Calle</label>
          <input type="text" id="calle" name="calle" required>
        </div>
        <div class="rfy-doble-item">
          <label for="numero">N° de puerta</label>
          <input type="text" id="numero" name="numero">
        </div>
      </div>

      <div class="rfy-doble">
        <div class="rfy-doble-item">
          <label for="manzana">Manzana</label>
          <input type="text" id="manzana" name="manzana">
        </div>
        <div class="rfy-doble-item">
          <label for="solar">Solar</label>
          <input type="text" id="solar" name="solar">
        </div>
      </div>

      <div class="rfy-campo">
        <label for="barrio">Barrio / Localidad</label>
        <input type="text" id="barrio" name="barrio" required>
      </div>

      <div class="rfy-campo">
        <label for="departamento">Departamento</label>
        <select id="departamento" name="departamento" required>
        <option value="">Seleccione...</option>
        <option value="Artigas">Artigas</option>
        <option value="Canelones">Canelones</option>
        <option value="Cerro Largo">Cerro Largo</option>
        <option value="Colonia">Colonia</option>
        <option value="Durazno">Durazno</option>
        <option value="Flores">Flores</option>
        <option value="Florida">Florida</option>
        <option value="Lavalleja">Lavalleja</option>
        <option value="Maldonado">Maldonado</option>
        <option value="Montevideo">Montevideo</option>
        <option value="Paysandú">Paysandú</option>
        <option value="Río Negro">Río Negro</option>
        <option value="Rivera">Rivera</option>
        <option value="Rocha">Rocha</option>
        <option value="Salto">Salto</option>
        <option value="San José">San José</option>
        <option value="Soriano">Soriano</option>
        <option value="Tacuarembó">Tacuarembó</option>
        <option value="Treinta y Tres">Treinta y Tres</option>
        </select>
      </div>

      <div class="rfy-doble">
        <div class="rfy-doble-item">
          <label for="apartamento">Apartamento</label>
          <input type="text" id="apartamento" name="apartamento">
        </div>
        <div class="rfy-doble-item">
          <label for="garage">Garage</label>
          <input type="text" id="garage" name="garage">
        </div>
      </div>
    </fieldset>

    <!-- Propietario -->
    <fieldset>
      <legend>Propietario/a</legend>
      <div class="rfy-doble">
        <input type="text" name="prop_nombre" placeholder="Nombre" required>
        <input type="text" name="prop_apellido" placeholder="Apellido" required>
      </div>
      <input type="tel" name="prop_telefono" placeholder="Teléfono de contacto" required>
      <input type="email" name="prop_mail" placeholder="Mail" required>
    </fieldset>

    <!-- Inquilino -->
    <fieldset>
      <legend>Inquilino/a</legend>
      <div class="rfy-doble">
        <input type="text" name="inq_nombre" placeholder="Nombre" required>
        <input type="text" name="inq_apellido" placeholder="Apellido" required>
      </div>
      <input type="tel" name="inq_telefono" placeholder="Teléfono de contacto" required>
      <input type="email" name="inq_mail" placeholder="Mail" required>
    </fieldset>

    <!-- Condiciones -->
    <fieldset>
      <legend>Condiciones del contrato</legend>

      <!-- Precio del alquiler -->
      <div class="rfy-fila">
        <label for="precio_alquiler">Precio del alquiler</label>
        <div class="rfy-opciones">
          <label><input type="radio" name="moneda" value="UYU" required> $U</label>
          <label><input type="radio" name="moneda" value="USD"> $USD</label>          
        </div>
      </div>

      <div class="rfy-campo">
        <input type="text" id="precio_alquiler" name="precio_alquiler" value="0" required>
      </div>

      <!-- Tipo de reajuste -->
      <div class="rfy-fila">
        <label for="tipo_reajuste">Tipo de reajuste</label>
        <div class="rfy-opciones">
          <label><input type="radio" name="tipo_reajuste" value="IPC" required> IPC</label>
          <label><input type="radio" name="tipo_reajuste" value="URA"> URA</label>
          <label><input type="radio" name="tipo_reajuste" value="Ley 14.219"> Ley 14.219</label>
        </div>
      </div>

      <!-- Garantía -->
      <div class="rfy-campo">
        <label for="garantia">Garantía</label>
        <select id="garantia" name="garantia" required>
          <option>SANCOR</option>
          <option>PORTO SEGURO</option>
          <option>MAPFRE</option>
          <option>SURA</option>
          <option>ZURICH</option>
          <option>ANDA</option>
          <option>CGM</option>
          <option>DEPÓSITO EN BHU</option>
          <option>PROPIEDAD</option>
        </select>
      </div>

      <!-- Duración -->
      <label for="duracion_anios" class="rfy-label">Duración del contrato</label>
      <div class="rfy-doble">
        <div class="rfy-doble-item">
          <label for="duracion_anios">Años</label>
          <select id="duracion_anios" name="duracion_anios">
            <option value="0">0</option>
            <option value="1">1 año</option>
            <option value="2">2 años</option>
            <option value="3">3 años</option>
            <option value="4">4 años</option>
            <option value="5">5 años</option>
          </select>
        </div>
        <div class="rfy-doble-item">
          <label for="duracion_meses">Meses</label>
          <select id="duracion_meses" name="duracion_meses">
            <option value="0">0 meses</option>
            <option value="1">1 mes</option>
            <option value="2">2 meses</option>
            <option value="3">3 meses</option>
            <option value="4">4 meses</option>
            <option value="5">5 meses</option>
            <option value="6">6 meses</option>
            <option value="7">7 meses</option>
            <option value="8">8 meses</option>
            <option value="9">9 meses</option>
            <option value="10">10 meses</option>
            <option value="11">11 meses</option>
          </select>
        </div>
      </div>

      <!-- Fechas -->
      <div class="rfy-doble">
        <div class="rfy-doble-item">
          <label for="inicio">Fecha de inicio</label>
          <input type="date" id="inicio" name="inicio" required>
        </div>
        <div class="rfy-doble-item">
          <label for="fin">Fecha de término</label>
          <input type="date" id="fin" name="fin" readonly>
        </div>
      </div>

      <!-- Link de carpeta Drive -->
      <div class="rfy-campo">
        <label for="link_drive">Link de carpeta Drive</label>
        <input type="url" id="link_drive" name="link_drive" placeholder="https://..." required>
      </div>
    </fieldset>

    <!-- Botón -->
    <div class= "rfy-boton-guardar">
      <button type="submit" class="rfy-btn">Guardar Contrato</button>
    </div>
  </form>
</div>

<script>
function calcularFechaFin() {
  const inicio = document.getElementById('inicio').value;
  const anios = parseInt(document.getElementById('duracion_anios').value) || 0;
  const meses = parseInt(document.getElementById('duracion_meses').value) || 0;

  if (!inicio) return;

  const fechaInicio = new Date(inicio);
  const fechaFin = new Date(fechaInicio);
  fechaFin.setFullYear(fechaFin.getFullYear() + anios);
  fechaFin.setMonth(fechaFin.getMonth() + meses);

  const dia = fechaInicio.getDate();
  if (fechaFin.getDate() !== dia) {
    fechaFin.setDate(0);
  }

  const yyyy = fechaFin.getFullYear();
  const mm = String(fechaFin.getMonth() + 1).padStart(2, '0');
  const dd = String(fechaFin.getDate()).padStart(2, '0');
  document.getElementById('fin').value = `${yyyy}-${mm}-${dd}`;
}

document.getElementById('inicio').addEventListener('change', calcularFechaFin);
document.getElementById('duracion_anios').addEventListener('change', calcularFechaFin);
document.getElementById('duracion_meses').addEventListener('change', calcularFechaFin);
window.addEventListener('DOMContentLoaded', calcularFechaFin);
</script>