<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'formulario-web';
$username = 'root';
$password='';

try {
  $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
  die("Error al conectarse a la base de datos: " . $e->getMessage());
}

if (isset($_POST['Crear'])) {
   // Validación de datos ingresados por el usuario
   if (isset($_POST['nombre_completo']) && isset($_POST['edad']) && isset($_POST['fecha_nacimiento']) && isset($_POST['fecha_inscripcion']) && isset($_POST['costo'])) {
    $nombre_completo = trim($_POST['nombre_completo']);
    $edad = (int) $_POST['edad'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $fecha_inscripcion = $_POST['fecha_inscripcion'];
    $costo = (float) $_POST['costo'];
   }
    $nombres = explode(' ', $nombre_completo);
    if (count($nombres) < 2 || strlen($nombres[0]) < 4 || strlen($nombres[1]) < 4) {
      echo 'Ingresa al menos dos nombres (nombre apellido) con 4 caracteres cada uno';
      exit;
    }

    if (strtotime($fecha_inscripcion) <= strtotime($fecha_nacimiento)) {
      echo 'La fecha de inscripción debe ser mayor que la de nacimiento';
      exit;
    }

    if (date_diff(date_create($fecha_nacimiento), date_create('today'))->y < 18) {
      echo 'Debes tener al menos 18 años';
      exit;
    }

    if (date_diff(date_create($fecha_nacimiento), date_create('today'))->y != $edad) {
      echo 'La edad ingresada no coincide con la fecha de nacimiento';
      exit;
    }

    $costo_esperado = 100 * date_diff(date_create($fecha_inscripcion), date_create('today'))->y;
    if ($costo != $costo_esperado) {
      echo 'El costo debe ser proporcional a la fecha de inscripción (100 dólares por cada año transcurrido)';
      exit;
    }

  // Inserción de datos en la base de datos
  $stmt = $db->prepare('INSERT INTO formulario (nombre_completo, edad, fecha_nacimiento, fecha_inscripcion, costo) VALUES (?, ?, ?, ?, ?)');
  $stmt->execute([$nombre_completo, $edad, $fecha_nacimiento, $fecha_inscripcion, $costo]);
  echo 'Registro creado exitosamente';
  } elseif (isset($_POST['Leer'])) {
  // Lectura de datos de la base de datos
  $stmt = $db->prepare('SELECT * FROM formulario');
  $stmt->execute();
  $registros = $stmt->fetchAll();

  if (count($registros) > 0) {
    foreach ($registros as $registro) {
      echo '<p>';
      echo 'Nombre completo: ' . $registro['nombre_completo'] . '<br>';
      echo 'Edad: ' . $registro['edad'] . '<br>';
      echo 'Fecha de nacimiento: ' . $registro['fecha_nacimiento'] . '<br>';
      echo 'Fecha de inscripción: ' . $registro['fecha_inscripcion'] . '<br>';
      echo 'Costo: ' . $registro['costo'] . '<br>';
      echo '</p>';
    }
  } else {
    echo 'No hay registros';
  }
  } elseif (isset($_POST['Actualizar'])) {
  // Validación de datos ingresados por el usuario
  if (isset($_POST['nombre_completo']) && isset($_POST['edad']) && isset($_POST['fecha_nacimiento']) && isset($_POST['fecha_inscripcion']) && isset($_POST['costo'])) {
    $nombre_completo = trim($_POST['nombre_completo']);
    $edad = (int) $_POST['edad'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $fecha_inscripcion = $_POST['fecha_inscripcion'];
    $costo = (float) $_POST['costo'];
  }
    $nombres = explode(' ', $nombre_completo);
    if (count($nombres) < 2 || strlen($nombres[0]) < 4 || strlen($nombres[1]) < 4) {
      echo 'Ingresa al menos dos nombres (nombre apellido) con 4 caracteres cada uno';
      exit;
    }

    if (strtotime($fecha_inscripcion) <= strtotime($fecha_nacimiento)) {
      echo 'La fecha de inscripción debe ser mayor que la de nacimiento';
      exit;
    }

    if (date_diff(date_create($fecha_nacimiento), date_create('today'))->y < 18) {
      echo 'Debes tener al menos 18 años';
      exit;
    }

    if (date_diff(date_create($fecha_nacimiento), date_create('today'))->y != $edad) {
      echo 'La edad ingresada no coincide con la fecha de nacimiento';
      exit;
    }
  
    $costo_esperado = 100 * date_diff(date_create($fecha_inscripcion), date_create('today'))->y;
    if ($costo != $costo_esperado) {
      echo 'El costo debe ser proporcional a la fecha de inscripción (100 dólares por cada año transcurrido)';
      exit;
    }
  
    // Actualización de datos en la base de datos
      $stmt = $db->prepare('UPDATE formulario SET nombre_completo = ?, edad = ?, fecha_nacimiento = ?, fecha_inscripcion = ?, costo = ? WHERE id = ?');
      $stmt->execute([$nombre_completo, $edad, $fecha_nacimiento, $fecha_inscripcion, $costo, (int) $_POST['id']]);
    echo 'Registro actualizado exitosamente';
    } elseif (isset($_POST['Borrar'])) {
    // Borrado de datos en la base de datos
    $stmt = $db->prepare('DELETE FROM formulario WHERE id = ?');
    $stmt->execute([(int) $_POST['id']]);
    echo 'Registro eliminado exitosamente';
    } else {
    echo 'Error: operación no valida';
    }

?>