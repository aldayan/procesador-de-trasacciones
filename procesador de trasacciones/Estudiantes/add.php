
<?php 
require_once '../layout/layout.php';
require_once '../ayuda/utilidad.php';
require_once 'estu.php';
require_once '../service/ServiceBase.php';
require_once 'EstudianteCookie.php';
require_once '../ayuda/Handler/FileHandler.php';
require_once '../ayuda/Handler/JsonFileHandler.php';
require_once 'EstudianteServiceFile.php';


$layout = new Layout(true);
$service = new EstudianteServiceFile();
$utilities = new utilities();






if(isset($_POST['monto']) && isset($_POST['descripcion']) ){



  $newEstudiante = new Estu();

  $newEstudiante-> InicializeData(0,$_POST['monto'],$_POST['descripcion']);


  $service -> Add($newEstudiante);



 header("Location:../index.php");
 exit();
}

?>

<?php $layout->printHeader();?>

<main role="main">
    <div style="margin-top: 2%;">

<div class="card">
  <div class="card-header bg-dark text-light" >
 <a href="../index.php" class="btn btn-warning"> Volver Atras</a> Crear nueva transaccion
  </div> 
  <div class="card-body">

  <form enctype="multipart/form-data" action="add.php" method="POST">

  <div class="form-group">
    <label for="monto">Monto:</label>
    <input type="text" class="form-control" id="monto" name="monto">
  </div>
  <div class="form-group">
    <label for="descripcion">Descripcion:</label>
    <input type="text" class="form-control" id="descripcion" name="descripcion">
  </div>


 

    <button type="submit" class=" btn btn-success">Guardar</button>

</form>
  </div>
</div>



</main>

<?php $layout->printFooter();?>