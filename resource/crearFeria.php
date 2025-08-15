<div class="modal fade" id="crearFeriaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form id="crearFeriaForm" action="../app/backend/procesar_crearFeria.php" method="POST"
                enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Crear feria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body overflow-auto" style="max-height: 70vh;">
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
                            <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha_fin" class="form-label">Fecha y hora de fin</label>
                            <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin" required>
                        </div>
                    </div>
                    <h5 class="mt-3">Ubicación</h5>
                    <div class="mb-3">
                        <label for="provincia" class="form-label">Provincia</label>
                        <select class="form-select" id="provincia" name="provincia" required>
                            <option value="" selected disabled>Seleccionar provincia</option>
                            <option value="San José">San José</option>
                            <option value="Alajuela">Alajuela</option>
                            <option value="Cartago">Cartago</option>
                            <option value="Heredia">Heredia</option>
                            <option value="Guanacaste">Guanacaste</option>
                            <option value="Puntarenas">Puntarenas</option>
                            <option value="Limón">Limón</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ubicacion" class="form-label">Descripcion adicional:</label>
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                    </div>
                    <div class="mb-3">
                        <label for="map-search" class="form-label">Buscar en el mapa</label>
                        <input type="text" class="form-control" id="map-search" placeholder="Escribí una ubicación">
                    </div>
                    <div id="map" class="mb-3" style="height: 300px;"></div>
                    <input type="hidden" id="lat">
                    <input type="hidden" id="lng">
                    <input type="hidden" id="ubicacion_json" name="ubicacion_json">
                    <h5 class="mt-3">Imagen</h5>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="imageSourceSwitch">
                        <label class="form-check-label" for="imageSourceSwitch">Subir archivo</label>
                    </div>
                    <div class="mb-3" id="urlInput">
                        <label for="image_url" class="form-label">URL de imagen</label>
                        <input type="url" class="form-control" id="image_url" name="image_url">
                    </div>
                    <div class="mb-3 d-none" id="fileInput">
                        <label for="image_file" class="form-label">Subir imagen</label>
                        <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*">
                    </div>
                    <img id="imagePreview" class="img-fluid mb-3 d-none" alt="Vista previa">
                    <div id="imageError" class="text-danger small"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar feria</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
  /* Ensure Google Places suggestions appear above Bootstrap modal */
  .pac-container {
    z-index: 1055 !important;
  }
</style>

<script>
    let map;
    let marker;

    function initMap() {
        const defaultPos = { lat: 9.7489, lng: -83.7534 };
        map = new google.maps.Map(document.getElementById('map'), {
            center: defaultPos,
            zoom: 7
        });

        const input = document.getElementById('map-search');
        const autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function () {
            const place = autocomplete.getPlace();
            if (!place.geometry || !place.geometry.location) {
                return;
            }
            map.setCenter(place.geometry.location);
            map.setZoom(15);
            if (marker) {
                marker.setPosition(place.geometry.location);
            } else {
                marker = new google.maps.Marker({
                    position: place.geometry.location,
                    map: map
                });
            }
            document.getElementById('lat').value = place.geometry.location.lat();
            document.getElementById('lng').value = place.geometry.location.lng();
        });


        map.addListener('click', function (e) {
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

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('crearFeriaModal').addEventListener('shown.bs.modal', function () {
            if (map) {
                google.maps.event.trigger(map, 'resize');
            }
        });

        var searchInput = document.getElementById('map-search');
        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });


        const toggle = document.getElementById('imageSourceSwitch');
        const urlInput = document.getElementById('urlInput');
        const fileInput = document.getElementById('fileInput');
        const imageUrl = document.getElementById('image_url');
        const imageFile = document.getElementById('image_file');
        const imagePreview = document.getElementById('imagePreview');
        const imageError = document.getElementById('imageError');

        toggle.addEventListener('change', function () {
            if (this.checked) {
                urlInput.classList.add('d-none');
                fileInput.classList.remove('d-none');
                imageUrl.value = '';
            } else {
                fileInput.classList.add('d-none');
                urlInput.classList.remove('d-none');
                imageFile.value = '';
            }
            imagePreview.src = '';
            imagePreview.classList.add('d-none');
        });

        imageUrl.addEventListener('input', function () {
            const url = this.value.trim();
            if (url) {
                imagePreview.src = url;
                imagePreview.classList.remove('d-none');
            } else {
                imagePreview.classList.add('d-none');
            }
        });

        imageFile.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.classList.add('d-none');
            }
        });



        var form = document.getElementById('crearFeriaForm');
        form.addEventListener('submit', function (e) {
            const usingFile = toggle.checked;
            const url = imageUrl.value.trim();
            const file = imageFile.files[0];

            if (usingFile && !file) {
                e.preventDefault();
                imageError.textContent = 'Subí una imagen o cambiá la opción.';
                return;
            }
            if (!usingFile && !url) {
                e.preventDefault();
                imageError.textContent = 'Ingresá la URL de la imagen o cambiá la opción.';
                return;
            }
            imageError.textContent = '';
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZwhVRWJo-My9lZCw_s1R5MaLCkR5fAIs&callback=initMap&libraries=places" async defer></script>
