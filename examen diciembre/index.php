<?php
    session_start();
    define('BARAJA', 40);

    if(  !isset( $_COOKIE['victorias'] )  )
        $_COOKIE['victorias'] = 0;

    if(  !isset( $_SESSION['juego'] )  )
        nuevaPartida();

    function nuevaPartida(){
        
        // Baraja las cartas
        $_SESSION['juego']['baraja'] = range(1, BARAJA);
        shuffle( $_SESSION['juego']['baraja'] );
     
        // Inicializa variables de sesión
        $_SESSION['juego']['jugador'] = [];
        $_SESSION['juego']['sumajugador'] = 0;
        $_SESSION['juego']['maquina'] = [];
        $_SESSION['juego']['sumamaquina'] = 0;
        $_SESSION['juego']['resultado'] = '';
        $_SESSION['juego']['riesgo'] = rand( 4, 7 );
    }

    function compruebaGanador(){
        $_SESSION['juego']['resultado'] =
        $_SESSION['juego']['sumamaquina'] > 7.5
        || ( $_SESSION['juego']['sumajugador'] <= 7.5
        && $_SESSION['juego']['sumajugador'] > $_SESSION['juego']['sumamaquina'] )?
            (function(){
                ++$_COOKIE['victorias'];
                return "¡HAS GANADO!";
            })()
        :   "HAS PERDIDO.";
    }

    // Función auxiliar que devuelve el valor de una carta
    function valorCarta( $carta ){
        return $carta % 10 != 8 && $carta % 10 != 9 && $carta % 10 != 0?
                   $carta % 10
               :   0.5;
    }

    function pideCarta(){
        if(  count( $_SESSION['juego']['baraja'] ) > 0  ){
            array_push(  $_SESSION['juego']['jugador'], array_pop( $_SESSION['juego']['baraja'] )  );
            $_SESSION['juego']['sumajugador'] += valorCarta( end( $_SESSION['juego']['jugador'] )  );
        }

        if( $_SESSION['juego']['sumamaquina'] < $_SESSION['juego']['riesgo'] )
            if(  count( $_SESSION['juego']['baraja'] ) > 0  ){
                array_push(  $_SESSION['juego']['maquina'], array_pop( $_SESSION['juego']['baraja'] )  );
                $_SESSION['juego']['sumamaquina'] += valorCarta( end( $_SESSION['juego']['maquina'] )  );
            }

        if($_SESSION['juego']['sumajugador'] >= 7.5 || $_SESSION['juego']['sumamaquina'] >= 7.5 )
            compruebaGanador();
    }

    function mePlanto(){
        while( count( $_SESSION['juego']['baraja'] ) > 0 
        && $_SESSION['juego']['sumamaquina'] < $_SESSION['juego']['riesgo'] ){
            array_push(  $_SESSION['juego']['maquina'], array_pop( $_SESSION['juego']['baraja'] )  );
            $_SESSION['juego']['sumamaquina'] += valorCarta( end($_SESSION['juego']['maquina'] )  );
        }

        compruebaGanador();
    }

    if(  isset( $_POST["boton"] )  )
        $_POST["boton"] == 'pide' && $_SESSION['juego']['resultado'] == ''?
            pideCarta()
        :( $_POST["boton"] == 'planta' && $_SESSION['juego']['resultado'] == ''?
            mePlanto()
        :( $_POST["boton"] == 'inicializa'?
            $_COOKIE['victorias'] = 0
        :( $_POST["boton"] == 'nueva'?
            nuevaPartida() : null
        )));
?>
<!DOCTYPE html>
<html lang="ES">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Álvaro García Fuentes">
        <title>Las Siete y media</title>
    </head>
    <body>
        <header><h1>Las Siete y media</h1></header>
        <nav>
            <p>Número de victorias: <?php echo $_COOKIE['victorias']; ?></p>
            <form action="index.php" method="POST">
                <button type='submit' name="boton" value='pide'>Pedir carta</button>
                <button type='submit' name="boton" value='planta'>Plantarse</button>
                <button type='submit' name="boton" value='inicializa'>Inicializar Victorias</button>
                <button type='submit' name="boton" value='nueva'>Nueva Partida</button>
            </form>
        </nav>
        <main>
            <div id='jugador'><p>Tus cartas:</p>
            <?php
                foreach( $_SESSION['juego']['jugador'] as $carta )
                    echo "<img src='img/".$carta.".jpg'><img>";
            ?>
            </div>
            <div id='maquina'><p>Cartas del rival:</p>
            <?php
                if( $_SESSION['juego']['resultado'] == '' )
                    foreach( $_SESSION['juego']['maquina'] as $carta )
                        echo "<img src='img/reverso.jpg' width='100' height='139'><img>";
                else
                    foreach( $_SESSION['juego']['maquina'] as $carta )
                        echo "<img src='img/$carta.jpg'><img>";
            ?>
            </div>
            <p><?php echo $_SESSION['juego']['resultado']; ?></p>
        </main>
        <footer><a href="../index.php">Atrás</a>
    </body>
</html>