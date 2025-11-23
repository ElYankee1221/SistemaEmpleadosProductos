<?php
    //empleados_salva.php
    require "funciones/conecta.php";
    $con = conecta();

    //Cahcar los datos enviados por el formulario
    $nombre     = $_REQUEST['nombre'];
    $apellidos  = $_REQUEST['apellidos'];
    $correo     = $_REQUEST['correo'];
    $pass       = $_REQUEST['pass'];
    $rol        = $_REQUEST['rol'];
    $passEnc    = md5 ($pass);
    $imagen     ='';

    //Cachar variables 
    $nombre_real        = $_FILES['archivo']['name'];
    $archivo_temporal   = $_FILES['archivo']['tmp_name'];

    //Obtener extension
    $arreglo    = explode(".", $nombre_real);
    $len        = count($arreglo);
    $pos        = $len -1;
    $extension  = $arreglo[$pos];

    //Carpeta para guardar archivos
    $carpeta = "archivos/";

    //Obtener nombre
    $encriptado     = md5_file($archivo_temporal);
    $nuevo_nombre   = "$encriptado.$extension";

    copy($archivo_temporal, $carpeta.$nuevo_nombre); 

    $imagen = $nuevo_nombre;

    $sql = "INSERT INTO empleados
            (nombre, apellidos, correo, pass, rol, imagen)
            VALUES ('$nombre', '$apellidos', '$correo', '$passEnc', $rol, '$imagen')";
    $res = $con->query($sql);

    header ("Location: empleados_lista.php");

    exit;
?>