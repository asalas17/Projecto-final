<?php
session_start();
$rol = $_SESSION['user_rol'] ?? 'cliente';
$activePage = 'ferias';
include(__DIR__ . '/../templates/header.php');
include(__DIR__ . '/../templates/nav.php');
include(__DIR__ . '/../config/db_conn.php');

$feriaId = $_GET['id'] ?? null;
$feria = null;
$agricultores = [];

if ($feriaId !== null) {
    $stmt = $connection->prepare(
        "SELECT f.id, f.nombre, f.descripcion, f.fecha_inicio, f.fecha_fin, f.ubicacion,
    i.image_url, i.image_path, i.alt_text
    FROM ferias f
    LEFT JOIN feria_imagen i ON i.feria_id = f.id
    WHERE f.id = ?"
    );
    $stmt->bind_param('i', $feriaId);
    $stmt->execute();
    $result = $stmt->get_result();
    $feria = $result->fetch_assoc();
    $stmt->close();

    if ($feria) {
        $stmtAgr = $connection->prepare(
            "SELECT u.id, u.nombre, u.descripcion
    FROM ferias fa
    INNER JOIN usuarios u ON fa.id = u.id
    WHERE fa.id = ?"
        );
        $stmtAgr->bind_param('i', $feriaId);
        $stmtAgr->execute();
        $resAgr = $stmtAgr->get_result();
        while ($row = $resAgr->fetch_assoc()) {
            $agricultores[] = $row;
        }
        $stmtAgr->close();
    }
}

$connection->close();

?>
<div class="container px-4 px-lg-5">
    <?php if (!$feria): ?>
        <p class="text-center my-5">Feria no encontrada.</p>
    <?php else: ?>
        <?php
        $imgSrc = '';
        if (!empty($feria['image_url'])) {
            $imgSrc = $feria['image_url'];
        } elseif (!empty($feria['image_path'])) {
            $imgSrc = '/' . ltrim($feria['image_path'], '/');
        }
        $ubicacionData = json_decode($feria['ubicacion'] ?? '', true) ?? [];
        $provincia = $ubicacionData['provincia'] ?? '';
        $ubicacion = $ubicacionData['ubicacion'] ?? '';
        ?>
        <div class="row gx-4 gx-lg-5 align-items-center my-5">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="rounded shadow overflow-hidden">
                    <?php if ($imgSrc !== ''): ?>
                        <img src="<?= htmlspecialchars($imgSrc) ?>" class="img-fluid"
                            alt="<?= htmlspecialchars($feria['alt_text'] ?? $feria['nombre']) ?>">
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-5">
                <h1 class="fw-bold text-success mb-3">
                    <i class="bi bi-shop"></i> <?= htmlspecialchars($feria['nombre']) ?>
                </h1>
                <p class="text-muted mb-1">
                    <?= nl2br(htmlspecialchars($feria['descripcion'])) ?>
                </p>
                <?php if ($provincia || $ubicacion): ?>
                    <p class="text-muted"><i class="bi bi-geo-alt"></i>
                        <?= htmlspecialchars(trim($ubicacion . ', ' . $provincia, ', ')) ?></p>
                <?php endif; ?>
                <?php if ($rol === 'agricultor'): ?>
                    <a class="btn btn-success btn-lg" href="asistirFeria.php?id=<?= $feria['id'] ?>">
                        <i class="bi bi-pencil-square"></i> Inscribirse
                    </a>
                <?php endif; ?>

            </div>
        </div>
        <div class="card bg-success bg-opacity-10 my-5 py-4 text-center border-0 shadow-sm">
            <div class="card-body">
                <h4 class="text-success m-0">
                    <i class="bi bi-megaphone"></i> Productores participantes
                </h4>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5">
            <?php if (count($agricultores) > 0): ?>
                <?php foreach ($agricultores as $agricultor): ?>
                    <div class="col-md-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <div class="card-body">
                                <h5 class="card-title text-success fw-bold">
                                    <i class="bi bi-person"></i> <?= htmlspecialchars($agricultor['nombre']) ?>
                                </h5>
                                <?php if (!empty($agricultor['descripcion'])): ?>
                                    <p class="card-text text-muted">
                                        <?= htmlspecialchars($agricultor['descripcion']) ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No hay agricultores inscritos todavía.</p>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>

</div>

<?php
include(__DIR__ . '/../templates/footer.php');
?>