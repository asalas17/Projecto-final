<div class="modal fade" id="crearFeriaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <form id="crearFeriaForm" action="../app/backend/procesar_crearFeria.php" method="POST"
                enctype="multipart/form-data">
                <div class="modal-header bg-success text-white border-0 rounded-top p-3">
                    <h5 class="modal-title">Crear feria</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body overflow-auto p-4" style="max-height: 70vh;">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre"
                            required>
                        <label for="nombre">Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Descripción" id="descripcion" name="descripcion"
                            style="height: 100px" required></textarea>
                        <label for="descripcion">Descripción</label>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio"
                                    placeholder="Fecha y hora de inicio" required>
                                <label for="fecha_inicio">Fecha y hora de inicio</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin"
                                    placeholder="Fecha y hora de fin" required>
                                <label for="fecha_fin">Fecha y hora de fin</label>
                            </div>
                        </div>
                    </div>
                    <h5 class="mt-4 mb-3">Ubicación</h5>
                    <div class="form-floating mb-3">
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
                        <label for="provincia">Provincia</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion"
                            placeholder="Descripción adicional" required>
                        <label for="ubicacion">Descripción adicional</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="map-search" placeholder="Escribí una ubicación">
                        <label for="map-search">Buscar en el mapa</label>
                    </div>
                    <div id="map" class="mb-3" style="height: 300px;"></div>
                    <input type="hidden" id="lat">
                    <input type="hidden" id="lng">
                    <input type="hidden" id="ubicacion_json" name="ubicacion_json">
                    <h5 class="mt-4 mb-3">Imagen</h5>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="imageSourceSwitch">
                        <label class="form-check-label" for="imageSourceSwitch">Subir archivo</label>
                    </div>
                    <div class="form-floating mb-3" id="urlInput">
                        <input type="url" class="form-control" id="image_url" name="image_url"
                            placeholder="URL de imagen">
                        <label for="image_url">URL de imagen</label>
                    </div>
                    <div class="form-floating mb-3 d-none" id="fileInput">
                        <input type="file" class="form-control" id="image_file" name="image_file"
                            accept="image/*" placeholder="Subir imagen">
                        <label for="image_file">Subir imagen</label>
                    </div>
                    <img id="imagePreview" class="img-fluid rounded shadow-sm mb-3 d-none" alt="Vista previa">
                    <div id="imageError" class="text-danger small"></div>
                </div>
                <div class="modal-footer bg-light border-0 rounded-bottom p-3">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
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
