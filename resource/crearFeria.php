<div class="modal fade" id="crearFeriaModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <form id="crearFeriaForm" action="../app/backend/procesar_crear_feria.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Crear feria</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
          </div>
          <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="fecha_inicio" class="form-label">Fecha y hora de inicio</label>
              <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="fecha_fin" class="form-label">Fecha y hora de fin</label>
              <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin" required>
            </div>
          </div>
          <h5 class="mt-3">Ubicación</h5>
          <div class="mb-3">
            <label for="provincia" class="form-label">Provincia</label>
            <input type="text" class="form-control" id="provincia" name="provincia" required>
          </div>
          <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
          </div>
          <div id="map" class="mb-3" style="height: 300px;"></div>
          <input type="hidden" id="lat">
          <input type="hidden" id="lng">
          <input type="hidden" id="ubicacion_json" name="ubicacion_json">
          <h5 class="mt-3">Imagen</h5>
          <div class="mb-3">
            <label for="image_url" class="form-label">URL de imagen</label>
            <input type="url" class="form-control" id="image_url" name="image_url">
          </div>
          <div class="mb-3">
            <label for="image_file" class="form-label">Subir imagen</label>
            <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*">
          </div>
          <div id="imageError" class="text-danger small"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar feria</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
let map;
let marker;

function initMap() {
  const defaultPos = { lat: -34.6037, lng: -58.3816 };
  map = new google.maps.Map(document.getElementById('map'), {
    center: defaultPos,
    zoom: 5
  });

  map.addListener('click', function(e) {
    if (marker) {
      marker.setPosition(e.latLng);
    } else {
      marker = new google.maps.Marker({
        position: e.latLng,
        map: map
      });
    }
    document.getElementById('lat').value = e.latLng.lat();
    document.getElementById('lng').value = e.latLng.lng();
  });
}

document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('crearFeriaModal').addEventListener('shown.bs.modal', function () {
    if (map) {
      google.maps.event.trigger(map, 'resize');
    }
  });

  var form = document.getElementById('crearFeriaForm');
  form.addEventListener('submit', function(e) {
    var url = document.getElementById('image_url').value.trim();
    var file = document.getElementById('image_file').files[0];
    if (url && file) {
      e.preventDefault();
      document.getElementById('imageError').textContent = 'Ingresá solo una URL o subí una imagen, no ambos.';
      return;
    }
    document.getElementById('imageError').textContent = '';
    var ubicacion = {
      provincia: document.getElementById('provincia').value,
      ubicacion: document.getElementById('ubicacion').value,
      google_maps: {
        lat: document.getElementById('lat').value,
        lng: document.getElementById('lng').value
      }
    };
    document.getElementById('ubicacion_json').value = JSON.stringify(ubicacion);
  });
});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZwhVRWJo-My9lZCw_s1R5MaLCkR5fAIs&callback=initMap" async defer></script>
