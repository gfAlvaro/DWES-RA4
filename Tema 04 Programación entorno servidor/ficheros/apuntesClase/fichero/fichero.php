<?php

    //Lectura de fichero linea por linea
    $file=fopen("poemas.txt","r") or exit("No se puede abrir el fichero");
    while(!feof($file)){
        $linea=fgets($file);
        echo $linea."<br>";
    }
    fclose($file);
    echo "<br><br><br>";
    //Lectura de fichero por caracter
    $file=fopen("poemas.txt","r") or exit("No se puede abrir el fichero");
    while(!feof($file)){
        $caracter=fgetc($file);
        if($caracter=="\n"){
            echo "<br>";
        }
        echo $caracter;
    }
    fclose($file);

    //Buffer
    $file=fopen("poemas.txt","r") or exit("No se puede abrir el fichero");
    $buffer=fread($file,filesize("poemas.txt"));
    $buffer=str_replace("\n","<br>",$buffer);
    echo "<br><br><br>";
    echo $buffer;
    fclose($file);
?>