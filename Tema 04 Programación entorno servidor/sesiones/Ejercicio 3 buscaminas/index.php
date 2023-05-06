<?php
    session_start();
    if(  !isset( $_SESSION['buscaminas'] )  ){
        $_SESSION['buscaminas']['filas'] = 8;
        $_SESSION['buscaminas']['columnas'] = 8;
        $_SESSION['buscaminas']['bombas'] = 10;
        $_SESSION['buscaminas']['tablero'] = [];
        $_SESSION['buscaminas']['pulsadas'] = [];
    }
	// Crea array con ceros
    function creaArrayTablero(){
        for( $i = 0; $i < $_SESSION['buscaminas']['filas']; $i++ )
            for( $j = 0; $j < $_SESSION['buscaminas']['columnas']; $j++ )
                $_SESSION['buscaminas']['tablero'][$i][$j] = 0;

        $_SESSION['buscaminas']['pulsadas'] = $_SESSION['buscaminas']['tablero'];
    }

	// Coloca las minas aleatoriamente en el tablero
	function ponMinas(){
	    $contador = 0;
	    while( $contador < $_SESSION['buscaminas']['bombas'] ){
    	    $fila = rand( 0, $_SESSION['buscaminas']['filas'] - 1 );
	        $columna = rand( 0, $_SESSION['buscaminas']['columnas'] - 1 );
            if( $_SESSION['buscaminas']['tablero'][$fila][$columna] != 9 ){
    		    $_SESSION['buscaminas']['tablero'][$fila][$columna] = 9;
		        $contador++;
		    }
	    }
	}

	// Indica la proximidad de las minas
	function marcaCasillas(){

        // Función auxiliar para incrementar el contador de minas de la casilla
        function aux_casilla( $I, $J ){
            $_SESSION['buscaminas']['tablero'][$I][$J] != 9?
                $_SESSION['buscaminas']['tablero'][$I][$J]++ : null;
        }

	    for( $I = 0; $I < $_SESSION['buscaminas']['filas']; $I++ )
		    for( $J = 0; $J < $_SESSION['buscaminas']['columnas']; $J++ ){
			    $J < ( $_SESSION['buscaminas']['columnas'] - 1 )
                 && $_SESSION['buscaminas']['tablero'][$I][$J+1] == 9?
                    aux_casilla( $I, $J ) : null;		

                $J > 0 && $_SESSION['buscaminas']['tablero'][$I][$J-1] == 9?
                    aux_casilla( $I, $J ) : null;		
				
    			$I > 0 && $J > 0 && $_SESSION['buscaminas']['tablero'][$I-1][$J-1] == 9?
                    aux_casilla( $I, $J ) : null;		

    			$I < ( $_SESSION['buscaminas']['filas'] - 1 )
                 && $J > 0 && $_SESSION['buscaminas']['tablero'][$I+1][$J-1] == 9?
                    aux_casilla( $I, $J ) : null;		

    			$I > 0 && $_SESSION['buscaminas']['tablero'][$I-1][$J] == 9?
                    aux_casilla( $I, $J ) : null;		

    			$I < ( $_SESSION['buscaminas']['filas'] - 1 )
                 && $_SESSION['buscaminas']['tablero'][$I+1][$J] == 9?
                    aux_casilla( $I, $J ) : null;		
				
    			$I > 0 && $J < ( $_SESSION['buscaminas']['columnas'] - 1 )
                 && $_SESSION['buscaminas']['tablero'][$I-1][$J+1] == 9?
                    aux_casilla( $I, $J ) : null;		

    			$I < ( $_SESSION['buscaminas']['filas'] - 1 )
                 && $J < ( $_SESSION['buscaminas']['columnas'] - 1 )
                 && $_SESSION['buscaminas']['tablero'][$I+1][$J+1] == 9?
                    aux_casilla( $I, $J ) : null;
            }
    }	

    function compruebaVictoria(){
        $victoria = true;

        for( $i = 0; $i < $_SESSION['buscaminas']['filas']; $i++ )
            for( $j = 0; $j < $_SESSION['buscaminas']['columnas']; $j++ )
                $_SESSION['buscaminas']['tablero'][$i][$j] != 9 && $_SESSION['buscaminas']['pulsadas'][$i][$j] == 0 ?
                    $victoria = false : null;
        
        return $victoria;
    }

    function pulsaCasillas( $i, $j ){
        if( $_SESSION['buscaminas']['tablero'][$i][$j] == 9 ){
            $_SESSION['buscaminas']['pulsadas']
                = array_fill( 0, $_SESSION['buscaminas']['filas'],
                              array_fill( 0, $_SESSION['buscaminas']['columnas'], 1 )  );
            return null;
        }

        if( $_SESSION['buscaminas']['tablero'][$i][$j] == 0 ){
            $aux = [ -1, 1 ];
            foreach( $aux as $k )
                foreach( $aux as $l)
                    if( $i + $k >= 0 && $i + $k < $_SESSION['buscaminas']['filas']
                     && $j + $l >= 0 && $j + $l < $_SESSION['buscaminas']['columnas'] )
                            pulsaCasillas( $i + $k, $j + $l );
        }

        $_SESSION['buscaminas']['pulsadas'][$i][$j] == 0?
            $_SESSION['buscaminas']['pulsadas'][$i][$j] = 1 : null;
    }

    function reinicia(){
        creaArrayTablero();
        ponMinas();
        marcaCasillas();   
    }

    !isset( $_POST ) || $_POST['casilla'] == 'reset'?
        reinicia()
    :   pulsaCasillas( $_POST['casilla'][0], $_POST['casilla'][1] );
        compruebaVictoria();
?>
<!DOCTYPE html>
<html lang="ES">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Álvaro García Fuentes">
        <title>Buscaminas</title>
    </head>
    <body>
        <header><h1>Buscaminas</h1></header>
        <main>
            <?php
                echo "<p>".$_SESSION['buscaminas']['filas']." filas, "
                     .$_SESSION['buscaminas']['columnas']." columnas y "
                     .$_SESSION['buscaminas']['bombas']." minas.</p>";
                echo "<form action='index.php' method='POST'>";
                echo "<button type='submit name='casilla' value='reset'>Nueva partida</button>";
            	echo "<table border='3'cellpadding='20'>";
	            for ( $i = 0; $i < $_SESSION['buscaminas']['filas']; $i++ ){
		            echo "<tr>";
        	    	for( $j = 0; $j < $_SESSION['buscaminas']['columnas']; $j++ )
                        echo "<td>"
                            .(  ( $_SESSION['buscaminas']['pulsadas'][$i][$j] == 0?
                                    "<button type='submit' name='casilla' value='".[$i, $j]."'>&nbsp;</button>"
                                : ( $_SESSION['buscaminas']['tablero'][$i][$j] == 0 ? "&nbsp"
                                : ( $_SESSION['buscaminas']['tablero'][$i][$j] == 9 ? "*"
                                : $_SESSION['buscaminas']['tablero'][$i][$j] ) ) )  )."</td>";
	    	        echo "</tr>";
            	}
        	    echo "</table>";
                echo "</form>";
            ?>
        </main>
        <footer>
            <p><a href="#" class='footlink'>Código fuente</a></p>
            <p><a href="../index.php" class='footlink'>Atrás</a></p>
        </footer>
    </body>
</html>