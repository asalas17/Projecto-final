<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="../app/css/registro.css">
</head>

<body>
  <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card mx-auto shadowb g-white shadow rounded-3 overflow-hidden" style="max-width: 1000px;">
      <div class="card-body">
        <h3 class="card-title text-center mb-4 text-success">
          <img src="/Projecto-final/img/Agronatura.png" alt="Agronatura" width="200">
        </h3>

        <form id="regForm" action="../app/backend/procesar_registro.php" method="POST">
          <!-- Step 1: Tipo de usuario -->
          <div class="tab">
            <h5>Paso 1 de 3: ¿Quién eres?</h5>
            <div class="form-check mt-3">
              <input class="form-check-input" type="radio" name="rol" id="rolCliente" value="cliente" required>
              <label class="form-check-label" for="rolCliente">Cliente</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="rol" id="rolAgricultor" value="agricultor">
              <label class="form-check-label" for="rolAgricultor">Agricultor</label>
            </div>
            <div id="rolError" class="text-danger small mt-1" style="display:none;">
              Por favor seleccioná si sos Cliente o Agricultor.
            </div>
          </div>

          <!-- Step 2: Credenciales -->
          <div class="tab">
            <h5>Paso 2 de 3: Credenciales</h5>
            <div class="mb-3 mt-3">
              <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <div class="mb-3">
              <input type="password" name="password2" class="form-control" placeholder="Repite la contraseña" required>
            </div>
          </div>

          <!-- Step 3: Datos de perfil -->
          <div class="tab">
            <h5>Paso 3 de 3: Información personal</h5>
            <div class="mb-3 mt-3">
              <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" required>
            </div>
            <div class="mb-3">
              <input type="text" name="telefono" class="form-control" placeholder="Teléfono">
            </div>
            <div class="mb-3">
              <input type="text" name="ubicacion" class="form-control" placeholder="Ubicación">
            </div>
            <!-- Solo aparece si es agricultor -->
            <div class="mb-3" id="divDescripcion" style="display:none;">
              <textarea name="descripcion" class="form-control" rows="3"
                placeholder="Describe tu finca/productos o tu historia como agricultor."></textarea>
            </div>
            <p class="text-center mt-4 text-muted small">
              Podrás cambiar este campo más adelante en tu perfil. Ten en cuenta que el texto será visible para todos en
              la plataforma.
            </p>
          </div>

          <!-- Navegación -->
          <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Anterior</button>
            <button type="button" class="btn btn-success" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>
          </div>

          <!-- Indicadores de paso -->
          <div class="text-center mt-3">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
          </div>

          <p class="text-center mt-4 text-muted small">
            ¿Ya nos habias visitado antes?
            <a href="inicioSesion.php" class="link-success-hover text-decoration-none fw-bold">Inicia Sesion aquí</a>
          </p>
        </form>
      </div>
    </div>
  </div>

  <script src="../app/js/registro.js" defer></script>

</body>




<?php
include(__DIR__ . '/../templates/footer.php');
