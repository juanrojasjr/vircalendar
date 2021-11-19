<?php
  include 'layout/head.html';
?>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">
              <img src="./image/logo.svg" width="30" alt="" loading="lazy">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#addEvent" data-toggle="modal">Agregar evento</a>
              </li>
              <li class="nav-item dropdown">
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
              </li>
            </ul>
          </div>
      </nav>
    </header>

    <main>
      <div class="page d-flex p-5">
        <div class="card p-5">
          <div id='calendar'></div>
        </div>
      </div>
    </main>

  <!-- Modal -->
  <div class="modal fade" id="addEvent" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addEventLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addEventLabel">Agregar un evento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" class="form-control" id="tt" placeholder="Titulo del evento">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="exampleInputEmail1">Fecha del evento</label>
                  <input type="date" class="form-control" id="ds" placeholder="Fecha inicio">
                </div>
              </div>
              <div class="col">
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" id="endDate">
                  <label class="form-check-label" for="endDate">
                    Fin del evento
                  </label>
                </div>
                <div class="form-group">
                  <input type="date" class="form-control" id="de" disabled>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="exampleInputEmail1">Hora de inicio</label>
                  <input type="time" class="form-control" id="hs">
                </div>
              </div>
              <div class="col">
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" id="endHour">
                  <label class="form-check-label" for="endHour">
                    Hora de fin
                  </label>
                </div>
                <div class="form-group">
                  <input type="time" class="form-control" id="he" disabled>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="dc">Descripción</label>
                  <textarea class="form-control" id="dc" rows="3"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cl">Color del evento</label>
                  <input type="color" id="cl" class="form-control">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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