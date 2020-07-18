<?php 


interface ServiceBase{

public function GetByid($id);
public function GetList();
public function Add($entity);
public function Update($id,$entity);
public function Delete($id);



}


?>