<?php

namespace app\engine;

class ImportXML {


    public $url;
    public $xml = null;
    
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function import(){

        $xml = $this->xml = new \XMLReader();

        $this->xml->open($this->url);

        while($xml->read()) {
       
            if($xml->nodeType == \XMLREADER::ELEMENT && $xml->localName == 'User'){
                $user = new People($xml->getAttribute('Name'));
                $user->insert();
                }
            if($xml->nodeType == \XMLREADER::ELEMENT && $xml->localName == 'Pet'){
                $pet_age = $xml->getAttribute('Age');
                $pet_gender = $xml->getAttribute('Gender');

                $pet_type = $xml->getAttribute('Type');  
                $type = new PetType($pet_type);
                $type->insert();
                }
            if($xml->nodeType == \XMLREADER::ELEMENT && $xml->localName == 'Nickname'){
                $nickname = $xml->getAttribute('Value');
            }
            if($xml->nodeType == \XMLREADER::ELEMENT && $xml->localName == 'Breed'){
                $breed = $xml->getAttribute('Name');

                $pet = new Pet($pet_age, $pet_gender, $nickname, $breed);
                $pet->id_people = (int)$user->getId();
                $pet->id_pets = (int)$type->getId();
                $pet->insert();

            }
        }

    }
}
 
?>