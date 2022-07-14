<?php
    include("funciones/config.php");
    $sql1 = "SELECT * FROM tipos_equipos 
    ORDER BY tipos ASC";
    $result1 = $conn->query($sql1);
    $conn->close();
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
                        <label class='titulo'>Gestionar Tipos de Equipos</label>
                    </div>
            </header>
        </div>
        <?php
            include("menu.php");
        ?>
        <form method='post' action='verTipos_Equipos.php' id='formulario'>
            <div class="columns">
                <div class="field-container">
                    <label>Tipo de Equipo:</label>
                    <p>
                        <i class="fas fa-microscope"></i>
                        <input type="text" name="tipos" class=field placeholder="ej. VENTILADOR" required="true">
                    </p>
                </div>
                <div>
                    <button class='but_green' type='submit' name='agregar' value='Agregar'>Agregar</button>
                    <button class='but_red' type='submit' name='borrar' value='Borrar'>Borrar</button>
                </div>
            </div>
        </form>

        <div class='margendiv'>
        <form method='post' action='verTipos_Equipos.php' id='formulario'>
        <div class="columns">
            <div class="field-container">  
                <label>Buscar:</label>
                <p>
                    <i class="fas fa-search"></i>
                    <input type="text" name="txtBusqueda" class=field>
                </p>
            </div> 
            <div>
                <button type='submit' name='buscar' value='Buscar'>Buscar</button>
            </div>
        </div>

    <div class='divTable' id='equipo'>
        
        </html>
    <?php
    include("funciones/config.php");
    if(isset($_POST['buscar'])){
        $busqueda = $_POST["txtBusqueda"];
    }else{
        $busqueda = '';
    }
    $sql = "SELECT * FROM tipos_equipos
    WHERE (tipos LIKE '%$busqueda%')
    ORDER BY tipos ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        printf("<div class='divTableRow'>
            <div class='divTableCellBorderW'>&nbsp;<b>EQUIPO</b></div>
            </div>");
		while($row = $result->fetch_array()){
            $rows[] = $row;
        }
        foreach($rows as $row){
            printf("
            <div class='divTableRow'>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            </div>",
                $row['tipos']);
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

        $tipos = $_POST["tipos"];

        $sql = "INSERT INTO tipos_equipos (tipos) VALUES ('$tipos')";	
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Equipo nuevo agregado.";
            print "<script>alert('$mensaje')</script>";
            echo "<script>window.location='verTipos_Equipos.php'</script>";
        } else {
            $mensaje = "El equipo nuevo no fue agregado correctamente.".$conn->error;
            print "<script>alert('$mensaje')</script>";
        }

        $conn->close();
    } 
?>

<?php
    if(isset($_POST['borrar'])){
        include("funciones/config.php");

        $tipos = $_POST["tipos"];

        $sql = "DELETE FROM tipos_equipos WHERE tipos='$tipos'";	
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Tipo de equipo borrado.";
            print "<script>alert('$mensaje')</script>";
            echo "<script>window.location='verTipos_Equipos.php'</script>";
        } else {
            $mensaje = "El tipo de equipo no fue borrado correctamente.".$conn->error;
            print "<script>alert('$mensaje')</script>";
        }

        $conn->close();
    }
?>