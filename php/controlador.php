<?php

require_once 'utiles.php';

if (isset($_REQUEST["accion"])) {

    $accion = $_REQUEST["accion"];
    $accion = strtolower($accion);
    $accion = str_replace(" ", "", $accion);
    switch ($accion) {
        case "entrar":
            $user = $_REQUEST["usuario"];
            $password = $_REQUEST["clave"];
            echo $user;
            echo $password;
            $ok = identificar($user, $password);
            if ($ok) {
                $_SESSION["usuario"] = $_REQUEST["usuario"];
                header("Location: administracion.php");
            } else {
                $_SESSION["mensaje"] = "Usuario incorrecto";
                header("Location: ../index.php");
            }
            break;
        case "registrarse":
            header("Location: crearUsuario.php");
            break;
        case "crearusuario":
            
            $user = $_REQUEST["usuario"];
            $password = $_REQUEST["clave"];
            $nombre = $_REQUEST["nombre"];
            $apellidos = $_REQUEST["apellidos"];
            $correo = $_REQUEST["correo"];
            
             
            $ok = registrar($user, $password, $nombre, $apellidos, $correo);
            if ($ok) {
                
                mkdir(DIR_BASE . "/" . $user);
                $_SESSION["mensaje"] = "El usuario ha sido registrado";
                
            } else {
                $_SESSION["mensaje"] = "El usuario no ha sido registrado";
            }
            header("Location: ../index.php");
            break;
        case "cerrarsesion": 
            unset($_SESSION["usuario"]);
            unset($_SESSION["style"]);
            header("Location: ../index.php");
            break;
        case "cambiarestilo":
            $_SESSION["estilos"]=$_REQUEST["style"];
            $ruta = $_REQUEST["ruta"];
            header("Location: administracion.php?ruta=".$ruta);
            break;
        case "nuevacarpeta":
            $ruta = $_REQUEST["ruta"];
            $nombre = $_REQUEST["nombre"];
            mkdir ($ruta."/".$nombre);
            header("Location: administracion.php?ruta=".$ruta);
            break;
        case "nuevofichero":
            $ruta = $_REQUEST["ruta"];
            $nombre = $_REQUEST["nombre"];
            header("Location: archivos.php?ruta=$ruta&archivo=$nombre");
            break;
       case "mostrar":
            $ruta = $_REQUEST["ruta"];
            $archivo = $_REQUEST["archivo"];
            
            header("Location: archivos.php?ruta=$ruta&archivo=$archivo");
            break;
        case "miperfil":
            $usuario=$_SESSION["usuario"];
            header("Location: Perfil.php?usuario=$usuario");
            break;
        case "actualizar":
            $usuario = $_SESSION["usuario"];
            $user = $_REQUEST["usuario"];
            $password = $_REQUEST["clave"];
            $nombre = $_REQUEST["nombre"];
            $apellidos = $_REQUEST["apellidos"];
            $correo = $_REQUEST["correo"];
            actualizarUsuario($user, $password, $nombre, $apellidos, $correo, $usuario);
            header("Location: administracion.php?ruta=".$ruta);
            break;
        case "cancelar":
            header("Location: administracion.php");
            break;
        case "volver":
            $ruta = $_REQUEST["ruta"];
            header("Location: administracion.php?ruta=".dirname($ruta));
            break;
        case "subir":
            $ruta = $_REQUEST["ruta"];
            subirArchivo($ruta);
            header("Location: administracion.php?ruta=".$ruta);
            break;
        case "guardarfichero":
            $descripcion=$_REQUEST["nombre"];
            $contenido=$_REQUEST["contenido"];
            $ruta=$_REQUEST["ruta"];
            echo $ruta;
            echo $nombre;
            echo $contenido;
            guardarTarea($descripcion, $contenido, $ruta);
            header("Location: administracion.php?ruta=".$ruta);
            break;
        case "borrar":
            $opciones=$_REQUEST["casilla"];
            $ruta=$_REQUEST["ruta"];
            borrarOpciones($opciones, $ruta);
            header("Location: administracion.php?ruta=".$ruta);
            break;
        case "copiar":
            $_SESSION["opciones"]=$_REQUEST["casilla"];
            $_SESSION["rutaOrigen"]=$_REQUEST["ruta"];
            $ruta=$_REQUEST["ruta"];
           header("Location: administracion.php?ruta=".$ruta);
            break;
        case "pegar":
            $opciones=$_SESSION["opciones"];
            $rutaOrigen=$_SESSION["rutaOrigen"];
            $rutaDestino=$_REQUEST["ruta"];
            pegarOpciones($opciones, $rutaOrigen, $rutaDestino);
            //unset($_SESSION["opciones"]);
            //unset($_SESSION["rutaOrigen"]);
            header("Location: administracion.php?ruta=".$rutaDestino);
            break;
        case "mover":
           $opciones=$_SESSION["opciones"];
            $rutaOrigen=$_SESSION["rutaOrigen"];
            $rutaDestino=$_REQUEST["ruta"];
            moverOpciones($opciones, $rutaOrigen, $rutaDestino);
           header("Location: administracion.php?ruta=".$rutaDestino);
            
            break;
        case "guardar":
            $ruta=$_REQUEST["rutaAbs"];
            $nuevonombre=$_REQUEST["nombreArchivo"];
            $rutaantigua=$_REQUEST["rutaArchivo"];
            rename($rutaantigua, $ruta."/".$nuevonombre) ;
            header("Location: administracion.php?ruta=".$ruta);
            break; 
        case "descargar":
            $ruta = $_REQUEST["ruta"];
            $archivos = $_REQUEST["casilla"];
            descargar($archivos, $ruta);
            
    }
}

 