<?php

session_start();


$_SESSION['user_id'] = $user_id; 
$_SESSION['username'] = $username; 

if ($user_authenticated) {
    if (isset($_POST['remember_me']) && $_POST['remember_me'] == 'on') {
      
        setcookie('user_id', $user_id, time() + (86400 * 30), '/'); 
        setcookie('username', $username, time() + (86400 * 30), '/');
    }
}

session_start();
// Lógica para guardar el progreso en $_SESSION u otro medio de almacenamiento
$_SESSION['current_question'] = $next_question_number;

session_start();
if (isset($_SESSION['quiz_started']) && $_SESSION['quiz_started'] === true) {
    // Restaurar el progreso guardado en $_SESSION u otro medio de almacenamiento
    $current_question = $_SESSION['current_question'];
    // Resto de la lógica para mostrar la pregunta actual, procesar respuestas, etc.
} else {
    // Redirigir al usuario a la página de inicio o mostrar un mensaje de error
    header("Location: inicio.php");
    exit;
}