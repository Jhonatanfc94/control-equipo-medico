<?php
    session_start();
    if (isset($_SESSION['user'])){
        $usuario = $_SESSION['user'];
        //echo "usuario" . $_SESSION["user"];
    }else{
        echo "<script type='text/javascript'>
            heap.resetIdentity();
        </script>";
        $urlLogin = 'index.php';
        echo "<script>window.location='$urlLogin'</script>";
    }
    
    include("funciones/config.php");
    $sql1 = "SELECT * FROM lineas 
    ORDER BY linea ASC";
    $result1 = $conn->query($sql1);

    $sql2 = "SELECT * FROM tipos_equipos 
    ORDER BY tipos ASC";
    $result2 = $conn->query($sql2);
    $conn->close();

    $tipo='Comodato';
    $depto='Guatemala';
    $linea='CARDINAL';
    if(isset($_GET['numeroserie'])){
        $var1= $_GET['numeroserie'];
        
        include("funciones/config.php");
        $sql = "SELECT * FROM equipos_medicos
        WHERE (no_serie= '$var1') LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            $equipo = $row['equipo'];     
            $marca=$row['marca'];
            $modelo=$row['modelo'];
            $no_serie=$row['no_serie'];
            $no_bien=$row['no_bien'];
            $hospital=$row['hospital'];
            $tipo=$row['tipo'];
            $servicio=$row['servicio'];
            $estado=$row['estado'];
            $linea=$row['linea'];
            $depto=$row['depto'];
        }
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset='utf-8'/>
        <title>Equipo medico</title>
        <meta name='description' content='Control de equipos medicos'/>
        <meta name='author' content='Jhonatan Flores y Oscar Blanck'/>
        <meta name='keywords' content='Mantenimiento, equipo medico, biomédica, hoja de vida'/>
        <script src='https://kit.fontawesome.com/ffd87086a1.js' crossorigin='anonymous'></script>
        <script type="text/javascript">
        window.heap=window.heap||[],heap.load=function(e,t){window.heap.appid=e,window.heap.config=t=t||{};var r=document.createElement("script");r.type="text/javascript",r.async=!0,r.src="https://cdn.heapanalytics.com/js/heap-"+e+".js";var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(r,a);for(var n=function(e){return function(){heap.push([e].concat(Array.prototype.slice.call(arguments,0)))}},p=["addEventProperties","addUserProperties","clearEventProperties","identify","resetIdentity","removeEventProperty","setEventProperties","track","unsetEventProperty"],o=0;o<p.length;o++)heap[p[o]]=n(p[o])};
        heap.load("1884061737");
        </script>
        <link rel="stylesheet" href="css/crearEquipo.css">
    </head>
    <script src="https://kit.fontawesome.com/ffd87086a1.js" crossorigin="anonymous"></script>
    <body>
        <div>
            <header class="header">
                <div>
                    <img class=logo src="images/logo.png"/>
                    <label class='titulo'>Hacer Mantenimiento</label>
                </div>
            </header>
            <?php include("menu.php"); ?>
            <form action="crearMantenimiento.php" id="formulario" method="post">
                <div class="columns2">
                    <div class="field-container">            
                        <label>Tipo de servicio: </label>
                        <p>
                            <i class="fas fa-tools"></i>
                            <select name='tiposervicio' class='field_s'>
                                <option value="Mantenimiento Preventivo">Mantenimiento Preventivo</option>
                                <option value="Mantenimiento Correctivo">Mantenimiento Correctivo</option>
                                <option value="Instalacion/Desinstalacion">Instalación/Desinstalación</option>
                                <option value="Actualizacion de Software">Actualización de Software</option>
                                <option value="Revision de equipo">Revisión de Equipo</option>
                                <option value="Revision de falla">Revisión de Falla</option>
                                <option value="Actualizacion de Software">Actualización de Software</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </p>
                    </div>
                    <div class="field-container">
                        </br>
                        <p>
                            <i class="fas fa-hand-holding-usd"></i>
                                <?php
                                    printf("<select name='tipo' class='field_s'>
                                    <option value='$tipo'>$tipo</option>");
                                    printf("<option value='Comodato'>Comodato</option>
                                    <option value='Facturable'>Facturable</option>
                                    <option value='Laboratorio de Biomédica'>Laboratorio de Biomédica</option>
                                    </select>");
                                ?>
                        </p>
                    </div>
                    <div class="field-container">
                        <label>Línea Comercial:</label>
                        <p>
                            <i class="fas fa-briefcase"></i>
                            <select name="linea" class="field_s">
                                <?php
                                    while($row1 = $result1->fetch_assoc()){
                                ?>
                                <option <?php if($linea == $row1['linea']){echo("selected");} ?>><?php echo $row1['linea']?></option>
                                <?php
                                    }
                                ?>
                            </select>    
                        </p>
                    </div>
                    <div class="field-container">            
                        <label>Tipo de Falla: </label>
                        <p>
                            <i class="fas fa-file-excel"></i>
                            <select name='tipofalla' class='field_s'>
                                <option value="Falla del equipo">Falla del equipo</option>
                                <option value="Falla del insumo/descartable">Falla del insumo/descartable</option>
                                <option value="Falla del software">Falla del software</option>
                                <option value="Falla de usuario">Falla de usuario</option>
                                <option value="Otra falla">Otra falla</option>
                                <option value="N/A" selected>N/A</option>                                
                            </select>
                        </p>
                    </div>
                    </br>
                    <div class="field-container">
                        <label>Servicio:</label>
                        <p>
                            <i class="fas fa-stethoscope"></i>
                            <!--<input type="text" name="servicio" class=field>-->
                            <?php
                                if(isset($_GET['numeroserie'])){
                                    printf("<input name='servicio' type='text' class='field' required='true' value='$servicio'/>");
                                }else{
                                    printf("<input name='servicio' type='text' class='field' required='true'/>");
                                }
                            ?>
                        </p>
                    </div>
                    <div class="field-container">
                        <label>Hospital/Clínica:</label>
                        <p>
                            <i class="far fa-hospital"></i>
                            <!--<input type="text" name="hospital" class=field>-->
                            <?php
                                if(isset($_GET['numeroserie'])){
                                    printf("<input name='hospital' type='text' class='field' required='true' value='$hospital'/>");
                                }else{
                                    printf("<input name='hospital' type='text' class='field' required='true'/>");
                                }
                            ?>
                        </p>
                    </div>
                    <div class="field-container">
                        <label>Departamento:</label>
                        <p>
                            <i class="fas fa-map-marked-alt"></i>
                            <?php
                                printf("<select name='depto' class='field_s'>
                                <option value='$depto'>$depto</option>");
                                printf("<option value='Alta Verapaz'>Alta Verapaz</option>
                                <option value='Baja Verapaz'>Baja Verapaz</option>
                                <option value='Chimaltenango'>Chimaltenango</option>
                                <option value='Chiquimula'>Chiquimula</option>
                                <option value='El Progreso'>El Progreso</option>
                                <option value='Escuintla'>Escuintla</option>
                                <option value='Guatemala'>Guatemala</option>
                                <option value='Guatemala (Laboratorio)'>Guatemala (Laboratorio)</option>
                                <option value='Huehuetenango'>Huehuetenango</option>
                                <option value='Izabal'>Izabal</option>
                                <option value='Jalapa'>Jalapa</option>
                                <option value='Jutiapa'>Jutiapa</option>
                                <option value='Petén'>Petén</option>
                                <option value='Quetzaltenango'>Quetzaltenango</option>
                                <option value='Quiché'>Quiché</option>
                                <option value='Retalhuleu'>Retalhuleu</option>
                                <option value='Sacatepéquez'>Sacatepéquez</option>
                                <option value='San Marcos'>San Marcos</option>
                                <option value='Santa Rosa'>Santa Rosa</option>
                                <option value='Sololá'>Sololá</option>
                                <option value='Suchitepéquez'>Suchitepéquez</option>
                                <option value='Totonicapán'>Totonicapán</option>
                                <option value='Zacapa'>Zacapa</option>
                                </select>");
                            ?>            
                        </p>
                    </div>
                    <div class="field-container">
                        <label>Ubicación/Zona:</label>
                        <p>
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" name="zona" class=field>
                        </p>
                    </div> 
                    </br>
                    <div class="field-container">
                        <label>Equipo:</label>
                        <p>
                            <i class="fas fa-microscope"></i>
                            <select name='equipos' class='field_s'>
                                <?php
                                    while($row2 = $result2->fetch_assoc()){
                                ?>
                                    <option <?php if(isset($equipo)){if($equipo == $row2['tipos']){echo("selected");}} ?>><?php echo $row2['tipos']?></option>
                                <?php
                                    }
                                ?>
                            </select>   
                        </p>
                    </div> 
                    <div class="field-container">
                        <label>Modelo:</label>
                        <p>
                            <i class="fas fa-arrow-alt-circle-right"></i>                  
                            <!--<input type="text" name="modelo" class=field>-->
                            <?php
                                if(isset($_GET['numeroserie'])){
                                    printf("<input name='modelo' type='text' class='field' required='true' value='$modelo'/>");
                                }else{
                                    printf("<input name='modelo' type='text' class='field' required='true'/>");
                                }
                            ?>                        
                        </p>
                    </div> 
                    <div class="field-container">
                        <label>Número de Serie:</label>
                        <p>
                            <i class="fas fa-book"></i>
                            <!--<input type="text" name="serie" class=field required="true">-->
                            <?php
                                if(isset($_GET['numeroserie'])){
                                    printf("<input name='serie' type='text' class='field' required='true' value='$var1'/>");
                                }else{
                                    printf("<input name='serie' type='text' class='field' required='true'/>");
                                }
                            ?>
                        </p>
                    </div>

                    <div class="field-container">
                        <label>Número de Bien:</label>
                        <p>
                            <i class="fas fa-book-medical"></i>
                            <!--<input type="text" name="bien" class=field>-->
                            <?php
                                if(isset($_GET['numeroserie'])){
                                    printf("<input name='bien' type='text' class='field' value='$no_bien'/>");
                                }else{
                                    printf("<input name='bien' type='text' class='field'/>");
                                }
                            ?>
                        </p>                        
                    </div>           
                </div>
                <div class='centrar'>
                    <p>
                    <i class="fas fa-clipboard"></i>
                        <label>Visita al Cliente:</label>
                    </p>
                    <textarea name="visita" class="field_c"></textarea>  
                </div>
                <div class='centrar'>
                    <p>
                    <i class="fas fa-hammer"></i>
                        <label>Repuestos:</label>
                    </p>
                    <textarea name="repuestos" class="field_c"></textarea>  
                </div>
                <div class="columns2">
                    <div class="check"> 
                        <p>
                            <label>Se hizo calibración</label> </br>
                            <input type="checkbox" name="calibrado" class='check', value='Calibrado'>
                        </p>
                    </div> 
                    <div class="field-container">
                        <label>Estado:</label>
                        <p>
                            <i class="far fa-flag"></i>
                            <select name="estado" class="field_s">
                                <option value="Liberado para uso">Liberado para uso</option>   
                                <option value="Inoperante">Inoperante</option>
                                <option value="Dado de Baja">Dado de Baja</option>
                            </select>
                        </p>
                    </div>     
                    <div class="field-container">
                        <label class="label">Fecha:</label>
                        <p>
                            <i class="fas fa-calendar-day"></i>
                            <input type="date" name="fecha" class="field" required="true">
                        </p>
                    </div>     
                    <div class="field-container">
                        <label class="label">Hora: </label>
                        <p>
                            <i class="fas fa-clock"></i>
                            <input type="time" class="field" name="hora">
                        </p>
                    </div>         
                </div>    
                <div class="columns2">
                    <div class="check"> 
                        <p>
                            <label>Servicio Terminado</label> </br>
                            <input type="checkbox" name="terminado" class='check' value='Terminado'>
                        </p>
                    </div> 
                    <div class="field-container">
                        <label class="label">Especialista Biomédico: </label>
                        <p>
                            <i class="fas fa-user-tie"></i>
                            <!--<input type="text" class="field" name="tecnico">-->
                            <?php
                                printf("<input name='tecnico' type='text' class='field' required='true' value='$usuario'/>");
                            ?>
                        </p>
                    </div>    
                    <div class="field-container">
                        <label class="label">Horas de Operación: </label>
                        <p>
                            <i class="fas fa-user-clock"></i>
                            <input type="number" class="field" name="horasop">
                        </p>
                    </div>   
                    <div class="field-container">
                        <label class="label">No. de Reporte: </label>
                        <p>
                            <i class="fas fa-clipboard"></i>
                            <input type="number" class="field" name="reporte">
                        </p>
                    </div>  
                </div>
                </br>
                <div class="centrar">
                    <button class="but_green2" type="submit" value="Guardar datos" name="guardar">Guardar Mantenimiento</button>
                </div>
            </form>
        </div>
    </body>
</html>

<?php
    if(isset($_POST['guardar'])){
        include("funciones/config.php");
        
        $tiposervicio = $_POST["tiposervicio"];
        $tipo = $_POST["tipo"];
        $linea = $_POST["linea"];
        $tipofalla = $_POST["tipofalla"];
        $servicio = $_POST["servicio"];
        $hospital = $_POST["hospital"];
        $depto = $_POST["depto"];
        $zona = $_POST["zona"];
        $equipo = $_POST["equipos"];
        $modelo = $_POST["modelo"];
        $no_serie = $_POST["serie"];
        $no_bien = $_POST["bien"];
        $visita = $_POST["visita"];
        $repuestos = $_POST["repuestos"];
        $calibracion = $_POST["calibrado"];
        $estado = $_POST["estado"];
        $fecha = $_POST["fecha"];
        $hora = $_POST["hora"];
        $terminado = $_POST["terminado"];
        $tecnico = $_POST["tecnico"];
        $horasop = $_POST["horasop"];
        $reporte = $_POST["reporte"];

        $sql = "SELECT * FROM cronograma
        WHERE (no_serie= '$no_serie')";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_array()){
                $rows[] = $row;
            }
            foreach($rows as $row){
                $fechaCronograma=$row['mes_planificado'];
                if(strpos($fecha, '-'.$fechaCronograma) !== false){
                    $sql = "UPDATE cronograma SET realizado='SI' WHERE mes_planificado='$fechaCronograma' AND cronograma.no_serie='$no_serie'";
                    if ($conn->query($sql) === TRUE) {
                        $mensaje = "Cronograma editado ";
                        print "<script>alert('$mensaje')</script>";
                    }else{
                        $mensaje = "No se encontro el hospital a editar ". $conn->error;
                        print "<script>alert('$mensaje')</script>";
                    }
                }
            }
        }

        $sql = "INSERT INTO mantenimiento (tiposervicio, tipo, linea, tipofalla, servicio, hospital, depto, zona, equipo, modelo, no_serie, no_bien, visita, repuestos, calibracion, estado, fecha, hora, terminado, tecnico, horasop, reporte) VALUES ('$tiposervicio','$tipo', '$linea', '$tipofalla', '$servicio', '$hospital', '$depto', '$zona', '$equipo', '$modelo', '$no_serie', '$no_bien', '$visita', '$repuestos', '$calibracion', '$estado', '$fecha', '$hora', '$terminado', '$tecnico', '$horasop','$reporte')";	
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Mantenimiento Guardado";
            print "<script>alert('$mensaje')</script>";
            
        } else {
            $mensaje = "Error al guardar mantenimiento ".$conn->error;
            print "<script>alert('$mensaje')</script>";
        }
        $conn->close();
    }
?>