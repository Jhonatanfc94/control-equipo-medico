<?php
    include("funciones/config.php");

    $no_serie= $_GET['numeroserie'];

    $sql2 = "SELECT * FROM tipos_equipos 
    ORDER BY tipos ASC";
    $result2 = $conn->query($sql2);

    $sql = "SELECT * FROM equipos_medicos
    WHERE (no_serie= '$no_serie') LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $modelo=$row['modelo'];
        $equipo=$row['equipo'];
    }
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
                        <label class='titulo'>Manuales</label>
                    </div>
            </header>
        </div>
        <?php
            include("menu.php");
        ?>
        <form method='post' id='formulario' enctype='multipart/form-data'>
            <div class="columns">
                <div class="field-container">
                    <label>Equipo:</label>
                    <p>
                        <p>
                            <i class="fas fa-th-list"></i>
                            <input name="equipo" type="text" class=field value="<?php printf($equipo)?>"readonly>
                        </p>    
                    </p>
                </div>           
                <div class="field-container">
                    <label>Modelo:</label>
                    <p>
                        <i class="fas fa-th-list"></i>
                        <input name="modelo" type="text" class=field value="<?php printf($modelo)?>"readonly>
                    </p>
                </div>
                <div class="field-container">
                    <label>Tipo Manual:</label>
                    <p>
                        <i class="far fa-flag"></i>
                        <select name="tipoManual" class="field_s">
                            <option value="Servicio">Servicio</option>
                            <option value="Usuario">Usuario</option>
                        </select>
                    </p>
                </div>
                <div class="field-container">
                    <?php
                        $file = 'manuales/'.$modelo."-Usuario.pdf";
                        $file2 = 'manuales/'.$modelo."-Servicio.pdf";
                        if (is_file($file)) {
                            $texto="<a href='manuales/"."$modelo"."-Usuario.pdf'>Descarga Manual de Usuario</a>";
                        } else {
                            $texto='Ingrese el manual de Usuario:';
                        }
                        if (is_file($file2)) {
                            $texto2="<a href='manuales/"."$modelo"."-Servicio.pdf'>Descarga Manual de Servicio</a>";;
                        } else {
                            $texto2='Ingrese el manual de Servicio:';
                        }
                    ?>
                    <label> <?php printf($texto)?></label></br>
                    <label> <?php printf($texto2)?></label>
                    <p>
                        <i class="fas fa-stethoscope"></i>
                        <input type="file" name="archivo" class=field>
                    </p>
                </div>
                <div>
                    <button class='but_blue' type='submit' name='subir' value='subir'>Subir</button>
                </div>
            </div>
        </form>
    </body>
</html>
<?php
    if (isset($_POST['subir'])) {
        $archivo = $_FILES['archivo']['name'];
        if (isset($archivo) && $archivo != "") {
            $tipo = $_FILES['archivo']['type'];
            $tamano = $_FILES['archivo']['size'];
            $temp = $_FILES['archivo']['tmp_name'];
            
            $archivo=$modelo.'-'.$_POST["tipoManual"].'.pdf';
                if(!((strpos($tipo, "pdf") ) && ($tamano < 5000000000))) {
                echo '<div><b> Error. Se permiten archivos .pdf, 5 mb como máximo.</div>';
            }
            else {
                if (move_uploaded_file($temp, 'manuales/'.$archivo)) {
                    chmod('manuales/'.$archivo, 0777);
                    $mensaje = "Se ha subido correctamente el manual ".$archivo;
                    print "<script>alert('$mensaje')</script>";
                    $url = 'manuales.php?numeroserie='.$no_serie;
                    echo "<script>window.location='$url'</script>";
                }
                else {
                echo '<div><b> Ocurrió algún error al subir el manual. No pudo guardarse.</b></div>';
                }
            }
        }
    }
?>