<?php

    include( "config/config.php" );
    session_start();

    if(  !isset( $_SESSION['imagenes'] )  ){
        $_SESSION['imagenes'] = [];
        foreach(  scandir( __DIR__."/piezas" ) as $pieza )
            if( $pieza != '.' && $pieza != '..' )
                $_SESSION['imagenes'][] = $pieza;
        shuffle( $_SESSION['imagenes'] );
    }

    $dosRespuestas = true;
    $enviado = isset( $_POST['respuesta'] );
    if( $enviado ){
        $cuenta = 0;
        foreach( $_POST['respuesta'] as $respuesta )
            if(  $respuesta != null )
                $cuenta++;

        $dosRespuestas = $cuenta == 2;
    }    
?>
<!DOCTYPE html>
<html lang="ES">
    <head>
        <meta name="author" content="Álvaro García Fuentes">
        <meta charset="utf-8">
        <title>Repaso UD4</title>
    </head>
    <body>
        <header><h1>Puzzle por parejas</h1></header>
        <main>
            <form action="" method="POST">
                <?php
                    if(  isset( $_SESSION['imagenes'] )  )
                        foreach( $_SESSION['imagenes'] as $valor => $pieza )
                            if( $pieza != '.' && $pieza != '..' ){
                                echo "<label>";
                                echo "<input type='checkbox' name='respuesta[$valor]' value='".$pieza[0]."'>";
                                echo "<img src='piezas/".$pieza."'>";
                                echo "</label>&nbsp";
                            }
                ?>
                <br><button type='submit'>Enviar</button><br><br>
            </form>
            <?php
                if( $enviado ){
                    if( $dosRespuestas ){
                        foreach( $_POST['respuesta'] as $respuesta )
                            if( $respuesta != null )
                                echo "<img src='piezas/".$respuesta.".JPG'><br>";
                        
                        $cuenta = 0;
                        foreach($soluciones as $solucion ){
                            foreach( $_POST['respuesta'] as $respuesta )
                                if( $solucion[0] == $respuesta || $solucion[1] == $respuesta )
                                    $cuenta++;

                            if( $cuenta == 2) break;
                            $cuenta = 0;
                        }
                        
                        echo $cuenta == 2? "<p>CORRECTO</p>"
                                         : "<p>INCORRECTO</p>";

                    } else
                        echo "<p>Se deben seleccionar dos piezas exactamente.</p>";
                }
            ?>
            <br><br>
        </main>
        <footer>
            <a href='../index.php'>Atrás</a>
        </footer>
    </body>
</html>