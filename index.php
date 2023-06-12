<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet">
  <title>Registro de usuarios</title>
</head>

<body>
  <div class="container">
    <div class="area">
      <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </div>
    <div class="toggle-container">
      <span class="toggle-group"><button class="active" id="button-toggle-registry" name="submit" type="button">Registrarse</button></span>
      <div class="toggle-group">
        <label class="switch">
          <input class="toggle" id="toggleB" type="checkbox">
          <div class="slider"></div>
        </label>
      </div>
      <span class="toggle-group"><button class="inactive" id="button-toggle-login" name="submit" type="button">Login</button></span>
    </div>


    <div class="flip-container" id="card">
      <div class="form-wrapper flipper">
        <div class="front register form-container" id="register-form">
          <form id="formulario-registro" name="formulario-registro" action="response.php" method="post" onsubmit="return false;">
            <div class="form-group">
              <label for="nombre">Nombre:</label>
              <input id="nombre" name="nombre" type="text" required value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
            </div>
            <div class="form-group">
              <label for="apellido1">Primer apellido:</label>
              <input id="apellido1" name="apellido1" type="text" required value="<?php echo isset($_POST['apellido1']) ? $_POST['apellido1'] : ''; ?>">
            </div>
            <div class="form-group">
              <label for="apellido2">Segundo apellido:</label>
              <input id="apellido2" name="apellido2" type="text" required value="<?php echo isset($_POST['apellido2']) ? $_POST['apellido2'] : ''; ?>">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input id="email" name="email" type="email" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
            </div>
            <div class="form-group">
              <label for="username">Nombre de usuario:</label>
              <input id="username" name="username" type="text" required value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
            </div>
            <div class="form-group">
              <label for="password">Contraseña:</label>
              <input id="password" name="password" type="password" required>
            </div>
            <button class="button" id="button-registry" name="submit-registry" type="submit">Enviar</button>
          </form>
        </div>
        <div class="back login form-container " id="login-form">
          <form id="formulario-login" name="formulario-login" action="validate-login.php" method="post" onsubmit="return false;">
            <div class="form-group">
              <label for="login-username">Usuario:</label>
              <input id="login-username" name="login-username" type="text" required>
            </div>
            <div class="form-group">
              <label for="login-password">Contraseña:</label>
              <input id="login-password" name="login-password" type="password" required>
            </div>
            <button class="button" id="button-login" name="submit-login" type="submit">Consultar registros</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="index.js"></script>

</html>