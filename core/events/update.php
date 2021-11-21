<?php
$config = include '../config.php';

//Id del evento
$eid = $_POST['eid'];
//Se recibe un array desde JS y los elementos tienen el siguiente orden:
// 0: name/titulo, 1: fecha inicio, 2: fecha fin, 3: hora inicio, 4: hora fin, 5: descripción, 6: color
$data = json_decode($_POST['data']);

//Establece la conexión con el servidor de base de datos
$connection = new PDO($config['db']['common'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);

try {
    $sql = "UPDATE `events` SET `name`=?,`desc`=?,`date_start`=?,`date_end`=?,`hour_start`=?,`hour_end`=?,`color`=? WHERE eid =?";
    $sent = $connection->prepare($sql);
    $sent->execute(array($data[0],$data[5],$data[1],$data[2],$data[3],$data[4],$data[6],$eid));
    echo 1;
} catch (PDOException $error) {
    echo $error;
}

