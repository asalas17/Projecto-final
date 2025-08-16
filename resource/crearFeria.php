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
  /* Este style hace que las recomendaciones aparezcan encima del buscar en el mapa */
  .pac-container {
    z-index: 1055 !important;
  }
</style>
