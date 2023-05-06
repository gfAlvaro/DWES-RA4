<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ES">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PUBLICO</title>
    </head>
    <body>
        <nav>
            <a href="index.php">Inicio</a>&nbsp;
            <?php
            if ($_SESSION['loggedin']) {
                echo '<a href="private.php">Privado</a>&nbsp;';
                echo '<a href="logout.php">Salir</a>';
                echo "<h2>Bienvenido ".$_SESSION["username"]."</h2>";
            }  
            ?>
        </nav>
        <h1>Pagina Publica</h1>
    </body>
</html>