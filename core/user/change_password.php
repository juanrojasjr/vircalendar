<?php

    $config = include '../config.php';

    //Establece la conexión con el servidor de base de datos
    $connection = new PDO($config['db']['common'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $result = [
        'changed' => false,
        'msg' => ''
    ];

    $uid = $_POST['uid'];
    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];

    $sent = $connection->prepare("SELECT password FROM users_data WHERE uid = ?");
    $sent->execute(array($uid));
    $resultado = $sent->fetch();

    if (password_verify($oldPass, $resultado[0])){
        //Encriptar la contraseña
        $passEncry = password_hash($newPass, PASSWORD_BCRYPT);
        //Actualiza la db con la nueva contraseña
        $sentUpdt = $connection->prepare("UPDATE users_data SET password=? WHERE uid=?");
        $sentUpdt->execute(array($passEncry,$uid));

        $result['changed'] = true;
    }

    echo json_encode($result);