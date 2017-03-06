<?php 
  session_start();
  if(isset($_SESSION["login"]) && ($_SESSION["login"]!=null)):
    $login = $_SESSION["login"];

    include("../../src/dbconnect.php");

    if (isset($_GET["success"])) {
      echo "MATERIA INSCRITA CON EXITO.";
    }

    if (isset($_GET["id"])) {
      $id = $_GET["id"];
    }

    $query = "SELECT * FROM usuario 
    JOIN estudiante ON usuario.usuario_id = estudiante.estudiante_usuario
    JOIN estudiante_seccion ON estudiante.estudiante_id = estudiante_seccion.es_estudiante
    JOIN seccion ON estudiante_seccion.es_seccion = seccion.seccion_id
    JOIN materia ON seccion.seccion_materia = materia.materia_id
    JOIN carrera ON materia.materia_carrera = carrera.carrera_id
    WHERE usuario_id = '{$id}'";
    $result = mysql_query($query, $connect);
    $carga_academica = 0;

    $user_query = "SELECT * FROM usuario 
    JOIN estudiante ON usuario.usuario_id = estudiante.estudiante_usuario
    WHERE usuario_id = '{$id}'";
    $sql = mysql_query($user_query, $connect);
    $user_data = mysql_fetch_assoc($sql);
    $phpdate = strtotime( $user_data["nacimiento"] );
    $nacimiento = date( 'd/m/Y', $phpdate );

    include("header.php");
    include("navbar.php");
?>
<div class="container">
  <div class="page-header">
    <h2>Datos del estudiante</h2>
  </div>

  <div class="col-xs-12 col-sm-4">
    <h3>Datos personales</h3>
    <b>Nombre:</b> <span><?php echo $user_data["nombre"] ?></span> <br>
    <b>Ceudula:</b> <span><?php echo $user_data["cedula"] ?></span> <br>
    <b>Fecha de nacimiento: </b> <span><?php echo $nacimiento ?></span>
    <h4>Informacion de contacto</h4>
    <b>Telefono: </b> <span><?php echo $user_data["telefono"] ?></span> <br>
    <b>Correo: </b> <span><?php echo $user_data["correo"] ?></span> <br>
    <b>Direccion: </b> <span><?php echo $user_data["direccion"] ?></span><br>
  </div>

  <div class="col-xs-12 col-sm-8">
    <h3>Datos academicos</h3>
    <b>Creditos aprobados: </b><?php echo $user_data["estudiante_carga_academica"] ?>
    <b> - Inscripcion: </b> <span><?php echo $user_data["estudiante_inscripcion"] ?></span>
    <table class="table table-bordered table-custom">
      <tr>
        <th>Materia inscrita</th>
        <th>Seccion</th>
        <th>Creditos</th>
      </tr>
      
      <?php while($data = mysql_fetch_assoc($result)): ?>
      <?php $carga_academica = $carga_academica + $data["materia_creditos"]; ?>
      <tr>
        <td>
          <a href="materia.php?seccion=<?php echo $data["seccion_id"] ?>">
            <?php echo $data["materia_nombre"] ?>
          </a>
        </td>
        <td>
          <?php echo $data["seccion_nombre"] ?>
        </td>
        <td>
          <?php echo $data["materia_creditos"] ?>
        </td>
      </tr>
      <?php endwhile ?>
      <b> - Carga academica: </b><?php echo $carga_academica ?> creditos
    </table>
  </div>
</div>

<?php 
  include('footer.php');
  else: 
    header('location: ../error.php');
  endif;
?>