<?php
    /*5. Incorpora a tu servidor un mensaje que indique al usuario el tiempo transcurrido desde su último
    acceso y un mensaje personalizado en función de éste. */

    setcookie( "visita", time() - ( isset( $_COOKIE["visita"] )? $_COOKIE["visita"] : 0 )  );
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Álvaro García Fuentes">
        <title>Ejercicio 5 Cookies</title>
    </head>
    <body>
        <header><h1>Ejercicio 5 Cookies</h1></header>
        <main>
            <?php
                echo "<p>";
                echo isset( $_COOKIE["visita"] )?
                        "Tiempo desde la última visita: ".$_COOKIE["visita"]
                    :   "Esta es tu primera visita.";
                echo "</p>";
            ?>
        </main>
        <footer>
            <p><a href="#">Código fuente.</a></p>
            <p><a href="index.php">Atrás.</a></p>
        </footer>
    </body>
</html>
