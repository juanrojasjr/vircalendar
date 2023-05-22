<?php

$config = include 'config.php';

$result = [
  'msg' => '',
  'exists' => false,
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Instalación | <?php echo $config['site']['name']; ?></title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style type="text/css">
    .codeBlock{
        background-color: black;
        color: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 2rem;
    }
    .codeBlock p{
      margin-bottom: 0;
      font-style: italic;
    }
  </style>
</head>
<body>
  <main class="container min-vh-100 d-flex flex-column justify-content-center align-items-center">
    <h1 class="text-center mb-5">🚀 Instalación de <?php echo $config['site']['name']; ?> 🚀</h1>
    <?php
      //Conexión a la base de datos
      $conexion = new PDO($config['db']['start'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);
      $stmt = $conexion->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $config['db']['nameDb'] . "'");
      // if ($result['msg'] != '00000' || $result['msg'] == '' && $stmt->fetchColumn() != 1) {
      if ($stmt->fetchColumn() != 1) {
        echo '<div class="codeBlock w-50 shadow-lg">
                <h4 class="text-white-50 border-bottom border-secondary pb-2 mb-3 text-center">Registro de actividades ✏</h4>
                <div class="mx-auto w-75 text-center">';
                  try {
                    //Creando la base de datos
                    $createDB = "CREATE DATABASE " . $config['db']['nameDb'];
                    $conexion->exec($createDB);
                    echo '<p>Base de datos <span class="text-muted">..........</span> creada con <span class="text-success">éxito</span>.</p>';
                    //Utilizando la base de datos creada
                    $conexionDB = new PDO($config['db']['common'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);
                    //Creando las tablas y registros
                    try {
                      $sql = file_get_contents("sqlDataBase.sql");
                      $conexionDB->exec($sql);
                      echo '<p>Tabla de roles de usuario <span class="text-muted">..........</span> creada con <span class="text-success">éxito</span></p>';
                      echo '<p>Tabla de usuarios <span class="text-muted">..........</span> creada con <span class="text-success">éxito</span></p>';
                      echo '<p>Tabla de eventos <span class="text-muted">..........</span> creada con <span class="text-success">éxito</span></p>';
                      echo '<hr class="text-warning">';
                      echo '<p>Roles <span class="text-muted">..........</span> creado con <span class="text-success">éxito</span></p>';
                      echo '<hr class="text-warning">';
                      echo '<p>Usuario DEMO <span class="text-muted">..........</span> creado con <span class="text-success">éxito</span></p>';
                      echo '<hr class="text-warning">';
                      echo '<p>Eventos de ejemplo <span class="text-muted">..........</span> creados con <span class="text-success">éxito</span></p>';
                    } catch(PDOException $error) {
                      echo $error->getMessage();
                    }          
                  } catch(PDOException $error) {
                    echo $error->getMessage();
                  }
                  $result['msg'] = $conexion->errorCode();
          echo '</div></div>';
      } else {
        $result['exists'] = true; 
      }
    ?>
    <?php
      if ($result['msg'] == '00000' || $result['msg'] == '' && !$result['exists']) {
        echo '<div class="card w-50 bg-success shadow-lg">';
      } else {
        echo '<div class="card w-50 bg-warning shadow-lg">';
      }
    ?>
      <div class="card-body text-center text-white">
        <p><?php
          if ($result['exists']) {
            echo '<h2 class="mb-4">💪 ¡Ya todo está instalado! 💪</h2>';
            echo "<a href='/' class='btn btn-light btn-lg text-uppercase' role='button'>⬅ volver</a>";
          }else if ($result['msg'] == '00000') {
            echo '<h2>✔ ¡Todo instalado! ✔</h2>';
            echo '<p class="w-75 mt-4 mx-auto">Hemos instalado un usuario y tres eventos por ti, lo sabemos, de nada.</p>';
          ?>
          <table class="table w-75 mx-auto text-white">
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
            echo '<p>Disfrútalo y gracias por instalar <strong>'. $config['site']['name'] . '</strong></p>';
            echo "<a href='/' class='btn btn-light btn-lg text-uppercase' role='button'>⬅ vamo' a darle</a>";
          }
        ?></p>
      </div>
    </div>
  </main>
</body>
</html>