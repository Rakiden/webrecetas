<?php
try {
    $enlace = new PDO("mysql:host=db;dbname=ejerciciosphp", "alumnado", "pestillo");
    // Selecciona modo de excepción
    $enlace->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die('Error: ' . $e->getMessage());
}
?>
