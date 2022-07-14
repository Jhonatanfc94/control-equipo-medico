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
        <div id="encabezado">
            <header class="header">
                <div>
                    <img class=logo src="images/logo.png"/>
                    <label class='titulo'>Buscar mantenimiento</label>
                </div>
            </header>
        </div>
        <?php
            include("menu.php");
        ?>
        <form method='post' action='buscarMantenimiento.php' id='formulario'>
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

    <div class='divTable2' id='mantenimiento'>
        </html>
<?php
    if(isset($_POST['buscar'])){
        $busqueda = $_POST["txtBusqueda"];
    }else{
        $busqueda = ' ';
    }

    $sql = "SELECT * FROM mantenimiento
    WHERE no_serie LIKE '%$busqueda%'";
    $result = $conn->query($sql);

    if(isset($_GET['numeroserie'])){
        $var1= $_GET['numeroserie'];
        $busqueda = $var1;

        $sql = "SELECT * FROM mantenimiento
        WHERE no_serie='$busqueda'";
        $result = $conn->query($sql);
    }

    if ($result->num_rows > 0) {
		while($row = $result->fetch_array()){
            $rows[] = $row;
        }
        printf("<div class='divTableRow'>
            <div class='divTableCellBorderW'>&nbsp;<b>EQUIPO</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>MODELO</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>NÚMERO DE SERIE</b></div>
            <div class='divTableCellBorderW'>&nbsp;<b>HOSPITAL</b>&nbsp;</div>
            <div class='divTableCellBorderW'>&nbsp;<b>SERVICIO</b>&nbsp;</div>
            <div class='divTableCellBorderW'>&nbsp;<b>FECHA</b>&nbsp;</div>
            <div class='divTableCellBorderW'>&nbsp;<b>TIPO DE SERVICIO</b>&nbsp;</div>
            <div class='divTableCellBorderW'>&nbsp;<b>ESTADO</b>&nbsp;</div>            
            </div>");
        foreach($rows as $row){
            $nid =$row['id'];
            $url = 'verMantenimiento.php?numeroid='.$nid;
            printf("
            <div class='divTableRow'>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'><a href= $url>&nbsp;%s&nbsp;</a></div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
            </div>",
            $row['equipo'], $row['modelo'], $row['no_serie'],  $row['hospital'], $row['servicio'], $row['fecha'], $row['tiposervicio'], $row['estado']);
        }    
	}else if($busqueda != ' '){
        printf("No se encontraron resultados para su búsqueda");
    }
    
    $conn->close();
    ?>    
    <!DOCTYPE html>
            </table>
        </form>
    </body>
</html>