<?php
define('DB_NAME', 'registro');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

function clean_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>