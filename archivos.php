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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    
    <meta charset="utf-8">
    <title Blog CSCW></title>
    
    <link href="CSS/blog.css" rel="stylesheet">
    <link href="CSS/bootstrap.css" rel="stylesheet">
    
    
    <script src="JS/bootstrap.js"></script>
          <script src="JS/jquery.js"></script>
          <script src="JS/jquery.flexslider.js"></script>
            <script src="JS/javascript.js"></script>
        <script src="JS/bootstrap-modal.js"></script>
    <script type="text/javascript" src="JS/jquery.scrollTo.min.js"></script>
    <script src="JS/admin.js" type="text/javascript"></script>
    
   

    
</head>

    <body>
    
         <!-- BARRA DE NAVEGACION -->
           <nav class="navbar navbar-inverse navbar-fixed-top">
               <div class="container">
                <div class="navbar-header">
                <a class="navbar-brand" align=left >CS-Blog-CW!</a>
                   </div>
                   <div id="navbar" class="collapse navbar-collapse">
                       
                       <!--Parte izquierda de Navbar -->
                   <ul class="nav navbar-nav">
                        <li ><a href="index.php">Home</a></li>
                        
                       <li><a href="mensajes.php">Mensajes</a></li>
                       <li class="active"><a  href="archivos.php">Archivos</a></li>
                       <li><a></a></li>
                       <li><a></a></li>
                       <li><a></a></li>
                       <li><a></a></li>
                       <li><a></a></li>
                       <li><a></a></li>
                       <li><a style="font-size:15px;">Hola <?php echo $usuario; ?>!</a></li>
                   </ul>
                       
                      
                       
                       <!--Parte derecha de Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="salir.php"><button class="btn btn-primary"  type="button" >Salir</button></a>
                        </li>
                       </ul>
                
                </div>
                </div>
               
               
            
        </nav>

        <!-- FIN BARRA DE NAVEGACION -->

        <form action="ftp_enviar.php"method="post" enctype="multipart/form-data" style="margin-top:50px;" >
		<div>Fichero: <input type="file" name="file" id="file" maxlength="45"></div>
		<dif><input type="submit" name="enviar" value="enviar"/></div>
	</form>
        
        
  <table class="table table-bordered" style="margin-top:60px; margin-left:10%;">

                <tr height="200px">
                    <td>
                        <table class="table table-hover" title="Contenido" border="0" >
                            <tr>
                            <td class="success"><span class="glyphicon glyphicon-paperclip"></span> Mis Archivos</td></tr>
                <tr>
                    <td><strong>Archivo</strong></td>
                    <td><strong>Fecha Upload</strong></td>
                    <td><strong>Tamaño</strong></td>

                </tr >
                <?php
                $stmt = $db->prepare('SELECT * FROM files WHERE prop = '$usuario);
                $stmt->execute(array(':username' => $_SESSION['user_login']));
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $long = count($row);
                for ($i = 0; $i <= $long - 1; $i++) {
                    $id = $row[$i]['id_file'];
                    $usern = $_SESSION['user_login'];
                    echo "<tr>";
                    echo "<td>" . $row[$i]['nombre'] . "</td>";
                    echo "<td>" . $row[$i]['hora'] . "</td>";
                    echo "<td>" . $row[$i]['peso'] . " Kb</td>";
                    echo '<td><a href="eliminar.php?nombre=' . $row[$i]['nombre'] . '&id=' . $id . '"a>Eliminar<td>';
                    echo '<td><a href="descargar.php?nombre=' . $row[$i]['nombre'] . '&usu=' . $usern . '"a>Descargar<td>';
                    echo "</tr>";
                }
                
               
                ?>

                </tr>
            </table>
            </td>
 

        
    </body>
</html>
