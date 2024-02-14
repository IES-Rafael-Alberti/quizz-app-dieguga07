<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form method="post" action="registro_procesar.php">
        <label for="username">Nombre de Usuario:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="email">Correo Electrónico:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>
