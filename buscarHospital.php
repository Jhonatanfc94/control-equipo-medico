<!DOCTYPE html>
<html lang='s'>
    <head>
        <?php
            include("head.php");
            include("funciones/config.php");
        ?>
        <link rel='stylesheet' href='css/buscarEquipo.css'>
    </head>
    <body>
        <div id='encabezado'>
            <header class='header'>
                    <div>
                        <img class=logo src='images/logo.png'/>
                        <label class='titulo'>Buscar Hospitales</label>
                    </div>
            </header>
        </div>
        <?php
            include("menu.php");
        ?>
        <form method='post' action='buscarHospital.php' id='formulario'>
            <div class="columns">
                <div class="field-container">
                    <label>Hospital/Clínica:</label>
                    <p>
                        <i class="far fa-hospital"></i>
                        <input type="text" name="hospital" class=field placeholder="ej. Hospital General" required="true">
                    </p>
                </div>
                <div class="field-container">
                    <label>Servicio:</label>
                    <p>
                        <i class="fas fa-stethoscope"></i>
                        <input type="text" name="servicio" class=field placeholder="ej. Sala de Operaciones" required="true">
                    </p>
                </div>
                <div class="field-container">
                    <label>Nivel:</label>
                    <p>
                        <i class="fas fa-th-list"></i>
                        <input type="text" name="nivel" class=field placeholder="ej. 1" required="true">
                    </p>
                </div>
                <div class="field-container">
                    <label>Jefe de Servicio:</label>
                    <p>
                    <i class="fas fa-user-nurse"></i>
                        <input type="text" name="jefe" class=field placeholder="ej. John Doe" required="true">
                    </p>
                </div>
                <div class="field-container">
                    <label>Horario Eficaz:</label>
                    <p>
                        <i class="far fa-clock"></i>
                        <input type="text" name="horario" class=field placeholder="ej. 13:00 - 15:00" required="true">
                    </p>
                </div>
                <div>
                    <button class='but_green' type='submit' name='agregar' value='Agregar'>Agregar</button>
                    <button class='but_teal' type='submit' name='editar' value='Editar'>Editar</button>
                </div>
            </div>
        </form>

        <div>
        <form method='post' action='buscarHospital.php' id='formulario'>
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
        
    <?php
    if(isset($_POST['buscar'])){
        $busqueda = $_POST["txtBusqueda"];
    }else{
        $busqueda = '';
    }
    $sql = "SELECT * FROM hospitales
    WHERE (hospital LIKE '%$busqueda%' OR servicio LIKE '%$busqueda%' OR jefe LIKE '%$busqueda%')
    ORDER BY hospital ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        printf("<div class='divTableRow'>
            <div class='divTableCellBorderW'>&nbsp;<b>HOSPITAL</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>SERVICIO</b>&nbsp;</div>
            <div class='divTableCellBorderW'>&nbsp;<b>NIVEL</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>JEFE DE SERVICIO</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>HORARIO</b></div>
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
            </div>",
                $row['hospital'], $row['servicio'], $row['nivel'], $row['jefe'],$row['horario']);
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
        include("funciones/config.php");

        $hospital = $_POST["hospital"];
        $servicio = $_POST["servicio"];
        $nivel = $_POST["nivel"];
        $jefe = $_POST["jefe"];
        $horario = $_POST["horario"];

        $sql = "INSERT INTO hospitales (hospital, servicio, nivel, jefe, horario) VALUES ('$hospital', '$servicio', '$nivel','$jefe','$horario')";	
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Hospital agregado";
            print "<script>alert('$mensaje')</script>";
            echo "<script>window.location='buscarHospital.php'</script>";
        } else {
            $mensaje = "El hospital no fue agregado correctamente ".$conn->error;
            print "<script>alert('$mensaje')</script>";
        }

        $conn->close();
    }

    if(isset($_POST['editar'])){
        include("funciones/config.php");

        $hospital = $_POST["hospital"];
        $servicio = $_POST["servicio"];
        $nivel = $_POST["nivel"];
        $jefe = $_POST["jefe"];
        $horario = $_POST["horario"];

        $sql = "SELECT * FROM hospitales WHERE hospital='$hospital';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sql = "UPDATE hospitales SET servicio='$servicio', nivel='$nivel', jefe='$jefe', horario='$horario' WHERE hospital='$hospital'";
            if ($conn->query($sql) === TRUE) {
                $mensaje = "Hospital editado ".$var1;
                print "<script>alert('$mensaje')</script>";
                echo "<script>window.location='buscarHospital.php'</script>";
            }else{
                $mensaje = "No se encontro el hospital a editar ". $conn->error;
                print "<script>alert('$mensaje')</script>";
            }
        }else{
            $mensaje = "No se encontro el hospital a editar ". $conn->error;
            print "<script>alert('$mensaje')</script>"; 
        }
        
        $conn->close();
    }
?>