<?php 
  session_start();
  if(isset($_SESSION["login"]) && ($_SESSION["login"]!=null)):
    $login = $_SESSION["login"];

    include("../../src/dbconnect.php");

    $messgae = "";
    if (isset($_GET["success"])) {
      $message =  "Accion ejecutada exitosamente";
    }

    if (isset($_GET["id"])) {
      $id = $_GET["id"];
    }

    $query = "SELECT * FROM usuario 
    JOIN profesor ON usuario.usuario_id = profesor.profesor_usuario
    JOIN profesor_seccion ON profesor.profesor_id = profesor_seccion.ps_profesor
    JOIN seccion ON profesor_seccion.ps_seccion = seccion.seccion_id
    JOIN materia ON seccion.seccion_materia = materia.materia_id
    JOIN carrera ON materia.materia_carrera = carrera.carrera_id
    WHERE usuario_id = '{$id}'";
    $result = mysql_query($query, $connect);
    $carga_academica = 0;

    $query = "SELECT * FROM usuario 
    JOIN profesor ON usuario.usuario_id = profesor.profesor_usuario
    WHERE usuario_id = '{$id}'";
    $sql = mysql_query($query, $connect);
    $user_data = mysql_fetch_assoc($sql);
    $phpdate = strtotime( $user_data["nacimiento"] );
    $nacimiento = date( 'd/m/Y', $phpdate );

    include("header.php");
    include("navbar.php");
?>
<div class="container">
  <div class="page-header">
    <h2>Datos del profesor</h2>
  </div>

  <?php if ($message):?>
    <div class="alert alert-success" role="alert"><?php echo $message ?></div>
  <?php endif ?> 

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
      <b>Carga academica: </b><?php echo $carga_academica ?> creditos
    </table>
  </div>
</div>

<?php 
  include('footer.php');
  else: 
    header('location: ../error.php');
  endif;
?>