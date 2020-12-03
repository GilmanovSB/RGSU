<?php
namespace app\engine;

class PetType extends Record{

    public $type;


    public function __construct($type = null)
    {
        parent::__construct();
        $this->type = $type;
    }


    public function getTable()
    {
        return 'pet_type';
    }

    public function getData()
    {
        $data['type'] = $this->type;
        return $data;
    }

    public function getId(){
        $sql = "SELECT id_pets FROM {$this->table} WHERE type = :type";
        return $this->db->queryOne($sql, [':type' => $this->type])['id_pets'];
}

}



?>