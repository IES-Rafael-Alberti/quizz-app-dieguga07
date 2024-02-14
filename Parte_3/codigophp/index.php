<?php
// Paso 1: Modificar el esquema de la base de datos
$host = "localhost";
$usuario = "root";
$contraseña = "Diego";
$base_de_datos = "cuestionario_php";

$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Modificar la tabla "preguntas" para agregar el campo question_type y question_details
$modificacionTabla = "ALTER TABLE preguntas
                      ADD question_type VARCHAR(50) NOT NULL,
                      ADD question_details TEXT";

if ($conexion->query($modificacionTabla) === TRUE) {
    echo "Tabla preguntas modificada con éxito.<br>";
} else {
    echo "Error al modificar la tabla preguntas: " . $conexion->error . "<br>";
}

$conexion->close();

// Paso 2: Crear el sistema CRUD
class Pregunta {
    private $conexion;

    public function __construct($host, $usuario, $contraseña, $base_de_datos) {
        $this->conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);
        if ($this->conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $this->conexion->connect_error);
        }
    }

    public function agregarPregunta($pregunta, $respuesta_correcta, $question_type, $question_details) {
        $stmt = $this->conexion->prepare("INSERT INTO preguntas (pregunta, respuesta_correcta, question_type, question_details) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $pregunta, $respuesta_correcta, $question_type, $question_details);
        $stmt->execute();
        $stmt->close();
    }

    // Implementar las demás operaciones CRUD (leer, actualizar, eliminar)
}

// Paso 3: Ajustar la interfaz de usuario (IU)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pregunta</title>
</head>
<body>
    <h1>Crear Pregunta</h1>
    <form method="post" action="crear_pregunta.php">
        <label for="pregunta">Pregunta:</label><br>
        <input type="text" id="pregunta" name="pregunta"><br>
        <label for="respuesta_correcta">Respuesta Correcta:</label><br>
        <input type="text" id="respuesta_correcta" name="respuesta_correcta"><br>
        <label for="question_type">Tipo de Pregunta:</label><br>
        <input type="text" id="question_type" name="question_type"><br>
        <label for="question_details">Detalles de la Pregunta:</label><br>
        <input type="text" id="question_details" name="question_details"><br>
        <input type="submit" value="Crear Pregunta">
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $pregunta = $_POST['pregunta'];
    $respuesta_correcta = $_POST['respuesta_correcta'];
    $question_type = $_POST['question_type'];
    $question_details = $_POST['question_details'];

    // Crear objeto Pregunta y agregar la pregunta a la base de datos
    $pregunta = new Pregunta($host, $usuario, $contraseña, $base_de_datos);
    $pregunta->agregarPregunta($pregunta, $respuesta_correcta, $question_type, $question_details);
    echo "Pregunta creada con éxito.";
}

// Lógica para insertar una nueva pregunta en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'db_connection.php'; // Incluimos el archivo de conexión a la base de datos
    
    // Obtenemos los datos del formulario
    $pregunta = $_POST['pregunta'];
    $respuesta_correcta = $_POST['respuesta_correcta'];
    $tipo_pregunta = $_POST['tipo_pregunta'];
    $detalles_pregunta = $_POST['detalles_pregunta'];
    
    // Preparamos la consulta SQL
    $sql = "INSERT INTO preguntas (pregunta, respuesta_correcta, question_type, question_details)
            VALUES ('$pregunta', '$respuesta_correcta', '$tipo_pregunta', '$detalles_pregunta')";
    
    // Ejecutamos la consulta y verificamos si se realizó correctamente
    if ($conexion->query($sql) === TRUE) {
        echo "Pregunta insertada correctamente.";
    } else {
        echo "Error al insertar la pregunta: " . $conexion->error;
    }
}

// Lógica para mostrar las preguntas existentes en la base de datos
require_once 'db_connection.php'; // Incluimos el archivo de conexión a la base de datos

// Consulta SQL para obtener todas las preguntas
$sql = "SELECT * FROM preguntas";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    echo "<h2>Listado de Preguntas</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Pregunta</th><th>Respuesta Correcta</th><th>Tipo de Pregunta</th><th>Detalles de la Pregunta</th></tr>";
    
    // Iteramos sobre cada fila de resultado y mostramos los detalles de la pregunta
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . $fila['pregunta'] . "</td>";
        echo "<td>" . $fila['respuesta_correcta'] . "</td>";
        echo "<td>" . $fila['question_type'] . "</td>";
        echo "<td>" . $fila['question_details'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron preguntas en la base de datos.";
}
// Lógica para mostrar las preguntas existentes en la base de datos con paginación
require_once 'db_connection.php'; // Incluimos el archivo de conexión a la base de datos

