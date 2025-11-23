<?php
    //empleados_actualiza.php
    require "funciones/conecta.php";
    $con = conecta();
    $id = $_REQUEST['id'];

    //Cahcar los datos enviados por el formulario
    $nombre     = $_REQUEST['nombre'];
    $apellidos  = $_REQUEST['apellidos'];
    $correo     = $_REQUEST['correo'];
    $pass       = $_REQUEST['pass'];
    $rol        = $_REQUEST['rol'];

    $sql = "UPDATE empleados SET 
            nombre = ?, 
            apellidos = ?, 
            correo = ?, 
            rol = ? ";

    $types = "sssi"; 
    $params = [$nombre, $apellidos, $correo, $rol];


    if (!empty($pass)) {
        $passEnc = md5 ($pass);

        $sql .= ", pass = ? "; 
        $types .= "s";         
        $params[] = $passEnc;  
    }

    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        //Cachar variables 
        $archivo_temporal = $_FILES['archivo']['tmp_name'];
        $nombre_real      = $_FILES['archivo']['name'];
        
        //Obtener extension
        $arreglo    = explode(".", $nombre_real);
        $len        = count($arreglo);
        $pos        = $len -1;
        $extension  = $arreglo[$pos];

        //Carpeta para guardar archivos
        $carpeta = "archivos/";

        //Obtener nombre
        $encriptado   = md5_file($archivo_temporal);
        $nuevo_nombre = "$encriptado.$extension";
        
        //Guardar archivo
        copy($archivo_temporal, $carpeta.$nuevo_nombre); 

        //Asignar nuevo nombre
        $imagen = $nuevo_nombre;

        $sql .= ", imagen = ? "; 
        $types .= "s";           
        $params[] = $nuevo_nombre;

    }

    $sql .= " WHERE id = ?"; 
    $types .= "i";           
    $params[] = $id;

    $stmt = $con->prepare($sql);
    $stmt->bind_param($types, ...$params);

    $stmt->execute();

    $stmt->close();
    $con->close();

    header ("Location: empleados_lista.php");

    exit;
?>