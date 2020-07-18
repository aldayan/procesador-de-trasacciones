<?php

use function PHPSTORM_META\elementType;

class EstudianteCookie  implements  ServiceBase {


 private $utilities;
 private $cookieName;

 public function __construct()
 {

$this->utilities = new utilities();
$this->cookieName = "estudiantes";


 }
 public function GetList()
 {

$listadoEstudiantes = array();
if(isset($_COOKIE[$this->cookieName])){

    $listadoEstudiantesDecode = json_decode($_COOKIE[$this->cookieName], false) ;

    foreach($listadoEstudiantesDecode as $elementDecode){

        $element = new estu();

        $element ->set($elementDecode);


        array_push($listadoEstudiantes, $element);
    }



}else{
   setcookie($this->cookieName,json_encode($listadoEstudiantes), $this->utilities->GetCookieTime(),"/");
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

      setcookie($this->cookieName,json_encode($listadoEstudiantes), $this->utilities->GetCookieTime(),"/");
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


 setcookie($this->cookieName,json_encode($listadoEstudiantes), $this->utilities->GetCookieTime(),"/");

}

public function Delete($id)
{

$listadoEstudiantes = $this->GetList();

$elementIndex = $this->utilities-> getIndexElement($listadoEstudiantes,'id',$id);

unset($listadoEstudiantes[$elementIndex]);

$listadoEstudiantes = array_values($listadoEstudiantes);

setcookie($this->cookieName,json_encode($listadoEstudiantes), $this->utilities->GetCookieTime(),"/");

}


 }


?>