<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "nardelli";

// Crear la conexión
$conexion = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Recuperar datos del formulario
$nombre_usuario = mysqli_real_escape_string($conexion, $_POST['User']);
$contrasena = mysqli_real_escape_string($conexion, $_POST['Password']);

// Consulta SQL para verificar las credenciales
$query = "SELECT id_sesion FROM sesion WHERE usuario = '$nombre_usuario' AND clave = '$contrasena'";
$result = mysqli_query($conexion, $query);

if (mysqli_num_rows($result) > 0) {
    // Autenticación exitosa
    session_start();
    $_SESSION['User'] = $nombre_usuario;
    header("Location: ../html/menu.html");
} else {
    // Credenciales invalidas
    
    echo "Usuario o contraseña incorrectos. Inténtalo nuevamente.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>

