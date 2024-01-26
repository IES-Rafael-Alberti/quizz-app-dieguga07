<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lógica del cuestionario
    require_once 'Quiz.php'; // Asegúrate de incluir el archivo de la clase Quiz

    $quiz = new Quiz();
    
    // Agrega preguntas y respuestas correctas
    $quiz->agregarPregunta('q1', 'b');
    $quiz->agregarPregunta('q2', 'b');
    $quiz->agregarPregunta('q3', 'b');
    $quiz->agregarPregunta('q4', 'b');
    $quiz->agregarPregunta('q5', 'b');
    $quiz->agregarPregunta('q6', 'b');
    $quiz->agregarPregunta('q7', 'b');
    $quiz->agregarPregunta('q8', 'b');
    $quiz->agregarPregunta('q9', 'a');
    $quiz->agregarPregunta('q10', 'c');

    $respuestasUsuario = $_POST;

    // Muestra resultados
    echo "<h2>Resultados del Cuestionario</h2>";
    $puntuacion = $quiz->calcularPuntuacion($respuestasUsuario);
    echo "<p>Tu puntuación es: $puntuacion</p>";

    // Muestra comentarios para cada pregunta
    echo "<h3>Comentarios:</h3>";
    foreach ($respuestasUsuario as $pregunta => $respuestaUsuario) {
        $respuestaCorrecta = $quiz->getRespuestaCorrecta($pregunta);
        echo "Respuesta: $respuestaUsuario ---- Respuesta correcta: $respuestaCorrecta</p>";
    }

}

?>