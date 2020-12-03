<?php

namespace app\engine;

class UploadXML {

    public $file;

    public function __construct(array $file = [])
    {
        $this->file = $file;
    }

    public function uploadFile(){
        if(!empty($this->file)){
            if($this->file['file']['type'] == 'text/xml'){
                $name_file = time();
                $file_directory = $_SERVER['DOCUMENT_ROOT'] . '/../resource//' .  $name_file . '.xml';
                move_uploaded_file($this->file['file']['tmp_name'], $file_directory);
                return  $file_directory;
            } else {
                die('Не верный формат файла');
            }
        }
    }

}

?>