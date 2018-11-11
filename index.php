<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
$_SESSION["estilos"]="azul";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Hosting</title>
        <link href="js/azul/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="js/azul/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
        <script src="js/azul/jquery.js" type="text/javascript"></script>
        <script src="js/azul/jquery-ui.js" type="text/javascript"></script>
        
        <script src="js/codigojs.js" type="text/javascript"></script>
    </head>
    <body bgcolor="#79b7e7">
        
        <div id="dialogo" title="Iniciar sesión">
            <?php
        if (isset($_SESSION["mensaje"])) {
            ?>
            <h2>
                <?php
                echo $_SESSION["mensaje"];
                unset($_SESSION["mensaje"]);
                ?>
            </h2>
            <?php
        }
        ?>
            <form action="php/controlador.php">
                <table>
                    <tr>
                        <td><label>Usuario</label></td>
                        <td><input type="text" name="usuario"/></td>
                    </tr>
                    <tr>
                        <td><label>Contraseña</label></td>
                        <td><input type="password" name="clave"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="accion" value="Entrar"/></td>
                        <td><input type="submit" name="accion" value="Registrarse"/></td>
                    </tr>
                </table>
            </form>
            
        </div>
    </body>
</html>
