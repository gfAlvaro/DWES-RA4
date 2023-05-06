<?php
    define( "MAXSIZE", 2000000 );
    $allowExts=array( "gif", "jpg", "png" );
    $allowedFormat=array( "image/gif", "image/jpg", "image/png" );
    define( "DIRUPLOAD", "upload/" );
    $aNombre = explode( ".", $_FILES["file"]["name"] );
    $extension = end( $aNombre );

    if( $_FILES["file"]["size"] < MAXSIZE && in_array( $extension, $allowExts ) && in_array( $_FILES["file"]["type"],$allowedFormat ) ){
        if( $_FILES["file"]["error"] > 0 )
            echo "Error: ".$_FILES["file"]["error"]."<br>";
        else {
            $filename = $_FILES["file"]["name"];
            $filename = uniqid().'.'.pathinfo( $filename, PATHINFO_EXTENSION );
            echo "Upload: ".$_FILES["file"]["name"]."<br>";
            echo "Type: ".$_FILES["file"]["type"]."<br>";
            echo "Size: ".($_FILES["file"]["size"]/1024)." Kb<br>";
            echo "Temp file: ".$_FILES["file"]["tmp_name"]."<br>";
            if( file_exists( DIRUPLOAD.$filename ) )
                echo "El fichero ya existe";
            else{
                move_uploaded_file( $_FILES["file"]["tmp_name"], DIRUPLOAD.$filename );
                echo "Stored in: ".DIRUPLOAD.$filename;
            }
            echo "<br/>";
            echo "<a href=\"".$_SERVER['HTTP_REFERER']."\">Volver</a>"; // No se recomienda.
            echo '<a href="javascript:history.back()">Volver</a>'; // Mejor.
        }
    }else
        echo "Error: El fichero no es valido";
?>