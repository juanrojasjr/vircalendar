<?php
    session_start();

    include_once 'core/conexion.php';

    if (isset($_SESSION["usernamelog"])) {
        header('location: admin');
    }else {
        if($_POST){
            $userName = $_POST['email'];
            $userPass = $_POST['password'];
        
            //VERIFICAR SI EL USUARIO EXISTE
            $sql = 'SELECT * FROM user WHERE Email=?';
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute(array($userName));
            $resultado = $sentencia->fetch();   
            if(!$resultado){
                echo '<script>alert("No existe el usuario")</script>';
            }elseif( password_verify($userPass, $resultado['Password']) ){
                //$_SESSION["id_user"] = $resultado['ID_USER'];
                $_SESSION["usernamelog"] = $resultado['FirstName'];
                header('location: admin');
            }else{
                echo '<script>alert("No son iguales las contraseñas")</script>';
            }
        }
    }
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">

    <title>VirtCalendar | Michael Bernal & Juan Rojas</title>
  </head>
  <body>
    <main>
        <div class="page d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="login-form card p-5 text-center shadow-lg">
                            <div class="panel">
                                <figure>
                                    <img src="image/logo.svg" alt="Logo VirtCalendar" class="img-fluid w-50">
                                </figure>
                                <!-- <h2>VirtCalendar</h2> -->
                                <p>Ingrese sus credenciales</p>
                            </div>
                            <form id="Login" class="w-50 mx-auto" method="POST">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email Address">                
                                </div>                        
                                <div class="form-group">       
                                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">                
                                </div>
                                <div class="forgot mb-2">
                                    <a href="registro.html" class="text-secondary">¿No tiene cuenta?</a>
                                    <a href="reset.html" class="text-secondary">¿Olvidaste la contraseña?</a>
                                </div>
                                <button type="submit" class="btn btn-primary">Ingresar</button>                
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>