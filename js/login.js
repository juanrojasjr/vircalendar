function loginInit() {
  /* Inicio de sesión */
  $('#login button[type="submit"]').click(function (e) {
    e.preventDefault();
    let nickname = $("#nickname").val(),
      pass = $("#password").val();
    $.ajax({
      method: "POST",
      url: "core/login.php",
      data: { nickname: nickname, pass: pass },
    }).done(function (msg) {
      const errors = JSON.parse(msg);
      const errContainer = $(".errorContainer");

      if (errors["error"]) {
        let html = `<div class="alert alert-${
          errors["error"] ? "danger" : "success"
        }" role="alert">${errors["msg"]}</div>`;
        errContainer.show();
        $(html).appendTo(errContainer);
      } else {
        sessionStorage.setItem("uid", errors["uid"]);
        setTimeout(function () {
          window.location.href = "home";
        }, 1000);
      }
    });
  });

  /* Reestablecer contraseña olvidada */
  $('#modal-forgotpassword button[type="submit"]').click(function (e) {
    e.preventDefault();
    const email = $("#email-forgot").val();
    $.ajax({
      method: "POST",
      url: "core/forgot_password.php",
      data: { email: email },
    }).done(function (msg) {
      console.log(msg);
      // if (msg==0) {
      //     alertD.removeClass('d-none')
      // }else{
      //     alertS.removeClass('d-none')
      // }
    });
  });

  function closeSession() {
    sessionStorage.clear();
    window.location.href = "/";
  }
}
