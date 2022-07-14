<?php
    include("funciones/config.php");
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
                        <label class='titulo'>Dashboard</label>
                    </div>
            </header>
        </div>
        <?php
            include("menu.php");
        ?>
        <form method='post' action='dashboard.php' id='formulario'>
            <div class="columns">
                <div class="field-container">  
                    <label>Filtro:</label>
                    <p>
                        <i class="fas fa-search"></i>
                        <select name="estado" class="field_s">
                            <option value="realizado">realizado</option> 
                            <option value="pendiente">pendiente</option>
                            <option value="ambos" selected>ambos</option>
                        </select> 
                    </p>
                </div> 
                <div>
                    <button type='submit' name='buscar' value='Buscar'>Aplicar</button>
                </div>
            </div>
            <div class='divTable2' id='equipo'>
            <?php
            if(isset($_POST['buscar'])){
                $estado = $_POST["estado"];
            }else{
                $estado = 'ambos';
            }

            $mesActual = date("m");
            $mesSiguiente = date("m")+1;
            if( $mesSiguiente<10){
                $mesSiguiente="0".$mesSiguiente;
            }
            
            if($mesSiguiente>12){
                $mesSiguiente=0;
            }
            $year=date("Y");

            if($estado=='realizado'){
                $sql = "SELECT equipos_medicos.no_serie,equipo,modelo,tipo,mes_planificado,realizado,descripcion
                FROM equipos_medicos
                INNER JOIN cronograma ON cronograma.no_serie=equipos_medicos.no_serie
                WHERE realizado='SI' AND (mes_planificado='$mesActual' or mes_planificado='$mesSiguiente')";
            
            }elseif($estado=='pendiente'){
                $sql = "SELECT equipos_medicos.no_serie,equipo,modelo,tipo,mes_planificado,realizado,descripcion
                FROM equipos_medicos
                INNER JOIN cronograma ON cronograma.no_serie=equipos_medicos.no_serie
                WHERE realizado='NO' AND (mes_planificado='$mesActual' or mes_planificado='$mesSiguiente')";
            
            }elseif($estado=='ambos'){
                $sql = "SELECT equipos_medicos.no_serie,equipo,modelo,tipo,mes_planificado,realizado,descripcion
                FROM equipos_medicos
                INNER JOIN cronograma ON cronograma.no_serie=equipos_medicos.no_serie 
                WHERE (mes_planificado='$mesActual' or mes_planificado='$mesSiguiente')";
            }
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_array()){
                    $rows[] = $row;
                }
                printf("<div class='divTableRow'>
                    <div class='divTableCellBorderW'>&nbsp;<b>EQUIPO</b></div>
                    <div class='divTableCellBorderW'>&nbsp;<b>MODELO</b></div>
                    <div class='divTableCellBorderW'>&nbsp;<b>NÚMERO DE SERIE</b></div>
                    <div class='divTableCellBorderW'>&nbsp;<b>MES</b></div>
                    <div class='divTableCellBorderW'>&nbsp;<b>DESCRIPCIÓN</b></div>
                    <div class='divTableCellBorderW'>&nbsp;<b>TIPO</b></div>
                    <div class='divTableCellBorderW'>&nbsp;<b>REALIZADO</b></div>
                    </div>");
                foreach($rows as $row){
                    printf("
                    <div class='divTableRow'>
                    <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
                    <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
                    <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
                    <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
                    <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
                    <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
                    <div class='divTableCellBorderL'>&nbsp;%s&nbsp;</div>
                    </div>",
                        $row['equipo'],$row['modelo'],$row['no_serie'],$row['mes_planificado'],$row['descripcion'],$row['tipo'],$row['realizado']);
                }
            }else{
                printf("No se encontraron resultados para su búsqueda");
            }
    
            $conn->close();
            ?>    
        </form>
    </body>
</html>