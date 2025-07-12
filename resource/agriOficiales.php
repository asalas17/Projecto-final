<?php
$activePage = 'sedes';
include(__DIR__ . '/../templates/header.php');
include(__DIR__ . '/../templates/nav.php');
?>

<!-- Header -->
<header class="bg-success py-5 text-white agronaturaHeader">
  <div class="container px-4 px-lg-5 my-5">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Agricultores oficiales</h1>
      <p class="lead text-white-50 mb-0">Descubrí productores locales registrados para las ferias en todo Costa Rica</p>
    </div>
  </div>
</header>

<!-- Buscador -->
<div class="container my-5">
  <h2 class="mb-4 text-center text-success fw-bold">
    <i class="bi bi-search"></i> Buscador por provincia
  </h2>

  <form class="row g-3 justify-content-center">
    <!-- Input de búsqueda -->
    <div class="col-md-5">
      <input type="text" class="form-control border-success" placeholder="Buscar producto, servicio, productor..." name="query">
    </div>

    <!-- Dropdown de provincia -->
    <div class="col-md-3">
      <select class="form-select border-success" name="provincia">
        <option selected disabled>Seleccionar provincia</option>
        <option value="San José">San José</option>
        <option value="Alajuela">Alajuela</option>
        <option value="Cartago">Cartago</option>
        <option value="Heredia">Heredia</option>
        <option value="Guanacaste">Guanacaste</option>
        <option value="Puntarenas">Puntarenas</option>
        <option value="Limón">Limón</option>
      </select>
    </div>

    <!-- Botón -->
    <div class="col-md-2">
      <button type="submit" class="btn btn-success w-100">
        <i class="bi bi-search"></i> Buscar
      </button>
    </div>
  </form>
</div>

<!-- Cards de productores -->
<div class="container px-4 px-lg-5 mb-5">
  <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-lg-3">

    <!-- Card de ejemplo -->
    <div class="col mb-5">
      <div class="card h-100 shadow border-0">
        <div class="card-body">
          <h5 class="card-title text-success fw-bold">
            <i class="bi bi-cup-hot"></i> Productor de café
          </h5>
          <p class="card-text text-muted">
            Somos una familia productora de café en La Fortuna, San Carlos. Calidad garantizada y postres basados en café que te encantarán.
          </p>
        </div>
        <div class="card-footer bg-transparent border-0 text-center">
          <a class="btn btn-outline-success btn-sm" href="#!">
            <i class="bi bi-box-arrow-up-right"></i> Ver todos los productos
          </a>
        </div>
      </div>
    </div>

    <!-- Puedes duplicar esta tarjeta para más productores -->

  </div>
</div>

<?php
include(__DIR__ . '/../templates/footer.php');
?>
