<?php
require_once '../../config/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['feria_id'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $fecha_inicio = $_POST['fecha_inicio'] ?? '';
    $fecha_fin = $_POST['fecha_fin'] ?? '';
    $ubicacion_json = $_POST['ubicacion_json'] ?? '';

    $stmt = $connection->prepare("UPDATE ferias SET nombre = ?, descripcion = ?, fecha_inicio = ?, fecha_fin = ?, ubicacion = ?, fechaActualizado = NOW() WHERE id = ?");
    $stmt->bind_param('sssssi', $nombre, $descripcion, $fecha_inicio, $fecha_fin, $ubicacion_json, $id);
    $stmt->execute();
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
        $stmtCheck = $connection->prepare("SELECT feria_id FROM feria_imagen WHERE feria_id = ?");
        $stmtCheck->bind_param('i', $id);
        $stmtCheck->execute();
        $stmtCheck->store_result();
        if ($stmtCheck->num_rows > 0) {
            $stmtImg = $connection->prepare("UPDATE feria_imagen SET image_url = ?, image_path = ?, alt_text = ? WHERE feria_id = ?");
            $alt = $nombre;
            $stmtImg->bind_param('sssi', $image_url, $image_path, $alt, $id);
        } else {
            $stmtImg = $connection->prepare("INSERT INTO feria_imagen (feria_id, image_url, image_path, alt_text) VALUES (?, ?, ?, ?)");
            $alt = $nombre;
            $stmtImg->bind_param('isss', $id, $image_url, $image_path, $alt);
        }
        $stmtImg->execute();
        $stmtImg->close();
        $stmtCheck->close();
    }

    header('Location: ../../resource/ferias.php');
    exit();
}
?>