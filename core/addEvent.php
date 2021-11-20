<?php

$config = include 'config.php';

//Establece la conexión con el servidor de base de datos
$connection = new PDO($config['db']['common'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);

$result = 0;

$event = [
    'uid' => $_POST['uid'],
    'tt' => $_POST['tt'],
    'dc' => $_POST['dc'],
    'ds' => $_POST['ds'],
    'de' => $_POST['de'],
    'hs' => $_POST['hs'],
    'he' => $_POST['he'],
    'cl' => $_POST['cl']
];

// foreach($event as $key => $val) {
//     echo "$key = $val ||";
// }

try {

    $sql = "INSERT INTO events(uid, name, `desc`, date_start, date_end, hour_start, hour_end, color)";
    $sql .= "VALUES (:" . implode(", :", array_keys($event)) . ")";
    $sent = $connection->prepare($sql);
    $sent->execute($event);
    $result = 1;

} catch (PDOException $error) {
    $result = $error->getMessage();
}

echo $result;