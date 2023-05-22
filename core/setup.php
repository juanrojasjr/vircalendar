<?php
    include '../layout/head.html';

    //Se acciona después de enviar el formulario
    if (isset($_POST['submit'])) {
        //Captura de datos
        $hostForm = $_POST['host'];
        $userForm = $_POST['user'];
        $passForm = $_POST['pass'];
        $dbnameForm = $_POST['dbname'];
        $appnameForm = $_POST['appname'];
        $emailForm = $_POST['email'];

        //Construcción de la información del archivo
        $dataForm = "<?php\n\n\$host = '$hostForm';\n\$user = '$userForm';\n\$pass = '$passForm';\n\$nameDb = '$dbnameForm';\n\nreturn [\n    'db' => [
        'start' => 'mysql:host='. \$host,
        'common' => 'mysql:host='.\$host.';dbname='.\$nameDb,
        'nameDb' => \$nameDb,
        'user' => \$user,
        'pass' => \$pass,
        'options' => [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
    ],
    'site' => [
        'name' => '$appnameForm',
        'correo' => '$emailForm'
    ]\n];";

        //Valida si la creación fue exitosa
        if (file_put_contents('config.php', $dataForm)) {
            //Al serlo, es dirigido a la instalación
            header( 'Location: install.php' );
            exit;
        }
    }
?>
    <main>
        <div class="page d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="login-form card p-5 shadow-lg">
                            <form id="register" class="w-75 mx-auto" method="POST">
                                <div class="row g-3 justify-content-center">
                                    <!-- Info DB -->
                                    <div class="col-12">
                                        <h2>Información de la base de datos</h2>
                                        <hr>
                                    </div>
                                    <!-- Host -->
                                    <div class="col-4">
                                        <label for="host" class="col-form-label">Host: </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="host" id="host">
                                    </div>
                                    <!-- User -->
                                    <div class="col-4">
                                        <label for="user" class="col-form-label">User: </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="user" id="user">
                                    </div>
                                    <!-- Password -->
                                    <div class="col-4">
                                        <label for="pass" class="col-form-label">Password: </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="pass" id="pass">
                                    </div>
                                    <!-- DBname -->
                                    <div class="col-4">
                                        <label for="dbname" class="col-form-label">DB Name: </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="dbname" id="dbname">
                                        <span class="form-text">Si está vacío, por defecto será: vircalendar</span>
                                    </div>
                                    <!-- Info APP -->
                                    <div class="col-12">
                                        <h2>Información de la aplicación</h2>
                                        <hr>
                                        <span class="form-text">Esta información es por si quiere cambiar el nombre de la aplicación y el correo para las notificaciones de administración.</span>
                                    </div>
                                    <!-- Name app -->
                                    <div class="col-4">
                                        <label for="appname" class="col-form-label">Nombre: </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="appname" id="appname">
                                    </div>
                                    <!-- Email -->
                                    <div class="col-4">
                                        <label for="email" class="col-form-label">Correo electrónico: </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="email" class="form-control" name="email" id="email">
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="actions mt-5 text-center">
                                        <button type="submit" name="submit" class="btn btn-primary">Instalar</button>
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
    include '../layout/footer.html';
?>