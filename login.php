<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "conexion-login.php";
    if ($pdo) {
        $conexion = $pdo;
    } else {
        $conexion = null;
        $errorMessage = "No se pudo establecer conexión con la base de datos.";
    }
    $user = $_POST['usuario'] ?? '';
    $contra = $_POST['contra'] ?? '';
    $sql = "SELECT * FROM users WHERE nombre = :usuario AND contra = :contra";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':usuario', $user);
        $consulta->bindParam(':contra', $contra);
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            header("Location: index.php");
            exit();
            } else {
                $errorMessage = "Usuario o contraseña incorrectos.";
                }
    }
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login laboratorio</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <main class="pagina-login">
        <section class="cuadro-login" >
            <h1 id="login-title">Login</h1>

            <form method="POST" action="">
                <label>USUARIO</label>
                <input type="text" id="usuario" name="usuario"  required >
                    <br>
                    <br>
                    <label>CONTRASEÑA</label>
                    <input type="text" id="contra" name="contra"  required >
                <button type="submit">Continuar</button>
            </form>
        </section>
    </main>
</body>
