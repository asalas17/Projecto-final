<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
    exit;
}

if (($_SESSION['user_rol'] ?? '') !== 'agricultor') {
    echo json_encode(['success' => false, 'error' => 'Acceso denegado']);
    exit;
}

$feriaId = intval($_POST['feria_id'] ?? 0);
$agricultorId = intval($_SESSION['user_id'] ?? 0);
if ($feriaId <= 0 || $agricultorId <= 0) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit;
}

require_once __DIR__ . '/../../config/db_conn.php';

// Verificar si ya está inscrito
$stmt = $connection->prepare('SELECT id FROM feria_agricultor WHERE feria_id = ? AND agricultor_id = ?');
$stmt->bind_param('ii', $feriaId, $agricultorId);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->close();
    $connection->close();
    echo json_encode(['success' => false, 'error' => 'Ya estás inscrito en esta feria']);
    exit;
}
$stmt->close();

// Insertar inscripción
$stmtIns = $connection->prepare('INSERT INTO feria_agricultor (feria_id, agricultor_id, estado) VALUES (?, ?, ?)');
$estado = 'pendiente';
$stmtIns->bind_param('iis', $feriaId, $agricultorId, $estado);
if ($stmtIns->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Error al inscribirse']);
}
$stmtIns->close();
$connection->close();