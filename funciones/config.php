<?php
    $subir=0;
    if($subir==0){
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "equipos";
    }else{
        $dbhost = "localhost";
        $dbuser = "id11823253_gestionycontrol";
        $dbpass = "12345";
        $dbname = "id11823253_gestionycontrol";
    }
    
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>