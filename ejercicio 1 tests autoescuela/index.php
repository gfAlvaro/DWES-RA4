<?php
    include "config/tests_cnf.php";

    session_start();

    if(  !isset( $_SESSION["random"] ) || isset( $_POST )  )
        $_SESSION["random"] = rand( 0, 2 );

    if( isset( $_POST['idtest'] ) ){
        $_SESSION["anterior"] = $_POST['idtest'];
        $_SESSION["aciertos"] = 0;

        for($i = 1; $i < 11; $i++ )
            if( isset( $_POST["respuesta$i"] ) && $_POST["respuesta$i"] == $aTests[$_SESSION["random"]]["Corrector"] )
                $_SESSION["aciertos"]++;
    }
?>
<!DOCTYPE html>
<html lang="ES">
    <head>
        <meta name="author" content="Álvaro García Fuentes">
        <meta charset="utf-8">
        <title>Repaso UD3</title>
    </head>
    <body>
        <header><h1>Ejercicio 1 tests autoescuela</h1></header>
        <main>
            <?php
                echo "<h2>".$aTests[$_SESSION["random"]]["Permiso"]."</h2>";
                echo "<h2>".$aTests[$_SESSION["random"]]["Categoria"]."</h2>";
                echo "<form action='' method='POST'>";
                echo "<input name='idtest' type='hidden' value='".$aTests[$_SESSION['random']]['idTest']."'>";
                foreach( $aTests[$_SESSION["random"]]["Preguntas"] as $pregunta ){
                    echo "<label>".$pregunta["Pregunta"];
                    if(  file_exists( __DIR__."/dir_img_test".$_SESSION["random"]."/img".$pregunta["idPregunta"].".jpg" )  )
                        echo "<br><img src='dir_img_test".$_SESSION["random"]."/img".$pregunta["idPregunta"].".jpg'>";
                    echo "<br>";
                    foreach( $pregunta["respuestas"] as $respuesta )
                        echo "<input type='radio' name='respuesta".$pregunta['idPregunta']."' value='".substr($respuesta, 0, 1)."'> $respuesta<br>";
                    echo "</label>";
                }
                echo "<button type='submit'>Enviar</button>";
                echo "</form>";
            ?>
            <br>
            <?php
                if( isset( $_SESSION['anterior'] ) ){
                    echo "<p>Último test hecho: ".$_SESSION['anterior']."</p>";
                    echo "<p>Número de aciertos: ".$_SESSION['aciertos']."</p>";
                    echo "<p style='color:".( $_SESSION['aciertos'] > 7 ?
                        "green'>TEST APROBADO" : "red'>TEST SUSPENDIDO")."</p>";
                }
            ?>
        </main>
        <footer>
            <a href='../index.php'>Atrás</a>
        </footer>
    </body>
</html>