<?php
    include("funciones/config.php");

    if(isset($_GET['reporteid'])){
        $var1= $_GET['reporteid'];
        
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
    include("tcpdf/tcpdf.php");
    $prueba='prueba variable';
    
    $pdf = new TCPDF('P','mm', 'A4');

    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    $pdf->AddPage();

    $html = <<<EOD
    <p style="text-align:center;"><img class=logo src="images/logo2.png" width="50" height="40"/></p>
    <p style="text-align:center; margin-left: 170px;" ><b>$depto $zona, $fecha, $hora</b></p>
    <p style="text-align:center; margin-left: 170px;" ><b>Reporte de $tiposervicio de $equipo $modelo</b></p>
    <p style="text-align:left;">
    <table width="100%" height="100%">
        <tr>
            <th>
                <p><b>No. Reporte: </b>$reporte</p>
            </th>
        </tr>
        <tr>
            <th>
            <p><b>Linea Comercial: </b>$linea</p>
            <p><b>Tipo: </b>$tipo</p>
            </th>
        </tr>
        <tr>
            <th>
            <p><b>Horas de operación: </b> $horasop</p>
            <p><b>Tipo de Falla: </b>$tipofalla</p>
            </th>
        </tr>
        <tr>
            <th>
            <p><b>Hospital/Clínica: </b> $hospital<b> Servicio: </b> $servicio</p>
            </th>
        </tr>
        <tr>
            <th>
            <p><b>Número de serie: </b> $no_serie<b> Número de bien: </b> $no_bien</p>
            </th>
        </tr>
        <tr>
            <th>
            <p><b>Visita al cliente: </b> $visita</p>
            <p><b>Repuestos: </b> $repuestos</p>
            </th>
        </tr>
        <tr>
            <th>
            <p><b>Calibración: </b> $calibracion</p>
            <p><b>Estado: </b> $estado</p>
            </th>
        </tr>
        <tr>
            <th>
            <p><b>Servicio terminado: </b> $terminado</p>
            <p><b>Especialista Biomédico: </b> $tecnico</p>
            </th>
        </tr>
    </table></p>
    <p style="text-align:center; margin-bottom:0px">
    <table width="100%">
        <tr>
            <th>
            <p>  _____________________   </p>
            <p>Responsable de servicio</p>
            </th>
            <th>
            <p>  _____________________   </p>
            <p>Dpto. Biomedica/mantenimiento</p>
            </th>
            <th>
            <p>  _____________________   </p>
            <p>Cliente/Usuario</p>
            </th>
        </tr>
    </table></p>
EOD;

    $pdf->writeHTML($html, true, false, true, false);

    ob_end_clean();
    $pdf->Output();
?>