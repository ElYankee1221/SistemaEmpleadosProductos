<?php
//empleados_lista.php

require "funciones/conecta.php";
$con = conecta();

$sql = "SELECT *
        FROM empleados
        WHERE eliminado = 0";
$res = $con->query($sql);
$num = $res->num_rows;

// while ($row = $res->fetch_array()) {
//     $id         = $row["id"];
//     $nombre     = $row["nombre"];
//     $apellidos  = $row["apellidos"];
//     echo "$id $nombre $apellidos";
//     echo "<br>";
// }

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/global.css">
		<link rel="stylesheet" href="css/style_empleados_lista.css">
    
		<title>Lista de Empleados</title>	
		
	</head>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script>
		function eliminar(idParaEliminar) {
			// $('#mensaje').html('Si jala');

			if (confirm("Seguro que deseas eliminar a este empleado?")) {
				// $('#mensaje').html('Si lo quiere eliminar');

				var id = idParaEliminar;

				// console.log(id);

				$.ajax({
                    url     : 'empleados_elimina.php',
                    type    : 'post',
                    dataType: 'text',
                    data    : 'id='+id,
                    success : function(res) {
                    //Recibe respuesta (res)
                        if (res == 1) {
                            $('#mensaje').html('El empleado '+id+' ya no existe.');
                            $('#'+id).remove();
							setTimeout("$('#mensaje').html('');",5000);

							var contador = $('#contador');
							var totalActual = parseInt(contador.text());
							var nuevoTotal = totalActual - 1;
							$('#contador').text(nuevoTotal);
							//contador.text(nuevoTotal);
                        } else {
							$('#mensaje').html('Hubo un erro en la eliminacion.');
						}
                    },error: function() {
                        alert('Error archivo no encontrado...');
                    }
                });

			} 
			// else {
			// 	$('#mensaje').html('No lo quiere eliminar');
			// }

		}
	</script>
	<body>
		<?php 
            include('menu.php');         
        ?>
        
		<h1>Lista de empleados (<span id="contador"><?php echo $num; ?></span>)</h1>

		<div class="crearRegistro">
			<a  href="empleados_alta.php">←Crear nuevo registro.</a>
		</div>
		<section class="centro">
			<div class="padreTabla">
				<table class="tabla">
					<tr class="encabezado">
						<th>Id</th>
						<th>Nombre Completo</th>
						<th>Correo</th>
						<th>Rol</th>
						<th>Ver Detalle</th>
						<th>Editar</th>
						<th>Eliminar</th>
						
					</tr>
					<?php
						while ($row = $res->fetch_array()) {
							$id         = $row["id"];
							$nombre     = $row["nombre"];
							$apellidos  = $row["apellidos"];
							$correo	    = $row["correo"];
							$numerorol  = $row["rol"];
	
							$rol = ($numerorol == 1) ? "Gerente" : "Ejecutivo";
	
							echo "<tr id=\"$id\" class=\"filaEmpleado\">";
							echo "<td>$id</td>";
							echo "<td>$nombre $apellidos</td>";
							echo "<td>$correo</td>";
							echo "<td>$rol</td>";
							echo "<td><a href=\"empleados_detalle.php?id=$id\">VER</a></td>";
							echo "<td><a href=\"empleados_edita.php?id=$id\">EDITAR</a></td>";
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