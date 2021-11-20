<?php

$config = include 'core/config.php';

$result = [
  'msg' => 'La base de datos y tablas ya está creadas.'
];

$conexion = new PDO($config['db']['start'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);

try {
  $sql = file_get_contents("core/sqlDataBase.sql");
  $conexion->exec($sql);
  $result['msg'] = "La base de datos y tablas necesarias han sido creadas con éxito.";
} catch(PDOException $error) {
  $result['msg'] = $error->getMessage();
}
$result['msg'] = $conexion->errorCode();
//echo $conexion->errorCode();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Instalación | VirCalendar</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
  <main class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card">
      <div class="card-body text-center">
        <p class="lead">Instalación de VirCalendar</p>
        <p><?php
          if ($result['msg'] == 'HY000') {
            echo '<h2 class="text-warning">¡Ya todo está instalado!</h2>';
            echo '<a href="/" class="link-primary text-decoration-none text-start d-block mt-3">⬅ volver</a>';
          }else if ($result['msg'] == '00000') {
            echo '<h2 class="text-success">¡Todo instalado!</h2>';
            echo '<p class="w-75 mt-4 mx-auto">Hemos instalado un usuario y tres eventos por ti, lo sabemos, de nada.</p>';
          ?>
          <table class="table w-75 mx-auto">
            <tr>
              <th>Usuario</th>
              <th>Contraseña</th>
            </tr>
            <tr>
              <td>demo</td>
              <td>demo</td>
            </tr>
          </table>
          <?php
            echo '<p>Disfrútalo y gracias por instalar VirCalendar.</p>';
            echo "<a href='/' class='link-success text-decoration-none'>⬅ vamo' a darle</a>";
          }
        ?></p>
      </div>
    </div>
  </main>
</body>
</html>