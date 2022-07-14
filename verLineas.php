<?php
    include("funciones/config.php");
    $sql1 = "SELECT * FROM lineas 
    ORDER BY linea ASC";
    $result1 = $conn->query($sql1);
?>
    
<!DOCTYPE html>
<html lang='s'>
    <head>
        <?php
            include("head.php");
        ?>
        <link rel='stylesheet' href='css/buscarEquipo.css'>
        
    </head>
    <body>
        <div id='encabezado'>
            <header class='header'>
                    <div>
                        <img class=logo src='images/logo.png'/>
                        <label class='titulo'>Gestionar Líneas</label>
                        
                    </div>
            </header>
        </div>
        <?php
            include("menu.php");
        ?>
        <form method='post' action='verLineas.php' id='formulario'>
            <div class="columns">
                <div class="field-container">
                    <label>Línea Comercial:</label>
                    <p>
                        <i class="fas fa-briefcase"></i>
                        <input type="text" name="linea" class=field placeholder="ej. PMR" required="true">
                    </p>
                </div>
                <div>
                    <button class='but_green' type='submit' name='agregar' value='Agregar'>Agregar</button>
                    <button class='but_red' type='submit' name='borrar' value='Borrar'>Borrar</button>
                </div>
            </div>
        </form>

        <div>
        <form method='post' action='verLineas.php' id='formulario'>
        

    <div class='divTable' id='equipo'>
        
        </html>
    <?php
    if(isset($_POST['buscar'])){
        $busqueda = $_POST["txtBusqueda"];
    }else{
        $busqueda = '';
    }
    $sql = "SELECT * FROM lineas
    WHERE (linea LIKE '%$busqueda%')
    ORDER BY linea ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        printf("<div class='divTableRow'>
            <div class='divTableCellBorderW'>&nbsp;<b>LÍNEA</b></div>
            </div>");
		while($row = $result->fetch_array()){
            $rows[] = $row;
        }
        foreach($rows as $row){
            printf("
            <div class='divTableRow'>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            </div>",
                $row['linea']);
        }
	}else{
        printf("No se encontraron resultados para su búsqueda.");
    }
    
    $conn->close();
    ?>    
    <!DOCTYPE html>
            </table>
        </form>
    </body>
</html>

<?php
    if(isset($_POST['agregar'])){
        include("funciones/config.php");

        $linea = $_POST["linea"];

        $sql = "INSERT INTO lineas (linea) VALUES ('$linea')";	
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Línea agregada";
            print "<script>alert('$mensaje')</script>";
            echo "<script>window.location='verLineas.php'</script>";
        } else {
            $mensaje = "La línea no fue agregada correctamente ".$conn->error;
            print "<script>alert('$mensaje')</script>";
        }

        $conn->close();
    } 
?>

<?php
    if(isset($_POST['borrar'])){
        include("funciones/config.php");

        $linea = $_POST["linea"];

        $sql = "DELETE FROM lineas WHERE linea='$linea'";	
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Línea borrada.";
            print "<script>alert('$mensaje')</script>";
            echo "<script>window.location='verLineas.php'</script>";
        } else {
            $mensaje = "La línea no fue borrada correctamente ".$conn->error;
            print "<script>alert('$mensaje')</script>";
        }

        $conn->close();
    }
?>