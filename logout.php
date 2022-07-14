<?php
    session_start();
    
    session_unset();
    session_destroy();

    if (isset($_SESSION['user'])){
        //echo "usuario" . $_SESSION["user"];
    }else{
        $urlLogin = 'index.php';
        echo "<script>window.location='$urlLogin'</script>";
    }
?>