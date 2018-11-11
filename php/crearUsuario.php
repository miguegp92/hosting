<?php
require_once 'utiles.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Crear nuevo usuario</title>
        <link href="../js/azul/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="../js/azul/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
        <script src="../js/azul/jquery.js" type="text/javascript"></script>
        <script src="../js/azul/jquery-ui.js" type="text/javascript"></script>
        <link href="../css/azul/estilos.css" rel="stylesheet" type="text/css"/>
        <script src="../js/codigojs.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="dialogo" title="Crear Usuario">
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
        <form action="controlador.php">
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
                    <td><label>Nombre</label></td>
                    <td><input type="text" name="nombre"></td>
                </tr>
                <tr>
                    <td><label>Apellidos</label></td>
                    <td><input type="text" name="apellidos"></td>
                </tr>
                <tr>
                    <td><label>Correo electrónico</label></td>
                    <td><input type="text" name="correo"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="accion" value="Crear Usuario"/></td>
                </tr>
            </table>
        </form>
        </div>
    </body>
</html>
