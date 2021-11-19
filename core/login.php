<?php
session_start();

include_once '../core/conexion.php';

$mail_login = $_POST['mail'];
$pass_login = $_POST['pass'];


//VERIFICAR SI EL USUARIO EXISTE
$sql = 'SELECT Email, Password FROM user WHERE Email = ?';
$sentencia = $pdo->prepare($sql);
$sentencia->execute(array($mail_login));
$resultado = $sentencia->fetch();

if(!$resultado){
    //matar la operación
    echo 'No existe el usuario';
    die();
}

if( password_verify($pass_login, $resultado['Password']) ){
    //las contraseñas son igual
    $_SESSION['admin'] = $mail_login;
    //header('location: ../panel-admin/');
    echo 1;
}else{
    echo 'No son iguales las contraseñas';
    die();
}