<!DOCTYPE html>
<html lang='s'>
    <head>
        <?php
            include("head.php");
            include("funciones/config.php");
        
            $buscado=false;
            $busquedaporequipo=NULL;
            $busquedapormm=NULL;
            $busquedaporserie=NULL;
            $busquedaporbien=NULL;
            $busquedaporhospital=NULL;
            $busquedaporservicio=NULL;
        
            if(isset($_POST["buscar"])){
                $buscado=true;
                $busquedaporequipo=$_POST["porequipo"];
                $busquedapormm=$_POST["pormm"];
                $busquedaporserie=$_POST["porserie"];
                $busquedaporbien=$_POST["porbien"];
                $busquedaporhospital=$_POST["porhospital"];
                $busquedaporservicio=$_POST["porservicio"];
            }
        ?>
        <link rel='stylesheet' href='css/buscarEquipo.css'>
    </head>
    <body>
        <div id='encabezado'>
            <header class='header'>
                    <div class="he">
                        <img class=logo src='images/logo.png'/>
                        <label class='titulo'>Buscar Equipo</label>
                    </div>
            </header>
        </div>
        <div>
        <?php
            include("menu.php");
        ?>
        </div>
        <form method='post' action='buscarEquipo.php' id='formulario'>
        <div class="columns2">
            <div class="field-container">
                <label>Equipo:</label>
                <p>
                    <i class="fas fa-microscope"></i>
                    <input type="text" name="porequipo" class=field value="<?php echo $busquedaporequipo;?>">
                </p>
            </div>  
            <div class="field-container">
                <label>Marca/Modelo:</label>
                <p>
                    <i class="fas fa-arrow-alt-circle-right"></i>
                    <input type="text" name="pormm" class=field value="<?php echo $busquedapormm;?>">      
                </p>
            </div>  
            <div class="field-container">
                <label>Número de Serie:</label>
                <p>
                    <i class="fas fa-book"></i>
                    <input type="text" name="porserie" class=field value="<?php echo $busquedaporserie;?>">
                </p>
            </div>    
        </div>      
        <div class="columns2">                    
            <div class="field-container">
                <label>Hospital/Clínica:</label>
                <p>
                    <i class="far fa-hospital"></i>
                    <input type="text" name="porhospital" class=field value="<?php echo $busquedaporhospital;?>">
                </p>
            </div>   
            <div class="field-container">
                <label>Servicio:</label>
                <p>
                    <i class="fas fa-stethoscope"></i>
                    <input type="text" name="porservicio" class=field value="<?php echo $busquedaporservicio;?>">
                </p>
            </div>    
            <div class="field-container">
                <label>Número de Bien:</label>
                <p>
                    <i class="fas fa-book-medical"></i>
                    <input type="text" name="porbien" class=field value="<?php echo $busquedaporbien;?>">
                </p>                        
            </div>             
        </div>
        <div>
            <button type='submit' name='buscar' value='Buscar'>Buscar</button>
        </div>

    <div class='divTable2' id='equipo'>

<?php
    $sql = "SELECT * FROM equipos_medicos
    WHERE (equipo LIKE '%$busquedaporequipo%' AND no_serie LIKE '%$busquedaporserie%' AND no_bien LIKE '%$busquedaporbien%' AND (modelo  LIKE '%$busquedapormm%' OR marca  LIKE '%$busquedapormm%') AND hospital LIKE '%$busquedaporhospital%' AND servicio LIKE '%$busquedaporservicio%')
    ORDER BY marca DESC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
		while($row = $result->fetch_array()){
            $rows[] = $row;
        }
        printf("<div class='divTableRow'>
            <div class='divTableCellBorderW'>&nbsp;<b>EQUIPO</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>MARCA</b>&nbsp;</div>
            <div class='divTableCellBorderW'>&nbsp;<b>MODELO</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>NÚMERO DE SERIE</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>NÚMERO DE BIEN</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>HOSPITAL</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>SERVICIO</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>ESTADO</b></div>
            </div>");
        foreach($rows as $row){
            
            $ns =$row['no_serie'];
            $url = 'verEquipo.php?numeroserie='.$ns;
            printf("
            <div class='divTableRow'>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>
            <a href= $url>&nbsp;%s&nbsp;</a>
            </div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            </div>",
                $row['equipo'], $row['marca'], $row['modelo'], $row['no_serie'], $row['no_bien'], $row['hospital'], $row['servicio'], $row['estado']);
        }
	}else if ($busquedaporserie = ' '){
        printf("No se encontraron resultados para su búsqueda");
    }
    
    $conn->close();
    ?>    
            </table>
        </form>
    </body>
</html>