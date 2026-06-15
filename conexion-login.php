<?php
$host = "localhost";
$db = "usuarios";
$user = "root";
$pass = "";
try {
    $pdo = new PDO (
        dsn: "mysql:host=$host;port=3306;dbname=$db;charset=utf8",
        username: $user,
        password: $pass);
    $pdo->setAttribute(attribute: PDO::ATTR_ERRMODE,
                    value: PDO::ERRMODE_EXCEPTION);
}   catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
