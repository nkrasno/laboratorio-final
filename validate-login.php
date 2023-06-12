<?php
if (isset($_POST['login-username']) && isset($_POST['login-password'])) {
    // Obtener datos del formulario de inicio de sesión
    $usuario = $_POST['login-username'];
    $contrasena = $_POST['login-password'];

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cursosql";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta SQL para verificar el usuario y la contraseña
    $sql = "SELECT * FROM suscriptores WHERE USERNAME = '$usuario' AND USERPASS = '$contrasena'";
    $result = $conn->query($sql);

    // Verificar si se encontró un registro
    if ($result->num_rows > 0) {
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

            // Cerrar la conexión a la base de datos
            $conn->close();

            // HTML y enlace a la hoja de estilos
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <title>Tabla de suscriptores</title>
                <link rel="stylesheet" href="table-styles.css">
            </head>
            <body>
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
                <div class="container">
                    <div class="form-container">
                        <h1>Tabla de suscriptores</h1>
                        <div class="table-container"><?php echo $table; ?></div>
                        <div class="button-container">
                            <a href="index.php" class="btn">Volver</a>
                        </div>
                    </div>
                </div>
            </body>
            </html>
            <?php
        } else {
            $error_message = "No se encontraron registros.";
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <title>Error</title>
                <link rel="stylesheet" href="table-styles.css">
            </head>
            <body>
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
                <div class="container">
                    <div class="error-container">
                        <p class="error-message"><?php echo $error_message; ?></p>
                        <div class="button-container">
                            <a href="index.php" class="btn">Volver</a>
                        </div>
                    </div>
                </div>
            </body>
            </html>
            <?php
        }
    } else {
        $error_message = "Usuario y/o contraseña incorrectos.";
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Error</title>
            <link rel="stylesheet" href="table-styles.css">
        </head>
        <body>
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
            <div class="container">
                <div class="form-container">
                    <div class="error-message"><?php echo $error_message; ?></div>
                    <div class="button-container">
                        <a href="index.php" class="btn">Volver</a>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
} else {
    $error_message = "No se recibieron los datos del formulario.";
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Error</title>
        <link rel="stylesheet" href="table-styles.css">
    </head>
    <body>
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
        <div class="container">
            <div class="form-container">
                <div class="error-message"><?php echo $error_message; ?></div>
                <div class="button-container">
                    <a href="index.php" class="btn">Volver</a>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
}
