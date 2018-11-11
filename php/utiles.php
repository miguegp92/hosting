<?php
session_start();

require_once 'conectarBD.php';

define("DIR_BASE", "../usuarios");

function identificar($user, $password) {
    $conexion = conectar();

    $sentencia = "SELECT * FROM HOSTING.USUARIOS WHERE LOGIN='$user' AND PASSWORD='$password'";
    //Ejecutamos la consulta
    $cursor = mysqli_query($conexion, $sentencia);
    if (mysqli_num_rows($cursor) > 0) {
        //recuperamos la primera fila
        $tupla = mysqli_fetch_array($cursor);
        $ok = true;
    } else {
        $ok = false;
    }
    //liberamos los recursos
    mysqli_free_result($cursor);
    mysqli_close($conexion);
    return $ok;
}

function registrar($user, $password, $nombre, $apellidos, $correo) {
    crearUsuario($user, $password);
    $conexion = conectar();
    $sentencia = "INSERT INTO HOSTING.USUARIOS (LOGIN, PASSWORD, NOMBRE, APELLIDOS, CORREO)" .
            " VALUES ('$user','$password','$nombre','$apellidos','$correo')";

    //ejecutamos la consulta en la base de datos
    mysqli_query($conexion, $sentencia);

    //si hay filas afectadas
    if (mysqli_affected_rows($conexion) > 0) {
        //
        $ok = true;
    } else {
        $ok = false;
    }
    mysqli_close($conexion);

    return $ok;
}

function datosUsuario($usuario) {
    $conexion = conectar();
    $consulta = "SELECT * FROM HOSTING.USUARIOS WHERE LOGIN='$usuario'";
    $result = mysqli_query($conexion, $consulta);
    $tupla = mysqli_fetch_array($result);

    while ($tupla) {
        ?>
        <tr>
            <td><label>Usuario</label></td>
            <td><input type="text" name="usuario" value="<?php echo $tupla["Login"] ?>"/></td>
        </tr>
        <tr>
            <td><label>Contraseña</label></td>
            <td><input type="text" name="clave" value="<?php echo $tupla["Password"] ?>"/></td>
        </tr>
        <tr>
            <td><label>Nombre</label></td>
            <td><input type="text" name="nombre" value="<?php echo $tupla["Nombre"] ?>"/></td>
        </tr>
        <tr>
            <td><label>Apellidos</label></td>
            <td><input type="text" name="apellidos" value="<?php echo $tupla["Apellidos"] ?>"/></td>
        </tr>
        <tr>
            <td><label>Correo electrónico</label></td>
            <td><input type="text" name="correo" value="<?php echo $tupla["Correo"] ?>"/></td>
        </tr>
        <?php
        $tupla = mysqli_fetch_array($result);
    }
    mysqli_free_result($result);
    mysqli_close($conexion);
}

function actualizarUsuario($user, $password, $nombre, $apellidos, $correo, $usuario) {
    $conexion = conectar();
    $sentencia = "UPDATE HOSTING.USUARIOS SET LOGIN='$user', PASSWORD='$password', NOMBRE='$nombre', APELLIDOS='$apellidos', CORREO='$correo' "
            . "WHERE LOGIN='$usuario'";
    mysqli_query($conexion, $sentencia);
}

//Archivos
function mostrarArchivos($ruta) {

    if (is_dir($ruta)) {
        $directorio = opendir($ruta);
        $entrada = readdir($directorio);

        while ($entrada != NULL) {
            if ($entrada != "." && $entrada != "..") {
                if (is_dir(realpath($ruta . "/" . $entrada))) {
                    $clase = "carpeta";
                }
                if (is_dir(realpath($ruta . "/" . $entrada))) {
                    ?>                            

                    <li class="<?php echo $clase ?>">  
                        <input type="checkbox"  value="<?php echo $entrada ?>" name="casilla[]"/>
                        <a href="administracion.php?ruta=<?php echo $ruta . "/" . $entrada ?>">
                            <img src="../css/imagenes/<?php echo $clase ?>.png" />
                            <?php echo $entrada ?>
                        </a>
                        <form action="controlador.php">
                            <input type="button" class="idNombre" value="Cambiar Nombre" />        
                        <input type="hidden" name="rutaAbs" value="<?php echo $ruta ?>" />   
                        <input type="hidden" name="rutaArchivo" value="<?php echo $ruta . "/" . $entrada ?>" /> 
                        
                        <input type="text" class="cambiarNombre" name="nombreArchivo" value="<?php echo $entrada ?>" />
                        <input type="submit" name="accion" class="cambiarNombre" value="Guardar" />  
                        </form>
                    </li>

                    <?php
                } else {
                    $clase = "archivo";
                    ?>

                    <li class="<?php echo $clase ?>">
                        <input type="checkbox" name="casilla[]" value="<?php echo $entrada ?>" />
                        <a href="controlador.php?accion=mostrar&ruta=<?php echo $ruta ?>&archivo=<?php echo $entrada ?>">
                            <img src="../css/imagenes/<?php echo $clase ?>.png" />
                            <?php echo $entrada ?>
                        </a>
                        <form action="controlador.php">
                            <input type="button" class="idNombre" value="Cambiar Nombre" />        
                        <input type="hidden" name="rutaAbs" value="<?php echo $ruta ?>" />   
                        <input type="hidden" name="rutaArchivo" value="<?php echo $ruta . "/" . $entrada ?>" /> 
                        
                        <input type="text" class="cambiarNombre" name="nombreArchivo" value="<?php echo $entrada ?>" />
                        <input type="submit" name="accion" class="cambiarNombre" value="Guardar" />  
                        </form>
                    </li>

                    <?php
                }
            }
            $entrada = readdir($directorio);
        }
    }
}

