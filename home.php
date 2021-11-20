<?php
  include 'layout/head.html';
?>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="#">VirCalendar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#addEvent" data-bs-toggle="modal">Agregar evento</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/" onclick="closeSession()">Cerrar sesión</a>
              </li>
              <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Categorías
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Entretenimiento</a>
                  <a class="dropdown-item" href="#">Estudio</a>
                  <a class="dropdown-item" href="#">Trabajo</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Ver todos</a>
                </div>
              </li> -->
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

  <!-- Modal -->
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
              <div class="col">
                <label for="ds" class="form-label">Fecha del evento</label>
                <input type="date" class="form-control" id="ds" placeholder="Fecha inicio">
              </div>
              <div class="col">
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" id="endDate">
                  <label class="form-check-label" for="endDate">
                    Fin del evento
                  </label>
                </div>
                <input type="date" class="form-control" id="de" disabled>
              </div>
              <div class="col">
                <label for="exampleInputEmail1">Hora de inicio</label>
                <input type="time" class="form-control" id="hs">
              </div>
              <div class="col">
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" id="endHour">
                  <label class="form-check-label" for="endHour">
                    Hora de fin
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

<?php
    include 'layout/footer.html';
?>