<?php
    /*3. Crea un formulario de login que permita al usuario recordar los datos introducidos. Incluye una
    opción para borrar la información almacenada.*/
    if( isset( $_POST ) ){
        $borrado = false;
        if( isset( $_POST['borrar'] ) ){
            unset( $_COOKIE['user'] );
            unset( $_COOKIE['password'] );
            $borrado = true;
        } else {
            setcookie( "user", $_POST["user"] );
            setcookie( "password", $_POST["password"] );
            $borrado = false;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Álvaro García Fuentes">
        <title>Ejercicio 3 Cookies</title>
    </head>
    <body>
        <header><h1>Ejercicio 3 Cookies</h1></header>
        <main>
            <?php
                echo "<form action='Ejercicio 3.php' method='POST'>";
                echo "<label>Usuario: <input type='text' name='user'></label>";
                echo "<label>Contraseña: <input type='text' name='password'></label>";
                echo "<label>¿Borrar datos? <input type='radio' name='borrar'></label>";
                echo "<button type='submit'>Enviar</button>";
                echo "</form>";

                if( isset( $_POST ) ){
                    echo "Usuario: ".$_COOKIE['user'];
                    if( $borrado )
                        echo "<p>Datos borrados.</p>";
                    else
                        echo "<p>Datos guardados</p>";
                }
            ?>
        </main>
        <footer>
            <p><a href="#">Código fuente.</a></p>
            <p><a href="index.php">Atrás.</a></p>
        </footer>
    </body>
</html>
