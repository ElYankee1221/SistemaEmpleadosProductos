<?php
    session_start();

    $userName = $_SESSION['userName'];

    if ($userName == '') {
        header("Location: index.php");
    }
?>

<nav class="menu-principal">
    
    <a href="bienvenido.php">Inicio</a>
    <a href="empleados_lista.php">Empleados</a>
    <a href="empleados_lista.php">Productos</a>
    <div style="margin-left: auto;"></div> 

    <span class="saludo-usuario">Bienvenido, <?php echo $userName; ?></span>
    <a href="cerrar_sesion.php" class="btn-salir">Salir</a>
</nav>