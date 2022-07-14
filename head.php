<meta charset='utf-8'/>
<title>Equipo medico</title>
<meta name='description' content='Control de equipos medicos'/>
<meta name='author' content='Jhonatan Flores y Oscar Blanck'/>
<meta name='keywords' content='Mantenimiento, equipo medico, biomédica, hoja de vida'/>
<script src='https://kit.fontawesome.com/ffd87086a1.js' crossorigin='anonymous'></script>
<script type="text/javascript">
  window.heap=window.heap||[],heap.load=function(e,t){window.heap.appid=e,window.heap.config=t=t||{};var r=document.createElement("script");r.type="text/javascript",r.async=!0,r.src="https://cdn.heapanalytics.com/js/heap-"+e+".js";var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(r,a);for(var n=function(e){return function(){heap.push([e].concat(Array.prototype.slice.call(arguments,0)))}},p=["addEventProperties","addUserProperties","clearEventProperties","identify","resetIdentity","removeEventProperty","setEventProperties","track","unsetEventProperty"],o=0;o<p.length;o++)heap[p[o]]=n(p[o])};
  heap.load("1884061737");
</script>
<?php
  session_start();
  if (isset($_SESSION['user'])){
      //echo "usuario" . $_SESSION["user"];
      $nameUser = $_SESSION["user"];
      echo "<script type='text/javascript'>
          heap.identify('$nameUser');
      </script>";
  }else{
      echo "<script type='text/javascript'>
          heap.resetIdentity();
      </script>";
      $urlLogin = 'index.php';
      echo "<script>window.location='$urlLogin'</script>";
  }
?>