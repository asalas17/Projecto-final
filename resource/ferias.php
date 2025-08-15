<?php
session_start();
$rol = $_SESSION['user_rol'] ?? 'cliente';
$activePage = 'ferias';
include(__DIR__ . '/../templates/header.php');
include(__DIR__ . '/../templates/nav.php');
include(__DIR__ . '/../config/db_conn.php');

$ferias = [];

$sql = "SELECT f.id, f.nombre, f.descripcion, f.fecha_inicio, f.fecha_fin, f.ubicacion, f.fechaCreacion, f.fechaActualizado,
       i.image_url, i.image_path, i.alt_text FROM ferias f LEFT JOIN feria_imagen i ON i.feria_id = f.id
       ORDER BY f.fechaCreacion DESC";
$result = $connection->query($sql);

if ($result === false) {
  error_log("Database query failed: " . $connection->error);
} else {
  while ($row = $result->fetch_assoc()) {
    $ferias[] = $row;
  }
  $result->free();
}

$connection->close();
?>

<style>
  .card-img-top {
    width: 100%;
    height: 250px;
    object-fit: cover;
  }
</style>

<!-- Header -->
<header class="bg-success py-5 text-white agronaturaHeader">
  <div class="container px-4 px-lg-5 my-5">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Próximas ferias agrícolas</h1>
      <p class="lead fw-normal text-white-50 mb-0">Encontrá los eventos más cercanos y apoyá a los productores locales
      </p>
    </div>
  </div>
</header>

<!-- Buscador -->
<div class="container mt-5">
  <h2 class="mb-4 text-center text-success fw-bold">Buscador por provincia</h2>

  <form class="row g-3 justify-content-center">
    <!-- Input de búsqueda -->
    <div class="col-md-5">
      <input type="text" class="form-control border-success" placeholder="Buscar por nombre, lugar, fecha, etc."
        name="query">
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
      <button type="submit" class="btn btn-success w-100">Buscar</button>
    </div>



  </form>

  <?php if (isset($rol) && $rol === 'admin'): ?>
    <div class="row g-3 justify-content-center">
      <div class="col-md-5"></div>
      <div class="col-md-3"></div>
      <div class="col-md-2 mt-4 text-end">
        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#crearFeriaModal">Crear
          feria</button>
      </div>
    </div>
    <?php include(__DIR__ . '/crearFeria.php'); ?>
    <?php include(__DIR__ . '/editarFeria.php'); ?>
    <?php include(__DIR__ . '/borrarFeria.php'); ?>
  <?php endif; ?>

</div>

<!-- Tarjetas de ferias -->
<section class="py-5">
  <div class="container px-4 px-lg-5 mt-4">
    <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">

      <?php if (count($ferias) > 0): ?>
        <?php foreach ($ferias as $feria): ?>
          <div class="col mb-5">
            <div class="card h-100 shadow border-0">
              <?php
              $imgSrc = 'https://via.placeholder.com/600x400';
              if (!empty($feria['image_url'])) {
                $imgSrc = $feria['image_url'];
              } elseif (!empty($feria['image_path'])) {
                $imgSrc = '/' . ltrim($feria['image_path'], characters: '/');
              }
              ?>
              <img class="card-img-top" src="<?= htmlspecialchars($imgSrc) ?>"
                alt="<?= htmlspecialchars($feria['alt_text'] ?? $feria['nombre']) ?>" />

              <div class="card-body text-center">
                <h5 class="fw-bold text-success"><?= htmlspecialchars($feria['nombre']) ?></h5>
                <p class="mb-0 text-muted"><?= htmlspecialchars($feria['fecha_inicio']) ?></p>
              </div>

              <div class="card-footer bg-transparent text-center border-0">
                <small class="text-muted">Registrada el <?= htmlspecialchars($feria['fechaCreacion']) ?></small>
              </div>

              <div class="text-center pb-3">
                <a class="btn btn-outline-success" href="feriaDetalle.php?id=<?= $feria['id'] ?>">Ver detalles</a>

                <?php if ($rol === 'agricultor'): ?>
                  <a class="btn btn-success ms-2" href="asistirFeria.php">Inscribirme</a>
                <?php elseif ($rol === 'admin'): ?>
                  <?php
                  $ubicacionData = json_decode($feria['ubicacion'], true) ?? [];
                  $provincia = $ubicacionData['provincia'] ?? '';
                  $ubicacion = $ubicacionData['ubicacion'] ?? '';
                  $lat = $ubicacionData['google_maps']['lat'] ?? '';
                  $lng = $ubicacionData['google_maps']['lng'] ?? '';
                  ?>
                  <button class="btn btn-warning ms-2 editarFeriaBtn" data-bs-toggle="modal"
                    data-bs-target="#editarFeriaModal" data-id="<?= $feria['id'] ?>"
                    data-nombre="<?= htmlspecialchars($feria['nombre'], ENT_QUOTES) ?>"
                    data-descripcion="<?= htmlspecialchars($feria['descripcion'], ENT_QUOTES) ?>"
                    data-fecha_inicio="<?= $feria['fecha_inicio'] ?>" data-fecha_fin="<?= $feria['fecha_fin'] ?>"
                    data-provincia="<?= htmlspecialchars($provincia, ENT_QUOTES) ?>"
                    data-ubicacion="<?= htmlspecialchars($ubicacion, ENT_QUOTES) ?>"
                    data-lat="<?= htmlspecialchars($lat, ENT_QUOTES) ?>" data-lng="<?= htmlspecialchars($lng, ENT_QUOTES) ?>"
                    data-image-url="<?= htmlspecialchars($feria['image_url'], ENT_QUOTES) ?>"
                    data-image-path="<?= htmlspecialchars($feria['image_path'], ENT_QUOTES) ?>">Editar</button>
                  <button class="btn btn-danger ms-2 eliminarFeriaBtn" data-bs-toggle="modal"
                    data-bs-target="#eliminarFeriaModal" data-id="<?= $feria['id'] ?>"
                    data-nombre="<?= htmlspecialchars($feria['nombre'], ENT_QUOTES) ?>">Eliminar</button>


                <?php endif; ?>

              </div>
            </div>
          </div>
        <?php endforeach; ?>

      <?php else: ?>
        <p class="text-center">No hay ferias registradas.</p>
      <?php endif; ?>

    </div>
  </div>
</section>

<?php
include(__DIR__ . '/../templates/footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>