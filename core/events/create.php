<?php

$config = include '../config.php';

//Establece la conexión con el servidor de base de datos
$connection = new PDO($config['db']['common'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);

$result = [
    'event' => false,
    'email' => false,
    'error' => ''
];

$uName = $_POST['uName'];

$event = [
    'uid' => $_POST['uid'],
    'tt' => $_POST['tt'],
    'invited' => $_POST['invited'],
    'dc' => $_POST['dc'],
    'ds' => $_POST['ds'],
    'de' => $_POST['de'],
    'hs' => $_POST['hs'],
    'he' => $_POST['he'],
    'cl' => $_POST['cl']
];

//Enviar correo invitación, si el usuario llenó el campo
if ($event['invited'] !== '') {
    $dest = $event['invited']; //Email de destino
    $asunto = "Has recibido una invitación de " . $uName . " vía " . $GLOBALS['config']['site']['name']; //Asunto
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
                        <h1>Has recibido una invitación de ". $uName ."</h1>
                    </header>
                    <div>
                        <h3>Estos son los datos de invitación</h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Título:<td>
                                    <td>". $event['tt'] ."<td>
                                <tr>
                                <tr>
                                    <td>Descripción:<td>
                                    <td>". $event['dc'] ."<td>
                                <tr>
                                <tr>
                                    <td>Día:<td>
                                    <td>". $event['ds'] ." - ". $event['de'] ."<td>
                                <tr>
                                <tr>
                                    <td>Hora:<td>
                                    <td>". $event['hs'] ." - ". $event['he'] ."<td>
                                <tr>
                            <tbody>
                        </table>
                    </div>
                </body>
                </html>"; //Cuerpo del mensaje

    //Cabeceras del correo
    $headers = "From:". $GLOBALS['config']['site']['name']." <". $GLOBALS['config']['site']['correo'] .">\r\n"; //Quien envia?
    $headers .= "X-Mailer: PHP5\n";
    $headers .= 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; //

    if(mail($dest,$asunto,$cuerpo,$headers)){
        $result['email'] = true;
    }
}

try {
    $sql = "INSERT INTO events(uid, name, `invited`,`desc`, date_start, date_end, hour_start, hour_end, color)";
    $sql .= "VALUES (:" . implode(", :", array_keys($event)) . ")";
    $sent = $connection->prepare($sql);
    $sent->execute($event);
    $result['event'] = true;
} catch (PDOException $error) {
    $result['error'] = $error->getMessage();
}

//Codifica el array a JSON
$resEncodeA  = json_encode($result);

//Imprime el resultado para que lo lea FullCalendar
echo $resEncodeA;