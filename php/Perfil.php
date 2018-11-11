<?php
require_once 'utiles.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mi Perfil</title>
        <link href="../js/<?php echo $_SESSION["estilos"] ?>/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="../js/<?php echo $_SESSION["estilos"] ?>/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
        <script src="../js/<?php echo $_SESSION["estilos"] ?>/jquery.js" type="text/javascript"></script>
        <script src="../js/<?php echo $_SESSION["estilos"] ?>/jquery-ui.js" type="text/javascript"></script>
        <link href="../css/<?php echo $_SESSION["estilos"] ?>/estilos.css" rel="stylesheet" type="text/css"/>
        <script src="../js/codigojs.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="dialogo" title="Mi Perfil">
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
                <?php
                datosUsuario($_REQUEST["usuario"]);
                ?>
                <tr>
                    <td><input type="submit" name="accion" value="Actualizar"/></td>
                    <td><input type="submit" name="accion" value="Cancelar"/></td>
                </tr>
            </table>
        </form>
        </div>
    </body>
</html>
