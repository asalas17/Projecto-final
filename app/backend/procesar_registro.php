<?php

require_once __DIR__ . '/../../config/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../resource/registro.php');
    exit;
}

$rol = $_POST['rol'] ?? '';
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$password2 = $_POST['password2'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$ubicacion = $_POST['ubicacion'] ?? '';
$descripcion = isset($_POST['descripcion'])
    ? trim($_POST['descripcion'])
    : null;

// 4. Validaciones básicas
$errors = [];

if (!in_array($rol, ['cliente', 'agricultor'], true)) {
    $errors[] = "Rol de usuario inválido.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "El correo no tiene un formato válido.";
}

if (strlen($password) < 6) {
    $errors[] = "La contraseña debe tener al menos 6 caracteres.";
}

if ($password !== $password2) {
    $errors[] = "Las contraseñas no coinciden.";
}

if ($nombre === '') {
    $errors[] = "El nombre completo es obligatorio.";
}

// 5. Comprobar si ya existe el correo
if (empty($errors)) {
    $stmt = $connection->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $errors[] = "Ya existe una cuenta con ese correo.";
    }
    $stmt->close();
}

// 6. Si hay errores, muéstralos y detén
if (!empty($errors)) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Error en registro</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
      <div class="container py-5">
        <div class="alert alert-danger">
          <h4 class="alert-heading">No se pudo completar el registro:</h4>
          <ul>
            <?php foreach ($errors as $e): ?>
              <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
          </ul>
          <hr>
          <a href="/../../resource/registro.php" class="btn btn-secondary">Volver al formulario</a>
        </div>
      </div>
    </body>
    </html>
    <?php
    exit;
}

// 7. Insertar nuevo usuario
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $connection->prepare(
    "INSERT INTO usuarios
      (nombre, email, password, rol, telefono, ubicacion, descripcion)
     VALUES (?, ?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param(
    "sssssss",
    $nombre,
    $email,
    $hash,
    $rol,
    $telefono,
    $ubicacion,
    $descripcion
);

if ($stmt->execute()) {
    // Registro exitoso: redirigir al login (o donde tú prefieras)
    header("Location: /../../resource/inicioSesion.php?registro=ok");
    exit;
} else {
    // Error en la inserción
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Error de Base de Datos</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
      <div class="container py-5">
        <div class="alert alert-danger">
          <h4 class="alert-heading">Error al guardar datos:</h4>
          <p><?= htmlspecialchars($stmt->error) ?></p>
          <hr>
          <a href="registro.php" class="btn btn-secondary">Intentar de nuevo</a>
        </div>
      </div>
    </body>
    </html>
    <?php
    exit;
}