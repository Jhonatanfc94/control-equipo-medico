<?php
    include("funciones/config.php");
    $sql2 = "SELECT * FROM tipos_equipos 
    ORDER BY tipos ASC";
    $result2 = $conn->query($sql2);
    
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
                        <label class='titulo'>Buscar Repuestos</label>
                    </div>
            </header>
        </div>
        
        <?php
            include("menu.php");
        ?>
        
        <form method='post' action='repuestos.php' id='formulario'>
            <div class="columns">
                <div class="field-container">
                    <label>Equipo:</label>
                    <p>
                        <i class="far fa-hospital"></i>
                        <select name="equipo" class="field_s">
                            <!--<option value="" selected disabled hidden></option>-->
                            <?php
                                while($row2 = $result2->fetch_assoc()){
                            ?>
                                <option value="<?php echo $row2['tipos']?>"><?php echo $row2['tipos']?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </p>
                </div>
                <div class="field-container">
                    <label>Marca:</label>
                    <p>
                        <i class="fas fa-stethoscope"></i>
                        <input type="text" name="marca" class=field placeholder="ej. Woo Young Medical" required="true">
                    </p>
                </div>
                <div class="field-container">
                    <label>Repuesto:</label>
                    <p>
                    <i class="fas fa-user-nurse"></i>
                        <input type="text" name="repuesto" class=field placeholder="ej. Motor" required="true">
                    </p>
                </div>
                <div class="field-container">
                    <label>Modelo:</label>
                    <p>
                        <i class="fas fa-th-list"></i>
                        <input type="text" name="modelo" class=field placeholder="ej. Accumate 2300" required="true">
                    </p>
                </div>
                
                <div class="field-container">
                    <label>Número de parte:</label>
                    <p>
                        <i class="far fa-clock"></i>
                        <input type="text" name="no_parte" class=field placeholder="ej. 2354M" required="true">
                    </p>
                </div>

                <div class="field-container">
                    <label>Precio:</label>
                    <p>
                        <i class="far fa-clock"></i>
                        <input type="text" name="precio" class=field placeholder="ej. Q 200">
                    </p>
                </div>
                <div>
                    <button class='but_green' type='submit' name='agregar' value='Agregar'>Agregar</button>
                    <button class='but_teal' type='submit' name='editar' value='Editar'>Editar</button>
                </div>
            </div>
        </form>

        <div>
        <form method='post' action='repuestos.php' id='formulario'>
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

    <div class='divTable2' id='equipo'>
        
        </html>
    <?php
    if(isset($_POST['buscar'])){
        $busqueda = $_POST["txtBusqueda"];
    }else{
        $busqueda = '';
    }
    $sql = "SELECT * FROM repuestos
    WHERE (equipo LIKE '%$busqueda%' OR marca LIKE '%$busqueda%' OR modelo LIKE '%$busqueda%' OR repuesto LIKE '%$busqueda%' OR no_parte LIKE '%$busqueda%')
    ORDER BY marca ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        printf("<div class='divTableRow'>
            <div class='divTableCellBorderW'>&nbsp;<b>EQUIPO</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>MARCA</b>&nbsp;</div>
            <div class='divTableCellBorderW'>&nbsp;<b>MODELO</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>REPUESTO</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>NÚMERO DE PARTE</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>PRECIO</b></div>
            </div>");
		while($row = $result->fetch_array()){
            $rows[] = $row;
        }
        foreach($rows as $row){
            printf("
            <div class='divTableRow'>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            </div>",
                $row['equipo'], $row['marca'], $row['modelo'], $row['repuesto'],$row['no_parte'],$row['precio']);
        }
	}else{
        printf("No se encontraron resultados para su búsqueda");
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
        $mensaje = "Repuesto agregado";
        print "<script>alert('$mensaje')</script>";

        include("funciones/config.php");

        $equipo = $_POST["equipo"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $repuesto = $_POST["repuesto"];
        $no_parte = $_POST["no_parte"];
        $precio = $_POST["precio"];

        $sql = "INSERT INTO repuestos (equipo, marca, modelo, repuesto, no_parte, precio) VALUES ('$equipo', '$marca', '$modelo','$repuesto','$no_parte','$precio')";	
        if ($conn->query($sql) === TRUE) {
            echo "<script>window.location='repuestos.php'</script>";
        } else {
            echo "Error al ingresar datos." . $conn->error;
        }

        $conn->close();
    }

    if(isset($_POST['editar'])){
        include("funciones/config.php");
    
        $equipo = $_POST["equipo"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $repuesto = $_POST["repuesto"];
        $no_parte = $_POST["no_parte"];
        $precio = $_POST["precio"];

        $sql = "SELECT * FROM repuestos WHERE equipo='$equipo' and no_parte='$no_parte';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sql = "UPDATE repuestos SET marca='$marca',modelo='$modelo',repuesto='$repuesto',precio='$precio' WHERE equipo='$equipo'";
            if ($conn->query($sql) === TRUE) {
                $mensaje = "Repuesto editado ".$var1;
                print "<script>alert('$mensaje')</script>";
                echo "<script>window.location='repuestos.php'</script>";
            }else{
                $mensaje = "No se encontro el repuesto a editar ". $conn->error;
                print "<script>alert('$mensaje')</script>";
            }
        }else{
            $mensaje = "No se encontro el repuesto a editar ". $conn->error;
            print "<script>alert('$mensaje')</script>"; 
        }

        $conn->close();
    }
?>