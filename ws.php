<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = clean_input($_POST['correo']);
    $clave = clean_input($_POST['clave']);
    
    if ($_POST['action'] === 'register') {
        if (!preg_match("/^(?=.*[0-9])(?=.{8,})/", $clave)) {
            exit(json_encode(["success" => false, "message" => "La contraseña debe tener mínimo 8 caracteres y un número."]));
        }
        $clave_hash = password_hash($clave, PASSWORD_DEFAULT);
        $query = $mysqli->prepare("SELECT * FROM usuario WHERE correo = ?");
        $query->bind_param("s", $correo);
        $query->execute();
        if ($query->get_result()->num_rows > 0) {
            exit(json_encode(["success" => false, "message" => "El correo ya está registrado."]));
        }
        $stmt = $mysqli->prepare("INSERT INTO usuario (correo, clave) VALUES (?, ?)");
        $stmt->bind_param("ss", $correo, $clave_hash);
        $stmt->execute();
        exit(json_encode(["success" => true, "message" => "Registro exitoso."]));
    }
    
    if ($_POST['action'] === 'login') {
        $query = $mysqli->prepare("SELECT * FROM usuario WHERE correo = ?");
        $query->bind_param("s", $correo);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        if ($result && password_verify($clave, $result['clave'])) {
            $_SESSION['correo'] = $correo;
            exit(json_encode(["success" => true, "message" => "Inicio de sesión exitoso."]));
        }
        exit(json_encode(["success" => false, "message" => "Credenciales incorrectas."]));
    }
}

if ($_GET['action'] === 'logout') {
    session_destroy();
    header("Location: login.php");
}
?>