<?php


class EstudianteServiceFile  implements  ServiceBase {


 private $utilities;
public $filehandler;
public $directory;
public $filename;

 public function __construct($directory = "data")
 {

$this->utilities = new utilities();
$this->directory = $directory;
$this->filename = "estudiantes";
$this->filehandler= new JsonFileHandler($this->directory,$this->filename);



 }
 public function GetList()
 {

  $listadoEstudiantesDecode = $this->filehandler->readfile();

$listadoEstudiantes = array();

if($listadoEstudiantes == false){
    $this->filehandler->SaveFile($listadoEstudiantes);

}else{
   

     foreach($listadoEstudiantesDecode as $elementDecode){
 
         $element = new estu();
 
         $element ->set($elementDecode);

         array_push($listadoEstudiantes, $element);
     }

   }

     return $listadoEstudiantes;
 }

public function GetByid($id)
{
    $listadoEstudiantes = $this->GetList();
    $estu= $this->utilities->searchProperty($listadoEstudiantes,'id',$id)[0];
    return $estu;

 } 
  public function Add($entity)
  {
      $listadoEstudiantes = $this->GetList();
      $estuId = 1; 
      if (!empty($listadoEstudiantes)){

        $lastEstudiante = $this->utilities->getLastElement($listadoEstudiantes);
        $estuId = $lastEstudiante->id + 1; 
      }



      $entity->id = $estuId;
     $entity ->profilePhoto ="";

     if(isset($_FILES['profilepPhoto']))  {


        $photoFile = $_FILES['profilePhoto'];

        if($photoFile['Error'] ==4){


            $entity->profilePhoto = "";

        }else{


        $typeReplace = str_replace("image/","", $_FILES['profilePhoto']['type']);
        $type =   $photoFile['type'];
        $size =   $photoFile['size'];
        $name = $estuId .  '.' . $typeReplace;
        $tmpname =  $photoFile['tmp_name'];

$success = $this -> utilities-> uploadImage('../assets/imagen/',$name,$tmpname,$type,$size);

if($success){
    $entity ->profilePhoto =$name;
}


        }


     } 

      array_push($listadoEstudiantes,$entity); 

       
     $this->filehandler->SaveFile($listadoEstudiantes);
  }

public function Update($id, $entity)
{
     $element = $this->GetByid($id);
     $listadoEstudiantes = $this->GetList();


     $elementIndex = $this->utilities-> getIndexElement($listadoEstudiantes,'id',$id);


     if(isset($_FILES['profilePhoto']))  {

        $photoFile = $_FILES['profilePhoto'];

        if($photoFile['Error'] ==4){


            $entity->profilePhoto =  $element ->profilePhoto;

        }else{


            $typeReplace = str_replace("image/","", $_FILES['profilePhoto']['type']);
            $type = 
            $photoFile['type'];
            $size = 
            $photoFile['size'];
            $name =  $id .  '.' . $typeReplace;
            $tmpname =   
            $photoFile['tmp_name'];

    $success = $this -> utilities-> uploadImage('../assets/imagen/',$name,$tmpname,$type,$size);

    if($success){
        $entity ->profilePhoto =$name;
    }

        }



     } 

     $listadoEstudiantes[$elementIndex] = $entity;

 
     $this->filehandler->SaveFile($listadoEstudiantes);
}

public function Delete($id)
{

$listadoEstudiantes = $this->GetList();

$elementIndex = $this->utilities-> getIndexElement($listadoEstudiantes,'id',$id);

unset($listadoEstudiantes[$elementIndex]);

$listadoEstudiantes = array_values($listadoEstudiantes);

 
$this->filehandler->SaveFile($listadoEstudiantes);

}


 }


?>