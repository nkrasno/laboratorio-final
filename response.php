<?php
session_start();

if (isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['apellido2']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
  // Obtener los datos del formulario
  $nombre = $_POST["nombre"];
  $apellido1 = $_POST["apellido1"];
  $apellido2 = $_POST["apellido2"];
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Validar los campos del formulario
  $errors = array();

  if (empty($nombre)) {
    $errors[] = "El campo Nombre es obligatorio";
  }

  if (empty($apellido1)) {
    $errors[] = "El campo Primer Apellido es obligatorio";
  }

  if (empty($apellido2)) {
    $errors[] = "El campo Segundo Apellido es obligatorio";
  }

  if (empty($email)) {
    $errors[] = "El campo Email es obligatorio";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "El formato del Email es inválido";
  }

  if (empty($username)) {
    $errors[] = "El campo Nombre de Usuario es obligatorio";
  }

  if (empty($password)) {
    $errors[] = "El campo Contraseña es obligatorio";
  } elseif (strlen($password) < 4 || strlen($password) > 8) {
    $errors[] = "La contraseña debe tener entre 4 y 8 caracteres";
  }

  // Establecer la conexión con la base de datos
  $servername = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "cursosql";

  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  // Verificar la conexión
  if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
  }

  // Verificar si el correo electrónico ya existe en la base de datos
  $emailExists = false;

  $checkEmailQuery = "SELECT COUNT(*) as count FROM suscriptores WHERE EMAIL = '$email'";
  $result = $conn->query($checkEmailQuery);

  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $emailCount = $row['count'];
    if ($emailCount > 0) {
      $emailExists = true;
    }
  }

  // Mostrar mensaje de error si el correo electrónico ya existe
  if ($emailExists) {
    $errorMessage = "El correo electrónico ya está registrado. Por favor, vuelva atrás.";
  }

  // Insertar los datos en la base de datos si no hay errores
  if (empty($errors) && !$emailExists) {
    $sql = "INSERT INTO suscriptores (NOMBRE, APELLIDO1, APELLIDO2, EMAIL, USERNAME, USERPASS) VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$username', '$password')";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
      $successMessage = "Registro completado con éxito";
      $userData = array(
        'Nombre' => $nombre,
        'Primer Apellido' => $apellido1,
        'Segundo Apellido' => $apellido2,
        'Email' => $email,
        'Nombre de Usuario' => $username,
      );

      // Consulta SQL para obtener todos los registros de la tabla
      $sql = "SELECT * FROM suscriptores";
      $result = $conn->query($sql);

      // Verificar si se encontraron registros
      if ($result->num_rows > 0) {
        // Crear una variable para almacenar la tabla HTML
        $table = "<table>";
        $table .= "<tr><th>ID</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th><th>Email</th><th>Usuario</th></tr>";

        while ($row = $result->fetch_assoc()) {
          $table .= "<tr>";
          $table .= "<td>" . $row['ID'] . "</td>";
          $table .= "<td>" . $row['NOMBRE'] . "</td>";
          $table .= "<td>" . $row['APELLIDO1'] . "</td>";
          $table .= "<td>" . $row['APELLIDO2'] . "</td>";
          $table .= "<td>" . $row['EMAIL'] . "</td>";
          $table .= "<td>" . $row['USERNAME'] . "</td>";
          $table .= "</tr>";
        }

        $table .= "</table>";
      }
    } else {
      $errorMessage = "Error al enviar el formulario: " . $conn->error;
    }
  }

  // Cerrar la conexión
  $conn->close();
} else {
  $errorMessage = "No se recibieron los datos del formulario";
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Respuesta del Formulario</title>
  <link href="style.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="form-container">
      <div class="message-container">
        <?php if (isset($errorMessage)) : ?>
          <div class="error-message">
            <?php echo $errorMessage; ?>
          </div>
          <div class="button-container">
            <a href="javascript:history.back()" class="btn">Volver</a>
          </div>
        <?php elseif (isset($successMessage)) : ?>
          <div class="success-message">
            <?php echo $successMessage; ?>
          </div>
          <div class="user-data">
            <h2>Datos del usuario:</h2>
            <table>
              <?php foreach ($userData as $key => $value) : ?>
                <tr>
                  <td><?php echo $key; ?>:</td>
                  <td><?php echo $value; ?></td>
                </tr>
              <?php endforeach; ?>
            </table>
          </div>
          <div class="table-container">
            <h2>Registros existentes:</h2>
            <div class="table-container"><?php echo $table; ?></div>
          </div>
          <div class="button-container">
            <a href="index.php" class="btn">Volver</a>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</body>

</html>