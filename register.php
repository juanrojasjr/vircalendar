<?php
    include 'layout/head.html';
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
                            <form id="register" class="w-50 mx-auto">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" placeholder="Nombre" id="firstname">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" placeholder="Apellidos" id="lastname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" placeholder="Correo electrónico">                
                                </div>                        
                                <div class="form-group">                
                                    <input type="password" class="form-control" id="password" placeholder="Password">                
                                </div>
                                <div class="form-group">                
                                    <input type="password" class="form-control" id="password2" placeholder="Repita la contraseña">
                                </div>
                                <div class="form-group">
                                    <input type="phone" class="form-control" placeholder="Teléfono" id="phone">
                                </div>
                                <div class="form-footer border-top">
                                    <div class="actions mt-3">
                                        <button type="submit" class="btn btn-primary">Registrarme</button>                
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
?>