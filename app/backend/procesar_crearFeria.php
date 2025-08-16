<?php
require_once __DIR__ . '/../../config/env.php';
require_once '../../config/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $fecha_inicio = $_POST['fecha_inicio'] ?? '';
    $fecha_fin = $_POST['fecha_fin'] ?? '';
    $ubicacion_json = $_POST['ubicacion_json'] ?? '';

    $stmt = $connection->prepare("INSERT INTO ferias (nombre, descripcion, fecha_inicio, fecha_fin, ubicacion) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $nombre, $descripcion, $fecha_inicio, $fecha_fin, $ubicacion_json);
    $stmt->execute();
    $feria_id = $connection->insert_id;
    $stmt->close();

    $image_url = !empty($_POST['image_url']) ? $_POST['image_url'] : null;
    $image_path = null;

    if (!empty($_FILES['image_file']['name'])) {
        $uploadDir = __DIR__ . '/../../resource/uploads';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $filename = time() . '_' . basename($_FILES['image_file']['name']);
        $destination = $uploadDir . '/' . $filename;
        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $destination)) {
            $image_path = 'resource/uploads/' . $filename;
        }
    }

    if ($image_url || $image_path) {
        $stmtImg = $connection->prepare("INSERT INTO feria_imagen (feria_id, image_url, image_path, alt_text) VALUES (?, ?, ?, ?)");
        $alt = $nombre;
        $stmtImg->bind_param('isss', $feria_id, $image_url, $image_path, $alt);
        $stmtImg->execute();
        $stmtImg->close();
    }

    header('Location: ' . BASE_PATH . '/resource/ferias.php');
    exit();
}
?>