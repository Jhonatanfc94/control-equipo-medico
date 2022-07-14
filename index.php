<?php session_start(); ?>
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
            heap.resetIdentity();
        </script>
        <link rel="stylesheet" href="css/home.css">
    </head>
    <script>
        a = 0;
        function addMantenimiento(){
            a++;
            var div = document.createElement('div');
            div.className = 'divTableRow';
            div.innerHTML = '<div class="divTableCell"><input name="mante[]" type="text" class="textbox" required="true"/></div><div class="divTableCell"><label><input type="radio" name = "ans_'+a+'" value="pass"> Pass </br><input type="radio" name = "ans_'+a+'" value="fail"> Fail </br></div>';
            document.getElementById('mantenimientos').appendChild(div);
            }
    </script>
        
    <body>
        <div>
            <header class="header">
                <div>
                    <img class=logo src="images/logo.png"/>
                    <label class='titulo'>Control de equipo médico</label>
                </div>
            </header>
            <div class="agrupar">
                <form method="post" action="index.php">
                    <table>
                        <tr>
                            <td rowspan="5"><img src="images/user.jpg" class="foto"/></td>
                            <td>
                                <label>Usuario</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="txtusuario" class=textBox/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Password</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" name="txtpassword" class=textBox/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Ingresar" name="ingresar"/>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>        
    </body>
</html>

<?php
    if(isset($_POST['ingresar'])){
        include("funciones/config.php");

        $nombre = $_POST["txtusuario"];
        $pass = $_POST["txtpassword"];

        $sql = "SELECT * FROM usuarios WHERE username = '$nombre' and password = '$pass'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION["user"] = "$nombre";
            $_SESSION["pass"] = "$pass";
            echo "<script>window.location='dashboard.php'</script>";
        } else {
            echo "<script>window.location='index.php'</script>";
        }

        $conn->close();

        
    }
?>