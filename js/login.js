export function loginInit() {
  /* Inicio de sesión */
  $('#login button[type="submit"]').click(function (e) {
    e.preventDefault();
    let nickname = $("#nickname").val(),
      pass = $("#password").val();
    $.ajax({
      method: "POST",
      url: "core/user/login.php",
      data: { nickname: nickname, pass: pass },
    }).done(function (msg) {
      const errors = JSON.parse(msg);
      const errContainer = $(".errorContainer");
      if (errors["error"]) {
        let html = `<div class="alert alert-${errors["error"] ? "danger" : "success"}" role="alert">${errors["msg"]}</div>`;
        errContainer.show();
        $(html).appendTo(errContainer);
      } else {
        sessionStorage.setItem("uid", errors["uid"]);
        sessionStorage.setItem("firstname", errors["name"]);
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
      url: "core/user/forgot_password.php",
      data: { email: email },
    }).done(function (msg) {
      console.log(msg);
    });
  });

  /* Cambiar contraseña */
  $('#changePassModal button[type="submit"]').click(function (e) {
    e.preventDefault();
    $('#changePassModal input').removeClass('is-invalid');
    $('#oldPassMsg').addClass('d-none')
    let uid = sessionStorage.getItem('uid'),
      oldPass = $("#oldPass").val(),
      newPass = $("#newPass").val(),
      repNewPass = $("#repNewPass").val();
    if (newPass === repNewPass) {
      $.ajax({
        method: "POST",
        url: "core/user/change_password.php",
        data: { uid, oldPass, newPass },
      }).done(function (msg) {
        const result = JSON.parse(msg);
        if (result['changed']) {
          $('#changePassModal').modal('hide');
          Swal.fire({
            icon: "success",
            title: "¡Listo!",
            text: "La contraseña se ha actualizado.",
            showConfirmButton: false,
            timer: 3000,
          });
        } else {
          $("#oldPass").addClass('is-invalid');
          $('#oldPassMsg').removeClass('d-none');
        }
      });
    } else {
      $("#newPass").addClass('is-invalid');
      $("#repNewPass").addClass('is-invalid');
    }
  });

  $('#closeSession').click(function (e) {
    sessionStorage.clear();
    window.location.href = 'core/user/close.php';
  })

}
