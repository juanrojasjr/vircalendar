<?php

include '../core/conexion.php';

$tt = $_POST['tt'];
$ds = $_POST['ds'];
$de = $_POST['de'];
$hs = $_POST['hs'];
$he = $_POST['he'];
$dc = $_POST['dc'];
$cl = $_POST['cl'];

// $sql = "INSERT INTO events VALUES(?,?,?,?,?,?,?)";
$sql = "INSERT INTO `events`(`DateStar`, `DateEnd`, `Description`, `Title`, `HourStar`, `HourEnd`, `Color`) VALUES (?,?,?,?,?,?,?)";
$sent = $pdo->prepare($sql);
$sent->execute(array($ds, $de, $dc, $tt, $hs, $he, $cl));

echo 1;