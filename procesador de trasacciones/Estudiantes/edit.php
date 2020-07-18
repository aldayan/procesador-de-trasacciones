<?php 
require_once '../layout/layout.php';
require_once '../ayuda/utilidad.php';
require_once 'estu.php';
require_once '../service/ServiceBase.php';
require_once 'EstudianteCookie.php';

$layout = new Layout(true);
$service = new EstudianteServiceFile();
$utilities = new utilities();


if(isset($_GET['id'])){

  $estuId = $_GET['id'];
  $element = $service-> GetByid($estuId);



  if(isset($_POST['monto']) && isset($_POST['descripcion'])){

    $updateEstudiante = new Estu();

    $updateEstudiante ->InicializeData($estuId,$_POST['monto'],$_POST['descripcion']);


$service->Update($estuId,
$updateEstudiante);

 header("Location:../index.php");
 exit();

}


}

else{
  header("Location:../index.php");
 exit();

}


?>

<?php $layout->printHeader();?>

<main role="main">
    <div style="margin-top: 2%;">

<div class="card">
  <div class="card-header bg-dark text-light" >
 <a href="../index.php" class="btn btn-warning"> Volver Atras</a> Editando transaccion: <?php echo $element->monto ?>
  </div> 
  <div class="card-body">
  <form action="edit.php?id=<?php echo $element->id;?>" method="POST">

  <?php
     $d - new DateTime("now", new DateTimeZone("america/santo_domingo"));
     var_dump($d->format("d/m/y h:i:s"));

     ?>

  <div class="form-group">
    <label for="monto">Monto:</label>
    <input type="text" value="<?php echo $element->monto; ?>"  class="form-control" id="monto" name="monto">
  </div>
  <div class="form-group">
    <label for="descripcion">Descripcion:</label>
    <input type="text"value="<?php echo $element->descripcion; ?>"  class="form-control" id="descripcion" name="descripcion">
  </div>

    

    <button type="submit" class=" btn btn-success">Guardar</button>

</form>
  </div>
</div>



</main>

<?php $layout->printFooter();?> 