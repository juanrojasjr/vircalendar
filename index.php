<?php
    session_start();
    //echo password_hash("123456", PASSWORD_DEFAULT)."\n";
    include 'layout/head.html';
?>
    <div class="errorContainer" style="display: none"></div>
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
                            <form id="login" class="w-75 mx-auto" method="POST">
                                <div class="mb-3">
                                    <input type="text" id="nickname" name="nickname" class="form-control" placeholder="Nombre de usuario">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                </div>
                                <div class="forgot mb-3">
                                    <a href="register" class="text-secondary">¿No tiene cuenta?</a>
                                    <a href="#modal-forgotpassword" data-bs-toggle="modal" class="text-secondary">¿Olvidaste la contraseña?</a>
                                </div>
                                <button type="submit" class="btn btn-primary">Ingresar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- <div class="main-div"> -->
            </div>
        </div>
    </main>

<!-- Modal -->
<div class="modal fade" id="modal-forgotpassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Recuperar contraseña</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Correo electrónico</label>
                <input type="email" class="form-control" id="email-forgot" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Se le enviará una contraseña alternativa a su correo electrónico.</small>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Recuperar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
    include 'layout/footer.html';