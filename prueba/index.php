<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-image: url();
    
}

.form-register{
    width: 400px;
    background: #24303c;
    padding: 30px;
    margin: auto;
    margin-top: 100px;
    border-radius: 15px;
    font-family: 'calibri';
    color: white;
    box-shadow: 7px 13px 37px #000;
}

.form-register h4{
    font-size: 22px;
    margin-bottom: 20px;
}
.controls{
    width: 100%;
    background: #24303c;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 16px;
    border: 1px solid #1f53c5;
    font-family: "calibri";
    font-size: 18px;
    color: white;
}

.form-register p{
    height: 40px;
    text-align: center;
    font-size: 18px;
    line-height: 40px;
}

.form-register a {
    color: white;
    text-decoration: none;
}

.form-register a:hover {
    color: white;
    text-decoration: underline;
}

.form-register .botons{
    width: 100%;
    background: #1f53c5;
    border: none;
    padding: 12px;
    color: white;
    margin: 16px 0;
    font-size: 16px;
    border-radius: 10px;
}
    </style>
</head>

<body>
    <div class="form-register">
    <form action="procesar_formulario.php" method="post">
        <label class="controls" for="nombre_completo">Nombre completo:</label><br>
        <input class="controls"  type="text" id="nombre_completo" name="nombre_completo"><br>
        <label class="controls" for="edad">Edad:</label><br>
        <input class="controls" type="number" id="edad" name="edad"><br>
        <label class="controls" for="fecha_nacimiento">Fecha de nacimiento:</label><br>
        <input class="controls" type="date" id="fecha_nacimiento" name="fecha_nacimiento"><br>
        <label class="controls" for="fecha_inscripcion">Fecha de inscripción:</label><br>
        <input class="controls" type="date" id="fecha_inscripcion" name="fecha_inscripcion"><br>
        <label class="controls" for="costo">Costo:</label><br>
        <input class="controls" type="number" id="costo" name="costo"><br><br>
        <input class="botons" type="submit" value="Crear">
        <input class="botons" type="submit" value="Leer">
        <input class="botons" type="submit" value="Actualizar">
        <input class="botons" type="submit" value="Eliminar">
    </form>
    </div>
</body>

</html>