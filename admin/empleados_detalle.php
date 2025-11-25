<?php
//empleados_detalle.php

    include('menu.php');
    require "funciones/conecta.php";
    $con = conecta();
    $id = $_REQUEST['id'];

    $sql = "SELECT *
        FROM empleados
        WHERE eliminado = 0 AND id = $id";

    $res = $con->query($sql);

    $row = $res->fetch_array();

	$nombre     = $row["nombre"];
	$apellidos  = $row["apellidos"];
	$correo	    = $row["correo"];
	$numerorol  = $row["rol"];
    $numestatus = $row["eliminado"];
    $imagen     = $row["imagen"];

    $rol = ($numerorol == 1) ? "Gerente" : "Ejecutivo";
    $estatus = ($numestatus == 1) ? "Inactivo" : "Activo";    
    
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/style_empleados_detalle.css">  
        
        <title>Detalle de empleados</title>

    </head>
    <script>
            
    </script>
    <body>         

        <h1>Detalle del empleado <?php echo($id); ?></h1>

        <div class="regresar">
            <a href="empleados_lista.php">← Regresar al listado</a>
        </div>

        <div class="detalle-container">

            <div class="detalle-card">
                
                <div class="detalle-foto">
                    <img src="archivos/<?php echo $imagen ?>" alt="Foto de perfil">
                </div>

                <div class="detalle-info">
                    
                    <h2><?php echo $nombre . ' ' . $apellidos; ?></h2>
                    
                    <p class="puesto"><?php echo $rol; ?></p>

                    <p>
                        <strong>ID de Empleado:</strong>
                        <?php echo $id; ?>
                    </p>
                    
                    <p>
                        <strong>Correo Electrónico:</strong>
                        <?php echo $correo; ?>
                    </p>
                    
                    <p>
                        <strong>Estatus:</strong>
                        <?php echo $estatus; ?>
                    </p>

                </div>

            </div>
        </div>


    </body>
</html>
