<?php 
require_once 'layout/layout.php';
require_once 'ayuda/utilidad.php';
require_once 'Estudiantes/estu.php';
require_once 'service/ServiceBase.php';
require_once 'Estudiantes/EstudianteCookie.php';
require_once 'ayuda/Handler/FileHandler.php';
require_once 'ayuda/Handler/JsonFileHandler.php';
require_once 'Estudiantes/EstudianteServiceFile.php';



$layout = new Layout(false);
$utilies =  new utilities();
$service= new EstudianteServiceFile();


$listadoEstudiantes = $service->GetList(); 




?>

<?php $layout->printHeader();?>

<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Procesador de transaccion</font></font></h1>
      <p class="lead text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Haz tu transaccion</font></font></p>
      <p>
        <a href="Estudiantes/add.php" class="btn btn-primary my-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Haz transaccion</font></font></a>

      </p>
    </div>
  </section>


  <div class="album py-5 bg-light">
    <div class="container">





    <div class="row">
      <div class = "col-md-5"></div>
    <div class = "col-md-3">

      





      <div class="row">

      <?php if(empty($listadoEstudiantes)): ?>


       <h2> No haz hecho tu transaccion, registrala aqui: <a href="Estudiantes/add.php" class="btn btn-primary">Nueva transaccion</a></h2>

      <?php  else:?>




      <?php   foreach($listadoEstudiantes as $estudiante):  ?>




        <div class="card">



           <div class="card-body">
            <h5 class="card-title"><?php echo $estudiante->monto; ?></h5>

            <p class="card-text"><?php echo $estudiante->descripcion; ?></p>

         
     

            <a href="Estudiantes/edit.php?id=<?php echo $estudiante->id; ?>" class="card-link">Editar</a>

            <a href="Estudiantes/borrar.php?id=<?php echo $estudiante->id; ?>" class="card-link">Borrar</a>

          </div>
        </div>


      <?php endforeach; ?>



      <?php   endif;?>


        </div>
      </div>
    </div>
  </div>

</main>

<?php $layout->printFooter();?>

