<?php
    session_start();
    if( !isset( $_POST ) )
        $_SESSION["dwes"];
    if(  isset( $_POST ) 
      && isset( $_POST['trimestre1'] )
      && isset( $_POST['trimestre2'] )
      && isset( $_POST['trimestre3'] )  )
        $_SESSION["dwes"][$_POST["nombre"]] = [ "1" => $_POST["trimestre1"],
                                                "2" => $_POST["trimestre2"],
                                                "3" => $_POST["trimestre3"],
                                                "media" =>( $_POST["trimestre1"] 
                                                          + $_POST["trimestre2"]
                                                          + $_POST["trimestre3"] ) / 3 ];
?>
<!DOCTYPE html>
<html lang="ES">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Álvaro García Fuentes">
        <title>Sesiones ejercicio 2</title>
    </head>
    <body>
        <header><h1>Sesiones ejercicio 2</h1></header>
        <main>
            <?php
                echo "<form action='index.php' method='POST'>";
                echo "<label>Nombre: <input type='text' name='nombre'></label>";
                echo "<br><label>Nota 1º trimestre: <input type='text' name='trimestre1'></label>";
                echo "<br><label>Nota 2º trimestre: <input type='text' name='trimestre2'></label>";
                echo "<br><label>Nota 3º trimestre: <input type='text' name='trimestre3'></label>";
                echo "<br><button type='submit'>Enviar</button>";
                echo "</form>";

                if( isset( $_POST ) )
                    foreach( $_SESSION['dwes'] as $nombre => $alumno )
                        echo "<p>Nombre: ".$nombre
                        ."; 1º trimestre: ".$alumno['1']
                        ."; 2º trimestre: ".$alumno['2']
                        ."; 3º trimestre: ".$alumno['3']
                        ."; media: ".$alumno['media']."</p>";
            ?>
        </main>
        <footer>
            <p><a href="#">Código fuente</a></p>    
            <p><a href="../index.php">Atrás</a></p>
        </footer>
    </body>
</html>