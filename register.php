<?php
    include 'layout/head.html';

    //Valida si existe el elemento.
    if (isset($_POST['submit'])) {
        $config = include 'core/config.php';

        //Establece la conexión con el servidor de base de datos
        $connection = new PDO($config['db']['common'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        $resultado = [
            'error' => false,
            'mensaje' => 'El usuario ' . $_POST['firstname'] . ' ha sido agregado con éxito'
        ];

        try {
            // Encriptación de la contraseña
            $pass = $_POST['password'];
            $pass_encryp = password_hash($pass, PASSWORD_DEFAULT);

            // Recogemos y almacenamos la información del usuario en un arreglo
            $newUser = [
                "nickname" => $_POST['nickname'],
                "password" => $pass_encryp,
                "firstname" => $_POST['firstname'],
                "lastname" => $_POST['lastname'],
                "email" => $_POST['email'],
                "age" => $_POST['age']
            ];

            $sql = "INSERT INTO users_data (nickname, password, firstname, lastname, email, age)";
            $sql .= "VALUES (:" . implode(", :", array_keys($newUser)) . ")";
            $sent = $connection->prepare($sql);
            $sent->execute($newUser);

        } catch (PDOException $error) {
            $resultado['error'] = true;
            $resultado['mensaje'] = $error->getMessage();
        }
    }

    if (isset($resultado)) {
        ?>
        <div class="container mt-3">
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
                <?= $resultado['mensaje'] ?>
              </div>
            </div>
          </div>
        </div>
        <?php
    }
?>
    <main>
        <div class="page d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="login-form card p-5 text-center shadow-lg">
                            <div class="panel">
                                <figure class="mb-0">
                                    <img src="image/logo.svg" alt="Logo VirtCalendar" class="img-fluid w-50">
                                </figure>
                            </div>
                            <form id="register" class="w-75 mx-auto" method="POST">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Nombre" name="firstname">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Apellidos" name="lastname">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Nombre de usuario" name="nickname">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" placeholder="Edad" name="age">
                                    </div>
                                    <div class="col">
                                        <input type="password" class="form-control" placeholder="Contraseña" name="password">
                                    </div>
                                    <div class="col">
                                        <input type="email" class="form-control" placeholder="Correo electrónico" name="email" >
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="actions mt-3">
                                        <a href="/" class="btn btn-secunday">Volver</a>
                                        <button type="submit" name="submit" class="btn btn-primary">Registrarme</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="main-div">
            </div>
        </div>
        <footer>
        </footer>
    </main>

<?php
    include 'layout/footer.html';
    //Si no hay errores, redirecciona al home.
?>