<?php
session_start();
require_once __DIR__ . '/../config/db_conn.php';
require_once __DIR__ . '/../vendor/autoload.php';
$Parsedown = new Parsedown();

$activePage = 'sedes';
include(__DIR__ . '/../templates/header.php');
include(__DIR__ . '/../templates/nav.php');

$isAdmin = ($_SESSION['user_rol'] ?? '') === 'admin';

$agricultores = [];
// Parámetros de búsqueda
$query = trim($_GET['query'] ?? '');
$provinciaIn = trim($_GET['provincia'] ?? '');
$mostrarProductos = ($_GET['productos'] ?? '0') === '1';

$sql = "SELECT DISTINCT u.id, u.nombre, u.descripcion, u.ubicacion
        FROM usuarios u
        LEFT JOIN productos p ON p.agricultor_id = u.id
        WHERE u.rol = 'agricultor'";

$params = [];
$types = '';

if ($query !== '') {
  $sql .= " AND (u.nombre LIKE ? OR u.descripcion LIKE ? OR p.nombre LIKE ? OR p.descripcion LIKE ?)";
  $like = "%{$query}%";
  $params[] = $like;
  $params[] = $like;
  $params[] = $like;
  $params[] = $like;
  $types .= 'ssss';
}

if ($provinciaIn !== '') {
  $sql .= " AND u.ubicacion LIKE ?";
  $params[] = "%{$provinciaIn}%";
  $types .= 's';
}

$sql .= " ORDER BY u.nombre";

