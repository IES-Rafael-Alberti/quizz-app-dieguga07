<?php

class Quiz {
    private $preguntas = [];
    private $respuestasCorrectas = [];

    public function agregarPregunta($pregunta, $respuestaCorrecta) {
        $this->preguntas[] = $pregunta;
        $this->respuestasCorrectas[$pregunta] = $respuestaCorrecta;
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

    // Agrega otros métodos según sea necesario
}

?>