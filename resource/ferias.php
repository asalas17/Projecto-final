<?php
session_start();
$rol = $_SESSION['user_rol'] ?? 'cliente';
$activePage = 'ferias';
include(__DIR__ . '/../templates/header.php');
include(__DIR__ . '/../templates/nav.php');
include(__DIR__ . '/../config/db_conn.php');
require_once __DIR__ . '/../config/env.php';
$gmapsApiKey = $_ENV['GMAPS_API_KEY'] ?? '';

$ferias = [];

// Parámetros de búsqueda
$query = trim($_GET['query'] ?? '');
$provinciaIn = trim($_GET['provincia'] ?? '');


$sql = "SELECT f.id, f.nombre, f.descripcion, f.fecha_inicio, f.fecha_fin, f.ubicacion, f.fechaCreacion, f.fechaActualizado,
       i.image_url, i.image_path, i.alt_text FROM ferias f LEFT JOIN feria_imagen i ON i.feria_id = f.id
        WHERE f.fecha_fin >= NOW()";

$params = [];
$types = '';

if ($query !== '') {
  $sql .= " AND (f.nombre LIKE ? OR f.descripcion LIKE ? OR JSON_UNQUOTE(JSON_EXTRACT(f.ubicacion, '$.ubicacion')) LIKE ?)";
  $like = "%{$query}%";
  $params[] = $like;
  $params[] = $like;
  $params[] = $like;
  $types .= 'sss';
}

if ($provinciaIn !== '') {
  $sql .= " AND JSON_UNQUOTE(JSON_EXTRACT(f.ubicacion, '$.provincia')) = ?";
  $params[] = $provinciaIn;
  $types .= 's';
}

$sql .= " ORDER BY f.fechaCreacion DESC";

$stmt = $connection->prepare($sql);
if (!empty($params)) {
  $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
  error_log("Database query failed: " . $connection->error);
} else {
  while ($row = $result->fetch_assoc()) {
    $ferias[] = $row;
  }
  $result->free();
}

$stmt->close();
$connection->close();
$feriasCoords = [];
foreach ($ferias as $feria) {
  $ubicacionData = json_decode($feria['ubicacion'] ?? '', true) ?? [];
  $lat = $ubicacionData['google_maps']['lat'] ?? null;
  $lng = $ubicacionData['google_maps']['lng'] ?? null;
  if ($lat !== null && $lng !== null) {
    $feriasCoords[] = [
      'id' => $feria['id'],
      'nombre' => $feria['nombre'],
      'lat' => $lat,
      'lng' => $lng,
    ];
  }
}
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
      <button class="btn btn-light mt-4" data-bs-toggle="offcanvas" data-bs-target="#mapaFerias"
        aria-controls="mapaFerias">Ver mapa de ferias</button>
    </div>
  </div>
</header>

<!-- Buscador -->
<div class="container mt-5">
  <h2 class="mb-4 text-center text-success fw-bold">Buscador con filtros</h2>

  <form class="row g-3 justify-content-center" method="get">
    <!-- Input de búsqueda -->
    <div class="col-md-5">
      <input type="text" class="form-control border-success" placeholder="Buscar por nombre, lugar, fecha, etc."
        name="query" value="<?= htmlspecialchars($query) ?>">
    </div>

    <!-- Dropdown de provincia -->
    <div class="col-md-3">
      <select class="form-select border-success" name="provincia">
        <option value="" <?= $provinciaIn === '' ? 'selected' : '' ?> disabled>Seleccionar provincia</option>
        <option value="San José" <?= $provinciaIn === 'San José' ? 'selected' : '' ?>>San José</option>
        <option value="Alajuela" <?= $provinciaIn === 'Alajuela' ? 'selected' : '' ?>>Alajuela</option>
        <option value="Cartago" <?= $provinciaIn === 'Cartago' ? 'selected' : '' ?>>Cartago</option>
        <option value="Heredia" <?= $provinciaIn === 'Heredia' ? 'selected' : '' ?>>Heredia</option>
        <option value="Guanacaste" <?= $provinciaIn === 'Guanacaste' ? 'selected' : '' ?>>Guanacaste</option>
        <option value="Puntarenas" <?= $provinciaIn === 'Puntarenas' ? 'selected' : '' ?>>Puntarenas</option>
        <option value="Limón" <?= $provinciaIn === 'Limón' ? 'selected' : '' ?>>Limón</option>
      </select>
    </div>

    <!-- Botón -->
    <div class="col-md-2">
      <button type="submit" class="btn btn-success w-100">Buscar</button>
    </div>


    <!-- Reset -->
    <div class="col-md-2">
      <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="btn btn-outline-secondary w-100">Limpiar</a>
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
            <div class="card h-100 shadow border-0" data-href="feriaDetalle.php?id=<?php echo $feria['id']; ?>">
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
                  <button class="btn btn-success ms-2 inscribirmeBtn" data-feria-id="<?= $feria['id'] ?>">Inscribirme</button>
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
        <p class="text-center">No hay ferias próximas.</p>
      <?php endif; ?>

    </div>
  </div>
</section>

</section>

<div class="offcanvas offcanvas-end w-50" tabindex="-1" id="mapaFerias" aria-labelledby="mapaFeriasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="mapaFeriasLabel">Mapa de ferias</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0" style="height:100vh;">
    <div id="feriasMap" style="height:100%; min-height:400px;"></div>
  </div>
</div>

<?php
include(__DIR__ . '/../templates/footer.php');
?>

<script>
  const feriasCoords = <?= json_encode($feriasCoords, JSON_UNESCAPED_UNICODE) ?>;
  let feriasMap;
  function initFeriasMap() {
    const defaultPos = { lat: 9.7489, lng: -83.7534 };
    const center = feriasCoords.length > 0
      ? { lat: parseFloat(feriasCoords[0].lat), lng: parseFloat(feriasCoords[0].lng) }
      : defaultPos;
    feriasMap = new google.maps.Map(document.getElementById('feriasMap'), {
      center: center,
      zoom: 9
    });
    feriasCoords.forEach(f => {
      const pos = { lat: parseFloat(f.lat), lng: parseFloat(f.lng) };
      const marker = new google.maps.Marker({ position: pos, map: feriasMap, title: f.nombre });
      const info = new google.maps.InfoWindow({ content: `<strong>${f.nombre}</strong>` });
      marker.addListener('click', () => info.open(feriasMap, marker));
    });
  }
  document.getElementById('mapaFerias').addEventListener('shown.bs.offcanvas', () => {
    if (feriasMap) {
      google.maps.event.trigger(feriasMap, 'resize');
      if (feriasCoords.length > 0) {
        feriasMap.setCenter({ lat: parseFloat(feriasCoords[0].lat), lng: parseFloat(feriasCoords[0].lng) });
      }
    }
  });

  function initMaps() {
    initFeriasMap();
    <?php if ($rol === 'admin'): ?>
      if (typeof initMap === 'function') {
        initMap();
      }
    <?php endif; ?>
  }
  document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    if (params.get('map') === '1') {
      const offcanvas = new bootstrap.Offcanvas(document.getElementById('mapaFerias'));
      offcanvas.show();
    }
  });
</script>
<?php if ($gmapsApiKey): ?>
  <script
    src="https://maps.googleapis.com/maps/api/js?key=<?= htmlspecialchars($gmapsApiKey, ENT_QUOTES) ?>&callback=initMaps&libraries=places"
    async defer></script>
<?php endif; ?>
<?php if ($rol === 'admin'): ?>
  <script src="../app/js/crearFeria.js"></script>
<?php endif; ?>
<script src="../app/js/asistirFeria.js"></script>