<?php
    include("funciones/config.php");
    $sql2 = "SELECT * FROM tipos_equipos 
    ORDER BY tipos ASC";
    $result2 = $conn->query($sql2);
    $conn->close();
    if ($result2->num_rows > 0) {
        $row2 = $result2->fetch_assoc();    
    }
    while($row2 = $result2->fetch_assoc()){
        $variable=$row2['tipos'];
        printf("<option value='$variable'>$variable</option>");
    }
?>