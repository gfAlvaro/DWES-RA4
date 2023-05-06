<!DOCTYPE html>
<html lang="ES">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Álvaro García Fuentes">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/estilos.css">
        <title>Tema 4 Programación entorno servidor</title>
    </head>
    <body>
        <header><h1>Tema 4 Programación entorno servidor</h1></header>
        <main>
            <?php
                echo "<ul>";
                foreach( scandir( getcwd() ) as $file )
                    if( $file != "index.php"
                     && $file != "."
                     && $file != ".." )
                        echo "<li><b><a href='$file'>$file</a></b></li>";
                echo "</ul>";
            ?>
        </main>
        <footer>
            <p><a href="../index.php" class='footlink'>Atrás</a></p>
            <p><a href="#" class='footlink'>Código fuente</a></p>
        </footer>
    </body>
</html>