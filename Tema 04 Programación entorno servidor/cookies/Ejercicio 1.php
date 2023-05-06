<?php
    /* 1. Escriba una página que permita crear una cookie de duración limitada, comprobar el estado de la
    cookie y destruirla. */
    setcookie( "micookie", rand(1,10), time()*60 );
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Álvaro García Fuentes">
        <title>Ejercicio 1 Cookies</title>
    </head>
    <body>
        <header><h1>Ejercicio 1 Cookies</h1></header>
        <main>
            <?php
                echo "Valor de la cookie: ".$_COOKIE["micookie"];
                unset( $_COOKIE["micookie"] );
                if( !isset( $_COOKIE["micookie"] ) )
                    echo "<p>Cookie destruida</p>";
            ?>
        </main>
        <footer>
            <p><a href="#">Código fuente.</a></p>
            <p><a href="index.php">Atrás.</a></p>
        </footer>
    </body>
</html>
