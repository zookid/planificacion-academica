<?php
include('../../src/dbconnect.php');
    $query = "SELECT * FROM usuario 
    JOIN profesor ON usuario.usuario_id = profesor.profesor_usuario
    JOIN profesor_seccion ON profesor.profesor_id = profesor_seccion.ps_profesor
    JOIN seccion ON profesor_seccion.ps_seccion = seccion.seccion_id
    JOIN materia ON seccion.seccion_materia = materia.materia_id
    JOIN horario_seccion ON horario_seccion.hs_seccion = seccion.seccion_id
    JOIN horario ON horario.horario_id = horario_seccion.hs_horario
    JOIN dia ON horario.horario_dia = dia.dia_id
    JOIN salon ON horario.horario_salon = salon.salon_id
    JOIN bloque ON horario.horario_bloque = bloque.bloque_id
    WHERE login = '{$login}'
    ORDER BY bloque, dia_id";

    $sql = mysql_query($query, $connect);
    $materias = array();
    while ($fila = mysql_fetch_assoc($sql)) {
      $materias[] = $fila;
    }
    foreach($materias as $result) {
      $horario[] =  $result["dia_id"].$result["bloque"];
      $nombre[] =  $result["materia_nombre"];
      $salon[] =  $result["salon"];
      $color[] =  $result["materia_color"];
      $seccion[] =  $result["seccion_nombre"];
      //$hora[] =  $result["bloque_hora"];
    }

    $hora_query = "SELECT * FROM bloque";
    $hora_result = mysql_query($hora_query, $connect);
    $hora_data = array();
    while ($i = mysql_fetch_assoc($hora_result)) {
      $hora_data[] = $i;
    }
    foreach($hora_data as $horas) {
      $hora[] =  $horas["bloque_hora"];
    }
   //echo $hora[1];

  //var_dump($horario);
  //var_dump($materia);