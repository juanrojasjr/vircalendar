<?php
    $usuario = 'root';
    $contraseña = '';
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=vircalendar', $usuario, $contraseña);
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }