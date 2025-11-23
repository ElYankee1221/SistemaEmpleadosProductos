<?php
// funciones/conecta.php

// 1. Definimos las constantes por separado
define("HOST_IP",'127.0.0.1'); // Usar 127.0.0.1 es más robusto que 'localhost'
define("HOST_PORT", 3306);       // El puerto como un NÚMERO
define("BD",'cliente01');
define("USER_BD",'root');
define("PASS_BD",'');

function conecta() {
    
    // 2. Usamos el constructor con 5 ARGUMENTOS
    $con = new mysqli(HOST_IP, USER_BD, PASS_BD, BD, HOST_PORT);

    // 3. ¡AÑADIMOS VERIFICACIÓN DE ERRORES!
    // Esto es crucial. Si falla, nos dirá EXACTAMENTE por qué.
    if ($con->connect_error) {
        
        // Esta línea es la que nos dará la respuesta final si algo falla
        die("Falló la conexión: (" . $con->connect_errno . ") " . $con->connect_error);
    }
    
    return $con;
}
?>