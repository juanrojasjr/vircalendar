<?php
  $config = include 'core/config.php';
  include 'layout/head.html';
?>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#"><?php echo $config['site']['name']; ?></a>

        <span class="firstname"></span>

        <div id="userMnu">
          <div class="photo" style="background: url('https://picsum.photos/200/') center center / cover"></div>
          <ul class="mnu shadow-lg">
            <li data-bs-toggle="modal" data-bs-target="#changePassModal"><i class="bi bi-key-fill"></i> Cambiar contraseña</li>
            <li class="text-danger" id="closeSession"><i class="bi bi-box-arrow-right"></i> Cerrar cesión</li>
          </ul>
        </div>

      </div>
    </nav>
  </header>

  <main>
    <div class="page p-5">
      <div class="card p-5">
        <div id='calendar'></div>
        <div class="noLogin text-center d-none">
          <p>No se ha iniciado sesión correctamente.</p>
          <a href="/">Inciar sesión</a>
        </div>
      </div>
    </div>
  </main>

  <!-- Modal addEvent-->
  <div class="modal fade" id="addEvent" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addEventLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addEventLabel">Agregar un evento</h5>
        </div>
        <div class="modal-body">
          <form>
            <div class="row g-3">
              <div class="col-12">
                <input type="text" class="form-control" id="tt" placeholder="Titulo del evento">
              </div>
              <div class="col-12">
                <input type="email" class="form-control" id="invited" placeholder="Invitados">
                <span class="text-muted">Escriba los correos electrónicos separados por comas.</span>
              </div>
              <div class="col">
                <label for="ds" class="form-label">📅 Fecha de inicio</label>
                <input type="date" class="form-control" id="ds" placeholder="Fecha inicio">
              </div>
              <div class="col">
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" id="endDate">
                  <label class="form-check-label" for="endDate">
                  📅 Fecha fin
                  </label>
                </div>
                <input type="date" class="form-control" id="de" disabled>
              </div>
              <div class="col">
                <label for="exampleInputEmail1" class="mb-2">⏰ Hora inicio</label>
                <input type="time" class="form-control" id="hs">
              </div>
              <div class="col">
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" id="endHour">
                  <label class="form-check-label" for="endHour">
                  ⏰ Hora de fin
                  </label>
                </div>
                <input type="time" class="form-control" id="he" disabled>
              </div>
              <div class="col-md-12">
                <label for="dc" class="form-label">Descripción</label>
                <textarea class="form-control" id="dc" rows="3"></textarea>
              </div>
              <div class="col-md-12">
                <label for="cl" class="form-label">Color del evento</label>
                <input type="color" id="cl" class="form-control">
              </div>
              <span class="text-muted">Serán notificadas las personas que estén invitadas vía correo electrónico.</span>
            </div>
            <div class="modal-footer mt-2">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal see information -->
  <div class="modal fade" id="eventModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <div class="btn-group" role="group">
              <button type="button" class="btn btn-outline-warning btn-sm" id="btnUpdateInputs">🖊 Modificar</button>
              <button type="button" class="btn btn-outline-danger btn-sm" id="btnDeleteEvent">🗑 Eliminar</button>
          </div>
        </div>
        <div class="modal-body text-center"></div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-success" id="btnSaveUpdt" style="display: none;">Guardar</button>
          <button type="button" class="btn btn-secondary btnClose" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal change passwords -->
  <div class="modal fade" id="changePassModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          Cambiar la contraseña
        </div>
        <div class="modal-body text-center">
          <form id="changePassForm" method="POST">
            <div class="mb-3 d-none">
                <input type="text" id="user" name="user" class="form-control" placeholder="user" autocomplete="user">
            </div>
            <div class="mb-3">
                <input type="password" id="oldPass" name="oldPass" class="form-control" placeholder="Contraseña anterior" autocomplete="current-password">
                <span class="text-danger d-none" id="oldPassMsg">La contraseña anterior, no coincide con la que tenemos en la base de datos.</span>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="newPass" name="newPass" placeholder="Nueva contraseña" autocomplete="new-password">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="repNewPass" name="repNewPass" placeholder="Repetir nueva contraseña" autocomplete="new-password">
            </div>
          </form>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-success" id="btnSaveChangePass">Cambiar</button>
          <button type="button" class="btn btn-secondary btnClose" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

<?php
    include 'layout/footer.html';
?>