// Definimos el número de preguntas por página y obtenemos el número total de preguntas
$preguntas_por_pagina = 10;
$sql_total_preguntas = "SELECT COUNT(*) AS total_preguntas FROM preguntas";
$resultado_total_preguntas = $conexion->query($sql_total_preguntas);
$fila_total_preguntas = $resultado_total_preguntas->fetch_assoc();
$total_preguntas = $fila_total_preguntas['total_preguntas'];

// Calculamos el número total de páginas
$total_paginas = ceil($total_preguntas / $preguntas_por_pagina);

// Obtenemos el número de página actual (si no se especifica, será la primera página)
$pagina_actual = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculamos el índice del primer registro de la página actual
$indice_inicio = ($pagina_actual - 1) * $preguntas_por_pagina;

// Consulta SQL para obtener las preguntas de la página actual
$sql_preguntas_pagina = "SELECT * FROM preguntas LIMIT $indice_inicio, $preguntas_por_pagina";
$resultado_preguntas_pagina = $conexion->query($sql_preguntas_pagina);

if ($resultado_preguntas_pagina->num_rows > 0) {
    echo "<h2>Listado de Preguntas</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Pregunta</th><th>Respuesta Correcta</th><th>Tipo de Pregunta</th><th>Detalles de la Pregunta</th></tr>";
    
    // Iteramos sobre cada fila de resultado y mostramos los detalles de la pregunta
    while ($fila = $resultado_preguntas_pagina->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . $fila['pregunta'] . "</td>";
        echo "<td>" . $fila['respuesta_correcta'] . "</td>";
        echo "<td>" . $fila['question_type'] . "</td>";
        echo "<td>" . $fila['question_details'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    // Mostramos los enlaces de paginación
    echo "<div>";
    echo "<p>Páginas:</p>";
    for ($i = 1; $i <= $total_paginas; $i++) {
        echo "<a href='listado_preguntas.php?page=$i'>$i</a> ";
    }
    echo "</div>";
} else {
    echo "No se encontraron preguntas en la base de datos.";
}


$conexion->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'db_connection.php'; // Incluimos el archivo de conexión a la base de datos
    
    // Obtenemos los datos del formulario de edición
    $id_pregunta = $_POST['id_pregunta'];
    $pregunta = $_POST['pregunta'];
    $respuesta_correcta = $_POST['respuesta_correcta'];
    $tipo_pregunta = $_POST['tipo_pregunta'];
    $detalles_pregunta = $_POST['detalles_pregunta'];
    
    // Preparamos la consulta SQL de actualización
    $sql_actualizar_pregunta = "UPDATE preguntas SET pregunta='$pregunta', respuesta_correcta='$respuesta_correcta', question_type='$tipo_pregunta', question_details='$detalles_pregunta' WHERE id=$id_pregunta";
    
    // Ejecutamos la consulta y verificamos si se realizó correctamente
    if ($conexion->query($sql_actualizar_pregunta) === TRUE) {
        echo "Pregunta actualizada correctamente.";
    } else {
        echo "Error al actualizar la pregunta: " . $conexion->error;
    }
}

// Lógica para eliminar preguntas del cuestionario
if (isset($_GET['eliminar_id'])) {
    require_once 'db_connection.php'; // Incluimos el archivo de conexión a la base de datos
    
    $id_pregunta_eliminar = $_GET['eliminar_id'];
    
    // Preparamos la consulta SQL de eliminación
    $sql_eliminar_pregunta = "DELETE FROM preguntas WHERE id=$id_pregunta_eliminar";
    
    // Ejecutamos la consulta y verificamos si se realizó correctamente
    if ($conexion->query($sql_eliminar_pregunta) === TRUE) {
        echo "Pregunta eliminada correctamente.";
    } else {
        echo "Error al eliminar la pregunta: " . $conexion->error;
    }
}


$stmt = $conexion->prepare("INSERT INTO preguntas (pregunta, respuesta_correcta, question_type, question_details) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $pregunta, $respuesta_correcta, $question_type, $question_details);
$stmt->execute();

echo "<p>" . htmlspecialchars($respuesta_usuario) . "</p>";
