<?php
    if(isset($_GET['numeroserie'])){
        $var1= $_GET['numeroserie'];
        
        include("funciones/config.php");
        $sql = "SELECT * FROM equipos_medicos
        WHERE (no_serie= '$var1') LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $equipo = $row['equipo'];        
        }
        //rintf($equipo);
        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            include("head.php");
        ?>
        <link rel="stylesheet" href="css/crearEquipo.css">
    </head>
    <script src="https://kit.fontawesome.com/ffd87086a1.js" crossorigin="anonymous">
    </script>
    <script>
        /*
        a = 0;
        function addMantenimiento(){
            a++;
            var div = document.createElement('div');
            div.className = 'divTableRow';
            div.innerHTML = '<div class="divTableCell"><i class="fas fa-book"></i><input name="mante[]" type="text" class="textbox" required="true"/></div><div class="divTableCell"><label class="radio"><input class="check" type="radio" name = "ans_'+a+'" value="pass" required> Pass <label class="radio"><input input class="check" type="radio" name = "ans_'+a+'" value="fail"> Fail </br></div>';
            document.getElementById('mantenimientos').appendChild(div);
            }
        */
    </script>
        
    <body>
        <div>
            <header class="header">
                <div>
                    <img class=logo src="images/logo.png"/>
                    <label class='titulo'>Hacer Mantenimiento</label>
                </div>
            </header>
            <?php
                include("menu.php");
            ?>
            <form action="mantenimiento.php" id="formulario" method="post">
                <div class="divTable">
                    <div class="divTableBody" id="mantenimientos">
                        <div class="divTableCell">
                            <label class="label">Tipo de mantenimiento: </label>
                            <i class="fas fa-tools"></i>
                            <select name="tipoman">
                                <option value="mantenimiento preventivo">Mantenimiento Preventivo</option>
                                <option value="mantenimiento correctivo">Mantenimiento Correctivo</option>
                                <option value="instalacion/desinstalacion">Instalación/Desinstalación</option>
                                <option value="actualizacion de software">Actualización de Software</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">
                                <label class="label">Nombre Equipo</label>
                                <p>
                                    <i class="fas fa-microscope"></i>
                                    <?php
                                        if(isset($_GET['numeroserie'])){
                                            printf("<select name='sltNombreEquipo' class='field_s'>
                                            <option value='$equipo'>$equipo</option>");
                                            include("seleccionarEquipos.php");
                                            printf("</select>");
                                        }else{
                                            printf("<select name='sltNombreEquipo' class='field_s'>");
                                            include("seleccionarEquipos.php");
                                            printf("</select>");
                                        }
                                    ?>
                                    
                                </p>
                            </div>
                            <div class="divTableCell">
                                <label class="label">No de serie</label>
                                <i class="fas fa-book"></i>
                                <?php
                                    if(isset($_GET['numeroserie'])){
                                        printf("<input name='txtNoSerie' type='text' class='textbox' required='true' value='$var1'/>");
                                    }else{
                                        printf("<input name='txtNoSerie' type='text' class='textbox' required='true'/>");
                                    }
                                ?>
                                
                            </div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">
                                <label class="label">Actividad:</label>
                                <!-- <span class="plus" id="addMantenimiento()" onClick="addMantenimiento()">+</span>
                                <input name="mante[]" type="text" class="textbox" required="true"/>--> 
                                <textarea name="mante[]" class="textarea" required="true"></textarea>
                            </div>
                            <div class="divTableCell">
                                <label class="label">Calibrado:</label>
                                <label class="radio">
                                <input class='check' type="radio" name = "ans_0" value="pass" required> Pass 
                                <label class="radio"><input class='check' type="radio" name = "ans_0" value="fail"> Fail </br>
                            </div>
                        </div>
                    </div>
                    <div class="divTableBody">
                        <div class="divTableRow">
                            <div class="divTableCell">
                                <label class="label">Estado: </label>
                                <i class="fas fa-thermometer"></i>
                                <select name="sltestado">
                                    <option value="liberado">Liberado</option>
                                    <option value="bloqueado">Bloqueado</option>
                                </select>
                            </div>
                            <div class="divTableCell">
                                <label class="label">Fecha del mantenimiento:</label>
                                <i class="fas fa-calendar-day"></i>
                                <input type="date" name="txtFechaMantenimiento" class="textbox" required="true">
                            </div>
                        </div>
                    </div>
                    <div class="divTableBody">
                        <div class="divTableRow">
                            <div class="divTableCell">
                                <label class="label">Hora: </label>
                                <i class="fas fa-thermometer"></i>
                                <input type="time" name="txtHora" class="textbox" required="true">
                            </div>
                            <div class="divTableCell">
                                <label class="label">Horas de operación:</label>
                                <i class="fas fa-calendar-day"></i>
                                <input type="text" name="txtHoraTrabajada" class="textbox" required="true">
                            </div>
                        </div>
                    </div>      
                </div>
                <div class="centro">
                    <label class="iconolabel">Repuestos:</label>
                    <textarea name="txtcomentario" class="textarea"></textarea>
                </div>
                <div class="centro">
                    <button class="but_green" type="submit" value="Guardar datos" name="guardar">Guardar Datos</button>
                </div>
                <div class="centro">
                    <button class="but_teal" type="submit" value="Editar datos" name="editar">Editar Datos</button>
                </div>
            </form>
        </div>        
    </body>
</html>

<?php
    if(isset($_POST['guardar'])){
        include("funciones/config.php");

        $array_mante = $_POST["mante"];
        $nombre_equipo = $_POST["sltNombreEquipo"];
        $serie = $_POST["txtNoSerie"];
        $fecha = $_POST["txtFechaMantenimiento"];
        $estadoEquipo = $_POST["sltestado"];
        $comentario = $_POST["txtcomentario"];
        $tipomantenimiento = $_POST["tipoman"];

        $hora = $_POST["txtHora"];
        $hora_trabajada = $_POST["txtHoraTrabajada"];
        $count=0;
        
        $sql = "SELECT * FROM equipos_medicos
        WHERE (no_serie = '$serie')";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            foreach($array_mante as $i=>$t) {
                $status=$_POST["ans_$count"] ;

                $sql = "INSERT INTO mantenimiento (nombre_equipo, no_serie, fecha, status_actividad, status_equipo, actividad, comentario, tipo_mantenimiento, hora, hora_trabajada) VALUES ('$nombre_equipo','$serie', '$fecha', '$status','$estadoEquipo','$array_mante[$i]','$comentario','$tipomantenimiento','$hora','$hora_trabajada')";	
                if ($conn->query($sql) === TRUE) {
                    $mensaje = "Mantenimiento Guardado";
                    print "<script>alert('$mensaje')</script>";
                    echo "<script>window.location='mantenimiento.php'</script>";
                } else {
                    echo "Error al ingresar mantenimineto" . $conn->error;
                }
                $count = $count+1;
            }

            $conn->close();
        } else {
            $mensaje = "No se encuentra un equipo con ese número de serie.";
            print "<script>alert('$mensaje')</script>";
        }
    }

    if(isset($_POST['editar'])){
        
        include("funciones/config.php");

        $array_mante = $_POST["mante"];
        $nombre_equipo = $_POST["sltNombreEquipo"];
        $serie = $_POST["txtNoSerie"];
        $fecha = $_POST["txtFechaMantenimiento"];
        $estadoEquipo = $_POST["sltestado"];
        $comentario = $_POST["txtcomentario"];
        $tipomantenimiento = $_POST["tipoman"];
        $count=0;
        foreach($array_mante as $i=>$t) {
            $status=$_POST["ans_$count"] ;
            $sql = "SELECT * FROM mantenimiento WHERE no_serie='$serie' and actividad='$array_mante[$i]' ORDER BY id DESC LIMIT 1;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $id = $row['id'];    
                $sql = "UPDATE mantenimiento SET nombre_equipo='$nombre_equipo',fecha='$fecha',status_actividad='$status',status_equipo='$estadoEquipo',comentario='$comentario',tipo_mantenimiento='$tipomantenimiento',hora='$hora',hora_trabajada='$hora_trabajada' WHERE no_serie='$serie' and id='$id'";
                if ($conn->query($sql) === TRUE) {
                    $mensaje = "Edicion realizada";
                    print "<script>alert('$mensaje')</script>";

                    echo "<script>window.location='mantenimiento.php'</script>";
                } else {
                    echo "Error al editar mantenimineto" . $conn->error;
                }
            }else{
                $mensaje = "La actividad con ese número de serie no existe";
                print "<script>alert('$mensaje')</script>";
            }
            $count = $count+1;
        }

        $conn->close();
    }
    
?>