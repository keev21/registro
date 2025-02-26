
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">Inicio de Sesión</div>
                    <div class="card-body">
                        <form id="loginForm">
                            <div class="mb-3">
                                <label class="form-label">Correo:</label>
                                <input type="email" class="form-control" name="correo" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contraseña:</label>
                                <input type="password" class="form-control" name="clave" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                            <a href="registro.php" class="btn btn-secondary w-100 mt-2">Registrarse</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#loginForm").submit(function(event) {
            event.preventDefault();
            $.post("ws.php", $(this).serialize() + "&action=login", function(response) {
                alert(response.message);
                if (response.success) window.location.href = "inicio.php";
            }, "json");
        });
    </script>
</body>
</html>