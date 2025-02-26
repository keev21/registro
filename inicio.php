<?php session_start(); if (!isset($_SESSION['correo'])) header("Location: login.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 text-center">
        <h1>Bienvenido, <?php echo $_SESSION['correo']; ?>!</h1>
        <a href="ws.php?action=logout" class="btn btn-danger">Cerrar Sesión</a>
    </div>
</body>
</html>