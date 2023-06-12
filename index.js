const checkbox = document.getElementById("toggleB");
const card = document.getElementById("card");
const toggleRegistry = document.getElementById("button-toggle-registry");
const toggleLogin = document.getElementById("button-toggle-login");
const nombre = document.getElementById("nombre");
const apellido1 = document.getElementById("apellido1");
const apellido2 = document.getElementById("apellido2");
const email = document.getElementById("email");
const username = document.getElementById("username");
const password = document.getElementById("password");
const loginUsername = document.getElementById("login-username");
const loginPassword = document.getElementById("login-password");
const registryButton = document.getElementById("button-registry");
const loginButton = document.getElementById("button-login");
const inputs = document.querySelectorAll(
  'input[type="text"], input[type="password"], input[type="email"]'
);
const filledInputs = [];
const formRegistro = document.getElementById("formulario-registro");
const formLogin = document.getElementById("formulario-login");

//Gira el formulario si se toca el slider o los botones del toggle
//Da formato a los botones según formulario en pantalla
checkbox.addEventListener("change", () => {
  card.classList.toggle("toggled", checkbox.checked);
  if (!card.classList.contains("toggled")) {
    activateRegistry();
    resetForm();
  } else if (card.classList.contains("toggled")) {
    activateLogin();
    resetForm();
  }
});

toggleRegistry.addEventListener("click", () => {
  checkbox.checked = false;
  card.classList.remove("toggled");
  activateRegistry();
  resetForm();
});

toggleLogin.addEventListener("click", () => {
  checkbox.checked = true;
  card.classList.add("toggled");
  activateLogin();
  resetForm();
});

//Activa formulario de registro
function activateRegistry() {
  toggleRegistry.classList.add("active");
  toggleRegistry.classList.remove("inactive");
  toggleLogin.classList.remove("active");
  toggleLogin.classList.add("inactive");
}

//Activa formualario de login
function activateLogin() {
  toggleLogin.classList.add("active");
  toggleLogin.classList.remove("inactive");
  toggleRegistry.classList.remove("active");
  toggleRegistry.classList.add("inactive");
}

//Resetar el formulario de Login o Registro
function resetForm() {
  if (toggleRegistry.classList.contains("active")) {
    formLogin.reset();
  }
  if (toggleLogin.classList.contains("active")) {
    formRegistro.reset();
  }
}

// Función para comprobar el formulario de registro
function checkRegistrationForm() {
  // Comprobar que los campos no estén vacíos
  if (
    nombre.value === "" ||
    apellido1.value === "" ||
    apellido2.value === "" ||
    email.value === "" ||
    password.value === ""
  ) {
    alert("Todos los campos son obligatorios");
    return false;
  }

  // Comprobar que nombre, apellido1 y apellido2 no contengan números
  let regexNombres = /\d/;
  if (
    regexNombres.test(nombre.value) ||
    regexNombres.test(apellido1.value) ||
    regexNombres.test(apellido2.value)
  ) {
    alert(
      "El nombre, primer apellido y segundo apellido no deben contener números"
    );
    return false;
  }

  // Comprobar que el correo cumpla con el regex
  let regexEmail = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
  if (!regexEmail.test(email.value)) {
    alert("Ingrese un correo válido");
    return false;
  }

  // Comprobar que la contraseña tenga entre 4 y 8 caracteres
  if (password.value.length < 4 || password.value.length > 8) {
    alert("La contraseña debe tener entre 4 y 8 caracteres");
    return false;
  }

  alert("Verificando inscripción");
  formRegistro.submit();
  return true;
}

// Función para comprobar el formulario de login
function checkLoginForm() {
  // Comprobar que los campos no estén vacíos
  if (loginUsername.value === "" || loginPassword.value === "") {
    alert("Todos los campos son obligatorios");
    return false;
  }

  alert("Verificando datos de login");
  formLogin.submit();
  return true;
}

//Escucha si el usuario ha apretado el botón
registryButton.addEventListener("click", checkRegistrationForm);
loginButton.addEventListener("click", checkLoginForm);
