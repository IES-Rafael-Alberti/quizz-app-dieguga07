<?php

class Quiz {
    private $preguntas = [];
    private $respuestasCorrectas = [];

    p public function cargarPreguntasDesdeBD() {
        global $conexion;

        // Modifica la consulta SQL según tu estructura de base de datos
        $consulta = "SELECT id, pregunta, respuesta_correcta FROM preguntas";
        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $this->agregarPregunta($fila['id'], $fila['pregunta'], $fila['respuesta_correcta']);
            }
        } else {
            die("Error al recuperar preguntas de la base de datos");
        }
    }

    public function agregarPregunta($id, $pregunta, $respuestaCorrecta) {
        $this->preguntas[] = $pregunta;
        $this->respuestasCorrectas[$id] = $respuestaCorrecta;
    }


    public function calcularPuntuacion($respuestasUsuario) {
        $puntuacion = 0;
        foreach ($respuestasUsuario as $pregunta => $respuestaUsuario) {
            if ($respuestaUsuario == $this->respuestasCorrectas[$pregunta]) {
                $puntuacion++;
            }
        }
        return $puntuacion;
    }

    public function getRespuestaCorrecta($pregunta) {
        return $this->respuestasCorrectas[$pregunta];
    }

}

?>