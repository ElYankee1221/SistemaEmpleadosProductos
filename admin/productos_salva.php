<?php
    //productos_salva.php
    require "funciones/conecta.php";
    $con = conecta();

    //Cachar los datos enviados por el formulario
    $nombre     = $_REQUEST['nombre'];
    $codigo     = $_REQUEST['codigo'];
    $descripcion= $_REQUEST['descripcion'];
    $costo      = $_REQUEST['costo'];
    $stock      = $_REQUEST['stock'];
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

    $sql = "INSERT INTO productos
            (nombre, codigo, descripcion, costo, stock, imagen)
            VALUES ('$nombre', '$codigo', '$descripcion', $costo, $stock, '$imagen')";
    $res = $con->query($sql);

    header ("Location: productos_lista.php");

    exit;
?>