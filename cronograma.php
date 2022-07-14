<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            include("head.php");
        ?>
        <link rel="stylesheet" href="css/formulario.css">
    </head>
    <script src="https://kit.fontawesome.com/ffd87086a1.js" crossorigin="anonymous">
    </script>
        
    <body>
        <div>
            <header class="header">
                <div>
                    <img class=logo src="images/logo.png"/>
                    <label class='titulo'>Cronograma</label>
                </div>
            </header>
            <?php
                include("menu.php");
                $url2 = 'cronograma.php?numeroserie='.$serie;
            ?>
            <form action="<?php printf($url2) ?>" id="formulario3" method="post">
                <div class="divTable">
                    <div class="divTableBody" id="mantenimientos">
                        <div class="divTableRow">
                            <div class="divTableCell">
                                <b>FECHA</b>
                            </div>
                            <div class="divTableCell">
                                <b>PLANIFICADO</b>
                            </div>
                            <div class="divTableCell">
                                <b>DESCRIPCION</b>
                            </div>
                            <div class="divTableCell">
                                <b>REALIZADO</b>
                            </div>
                            <div class="divTableCell">
                                <b>ESTADO</b>
                            </div>
                            <div class="divTableCell">
                                <b>FECHA</b>
                            </div>
                        </div>
                            <?php
                            include("funciones/config.php");

                            for ($i = 1; $i <= 12; $i++) {
                                $mes = $i;
                                if($i<10){
                                    $mes = '0'.$i;
                                }
                                $sql = "SELECT * FROM cronograma
                                WHERE (mes_planificado LIKE '%$mes%') and no_serie='$serie' LIMIT 1";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $checked='checked';
                                }else{
                                    $checked='';
                                }
                                $year=date("Y");
                                printf("<div class='divTableRow'>
                                <div class='divTableCell'>
                                    <label>$mes-$year</label>
                                </div>
                                <div class='divTableCell'>
                                    <input class='check' type='checkbox' name='plan[]' value='$mes' $checked>
                                </div>");
                                if ($result->num_rows > 0) {
                                    printf("<div class='divTableCell'>
                                        <input class='textbox' type='text' name='descrip$mes' value='%s'>
                                    </div>",
                                    $row['descripcion']);
                                }else{
                                    printf("<div class='divTableCell'>
                                        <input class='textbox' type='text' name='descrip$mes'>
                                    </div>");
                                }
                                
                                
                                $busqueda = '-'.$mes.'-';
    
                                $sql = "SELECT estado,fecha FROM mantenimiento
                                WHERE (fecha LIKE '%$busqueda%') and no_serie='$serie' AND tiposervicio='Mantenimiento Preventivo' LIMIT 1";
                                $result = $conn->query($sql);
    
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    printf("<div class='divTableCell'>
                                            SI
                                        </div>
                                        <div class='divTableCell'>
                                        &nbsp;%s&nbsp;
                                        </div>
                                        <div class='divTableCell'>
                                        &nbsp;%s&nbsp;
                                        </div></div>",
                                        $row['estado'], $row['fecha']);
                                    
                                }else{
                                    printf("<div class='divTableCell'>
                                            -
                                        </div>
                                        <div class='divTableCell'>
                                        -
                                        </div>
                                        <div class='divTableCell'>
                                        -
                                        </div></div>");
                                    }

                            }
                                                        
                            $conn->close();
                            ?>
                    </div>
                </div>
                <div class="centro">
                    <button type="submit" value="Guardar datos" name="guardar">Guardar Datos</button>
                    
                </div>
            </form>
        </div>        
    </body>
</html>

<?php
    if(isset($_POST['guardar'])){
        $mensaje = "Cronograma Guardado";
        print "<script>alert('$mensaje')</script>";

        include("funciones/config.php");
        $sql = "DELETE FROM cronograma WHERE no_serie='$serie' and anio='$year' and realizado='NO'";
        $result = $conn->query($sql);
        
        if(isset($_POST['plan'])){
        $array_plan = $_POST["plan"];
        $count=0;

        $min = count($array_plan);
            foreach($array_plan as $i=>$t) {
                $descripIn=$_POST["descrip$t"];
    
                $sql = "INSERT INTO cronograma (no_serie, mes_planificado, anio, descripcion,realizado) VALUES ('$serie', '$array_plan[$i]','$year','$descripIn','NO')";	
                if ($conn->query($sql) === TRUE) {
                    $url2 = 'cronograma.php?numeroserie='.$serie;
                    echo "<script>window.location='$url2'</script>";
                } else {
                    echo "Error al ingresar al mantenimiento" . $conn->error;
                }
            }
        }else{
            $url2 = 'cronograma.php?numeroserie='.$serie;
            echo "<script>window.location='$url2'</script>";
        }
        
        $conn->close();
    }
    
?>