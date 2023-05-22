<?php
session_start();

$config = include '../config.php';

$nickname = $_POST['nickname'];
$pass = $_POST['pass'];

$callback = [
    'error' => false,
    'msg' => '',
    'uid' => 0,
    'name' => $nickname,
];

//Establece la conexión con el servidor de base de datos
$connection = new PDO($config['db']['common'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);

try {
    $sql = "SELECT uid, nickname, password, firstname FROM users_data WHERE nickname = ?";
    $sent = $connection->prepare($sql);
    $sent->execute(array($nickname));
    $resultado = $sent->fetch();

    //Valida si existe el usuario ingresado.
    if(!$resultado){
        $callback['error'] = true;
        $callback['msg'] = 'El usuario no existe.';
    //Si el usuario existe, valida la contraseña ingresada con la almacenada.
    }else if (password_verify($pass, $resultado[2])) {
        $_SESSION['u_name'] = $resultado[1];
        $_SESSION['uid'] = $resultado[0];
        $callback['uid'] = $resultado[0];
        $callback['name'] = $resultado[3];
    }else{
        //En caso contrario, la contraseña es incorrecta.
        $callback['error'] = true;
        $callback['msg'] = 'La contraseña no es correcta.';
    }
} catch (PDOException $error) {
    $callback['error'] = true;
    $callback['msg'] = $error->getMessage();
}

//Devuelve el array asociativo con las respuestas.
echo json_encode($callback);