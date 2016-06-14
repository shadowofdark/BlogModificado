<?php


      session_name('data');
       session_start();
    
     $usuario = $_SESSION['user_login'];



if(isset($usuario)){
    echo "Bienvenido,",$usuario;}


$conexion = mysqli_connect("localhost","root","1234") 
                    or  die("Problemas en la conexion");

mysqli_select_db($conexion,"wordpress") 
                    or  die("Problemas en la selección de la base de datos");
    
# Comprovamos que se haya enviado algo desde el formulario
if (is_uploaded_file($_FILES['file']['tmp_name'])) {
# Definimos las variables
$host = "192.168.1.8";
$port = 21;
$user = "elio";
$password = "1234";
$ruta = "/home/ubuntu/archivos/";
$fecha = date("d") . " del " . date("m") . " de " . date("Y");
# Realizamos la conexion con el servidor
$conn_id = @ftp_connect($host, $port);
if ($conn_id) {
    # Realizamos el login con nuestro usuario y contraseña
    if (@ftp_login($conn_id, $user, $password)) {
        # Canviamos al directorio especificado
        if (@ftp_chdir($conn_id, $ruta)) {
            if (!@ftp_chdir($conn_id, $ruta . "/" . $_SESSION['user_login'])) {
                ftp_mkdir($conn_id, $ruta . "" . $_SESSION['user_login']); //echo "FC";
                $ruta = $ruta . "" . $_SESSION['user_login'];
                @ftp_chdir($conn_id, $ruta);
            } else {
                echo $ruta = $ruta . "" . $_SESSION['user_login'] . "/";
                @ftp_chdir($conn_id, $ruta);
            }
            # Subimos el fichero
            if (@ftp_put($conn_id, $_FILES["file"]["name"], $_FILES["file"]["tmp_name"], FTP_BINARY)) {
                echo "Fichero subido correctamente";
                $stmt = $db->prepare('INSERT INTO files(direc, nombre, prop,hora,peso) VALUES (:direc, :nombre, :prop, :hora, :peso)');
                $stmt->execute(array(
                    ':direc' => "" . $ruta . "" . $_FILES['file']['name'],
                    ':nombre' => $_FILES['file']['name'],
                    ':prop' => $_SESSION['user_login'],
                    ':hora' => $fecha,
                    ':peso' => round($_FILES['file']['size']/1024)));
            } else
                echo "No ha sido posible subir el fichero";
        } else
            echo "No existe el directorio especificado";
    } else
        echo "El usuario o la contraseña son incorrectos";
    # Cerramos la conexion ftp
    ftp_close($conn_id);
} else
    echo "No ha sido posible conectar con el servidor";
}else {
echo "Selecciona un archivo...";
}
header('Location: archivos.php');
?>