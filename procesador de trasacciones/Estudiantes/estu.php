<?php 
class estu{

public $id;

public $monto;
public $descripcion;




private $utilities;


public function __construct() {

$this->utilities = new utilities();
}

public function  InicializeData($id,$monto,$descripcion){

  $this->id=$id; 
 
  $this->monto=$monto;
  $this->descripcion=$descripcion;
 


}


public function set($data)
{
    foreach($data as $key => $value) $this->{$key} = $value;
}




}



?>