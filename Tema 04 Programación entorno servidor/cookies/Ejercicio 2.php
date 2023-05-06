<?php
    /* 2. Escriba una página que compruebe si el navegador permite crear cookies y se lo diga al usuario
    (mediante una o más páginas).*/
    setcookie( "micookie", rand(1,10) );
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Álvaro García Fuentes">
        <title>Ejercicio 2 Cookies</title>
    </head>
    <body>
        <header><h1>Ejercicio 2 Cookies</h1></header>
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
