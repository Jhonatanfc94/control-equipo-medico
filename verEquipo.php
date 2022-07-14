<?php
    $var1= $_GET['numeroserie'];
    
    include("funciones/config.php");
    $sql = "SELECT * FROM equipos_medicos
    WHERE (no_serie= '$var1') LIMIT 1";
    $result = $conn->query($sql);

    $sql1 = "SELECT * FROM lineas 
    ORDER BY linea ASC";
    $result1 = $conn->query($sql1);

    $sql2 = "SELECT * FROM tipos_equipos 
    ORDER BY tipos ASC";
    $result2 = $conn->query($sql2);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $equipo = $row['equipo'];     
        $marca=$row['marca'];
        $modelo=$row['modelo'];
        $referencia=$row['referencia'];
        $no_serie=$row['no_serie'];
        $no_bien=$row['no_bien'];
        $hospital=$row['hospital'];
        $tipo=$row['tipo'];
        $servicio=$row['servicio'];
        $estado=$row['estado'];

        $frecuencia_mant=$row['frecuencia_mant'];
        $comentario=$row['comentario'];  
        $garantia=$row['garantia'];
        $linea=$row['linea'];
        $depto=$row['depto'];
    }
    #printf($equipo);
    $conn->close();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            include("head.php");
        ?>
        <link rel="stylesheet" href="css/crearEquipo.css">
    </head>
    <body>
        <div id="encabezado">
            <header class="header">
                <div>
                    <img class=logo src="images/logo.png"/>
                    <label class='titulo'>Hoja de Vida</label>
                </div>
            </header>
        </div>
        <?php
            include("menu.php");
        ?>
        <div id="formulario">
            <form method="post">  
            <div class="columns">    
                <div class="field-container">
                    <label>Equipo:</label>
                    <p>
                        <i class="fas fa-microscope"></i>
                        <select name='equipos' class='field_s'>
                            <?php
                                while($row2 = $result2->fetch_assoc()){
                            ?>
                                <option <?php if($equipo == $row2['tipos']){echo("selected");} ?>><?php echo $row2['tipos']?></option>
                            <?php
                                }
                            ?>
                        </select>    
                    </p>
                </div>                 
                <div class="field-container">
                    <label>Línea Comercial:</label>
                    <p>
                        <i class="fas fa-briefcase"></i>
                        <select name='linea' class='field_s'>
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
            </div>

            <div class="columns">
                <div class="field-container">
                    <label>Hospital/Clínica:</label>
                    <p>
                        <i class="far fa-hospital"></i>                
                        <input name="hospital" type="text" class=field value="<?php printf($hospital)?>">                        
                    </p>
                </div>                
                <div class="field-container">
                    <label>Marca:</label>
                    <p>    
                        <i class="fas fa-arrow-alt-circle-right"></i>
                        <input name="marca" type="text" class=field value="<?php printf($marca)?>">
                    </p>
                </div>
            </div>

            <div class="columns">
                <div class="field-container">
                    <label>Servicio:</label>
                    <p>
                        <i class="fas fa-stethoscope"></i>
                        <input name="servicio" type="text" class=field value="<?php printf($servicio)?>">
                    </p>
                </div>
                <div class="field-container">
                    <label>Modelo:</label>
                    <p>
                        <i class="fas fa-arrow-alt-circle-right"></i>  
                        <input name="modelo" type="text" class=field value="<?php printf($modelo)?>">
                    </p>                        
                </div>
            </div>

            <div class="columns">
                <div class="field-container">
                    <label>Tipo:</label>
                    <p>
                        <i class="far fa-folder"></i>
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
                    <label>Código de Referencia:</label>
                    <p>
                        <i class="fas fa-hashtag"></i> 
                        <input name="ref" type="text" class=field value="<?php printf($referencia)?>">
                    </p>
                </div>
            </div>

            <div class="columns">
                <div class="field-container">
                    <label>Garantía:</label>
                    <p>
                        <i class="fas fa-file-contract"></i>
                        <input name="garantia" type="date" class=field value="<?php printf($garantia)?>"> 
                    </p>
                </div>
                <div class="field-container">
                    <label>Número de Serie:</label>
                    <p>
                        <i class="fas fa-book"></i>
                        <input name="serie" type="text" class=field value="<?php printf($no_serie)?>" readonly>
                    </p>
                </div>
            </div>

            <div class="columns">
                <div class="field-container">
                    <label>Estado:</label>
                    <p>
                        <i class="far fa-flag"></i>
                        <?php
                            printf("<select name='estado' class='field_s'>
                            <option value='$estado'>$estado</option>");
                            printf("<option value='Esperando Limpieza'>Esperando Limpieza</option>
                            <option value='Esperando Diagnóstico (Inoperante)'>Esperando Diagnóstico (Inoperante)</option>
                            <option value='Esperando Repuesto (Inoperante)'>Esperando Repuesto (Inoperante)</option>   
                            <option value='Esperando Calibración (Inoperante)'>Esperando Calibración (Inoperante)</option>                                 
                            <option value='Liberado para Uso'>Liberado para Uso</option>
                            <option value='Dado de Baja'>Dado de Baja</option>
                            </select>");
                        ?>
                    </p>
                </div>

                <div class="field-container">
                    <label>Número de Bien:</label>
                    <p>
                        <i class="fas fa-book-medical"></i>
                        <input name="bien" type="text" class=field value="<?php printf($no_bien)?>">
                    </p>
                </div>
            </div>
                

            <div class="columns">
                <div class="field-container">
                    <label>Último Mantenimiento Preventivo:</label>
                    <p>
                        <i class="far fa-calendar-check"></i>
                        <input name="um" type="text" class=field value="
                        <?php 
                        include("funciones/config.php");
                        $sql = "SELECT * FROM mantenimiento
                        WHERE no_serie='$var1' AND tiposervicio='Mantenimiento Preventivo' ORDER BY date(fecha) DESC LIMIT 1";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $variable=$row['fecha'];
                            printf($variable);
                        }
                        
                        $conn->close();
                        
                        ?>" readonly>
                    </p>
                </div>

                <div class="field-container">
                    <label>Próximo Mantenimiento:</label>
                    <p>
                        <i class="far fa-calendar-alt"></i>
                        <input name="pm" type="text" class=field value="
                        <?php 
                        $mes=date("m");
                        $year=date("Y");
                        include("funciones/config.php");
                        $sql = "SELECT * FROM cronograma
                        WHERE no_serie='$var1' and (mes_planificado>=$mes) and (anio>=$year) ORDER BY mes_planificado ASC LIMIT 1";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $variable=$row['mes_planificado'];
                            printf($variable.'-'.$year);
                        }
                        
                        $conn->close();                        
                        ?>" readonly>
                    </p>
                </div>
            </div>
                
            <div class="columns">
                <div class="field-container">
                    <label>Última Calibración:</label>
                    <p>
                        <i class="far fa-calendar-check"></i>
                        <input name="uc" type="text" class=field value="
                        <?php 
                        include("funciones/config.php");
                        $sql = "SELECT * FROM mantenimiento
                        WHERE no_serie='$var1' AND calibracion='Calibrado' ORDER BY date(fecha) DESC LIMIT 1";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $variable=$row['fecha'];
                            printf($variable);
                        }
                        
                        $conn->close();
                        
                        ?>
                        " readonly>
                    </p>
                </div>

                <div class="field-container">
                    <label>Frecuencia de Mantenimiento:</label>
                    <p>
                        <i class="fas fa-wave-square"></i>
                        <input name="fm" type="text" class=field value="<?php printf($frecuencia_mant) ?>">                
                    </p>
                </div>
            </div>
            <div class="columns">            
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
                <div>
                    <!--<input class='but_gren' type="submit" value="Eliminar Equipo" name="editar"/>-->
                    <button class='but_red' type='submit' name='eliminar' value='Eliminar'>Eliminar Equipo</button>
                </div>
            </div>
            
            <div class="columns">
                <div>
                    <p>
                        <i class="far fa-comment-dots"></i>
                        <label>Comentarios:</label>
                    </p>
                    <textarea name="comentarios" class="field_c" rows="10" cols="30"><?php printf($comentario)?></textarea>  
                    <!--<input type="submit" value="Editar" name="editar"/>   -->
                    <button class='but_green' type='submit' name='editar' value='Editar'>Editar</button> 
                </div>
                <div>
                    <?php
                    $ns =$var1;
                    $url = 'cronograma.php?numeroserie='.$ns;
                    $url2 = 'crearMantenimiento.php?numeroserie='.$ns;
                    $url3 = 'buscarMantenimiento.php?numeroserie='.$ns;
                    $url4 = 'manuales.php?numeroserie='.$ns;
                    printf("<button class='but_teal' type='button' onclick=\"location.href='$url3'\">Mantenimientos previos</button>
                    <button class='but_teal' type='button' onclick=\"location.href='$url'\">Cronograma del equipo</button>
                    <button class='but_teal' type='button' onclick=\"location.href='$url2'\">Hacer mantenimiento</button>
                    <button class='but_teal' type='button' onclick=\"location.href='$url4'\">Manual</button>");
                    ?>                    
                </div>
            </div>
            </form>
        </div> 
    </body>
