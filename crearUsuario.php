<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            include("head.php");
        ?>
        <link rel="stylesheet" href="css/formulario.css">
    </head>
    <body>
        <div>
            <header class="header">
                <div>
                    <img class=logo src="images/logo.png"/>
                    <label class='titulo'>Crear usuario</label>
                </div>
            </header>
            <?php
                include("menu.php");
            ?>
            <form method="post" action="crearUsuario.php" id="formulario2">
                <div class="field-container">
                    <label>Usuario:</label>
                    <p>
                        <i class="fas fa-user"></i>
                        <input type="text" name="txtusuario" class=field>
                    </p>
                </div>
                <div class="field-container">
                    <label>Contraseña:</label>
                    <p>
                        <i class="fas fa-key"></i>
                        <input type="text" name="txtpassword" class=field required="true">      
                    </p>
                </div>
                <div>
                    </br>
                    <button class="but_green" type="submit" value="guardar" name="guardar">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </body>
</html>

<?php
    if(isset($_POST['guardar'])){
        include("funciones/config.php");

        $usuario = $_POST["txtusuario"];
        $pass = $_POST["txtpassword"];

        //$sql = "DELETE FROM login WHERE usuario='$usuario'";
        $sql = "INSERT INTO usuarios (username, password) VALUES ('$usuario', '$pass')";
        
        if ($conn->query($sql) === TRUE) {
            echo "User create successfully";
        } else {
            echo "Error inserting user: " . $conn->error;
        }
        
        $conn->close();
    }
?>