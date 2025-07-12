<?php
$activePage = 'inscribirse';
include(__DIR__ . '/../templates/header.php'); 
include(__DIR__ . '/../templates/nav.php'); 
?>


<div class="container my-5">
    <h2 class="mb-4 text-success">Inscripción para Agricultores</h2>
    <form action="procesar_inscripcion.php" method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
            <div class="invalid-feedback">
                Por favor ingresa tu nombre.
            </div>
        </div>

        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" class="form-control" id="cedula" name="cedula" required>
            <div class="invalid-feedback">
                Este campo es obligatorio.
            </div>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" required>
            <div class="invalid-feedback">
                Ingresa un número de teléfono válido.
            </div>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
            <div class="invalid-feedback">
                Proporciona un correo válido.
            </div>
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación de la finca</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
            <div class="invalid-feedback">
                Ingresa la ubicación de la finca.
            </div>
        </div>

        <div class="mb-3">
            <label for="productos" class="form-label">Productos que ofrece</label>
            <textarea class="form-control" id="productos" name="productos" rows="3" required></textarea>
            <div class="invalid-feedback">
                Especifica al menos un producto.
            </div>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle"></i> Enviar inscripción
        </button>
    </form>
</div>



<?php
include(__DIR__ . '/../templates/footer.php'); 
?>
