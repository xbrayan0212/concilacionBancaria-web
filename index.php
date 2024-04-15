<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/loginStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
       
</head>
<body>
    <main>
        <div class="contenedor">
            <div class="imagen">
                <img src="https://images.pexels.com/photos/2385477/pexels-photo-2385477.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
            </div>
            <div class="login">
                <div class="logo">
                <img src="imagenes/logologin.png" alt="">
                <h1>Elite Snikers</h1>
                </div>
                <h2>Bienvenido de Vuelta</h2>
                <form action="logica/usuarioDB.php" method="post">
                    <label for="cedula">
                        <img src="imagenes/icons8-tarjeta-de-identificación-24.png" alt="">
                        <input class="input" name="cedula" placeholder="Ingrese su Cedula" type="text">
                    </label>
                    <label for="contraseña">
                        <img src="imagenes/icons8-contraseña-24.png" alt="">
                        <input class="input" name="contraseña" placeholder="Ingrese su Contraseña " type="text">
                    </label>
                        <?php
                            if(isset($_SESSION['mensajeError'])) {
                                echo "<p class='errorM'>" . $_SESSION['mensajeError'] ."</p>";
                                unset($_SESSION['mensajeError']);
                            }
                        ?>
                    <button type="submit">Login</button>
                </form>
                <p>¡Camina con estilo, camina con calidad!</p>
            </div>
        </div>
    </main>
</body>
</html>