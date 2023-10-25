
<?php

function conectarDB() : mysqli{
    $db= mysqli_connect('localhost','root','','bienesraices');

    if(!$db){
        echo "No se pudo conectar a la base de datos";
        exit;
    }

    return $db;
}