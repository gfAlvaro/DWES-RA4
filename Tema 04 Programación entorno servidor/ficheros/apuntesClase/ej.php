<?php
    session_start();
    if(!isset($_SESSION['auth'])){
        $_SESSION['auth'] = false;
    }

    if (isset($_POST['enviar'])){
        if(($_POST['usuario'] == 'usuario') and ($_POST['psw'] == '1234')){
            $_SESSION['auth'] = true;
        }
    }
        define("DIRUPLOAD",'upload/');
        define("MAXSIZE",200000);
    
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $allowedFormat = array("image/gif","image/jpeg","image/jpg","image/jpeg","image/x-png","image/png");
        

        if(isset($_POST['submit'])){
        //Obtenemos la extensión, podriamos hacerlo tambien con pathinfo() más adelante.
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);
        
        if (( $_FILES["file"]["size"] < MAXSIZE) && 
              in_array($_FILES["file"]["type"],$allowedFormat)  && 
              in_array($extension, $allowedExts)) {
    
            if ($_FILES["file"]["error"] > 0)    {
                 echo "Return Code: " . $_FILES["file"]["error"] . "<br/>";
            }else {
                $filename = $_FILES["file"]["name"];
                /* Conviene renombrar la imagen bien con el id de una base de datos o con un 
                identificador único
                */
               // $filename = time() . $filename; 
                $filename = uniqid().'.'.pathinfo($filename,PATHINFO_EXTENSION);
                echo "Fichero subido <br>";
                if (file_exists(DIRUPLOAD .$filename )) {
                    echo $_FILES["file"]["name"] . " el fichero ya existe. ";
                 }
                else {  
                    move_uploaded_file($_FILES["file"]["tmp_name"], DIRUPLOAD . $filename);
                    echo "Guardado en: " . DIRUPLOAD . $filename;
                    echo "<br>";
                    
                 }
                echo "<br/>";
                echo '<a href="javascript:history.back()">Volver</a>';
          }
      }else {
        echo "Fichero no válido";
    }
        }
    // mostrar las imagenes subidas en el directorio uploadç
    $dir = opendir(DIRUPLOAD);
    while ($archivo = readdir($dir)){
        if ($archivo != "." && $archivo != ".."){
            echo "<img src='".DIRUPLOAD.$archivo."' width='100' height='100'/>";
        }
    }

    if(isset($_POST['salir'])){
        $_SESSION['auth'] = false;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
        <?php
        if($_SESSION['auth']){
            echo '<h1>Subida de archivos.</h1>';
            echo '<form action="" method="post" enctype="multipart/form-data">';
            echo '<label for="file">Filename:</label>';
            echo '<input type="file" name="file" id="file"><br/>';
            echo '<input type="submit" name="submit" value="Submit">';
            echo '<input type="submit" name="salir" value="Cerrar Sesion">';
            echo '</form>';
        }else{
            echo '<h1>autenticacion</h1>';
            include "form.html";
        }
        ?>
    </body>
</html>