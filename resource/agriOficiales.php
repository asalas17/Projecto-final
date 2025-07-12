<?php
$activePage = 'sedes';
include(__DIR__ . '/../templates/header.php');
include(__DIR__ . '/../templates/nav.php');
?>

<header class="bg-dark py-5">
  <div class="container px-4 px-lg-5 my-5">
    <div class="text-center text-white">
      <h1 class="display-4 fw-bolder">Agricultores oficiales</h1>
      <p class="lead fw-normal text-white-50 mb-0">Aquí encontrarás a los agrícolas registrados para las ferias del agricultor alrededor del país</p>
    </div>
  </div>
</header>

<div class="container mt-5 mb-5">
  <h2 class="mb-4 text-center">Buscador con filtro por provincia</h2>

  <form class="row g-3 justify-content-center">
    <!-- Input de búsqueda -->
    <div class="col-md-5">
      <input type="text" class="form-control" placeholder="Buscar producto, servicio, etc." name="query">
    </div>

    <!-- Dropdown de provincia -->
    <div class="col-md-3">
      <select class="form-select" name="provincia">
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
      <button type="submit" class="btn btn-primary w-100">Buscar</button>
    </div>
  </form>
</div>

<div class="container px-4 px-lg-5">
  <!-- Content Row -->
  <div class="row gx-4 gx-lg-5">
    <div class="col-md-4 mb-5">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">Productor de café</h5>
          <p class="card-text">Somos una familia productora de café originaria de La Fortuna, San Carlos. Aseguramos
            calidad y muchos productos de distintos precios y calidades. Ademas de postres en base a café que te van a
            sorprender!</p>
        </div>
        <div class="card-footer">
          <a class="btn btn-primary btn-sm" href="#!">Ver todos los productos</a>
        </div>
      </div>
    </div>
  </div>
</div>





<?php
include(__DIR__ . '/../templates/footer.php');
?>