$stmt = $connection->prepare($sql);
if (!empty($params)) {
  $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
if ($result) {
  while ($row = $result->fetch_assoc()) {
    // Obtener productos del agricultor
    $stmtProd = $connection->prepare('SELECT id, nombre, descripcion, precio, imagen_url FROM productos WHERE agricultor_id = ?');
    $stmtProd->bind_param('i', $row['id']);
    $stmtProd->execute();
    $resProd = $stmtProd->get_result();
    $row['productos'] = [];
    while ($prod = $resProd->fetch_assoc()) {
      $row['productos'][] = $prod;
    }
    $stmtProd->close();

    // Obtener ferias futuras en las que participa el agricultor (si existe tabla de relación)
    $row['ferias'] = [];
    $stmtFeria = $connection->prepare("SELECT f.id, f.nombre, f.fecha_inicio FROM ferias f INNER JOIN feria_agricultor fa ON fa.feria_id = f.id WHERE fa.agricultor_id = ? AND f.fecha_inicio >= CURDATE() ORDER BY f.fecha_inicio");
    if ($stmtFeria) {
      $stmtFeria->bind_param('i', $row['id']);
      if ($stmtFeria->execute()) {
        $resFeria = $stmtFeria->get_result();
        while ($feria = $resFeria->fetch_assoc()) {
          $row['ferias'][] = $feria;
        }
      }
      $stmtFeria->close();
    }

    $agricultores[] = $row;
  }
}
$stmt->close();
$connection->close();
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
    <i class="bi bi-search"></i> Buscador
  </h2>

  <form class="row g-3 justify-content-center" method="get">
    <!-- Input de búsqueda -->
    <div class="col-md-5">
      <input type="text" class="form-control border-success" placeholder="Buscar producto, servicio, productor..."
        name="query" value="<?= htmlspecialchars($query) ?>">
    </div>
    <!-- Botón -->
    <div class="col-md-2">
      <button type="submit" class="btn btn-success w-100">
        <i class="bi bi-search"></i> Buscar
      </button>
    </div>

    <!-- Reset -->
    <div class="col-md-2">
      <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="btn btn-outline-secondary w-100">Limpiar</a>
    </div>
  </form>
</div>

<!-- Switch para mostrar productos -->
<div class="container mb-4 d-flex justify-content-end">
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="toggleProductos" <?= $mostrarProductos ? 'checked' : '' ?>>
    <label class="form-check-label" for="toggleProductos">Mostrar productos</label>
  </div>
</div>

<!-- Cards de productores -->
<div class="container px-4 px-lg-5 mb-5">
  <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-lg-3">
    <?php foreach ($agricultores as $a): ?>
      <div class="col mb-5">
        <div class="card h-100 shadow border-0">
          <div class="card-body text-center">
            <h5 class="card-title text-success fw-bold mb-0">
              <i class="bi bi-person-circle"></i> <?= htmlspecialchars($a['nombre']) ?>
            </h5>
            <div class="productos-list <?= $mostrarProductos ? '' : 'd-none' ?> mt-3"
              style="max-height: 8rem; overflow-y: auto;">
              <?php if (!empty($a['productos'])): ?>
                <ul class="list-unstyled mb-0 text-start">
                  <?php foreach ($a['productos'] as $p): ?>
                    <li class="d-flex justify-content-between align-items-center">
                      <div class="d-flex align-items-center">
                        <?php if (!empty($p['imagen_url'])): ?>
                          <img src="<?= htmlspecialchars($p['imagen_url']) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>"
                            style="height:40px;width:auto;" class="me-2">
                        <?php endif; ?>
                        <span><?= htmlspecialchars($p['nombre']) ?></span>
                      </div> <span class="badge rounded-pill bg-success-subtle text-success">
                        ₡<?= htmlspecialchars($p['precio']) ?>
                      </span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php else: ?>
                <p class="text-muted mb-0">Este agricultor no ha registrado productos.</p>
              <?php endif; ?>
            </div>
          </div>
          <div class="card-footer bg-transparent border-0 text-center">
            <button class="btn btn-outline-success btn-sm" data-bs-toggle="offcanvas"
              data-bs-target="#agricultorModal<?= $a['id'] ?>" aria-controls="agricultorModal<?= $a['id'] ?>">
              <i class="bi bi-box-arrow-up-right"></i> Ver detalles
            </button>
          </div>
        </div>
      </div>

      <div class="offcanvas offcanvas-end w-25" tabindex="-1" id="agricultorModal<?= $a['id'] ?>"
        aria-labelledby="agricultorModalLabel<?= $a['id'] ?>">
        <div class="offcanvas-header">
          <div class="d-flex align-items-center">
            <i class="bi bi-person-circle fs-4 me-2"></i>
            <h5 class="offcanvas-title mb-0" id="agricultorModalLabel<?= $a['id'] ?>">
              <?= htmlspecialchars($a['nombre']) ?>
            </h5>
          </div>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div class="mb-3">
            <div class="card">
              <div class="card-header text-success fw-bold">
                Descripción
              </div>
              <div class="card-body">
                <?= $Parsedown->text($a['descripcion'] ?? '') ?>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <h6 class="text-success">Productos</h6>
            <?php if (!empty($a['productos'])): ?>
              <div class="table-responsive">
                <table class="table table-sm table-bordered mb-0">
                  <thead>
                    <tr>
                      <th>Imagen</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th class="text-end">Precio</th>
                      <?php if ($isAdmin): ?>
                        <th>Acciones</th>
                      <?php endif; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($a['productos'] as $p): ?>
                      <tr>
                        <td>
                          <?php if (!empty($p['imagen_url'])): ?>
                            <img src="<?= htmlspecialchars($p['imagen_url']) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>"
                              style="height:40px;width:auto;">
                          <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($p['nombre']) ?></td>
                        <td><?= htmlspecialchars($p['descripcion']) ?></td>
                        <td class="text-end">₡<?= htmlspecialchars($p['precio']) ?></td>
                        <?php if ($isAdmin): ?>
                          <td class="text-center">
                            <form method="post" action="../app/backend/procesar_borrarProducto.php"
                              onsubmit="return confirm('¿Eliminar producto?');">
                              <input type="hidden" name="id_producto" value="<?= $p['id'] ?>">
                              <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                              </button>
                            </form>
                          </td>
                        <?php endif; ?>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <p class="text-muted mb-0">Este agricultor no ha registrado productos.</p>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <h6 class="text-success">Próximas ferias</h6>
            <?php if (!empty($a['ferias'])): ?>
              <ul class="list-unstyled mb-0">
                <?php foreach ($a['ferias'] as $f): ?>
                  <li class="mb-1">
                    <?= htmlspecialchars($f['nombre']) ?>
                    <small class="text-muted">(<?= htmlspecialchars($f['fecha_inicio']) ?>)</small>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <p class="text-muted mb-0">No tiene ferias próximas registradas.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php
include(__DIR__ . '/../templates/footer.php');
?>