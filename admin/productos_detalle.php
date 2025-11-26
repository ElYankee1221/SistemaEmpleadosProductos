<?php
//productos_detalle.php

    include('menu.php');
    require "funciones/conecta.php";
    $con = conecta();
    $id = $_REQUEST['id'];

    $sql = "SELECT *
        FROM productos
        WHERE eliminado = 0 AND id = $id";

    $res = $con->query($sql);

    $row = $res->fetch_array();

	$nombre     = $row["nombre"];
	$codigo     = $row["codigo"];
	$descripcion= $row["descripcion"];
	$costo      = $row["costo"];
	$stock      = $row["stock"];
    $numestatus = $row["eliminado"];
    $imagen     = $row["imagen"];

    $estatus = ($numestatus == 1) ? "Inactivo" : "Activo";    
    
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/style_empleados_detalle.css">  
        
        <title>Detalle de productos</title>

    </head>
    <script>
            
    </script>
    <body>         

        <h1>Detalle del producto <?php echo($id); ?></h1>

        <div class="regresar">
            <a href="productos_lista.php">← Regresar al listado</a>
        </div>

        <div class="detalle-container">

            <div class="detalle-card">
                
                <div class="detalle-foto">
                    <img src="archivos/<?php echo $imagen ?>" alt="Foto de perfil">
                </div>

                <div class="detalle-info">
                    
                    <h2><?php echo $nombre; ?></h2>
                    
                    <p class="puesto"><?php echo $id; ?></p>

                    <p>
                        <strong>Codigo del Producto:</strong>
                        <?php echo $codigo; ?>
                    </p>
                    
                    <p>
                        <strong>Descripcion:</strong>
                        <?php echo $descripcion; ?>
                    </p>
                    
                    <p>
                        <strong>Costo:</strong>
                        <?php echo "\$$costo"; ?>
                    </p>
                    
                    <p>
                        <strong>Stock:</strong>
                        <?php echo $stock; ?>
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
