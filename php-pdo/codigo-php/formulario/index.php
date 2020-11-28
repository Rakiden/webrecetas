<?php
require('conexion.php');
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Datos del usuario</title>
    </head>
    <body>
        <h1>Bienvenido a nuestra web</h1>
        <?php

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sql = $enlace->prepare("SELECT * FROM usuarios WHERE username = :username");
            $sql->bindParam(':username', $_POST['name']);
            $sql->execute();
            // foreach( coleccion as variable_iteracion )
            foreach( $sql as $fila ) {
                echo $fila['id'] . " [PDO]: " . $fila['username'] . " correo: " . $fila['email'] . "<br>\n";
            }
            echo '<span>Gracias, '.$_POST['name'];
        } else {
            echo
            '<form action="." method="POST" enctype="multipart/form-data">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name">
            <input type="submit" value="Go!">
            </form>';
        }

        // Importante cerrar bloque php
        ?>
    </body>
</html>
