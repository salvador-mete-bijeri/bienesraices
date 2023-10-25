

<?php

require 'app.php';


function incluirTemplate( string $nombre, bool $inicio=false){
    include_once TEMPLATES_URL . "/${nombre}.php";
}