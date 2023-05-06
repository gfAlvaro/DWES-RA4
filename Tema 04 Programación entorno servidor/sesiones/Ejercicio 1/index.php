<?php
    session_start();
    if( !isset( $_POST ) )
        $_SESSION['agenda'] = [];
    if( isset( $_POST ) )
        $_SESSION["agenda"][$_POST["nombre"]] = $_POST["telefono"];
?>
<!DOCTYPE html>
<html lang="ES">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Álvaro García Fuentes">
        <title>Sesiones ejercicio 1</title>
    </head>
    <body>
        <header><h1>Sesiones ejercicio 1</h1></header>
        <main>
            <?php
                echo "<form action='index.php' method='POST'>";
                echo "<label>Nombre: <input type='text' name='nombre'></label>";
                echo "<label> Teléfono: <input type='text' name='telefono'></label>";
                echo "<br><button type='submit'>Enviar</button>";
                echo "</form>";

                if( isset( $_POST ) )
                    foreach( $_SESSION['agenda'] as $nombre => $telefono )
                        echo "<p>Nombre: $nombre, Teléfono: $telefono</p>";
            ?>
        </main>
        <footer>
            <p><a href="#">Código fuente</a></p>
            <p><a href="../index.php">Atrás</a></p>
        </footer>
    </body>
</html>