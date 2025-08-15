<?php

require_once __DIR__ . '/../config/auth.php';
?>
<div class="container py-5">
    <h2 class="mb-4">Crear producto</h2>
    <form action="../app/backend/procesar_crearProducto.php" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
            <label for="nombre">Nombre</label>
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" style="height: 100px" required></textarea>
            <label for="descripcion">Descripción</label>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" placeholder="Precio" required>
                    <label for="precio">Precio</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" required>
                    <label for="stock">Stock</label>
                </div>
            </div>
        </div>
        <div class="form-floating my-3">
            <input type="datetime-local" class="form-control" id="fecha_publicacion" name="fecha_publicacion" required>
            <label for="fecha_publicacion">Fecha de publicación</label>
        </div>
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="imageSourceSwitch">
            <label class="form-check-label" for="imageSourceSwitch">Subir archivo</label>
        </div>
        <div class="form-floating mb-3" id="urlInput">
            <input type="url" class="form-control" id="imagen_url" name="imagen_url" placeholder="URL de imagen">
            <label for="imagen_url">URL de imagen</label>
        </div>
        <div class="form-floating mb-3 d-none" id="fileInput">
            <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*" placeholder="Subir imagen">
            <label for="image_file">Subir imagen</label>
        </div>
        <button type="submit" class="btn btn-success">Guardar producto</button>
    </form>
</div>
<script src="../app/js/crearFeria.js"></script>