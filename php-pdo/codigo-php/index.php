<?php
try {
    $enlace = new PDO("mysql:host=db;dbname=ejerciciosphp", "alumnado", "pestillo");
    // Selecciona modo de excepción
    $enlace->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM usuarios";
    $rs = $enlace->query($sql);
    // foreach( coleccion as variable_iteracion )
    foreach( $rs as $fila ) {
        echo $fila['id'] . " [PDO]: " . $fila['username'] . " correo: " . $fila['email'] . "<br>\n";
    }
    echo "Conectado satisfactoriamente por PDO para Raul\n";
} catch(PDOException $e) {
    die('Error: ' . $e->getMessage());
}
$enlace = null;
?>
