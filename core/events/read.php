<?php
$config = include '../config.php';

$uid = $_POST['uid'];

//? Para realizar pruebas ?uid=1
// $uid = $_GET['uid'];

//Establece la conexión con el servidor de base de datos
$connection = new PDO($config['db']['common'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);

//Realiza la consulta con PDO
$sql = "SELECT * FROM events WHERE uid = ?";
$sent = $connection->prepare($sql);
$sent->execute(array($uid));
$res = $sent->fetchAll();

$arrayV = [];

//Recorre los resultados y los organiza de forma fácil para FullCalendar
foreach ($res as $key) {
    $arrayV[] = array(
        "title" => $key['name'],
        "invited" => $key['invited'],
        "start" => $key['date_start'],
        "end"   => $key['date_end'],
        "desc" => $key['desc'],
        "hourstar" => $key['hour_start'],
        "hourend" => $key['hour_end'],
        "color" => $key['color'],
        "eid" => $key['eid'],
        "textColor" => '#ffffff',
    );
}
//Codifica el array a JSON
$resEncodeA  = json_encode($arrayV);

//Imprime el resultado para que lo lea FullCalendar
echo $resEncodeA;