</html>

<?php
    if(isset($_POST['editar'])){
        include("funciones/config.php");
        
        $equipo = $_POST["equipos"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $referencia = $_POST["ref"];
        $no_serie = $_POST["serie"];
        $no_bien = $_POST["bien"];
        $hospital = $_POST["hospital"];
        $tipo = $_POST["tipo"];
        $servicio = $_POST["servicio"];
        $estado = $_POST["estado"];
        $frecuencia_mant = $_POST["fm"];
        $comentario = $_POST["comentarios"];
        $garantia = $_POST["garantia"];
        $linea = $_POST["linea"];
        $depto = $_POST["depto"];

        $sql = "UPDATE equipos_medicos SET equipo='$equipo', marca='$marca', modelo='$modelo', referencia='$referencia', no_bien='$no_bien', hospital='$hospital', tipo='$tipo', servicio='$servicio', estado='$estado', comentario='$comentario', garantia='$garantia', linea='$linea', depto='$depto' WHERE no_serie='$no_serie'"; 
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Equipo editado ".$var1;
            print "<script>alert('$mensaje')</script>";
            $url = 'verEquipo.php?numeroserie='.$var1;
            echo "<script>window.location='$url'</script>";
        } else {
            $mensaje = "No se encontro el equipo a editar ". $conn->error;
            print "<script>alert('$mensaje')</script>";
        }

        $conn->close();
    }
?>

<?php
    if(isset($_POST['eliminar'])){
        include("funciones/config.php");
        $sql = "DELETE from equipos_medicos WHERE no_serie='$no_serie'";
        if ($conn->query($sql) === TRUE) {
            $mensaje = "Equipo eliminado ".$var1;
            print "<script>alert('$mensaje')</script>";
            echo "<script>window.location='buscarEquipo.php'</script>";
        } else {
            $mensaje = "No se encontro el equipo a editar ". $conn->error;
            print "<script>alert('$mensaje')</script>";
        }

        $conn->close();
    }
?>