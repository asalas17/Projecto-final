<div class="modal fade" id="editarFeriaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form id="editarFeriaForm" action="../app/backend/procesar_editarFeria.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="edit_feria_id" name="feria_id">
                <div class="modal-header">
                    <h5 class="modal-title">Editar feria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body overflow-auto" style="max-height: 70vh;">
                    <div class="mb-3">
                        <label for="edit_nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="edit_descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_fecha_inicio" class="form-label">Fecha y hora de inicio</label>
                            <input type="datetime-local" class="form-control" id="edit_fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_fecha_fin" class="form-label">Fecha y hora de fin</label>
                            <input type="datetime-local" class="form-control" id="edit_fecha_fin" name="fecha_fin" required>
                        </div>
                    </div>
                    <h5 class="mt-3">Ubicación</h5>
                    <div class="mb-3">
                        <label for="edit_provincia" class="form-label">Provincia</label>
                        <select class="form-select" id="edit_provincia" name="provincia" required>
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
                        <label for="edit_ubicacion" class="form-label">Descripcion adicional:</label>
                        <input type="text" class="form-control" id="edit_ubicacion" name="ubicacion" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_map-search" class="form-label">Buscar en el mapa</label>
                        <input type="text" class="form-control" id="edit_map-search" placeholder="Escribí una ubicación">
                    </div>
                    <div id="edit_map" class="mb-3" style="height: 300px;"></div>
                    <input type="hidden" id="edit_lat">
                    <input type="hidden" id="edit_lng">
                    <input type="hidden" id="edit_ubicacion_json" name="ubicacion_json">
                    <h5 class="mt-3">Imagen</h5>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="edit_imageSourceSwitch">
                        <label class="form-check-label" for="edit_imageSourceSwitch">Subir archivo</label>
                    </div>
                    <div class="mb-3" id="edit_urlInput">
                        <label for="edit_image_url" class="form-label">URL de imagen</label>
                        <input type="url" class="form-control" id="edit_image_url" name="image_url">
                    </div>
                    <div class="mb-3 d-none" id="edit_fileInput">
                        <label for="edit_image_file" class="form-label">Subir imagen</label>
                        <input type="file" class="form-control" id="edit_image_file" name="image_file" accept="image/*">
                    </div>
                    <img id="edit_imagePreview" class="img-fluid mb-3 d-none" alt="Vista previa">
                    <div id="edit_imageError" class="text-danger small"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Actualizar feria</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
  .pac-container {
    z-index: 1055 !important;
  }
</style>

<script src="../app/js/editarFeria.js"></script>