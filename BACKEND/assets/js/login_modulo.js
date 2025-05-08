import { validarCampo, emailRegex, passwordRegex, estadoValidacionCampos,enviarFormulario} from "./register.js";

const formLogin = document.querySelector(".form-login");
const inputPass = document.querySelector('.form-login input[type="password"]');
const inputEmail = document.querySelector('.form-login input[type="email"]');
const alertaErrorLogin = document.querySelector(".form-login .alerta-error");
const alertaExitoLogin = document.querySelector(".form-login .alerta-exito");

document.addEventListener("DOMContentLoaded", () => {
    formLogin.addEventListener("submit", (e) => {
      estadoValidacionCampos.userName = true;
      e.preventDefault();
      enviarFormulario(formLogin,alertaErrorLogin,alertaExitoLogin);
    });
  
    inputEmail.addEventListener("input", () => {
      validarCampo(emailRegex,inputEmail,"El correo solo puede contener letras, números, puntos, guiones y guíon bajo.");
    });
  
    inputPass.addEventListener("input", () => {
      validarCampo(passwordRegex,inputPass,"La contraseña tiene que ser de 4 a 12 dígitos");
    });
});


document
  .getElementById("registerForm")
  .addEventListener("submit", function (event) {
    const form = event.target;
    const errorDiv = document.getElementById("errorRegister");
    const successDiv = document.getElementById("successRegister");

    if (!form.checkValidity()) {
      event.preventDefault();
      errorDiv.style.display = "block";
      successDiv.style.display = "none";
    } else {
      errorDiv.style.display = "none";
      successDiv.style.display = "block";
    }
  });

document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    const form = event.target;
    const errorDiv = document.getElementById("errorLogin");
    const successDiv = document.getElementById("successLogin");

    if (!form.checkValidity()) {
      event.preventDefault();
      errorDiv.style.display = "block";
      successDiv.style.display = "none";
    } else {
      errorDiv.style.display = "none";
      successDiv.style.display = "block";
    }
  });