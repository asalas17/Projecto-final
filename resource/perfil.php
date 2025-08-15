<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_rol'] !== 'agricultor') {
    header('Location: inicio.php');
    exit;
}

require_once __DIR__ . '/../config/db_conn.php';

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    if ($accion === 'guardar_descripcion') {
        $descripcion = $_POST['descripcion'] ?? '';
        $stmt = $connection->prepare('UPDATE usuarios SET descripcion = ? WHERE id = ?');
        $stmt->bind_param('si', $descripcion, $userId);
        $stmt->execute();
        $stmt->close();
    } elseif ($accion === 'agregar_producto') {
        $nombreProd = $_POST['nombre'] ?? '';
        $descProd = $_POST['descripcion'] ?? '';
        $precioProd = (float)($_POST['precio'] ?? 0);
        $stmt = $connection->prepare('INSERT INTO productos (usuario_id, nombre, descripcion, precio) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('issd', $userId, $nombreProd, $descProd, $precioProd);
        $stmt->execute();
        $stmt->close();
    } elseif ($accion === 'eliminar_producto') {
        $prodId = (int)($_POST['id_producto'] ?? 0);
        $stmt = $connection->prepare('DELETE FROM productos WHERE id = ? AND usuario_id = ?');
        $stmt->bind_param('ii', $prodId, $userId);
        $stmt->execute();
        $stmt->close();
    } elseif ($accion === 'actualizar_producto') {
        $prodId = (int)($_POST['id_producto'] ?? 0);
        $nombreProd = $_POST['nombre'] ?? '';
        $descProd = $_POST['descripcion'] ?? '';
        $precioProd = (float)($_POST['precio'] ?? 0);
        $stmt = $connection->prepare('UPDATE productos SET nombre = ?, descripcion = ?, precio = ? WHERE id = ? AND usuario_id = ?');
        $stmt->bind_param('ssdii', $nombreProd, $descProd, $precioProd, $prodId, $userId);
        $stmt->execute();
        $stmt->close();
    }
}

$stmt = $connection->prepare('SELECT descripcion FROM usuarios WHERE id = ?');
$stmt->bind_param('i', $userId);
$stmt->execute();
$stmt->bind_result($descripcionActual);
$stmt->fetch();
$stmt->close();

$productos = [];
$stmt = $connection->prepare('SELECT id, nombre, descripcion, precio FROM productos WHERE usuario_id = ?');
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}
$stmt->close();

$activePage = '';
include(__DIR__ . '/../templates/header.php');
include(__DIR__ . '/../templates/nav.php');
?>
<div class="container my-5">
    <h2 class="mb-4 text-success">Mi Perfil</h2>

    <div class="card mb-4">
        <div class="card-header bg-success text-white">Descripción pública</div>
        <div class="card-body">
            <form method="post">
                <input type="hidden" name="accion" value="guardar_descripcion">
                <div class="mb-3">
                    <textarea name="descripcion" class="form-control" rows="5"><?= htmlspecialchars($descripcionActual) ?></textarea>
                </div>
                <button class="btn btn-success" type="submit">Guardar</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-success text-white">Mis productos</div>
        <div class="card-body">
            <form method="post" class="row g-3 mb-4">
                <input type="hidden" name="accion" value="agregar_producto">
                <div class="col-md-4">
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="descripcion" class="form-control" placeholder="Descripción" required>
                </div>
                <div class="col-md-2">
                    <input type="number" step="0.01" name="precio" class="form-control" placeholder="Precio" required>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success w-100" type="submit">Agregar</button>
                </div>
            </form>

            <?php if ($productos): ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['nombre']) ?></td>
                            <td><?= htmlspecialchars($p['descripcion']) ?></td>
                            <td><?= number_format($p['precio'], 2) ?></td>
                            <td class="d-flex gap-2">
                                <form method="post" class="d-inline">
                                    <input type="hidden" name="accion" value="eliminar_producto">
                                    <input type="hidden" name="id_producto" value="<?= $p['id'] ?>">
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar producto?');"><i class="bi bi-trash"></i></button>
                                </form>
                                <button class="btn btn-secondary btn-sm" data-bs-toggle="collapse" data-bs-target="#edit<?= $p['id'] ?>" aria-expanded="false"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                        <tr class="collapse" id="edit<?= $p['id'] ?>">
                            <td colspan="4">
                                <form method="post" class="row g-2">
                                    <input type="hidden" name="accion" value="actualizar_producto">
                                    <input type="hidden" name="id_producto" value="<?= $p['id'] ?>">
                                    <div class="col-md-4">
                                        <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($p['nombre']) ?>" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="descripcion" class="form-control" value="<?= htmlspecialchars($p['descripcion']) ?>" required>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" step="0.01" name="precio" class="form-control" value="<?= htmlspecialchars($p['precio']) ?>" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-success w-100" type="submit">Actualizar</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <p class="text-muted">Aún no tienes productos registrados.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
include(__DIR__ . '/../templates/footer.php');
?>
