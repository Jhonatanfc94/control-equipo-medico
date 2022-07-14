<?php
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
    if(isset($_GET['numeroid'])){
        $var1= $_GET['numeroid'];
        
        include("funciones/config.php");
        $sql = "SELECT * FROM mantenimiento
        WHERE (id= '$var1') LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id2 = $row['id'];
            $tiposervicio = $row['tiposervicio']; 
            $tipo = $row['tipo'];
            $linea = $row['linea'];
            $tipofalla = $row['tipofalla'];   
            $servicio=$row['servicio'];
            $hospital=$row['hospital'];
            $depto=$row['depto'];
            $zona=$row['zona'];
            $equipo = $row['equipo'];
            $modelo=$row['modelo'];
            $no_serie=$row['no_serie'];
            $no_bien=$row['no_bien'];
            $visita=$row['visita'];
            $repuestos=$row['repuestos'];
            $calibracion=$row['calibracion'];
            $estado=$row['estado'];
            $fecha=$row['fecha'];
            $hora=$row['hora'];
            $terminado=$row['terminado'];
            $tecnico=$row['tecnico'];
            $horasop=$row['horasop'];
            $reporte=$row['reporte'];
        }
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
        <script src="https://kit.fontawesome.com/ffd87086a1.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div>
            <header class="header">
                <div>
                    <img class=logo src="images/logo.png"/>
                    <label class='titulo'>Ver Mantenimiento</label>
                </div>
            </header>
            <?php include("menu.php"); ?>
            <form action="verMantenimiento.php" id="formulario" method="post">
                <input type="hidden" name="nid" value="<?php printf($id2);?>">
                <div class="columns2">
                    <div class="field-container">            
                        <label>Tipo de servicio: </label>
                        <p>
                            <i class="fas fa-tools"></i>
                            <?php 
                                printf("<select name='tiposervicio' class='field_s'>    
                                <option value='$tiposervicio'>$tiposervicio</option>");
                                printf("<option value='Mantenimiento Preventivo'>Mantenimiento Preventivo</option>
                                <option value='Mantenimiento Correctivo'>Mantenimiento Correctivo</option>
                                <option value='Instalacion/Desinstalacion'>Instalación/Desinstalación</option>
                                <option value='Actualizacion de Software'>Actualización de Software</option>
                                <option value='Revision de equipo'>Revisión de Equipo</option>
                                <option value='Revision de falla'>Revisión de Falla</option>
                                <option value='Actualizacion de Software'>Actualización de Software</option>
                                <option value='Otro'>Otro</option>
                                </select>");
                            ?>
                                
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
                                <option <?php if($linea == $row1['linea']){echo("selected");} ?>><?php echo $row1['linea'];?></option>
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
                            <?php
                                printf("<select name='tipofalla' class='field_s'>
                                <option value='$tipofalla'>$tipofalla</option>");
                                printf("<option value='Falla del equipo'>Falla del equipo</option>
                                <option value='Falla del insumo/descartable'>Falla del insumo/descartable</option>
                                <option value='Falla del software'>Falla del software</option>
                                <option value='Falla de usuario'>Falla de usuario</option>
                                <option value='Otra falla'>Otra falla</option>
                                <option value='N/A'>N/A</option>                                
                                </select>");
                            ?>    
                        </p>
                    </div>
                    </br>
                    <div class="field-container">
                        <label>Servicio:</label>
                        <p>
                            <i class="fas fa-stethoscope"></i>
                            <!--<input type="text" name="servicio" class=field>-->
                            <?php
                                if(isset($_GET['numeroid'])){
                                    printf("<input name='servicio' type='text' class='field' required='true' value='$servicio'>");
                                }else{
                                    printf("<input name='servicio' type='text' class='field' required='true'>");
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
                                if(isset($_GET['numeroid'])){
                                    printf("<input name='hospital' type='text' class='field' required='true' value='$hospital'>");
                                }else{
                                    printf("<input name='hospital' type='text' class='field' required='true'>");
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
                            <!--<input type="text" name="zona" class=field>-->
                            <?php
                                if(isset($_GET['numeroid'])){
                                    printf("<input name='zona' type='text' class='field' required='true' value='$zona'>");
                                }else{
                                    printf("<input name='zona' type='text' class='field' required='true'>");
                                }
                            ?>
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
                                    <option <?php if($equipo == $row2['tipos']){echo("selected");} ?>><?php echo $row2['tipos'];?></option>
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
                                if(isset($_GET['numeroid'])){
                                    printf("<input name='modelo' type='text' class='field' required='true' value='$modelo'>");
                                }else{
                                    printf("<input name='modelo' type='text' class='field' required='true'>");
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
                                if(isset($_GET['numeroid'])){
                                    printf("<input name='serie' type='text' class='field' required='true' value='$no_serie'>");
                                }else{
                                    printf("<input name='serie' type='text' class='field' required='true'>");
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
                                if(isset($_GET['numeroid'])){
                                    printf("<input name='bien' type='text' class='field' value='$no_bien'>");
                                }else{
                                    printf("<input name='bien' type='text' class='field'>");
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
                    <textarea name="visita" class="field_c"><?php printf($visita)?></textarea>  
                </div>
                <div class='centrar'>
                    <p>
                    <i class="fas fa-hammer"></i>
                        <label>Repuestos:</label>
                    </p>
                    <textarea name="repuestos" class="field_c"><?php printf($repuestos)?></textarea>  
                </div>
                <div class="columns2">
                    <div class="check"> 
                        <p>
                            <label>Se hizo calibración</label> </br>
                            <?php
                                if ($calibracion=='Calibrado'){
                                    printf("<input type='checkbox' name='calibrado' class='check' value='Calibrado' checked>");
                                }else{
                                    printf("<input type='checkbox' name='calibrado' class='check' value='Calibrado'>");
                                }
                            ?> 
                        </p>
                    </div> 
                    <div class="field-container">
                        <label>Estado:</label>
                        <p>
                            <i class="far fa-flag"></i>
                            <?php
                                printf("<select name='estado' class='field_s'>
                                <option value='$estado'>$estado</option>");
                                printf("<option value='Liberado para uso'>Liberado para uso</option>   
                                <option value='Inoperante'>Inoperante</option>
                                <option value='Dado de Baja'>Dado de Baja</option>
                                </select>");
                            ?>                                
                        </p>
                    </div>     
                    <div class="field-container">
                        <label class="label">Fecha:</label>
                        <p>
                            <i class="fas fa-calendar-day"></i>
                            <!--<input type="date" name="fecha" class="field" required="true">-->
                            <?php
                                if(isset($_GET['numeroid'])){
                                    printf("<input name='fecha' type='date' class='field' value='$fecha'>");
                                }else{
                                    printf("<input name='fecha' type='date' class='field'>");
                                }
                            ?>
                        </p>
                    </div>     
                    <div class="field-container">
                        <label class="label">Hora: </label>
                        <p>
                            <i class="fas fa-clock"></i>
                            <!--<input type="time" class="field" name="hora">-->
                            <?php
                                if(isset($_GET['numeroid'])){
                                    printf("<input name='hora' type='time' class='field' value='$hora'>");
                                }else{
                                    printf("<input name='hora' type='time' class='field'>");
                                }
                            ?>
                        </p>
                    </div>         
                </div>    
                <div class="columns2">
                    <div class="check"> 
                        <p>
                            <label>Servicio Terminado</label> </br>
                            <?php
                                if ($terminado=="Terminado"){
                                    printf("<input type='checkbox' name='terminado' class='check' value='Terminado' checked>");
                                }else{
                                    printf("<input type='checkbox' name='terminado' class='check' value='Terminado'>");
                                }
                            ?>  
                        </p>
                    </div> 
                    <div class="field-container">
                        <label class="label">Especialista Biomédico: </label>
                        <p>
                            <i class="fas fa-user-tie"></i>
                            <!--<input type="text" class="field" name="tecnico">-->
                            <?php
                                if(isset($_GET['numeroid'])){
                                    printf("<input name='tecnico' type='text' class='field' value='$tecnico'>");
                                }else{
                                    printf("<input name='tecnico' type='text' class='field'>");
                                }
                            ?>
                        </p>
                    </div>    
                    <div class="field-container">
                        <label class="label">Horas de Operación: </label>
                        <p>
                            <i class="fas fa-user-clock"></i>
                            <!--<input type="number" class="field" name="horasop">-->
                            <?php
                                if(isset($_GET['numeroid'])){
                                    printf("<input name='horasop' type='number' class='field' value='$horasop'>");
                                }else{
                                    printf("<input name='horasop' type='number' class='field'>");
                                }
                            ?>
                        </p>
                    </div>   
                    <div class="field-container">
                        <label class="label">No. de Reporte: </label>
                        <p>
                            <i class="fas fa-clipboard"></i>
                            <!--<input type="number" class="field" name="reporte">--> 
                            <?php
                                if(isset($_GET['numeroid'])){
                                    printf("<input name='reporte' type='number' class='field' value='$reporte'>");
                                }else{
                                    printf("<input name='reporte' type='number' class='field'>");
                                }
                            ?>                            
                        </p>
                    </div>  
                </div>
                <div class="centrar">
                    <button class="but_green2" type="submit" value="Guardar datos" name="editar">Editar Mantenimiento</button>
                    <?php 
                        $url = 'report.php?reporteid='.$id2;
                        printf("<button class='but_teal2' type='button' name='pdf'  onclick=\"location.href='$url'\">PDF</button>");
                    ?>
                </div>
            </form>
        </div>
    </body>
</html>

<?php
    if(isset($_POST['editar'])){
        include("funciones/config.php");
        $nid = $_POST["nid"];
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

        $sql = "UPDATE mantenimiento SET tiposervicio='$tiposervicio', tipo='$tipo', linea='$linea', tipofalla='$tipofalla', 
        servicio='$servicio', hospital='$hospital', depto='$depto', zona='$zona', equipo='$equipo', modelo='$modelo', 
        no_serie='$no_serie', no_bien='$no_bien', visita='$visita', repuestos='$repuestos', calibracion='$calibracion', 
        estado='$estado', fecha='$fecha', hora='$hora', terminado='$terminado', tecnico='$tecnico', horasop='$horasop',
        reporte='$reporte' 
        WHERE id='$nid'";	

        if ($conn->query($sql) === TRUE) {
            $mensaje = "Mantenimiento editado".$id2;
            print "<script>alert('$mensaje')</script>";
            $url = 'verMantenimiento.php?numeroid='.$nid;
            echo "<script>window.location='$url'</script>";
        } else {
            $mensaje = "No se encontro mantenimiento a editar.".$conn->error;
            print "<script>alert('$mensaje')</script>";
        }
        $conn->close();
    }
?>