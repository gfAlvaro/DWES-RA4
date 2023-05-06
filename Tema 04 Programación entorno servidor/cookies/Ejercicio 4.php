<?php
    /*4. Incluir en vuestro servidor un contador que indique al usuario el número de veces que ha visitado
    el sitio.*/
    if(  !isset( $_COOKIE["contador"] )  )
            setcookie( "contador", 1 );
    else
        setcookie( "contador", $_COOKIE["contador"] + 1 );

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Álvaro García Fuentes">
        <title>Ejercicio 4 Cookies</title>
    </head>
    <body>
        <header><h1>Ejercicio 4 Cookies</h1></header>
        <main>
            <?php echo "<p>Veces que has entrado: ".$_COOKIE["contador"]."</p>"; ?>
        </main>
        <footer>
            <p><a href="#">Código fuente.</a></p>
            <p><a href="index.php">Atrás.</a></p>
        </footer>
    </body>
</html>
