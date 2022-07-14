<?php
    include("funciones/config.php");
    $sql1 = "SELECT * FROM lineas 
    ORDER BY linea ASC";
    $result1 = $conn->query($sql1);

    $sql2 = "SELECT * FROM tipos_equipos 
    ORDER BY tipos ASC";
    $result2 = $conn->query($sql2);
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
            <form method="post" action="crearEquipo.php">  
            <div class="columns">    
                <div class="field-container">
                    <label>Equipo:</label>
                    <p>
                        <i class="fas fa-microscope"></i>
                        <select name="equipos" class="field_s">
                            <?php
                                include("seleccionarEquipos.php");
                            ?>
                        </select> 
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
                                <option value="<?php echo $row1['linea']?>"><?php echo $row1['linea']?></option>
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
                        <input type="text" name="hospital" class=field>
                    </p>
                </div>
                <div class="field-container">
                    <label>Marca:</label>
                    <p>
                        <i class="fas fa-arrow-alt-circle-right"></i>
                        <input type="text" name="marca" class=field required="true">      
                    </p>
                </div>
            </div>

            <div class="columns">
                <div class="field-container">
                    <label>Servicio:</label>
                    <p>
                        <i class="fas fa-stethoscope"></i>
                        <input type="text" name="servicio" class=field>
                    </p>
                </div>
                <div class="field-container">
                    <label>Modelo:</label>
                    <p>
                        <i class="fas fa-arrow-alt-circle-right"></i>                  
                        <input type="text" name="modelo" class=field>                        
                    </p>
                </div>                
            </div>

            <div class="columns">
                <div class="field-container">
                    <label>Tipo:</label>
                    <p>
                        <i class="far fa-folder"></i>
                        <select name="tipo" class="field_s">
                            <option value="Comodato">Comodato</option>
                            <option value="Facturable">Facturable</option>
                            <option value="Laboratorio de Biomédica">Laboratorio de Biomédica</option>
                        </select>  
                    </p>
                </div>
                <div class="field-container">
                    <label>Código de Referencia:</label>
                    <p>    
                        <i class="fas fa-hashtag"></i> 
                        <input type="text" name="ref" class=field>
                    </p>
                </div>
            </div>

            <div class="columns">
                <div class="field-container">
                    <label>Vencimiento de Garantía:</label>
                    <p>
                        <i class="fas fa-file-contract"></i>
                        <input type="date" name="garantia" class=field>
                    </p>                        
                </div>
                <div class="field-container">
                    <label>Número de Serie:</label>
                    <p>
                        <i class="fas fa-book"></i>
                        <input type="text" name="serie" class=field required="true">
                    </p>
                </div>
            </div>
            <div class="columns">
                <div class="field-container">
                    <label>Estado:</label>
                    <p>
                        <i class="far fa-flag"></i>
                        <select name="estado" class="field_s">
                            <option value="Laboratorio - Esperando Limpieza">Esperando Limpieza</option>
                            <option value="Esperando Diagnóstico (Inoperante)">Esperando Diagnóstico (Inoperante)</option>
                            <option value="Esperando Repuesto (Inoperante)">Esperando Repuesto (Inoperante)</option>   
                            <option value="Esperando Calibración (Inoperante)">Esperando Calibración (Inoperante)</option>
                            <option value="Liberado para Uso" selected>Liberado para Uso</option>
                            <option value="Dado de Baja">Dado de Baja</option>
                        </select>
                    </p>
                </div>
                <div class="field-container">
                    <label>Número de Bien:</label>
                    <p>
                        <i class="fas fa-book-medical"></i>
                        <input type="text" name="bien" class=field>
                    </p>                        
                </div>
            </div>

            <div class="columns">
                <div class="field-container">
                    <label>Frecuencia de Mantenimiento:</label>
                    <p>
                        <i class="fas fa-wave-square"></i>
                        <input type="text" name="fm" class=field>                
                    </p>
                </div>
                <div class="field-container">
                    <label>Departamento:</label>
                    <p>
                        <i class="fas fa-map-marked-alt"></i>
                        <select name="depto" class="field_s">
                            <option value="Alta Verapaz">Alta Verapaz</option>
                            <option value="Baja Verapaz">Baja Verapaz</option>
                            <option value="Chimaltenango">Chimaltenango</option>
                            <option value="Chiquimula">Chiquimula</option>
                            <option value="El Progreso">El Progreso</option>
                            <option value="Escuintla">Escuintla</option>
                            <option value="Guatemala" selected>Guatemala</option>
                            <option value="Guatemala (Laboratorio)">Guatemala (Laboratorio)</option>
                            <option value="Huehuetenango">Huehuetenango</option>
                            <option value="Izabal">Izabal</option>
                            <option value="Jalapa">Jalapa</option>
                            <option value="Jutiapa">Jutiapa</option>
                            <option value="Petén">Petén</option>
                            <option value="Quetzaltenango">Quetzaltenango</option>
                            <option value="Quiché">Quiché</option>
                            <option value="Retalhuleu">Retalhuleu</option>
                            <option value="Sacatepéquez">Sacatepéquez</option>
                            <option value="San Marcos">San Marcos</option>
                            <option value="Santa Rosa">Santa Rosa</option>
                            <option value="Sololá">Sololá</option>
                            <option value="Suchitepéquez">Suchitepéquez</option>
                            <option value="Totonicapán">Totonicapán</option>
                            <option value="Zacapa">Zacapa</option>
                        </select>                
                    </p>
                </div>
            </div>
            
            <div class="columns">
                <div>
                    <p>
                        <i class="far fa-comment-dots"></i>
                        <label>Comentarios:</label>
                    </p>
                    <textarea name="comentarios" class="field_c" rows="10" cols="30"></textarea>  
                </div>
                <div>
                    </br></br>
                    <button class="but_green" type="submit" value="Guardar datos" name="guardar">Guardar datos</button>
                </div>
            </div>
            </form>
        </div> 
    </body>
</html>

<?php
    if(isset($_POST['guardar'])){
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

        $sql = "SELECT * FROM equipos_medicos WHERE (no_serie LIKE '$no_serie')";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $mensaje = "Ya existe un equipo con ese número de serie.".$conn->error;
            print "<script>alert('$mensaje')</script>";
            $url = 'verEquipo.php?numeroserie='.$no_serie;
            echo "<script>window.location='$url'</script>";    
        } else {  

            $sql = "INSERT INTO equipos_medicos (equipo, marca, modelo, referencia, no_serie, no_bien, hospital, tipo, servicio, estado, frecuencia_mant, comentario, garantia, linea, depto) VALUES ('$equipo', '$marca', '$modelo','$referencia','$no_serie','$no_bien','$hospital','$tipo','$servicio','$estado','$frecuencia_mant','$comentario','$garantia','$linea', '$depto')";	
            if ($conn->query($sql) === TRUE) {
                $mensaje = "Equipo Guardado";
                print "<script>alert('$mensaje')</script>";
                
            } else {
                $mensaje = "Error al guardar equipo ".$conn->error;
                print "<script>alert('$mensaje')</script>";
            }
        }
        $conn->close();
    }
?>