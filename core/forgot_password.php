<?php
    $config = include 'core/config.php';

    //Establece la conexión con el servidor de base de datos
    $connection = new PDO($config['db']['common'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $email = $_POST['email'];

    $sql = 'SELECT IdUser, Email FROM user WHERE Email=?';
    $sent = $pdo->prepare($sql);
    $sent->execute(array($email));
    $res = $sent->fetch();

    if ($res) {
            //Carácteres para la contraseña
            $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890*/$#";
            $password = "";
            //Reconstruimos la contraseña segun la longitud que se quiera
            for($i=0 ; $i<8 ; $i++) {
                //obtenemos un caracter aleatorio escogido de la cadena de caracteres
                $password .= substr($str,rand(0,62),1);
            }
            $iddUser = $res['IdUser'];
            sendEmail($password,$iddUser,$email);
    }else {
        echo 0;
        // echo 'El usuario ingresado no existe';
    }

    function sendEmail($pass,$iddUser,$email){
        include '../core/conexion.php';

        $passEncry = password_hash($pass, PASSWORD_BCRYPT);

        //Actualiza la db con la nueva contraseña
        $sqlUp = 'UPDATE user SET Password=? WHERE IdUser=?';
        $sent1 = $pdo->prepare($sqlUp);
        $sent1->execute(array($passEncry,$iddUser));

        $dest = $email; //Email de destino
        $nombre = 'VirtCalendar';
        $asunto = "Reestablecer contraseña - VirCalendar"; //Asunto
        $cuerpo = "
                    <!DOCTYPE html>
                    <html lang='es'>
                    <head>
                    <head>
                        <meta charset='UTF-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
                    </head>
                    </head>
                    <body>
                        <header>
                            <h1>¿Olvidaste la contraseña?</h1>
                        </header>
                        <div>
                            <p>No te preocupes, aquí tienes una nueva.</p>
                            <p>Recuerda cambiarla por una que no olvides al momento de ingresar al sistema.</p>
                            <code> ".$pass."</code>
                        </div>
                    </body>
                    </html>"; //Cuerpo del mensaje
                    
        //Cabeceras del correo
        $headers = "From: $nombre <soporte@vircalendar.com>\r\n"; //Quien envia?
        $headers .= "X-Mailer: PHP5\n";
        $headers .= 'MIME-Version: 1.0' . "\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; //

        if(mail($dest,$asunto,$cuerpo,$headers)){
            $result = 1;
        }else{
            $result = 0;
        }
        
        echo $result;
    }