function subirArchivo($ruta) {
    $target_path = $ruta . "/";
    $target_path = $target_path . basename($_FILES['uploadedfile']['name']);
    if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
        echo "El archivo " . basename($_FILES['uploadedfile']['name']) . " ha sido subido";
    } else {
        echo "Ha ocurrido un error en la subida del fichero";
    }
}

function guardarTarea($descripcion, $contenido, $ruta) {


    $nombre = "$ruta/$descripcion";

    guardarFichero($nombre, $contenido);
}

function guardarFichero($ruta, $contenido) {
    $fichero = fopen($ruta, "w");
    if ($fichero) {

        fwrite($fichero, $contenido);

        fclose($fichero);
    }
}

function mostrarArchivo($ruta, $archivo) {
    $ruta = $ruta . "/" . $archivo;
    $fichero = fopen($ruta, "r");
    if ($fichero != NULL) {
        while (!feof($fichero)) {
            $contenido = $contenido . fgets($fichero);
        }
    }

    return $contenido;
}

function crearUsuario($usuario, $clave) {
    $user = md5($usuario);
    $password = md5($clave);
    $ruta = (DIR_BASE . "/usuarios.ini");
    echo $ruta;

    $contenido = $user . "=" . $password;

    guardarFicheroIni($ruta, "\n");
    guardarFicheroIni($ruta, $contenido);
}

function guardarFicheroIni($ruta, $contenido) {
    $fichero = fopen($ruta, "a+");
    if ($fichero) {

        fwrite($fichero, $contenido);

        fclose($fichero);
    }
}

function borrarOpciones($opciones, $ruta) {
    foreach ($opciones as $opcion) {
        borrar($opcion, $ruta);
        //echo $ruta . "/" . $opcion;
    }
}

function borrar($opcion, $ruta) {


    //echo $opcion;
    if (is_file(realpath($ruta . "/" . $opcion))) {
        unlink($ruta . "/" . $opcion);
    } else {
        $archivos = scandir($ruta . "/" . $opcion);
        foreach ($archivos as  $archivo) {
            if ($archivo != "." && $archivo != "..") {
                unlink($ruta . "/" . $opcion . "/" . $archivo);
                rmdir($ruta . "/" . $opcion . "/" . $archivo);
            }
        }
        rmdir($ruta . "/" . $opcion);
    }
}

function pegarOpciones($opciones, $rutaOrigen, $rutaDestino) {
    foreach ($opciones as $opcion) {
        if (is_dir($rutaOrigen . "/" . $opcion)) {
            copy($rutaOrigen . "/" . $opcion, $rutaDestino . "/" . $opcion);
        } elseif (is_file($rutaOrigen . "/" . $opcion)) {
            copy($rutaOrigen . "/" . $opcion, $rutaDestino . "/" . $opcion);
        }
    }
}

function moverOpciones($opciones, $rutaOrigen, $rutaDestino) {
    foreach ($opciones as $opcion) {
        if (is_dir($rutaOrigen . "/" . $opcion)) {
            rename($rutaOrigen . "/" . $opcion, $rutaDestino . "/" . $opcion);
        } elseif (is_file($rutaOrigen . "/" . $opcion)) {
            rename($rutaOrigen . "/" . $opcion, $rutaDestino . "/" . $opcion);
        }
    }
}

function comprobarOpciones($opciones, $ruta) {

    foreach ($opciones as $opcion) {
        if (is_dir($ruta . "/" . $opcion)) {
            echo "<p>" . $ruta . "/" . $opcion . " es una carpeta </p>";
        } elseif (is_file($ruta . "/" . $opcion)) {
            echo "<p>" . $ruta . "/" . $opcion . " es un archivo </p>";
        }
    }
}

function descargar($archivos, $ruta) {
    
    $nombre = 'archivos.zip';
    
    foreach ($archivos as $archivo) {
        $fichero = $ruta."/".$archivo;
        if (is_file($fichero)) {
            comprimir($fichero, $nombre);
        }
    }
    
    header("Content-type: application/zip");
    header("Content-Disposition: attachment; filename=$nombre");
    header("Content-Transfer-Encoding: binary");
    readfile($nombre);
    
}

function  comprimir($fichero, $nombre) {
    $zip = new ZipArchive();
    
    if ($zip->open($nombre, ZIPARCHIVE::CREATE) === true) {
        $zip->addFile($fichero);
    }
}
