<!DOCTYPE html>
<html lang="es">
    <head>

        <meta charset="utf-8">
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/style_empleados_edita.css">

        <title>Formularios</title>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
            
            function validar() {
                var nombre      = $('#nombre').val();
                var codigo      = $('#codigo').val();
                var descripcion = $('#descripcion').val();
                var costo       = $('#costo').val();
                var stock       = $('#stock').val();
                var archivo     = $('#archivo').val();
                
                if (nombre == '' || codigo == '' || descripcion == '' || costo == '' || stock == '' || archivo == '') {
                    $('#mensaje').html('Faltan campos por llenar.');
                    setTimeout("$('#mensaje').html('');",5000);
                }
                else {
                    document.Forma01.submit();
                }
            }

            function sale() {
                
                var codigo = $('#codigo').val();
                
                if (codigo != '') {                  
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
                                setTimeout("$('#mensaje_correo').html('');",5000);
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
        <?php 
            include('menu.php');         
        ?>
        
        <h1>Alta de productos</h1>

        <div class="regresar">
            <a href="productos_lista.php">← Regresar al listado</a>
        </div>
        
        <div class="form-container">
            <div class="form-card">
                <div id="mensaje"></div>
                <form name="Forma01" method="post" action="productos_salva.php" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre" />
                    </div>

                    <div class="form-group">
                        <label>Codigo:</label>
                        <input type="text" name="codigo" id="codigo" placeholder="Codigo" onBlur="sale();"/>
                        <div id="mensaje_correo"></div>
                    </div>

                    <div class="form-group">
                        <label>Descripcion:</label>
                        <textarea autocapitalize="sentences" maxlength="500" name="descripcion" id="descripcion" placeholder="Descripcion"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Costo:</label>
                        <input type="number" name="costo" id="costo" placeholder="Costo" />
                    </div>

                    <div class="form-group">
                        <label>Stock:</label>
                        <input type="number" name="stock" id="stock" placeholder="Stock" />
                    </div>

                    <div class="form-group">
                        <label>Imagen:</label>
                        <input type="file" id="archivo" name="archivo"><br>
                    </div>

                    <input onclick="validar(); return false;" type="submit" value="Registrar nuevo producto" class="btn-submit" />

                </form>
            </div>
        </div>

        
    </body>
</html>