<?php
$config = include '../config.php';

$eid = $_POST['eid'];

//Establece la conexión con el servidor de base de datos
$connection = new PDO($config['db']['common'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);

try {
    $sql = "DELETE FROM events WHERE eid = ?";
    $sent = $connection->prepare($sql);
    $sent->execute(array($eid));
    echo 1;
} catch (PDOException $error) {
    echo $error;
}