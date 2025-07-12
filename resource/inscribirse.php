<?php
$activePage = 'inscribirse';
include(__DIR__ . '/../templates/header.php'); 
include(__DIR__ . '/../templates/nav.php'); 
?>

<!-- Header o banner opcional -->
<header class="bg-success py-5 text-white mb-4 agronaturaHeader">
  <div class="container text-center">
    <h1 class="display-4 fw-bold">Registro para Agricultores</h1>
    <p class="lead text-white-50 mb-0">Sumate a Agronatura y compartí tus productos con más costarricenses</p>
  </div>
</header>

<!-- Formulario -->
<div class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-xl-6">
      <div class="card shadow border-0">
        <div class="card-body p-5">
          <h2 class="mb-4 text-success fw-bold text-center">
            <i class="bi bi-pencil-square"></i> Formulario de inscripción
          </h2>
          <p class="text-muted text-center mb-4">
            Completá tus datos para que podamos incluir tu feria o puesto en nuestro directorio.
          </p>

          <form action="procesar_inscripcion.php" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre completo</label>
              <input type="text" class="form-control border-success" id="nombre" name="nombre" required>
              <div class="invalid-feedback">
                Por favor ingresa tu nombre.
              </div>
            </div>

            <div class="mb-3">
              <label for="cedula" class="form-label">Cédula</label>
              <input type="text" class="form-control border-success" id="cedula" name="cedula" required>
              <div class="invalid-feedback">
                Este campo es obligatorio.
              </div>
            </div>

            <div class="mb-3">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="tel" class="form-control border-success" id="telefono" name="telefono" required>
              <div class="invalid-feedback">
                Ingresa un número de teléfono válido.
              </div>
            </div>

            <div class="mb-3">
              <label for="correo" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control border-success" id="correo" name="correo" required>
              <div class="invalid-feedback">
                Proporciona un correo válido.
              </div>
            </div>

            <div class="mb-3">
              <label for="ubicacion" class="form-label">Ubicación de la finca</label>
              <input type="text" class="form-control border-success" id="ubicacion" name="ubicacion" required>
              <div class="invalid-feedback">
                Ingresa la ubicación de la finca.
              </div>
            </div>

            <div class="mb-3">
              <label for="productos" class="form-label">Productos que ofrece</label>
              <textarea class="form-control border-success" id="productos" name="productos" rows="3" required></textarea>
              <div class="invalid-feedback">
                Especifica al menos un producto.
              </div>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-success btn-lg">
                <i class="bi bi-check-circle-fill"></i> Enviar inscripción
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include(__DIR__ . '/../templates/footer.php'); 
?>
