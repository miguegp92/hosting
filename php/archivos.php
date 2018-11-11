<?php
session_start();
require_once 'utiles.php';

$usuario = $_SESSION["usuario"];

if (!isset($_REQUEST["ruta"])) {
    $ruta = "../usuarios/" . $usuario;
} else {
    $ruta = $_REQUEST["ruta"];
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Administración del sitio</title>
        <link href="../js/<?php echo $_SESSION["estilos"] ?>/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="../js/<?php echo $_SESSION["estilos"] ?>/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
        <script src="../js/<?php echo $_SESSION["estilos"] ?>/jquery.js" type="text/javascript"></script>
        <script src="../js/<?php echo $_SESSION["estilos"] ?>/jquery-ui.js" type="text/javascript"></script>
        <link href="../css/<?php echo $_SESSION["estilos"] ?>/estilos.css" rel="stylesheet" type="text/css"/>
        <script src="../js/codigojs.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="cabecera">
            <div id="perfil">
                <form action="controlador.php">
                    <select id="listaTemas" name="style">
                        <option value="azul">Azul</option>
                        <option value="dark">Oscuro</option>
                        <option value="rojo">Rojo</option>
                        <option value="verde">Verde</option>
                    </select>
                    <input type="submit" name="accion" value="Cambiar Estilo" id="cambiarEstilo"/>
                    <input type="submit" name="accion" value="Mi Perfil" id="miPerfil"/>
                    <input type="submit" name="accion" value="Cerrar Sesion" id="cerrarSesion"/>

                </form>
            </div>
            <div id="nombre">
                <h1>Sitio Personal de: <?php echo $_SESSION["usuario"] ?></h1>  
            </div> 

        </div>
        <div id="contenido">
        <form action="controlador.php">
            <p><textarea name="contenido" cols="40" rows="20"><?php
                                $contenido = mostrarArchivo($_REQUEST["ruta"], $_REQUEST["archivo"]);
                                echo $contenido;
                                ?></textarea></p>
            <p><input type="text" name="nombre" value="<?php echo $_REQUEST["archivo"]?>"/></p>
            <input type="submit" name="accion" value="Guardar Fichero"/>
            <input type="text" name="ruta" value="<?php echo $_REQUEST["ruta"]?>"/>
        </form>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
