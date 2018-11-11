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
                    <input type="hidden" name="ruta" value="<?php echo $ruta ?>" />
                </form>
            </div>
            <div id="nombre">
                <h1>Sitio Personal de: <?php echo $_SESSION["usuario"] ?></h1>  
            </div> 

        </div>
        <div id="ruta">
            <?php
            echo "<p>Estas en la carpeta: " . basename($ruta) . "</p>";
            ?>
            <form action="controlador.php">
                <div>
                    <input type="text" name="nombre"/>
                    <input type="submit" name="accion" value="Nueva Carpeta" class="boton"/>
                    <input type="submit" name="accion" value="Nuevo fichero" class="boton"/>
                    <input type="button" id="subir" value="Subir Fichero" class="boton"/>
                </div>
                <input type="hidden" name="ruta" value="<?php echo $ruta ?>" />

            </form>
            <form id="subida" enctype="multipart/form-data" action="controlador.php?ruta=<?php echo $ruta ?>" method="POST">
                <input name="uploadedfile" type="file" />
                <input type="submit" name="accion" value="Subir" />
            </form>

        </div>


        <div id="contenido">
            <form action="controlador.php">
                <div id="botones">
                    <input type="submit" name="accion" value="Mover" />
                    <input type="submit" name="accion" value="Copiar"/>
                    <input type="submit" name="accion" value="Pegar" />
                    <input type="submit" name="accion" value="Borrar" />
                   
                    <input type="submit" name="accion" value="Descargar"  />
                </div>
               
                <input type="submit" name="accion" value="Volver"/>
                <input type="hidden" name="ruta" value="<?php echo $ruta ?>" />
                <ul> 

                    <?php
                    mostrarArchivos($ruta);
                    ?>

                </ul>

            </form>

        </div>


    </body>
</html>
