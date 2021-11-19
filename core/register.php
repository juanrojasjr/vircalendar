<?php

    include_once '../core/conexion.php';

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $phone = $_POST['phone'];

    $pass_encryp = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `user`(`FirstName`, `LastName`, `Email`, `Password`, `Phone`) VALUES (?,?,?,?,?)";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($firstname, $lastname, $email, $pass_encryp, $phone));
    $resultado = $sentencia->fetch();

    $retVal = (!$resultado) ? 1 : 0 ;

    echo $retVal;