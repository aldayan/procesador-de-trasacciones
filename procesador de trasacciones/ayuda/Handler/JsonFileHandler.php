<?php 

class JsonFileHandler implements FileHandler{



    public $directoy;
    public $filename;



       function __construct($directoy , $filename)
       {
           $this->directoy = $directoy;
           $this->filename = $filename;
       }



    function CreateDirectory(){
        if(!file_exists($this->directoy)){

            mkdir($this->directoy,0777,true);
        }

    }
    function SaveFile($value){

        $this->CreateDirectory($this->directoy);
        $path = $this->directoy . "/"  . $this->filename  . ".json";


        $serializeData = json_encode($value);


         $file = fopen($path,"w+");

         fwrite($file,$serializeData); 
 
         fclose($file);
    }
    function ReadFile(){

        $this->CreateDirectory($this->directoy);

        $path = $this->directoy . "/" . $this->filename . ".json";

        if(file_exists($path)){

            $file = fopen($path,"r");
            $contents = fread($file,filesize($path));

            fclose($file);
            return json_decode($contents);
        }
        else{
            return false;
        }
         
    }


}





?>