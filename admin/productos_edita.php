<?php
//empleados_edita.php

     
    include('menu.php');      

    require "funciones/conecta.php";
    $con = conecta();
    $id = $_REQUEST['id'];

    $sql = "SELECT *
            FROM productos
            WHERE eliminado = 0 AND id = $id";

    $res = $con->query($sql);

    $row = $res->fetch_array();
	$id         = $row["id"];
	$nombre     = $row["nombre"];
	$codigo     = $row["codigo"];
	$descripcion= $row["descripcion"];
	$costo      = $row["costo"];
	$stock      = $row["stock"];
    $numestatus = $row["eliminado"];

?>

<html>
    <head>

        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/style_empleados_edita.css">

        <title>Editar Productos</title>
        <style>
            #mensaje {
                font-size: 15px;
                color: red;
            }
        </style>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
            
            function validar() {
                var nombre      = $('#nombre').val();
                var codigo      = $('#codigo').val();
                var descripcion = $('#descripcion').val();
                var costo       = $('#costo').val();
                var stock       = $('#stock').val();

                if (nombre == '' || codigo == ''|| descripcion == '' || costo == '' || stock == '') {
                    $('#mensaje').html('Faltan campos por llenar.');
                    setTimeout("$('#mensaje').html('');", 5000);
                }
                else {
                    document.Forma01.submit();
                }
            }
            
            function sale() {
                // $('#mensaje').html('Salio del campo');

                var codigoId = '<?php echo $codigo; ?>';
                var codigo = $('#codigo').val();

                if (codigo != codigoId) {                   
                    $.ajax({
                        url     : 'valida_codigo.php',
                        type    : 'post',
                        dataType: 'text',
                        data    : 'codigo='+codigo,
                        success : function(res) {
                        //Recibe respuesta (res)
                            if (res != 0) {
                                $('#mensaje_correo').html('El codigo '+codigo+' ya existe.');
                                $('#codigo').val('');
                                setTimeout("$('#mensaje_correo').html('');", 5000);
                            }
                        },error: function() {
                            alert('Error archivo no encontrado...');
                        }
                    });
                }
            }

        </script>
    </head>
    <body>
        
        <h1>Editar productos</h1>
        
        <div class="regresar">
            <a href="productos_lista.php">← Regresar al listado</a>
        </div>

        <div class="form-container">
            
            <div class="form-card">
                <div id="mensaje"></div>
                <form name="Forma01" method="post" action="productos_actualiza.php" enctype="multipart/form-data">
                    
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>"/>
                    
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre ?>"/>
                    </div>

                    <div class="form-group">
                        <label>Codigo:</label>
                        <input type="text" name="codigo" id="codigo" placeholder="Codigo" value="<?php echo $codigo ?>" onBlur="sale();"/>
                        <div id="mensaje_correo"></div>
                    </div>
                    
                    <div class="form-group">
                        <label>Descripcion:</label>
                        <textarea name="descripcion" id="descripcion" placeholder="Descripcion" ><?php echo $descripcion?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Costo:</label>
                        <input type="number" name="costo" id="costo" placeholder="Costo" value="<?php echo $costo?>"/>
                    </div>

                    <div class="form-group">
                        <label>Stock:</label>
                        <input type="number" name="stock" id="stock" placeholder="Stock" value="<?php echo $stock ?>"/>
                    </div>

                    <div class="form-group">
                        <label>Imagen (Opcional):</label>
                        <input type="file" id="archivo" name="archivo">
                    </div>

                    <input onclick="validar(); return false;" type="submit" value="Actualizar Producto" class="btn-submit" />
                    
                    

                </form>
            </div>
        </div>
    </body>
</html>