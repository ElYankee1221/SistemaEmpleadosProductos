<?php
//productos_lista.php

require "funciones/conecta.php";
$con = conecta();

$sql = "SELECT *
        FROM productos
        WHERE eliminado = 0";
$res = $con->query($sql);
$num = $res->num_rows;

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/global.css">
		<link rel="stylesheet" href="css/style_empleados_lista.css">
    
		<title>Lista de Productos</title>	
		
	</head>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script>
		function eliminar(idParaEliminar) {

			if (confirm("Seguro que deseas eliminar a este producto?")) {

				var id = idParaEliminar;

				$.ajax({
                    url     : 'productos_elimina.php',
                    type    : 'post',
                    dataType: 'text',
                    data    : 'id='+id,
                    success : function(res) {
                    //Recibe respuesta (res)
                        if (res == 1) {
                            $('#mensaje').html('El producto '+id+' ya no existe.');
                            $('#'+id).remove();
							setTimeout("$('#mensaje').html('');",5000);

							var contador = $('#contador');
							var totalActual = parseInt(contador.text());
							var nuevoTotal = totalActual - 1;
							$('#contador').text(nuevoTotal);
                        } else {
							$('#mensaje').html('Hubo un erro en la eliminacion.');
						}
                    },error: function() {
                        alert('Error archivo no encontrado...');
                    }
                });
			} 

		}
	</script>
	<body>
		<?php 
            include('menu.php');         
        ?>
        
		<h1>Lista de productos (<span id="contador"><?php echo $num; ?></span>)</h1>

		<div class="crearRegistro">
			<a  href="productos_alta.php">←Crear nuevo registro.</a>
		</div>
		<section class="centro">
			<div class="padreTabla">
				<table class="tabla">
					<tr class="encabezado">
						<th>Id</th>
						<th>Nombre</th>
						<th>Codigo</th>
						<th>Costo</th>
						<th>Stock</th>
						<th>Ver Detalle</th>
						<th>Editar</th>
						<th>Eliminar</th>
						
					</tr>
					<?php
						while ($row = $res->fetch_array()) {
							$id         = $row["id"];
							$nombre     = $row["nombre"];
							$codigo     = $row["codigo"];
							$costo      = $row["costo"];
							$stock      = $row["stock"];
	
							echo "<tr id=\"$id\" class=\"filaEmpleado\">";
							echo "<td>$id</td>";
							echo "<td>$nombre</td>";
							echo "<td>$codigo</td>";
							echo "<td>\$$costo</td>";
							echo "<td>$stock</td>";
							echo "<td><a href=\"productos_detalle.php?id=$id\">VER</a></td>";
							echo "<td><a href=\"productos_edita.php?id=$id\">EDITAR</a></td>";
							echo "<td><a href=\"#\" class=\"eliminar\" onclick=\"eliminar($id);\">ELIMINAR</a></td>";
							echo "</tr>";
						}
					?>
				</table>

				<div id="mensaje"></div>
			</div>
		</section>
	</body>
</html>