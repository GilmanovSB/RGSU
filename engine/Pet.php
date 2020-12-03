<?php
namespace app\engine;

class Pet extends Record{

    public $id_people = null;
    public $id_pets = null;
    public $nickname;
    public $age;
    public $gender;
    public $breed;
    


    public function __construct($age = null, $gender = null, $nickname = null, $breed = null)
    {
        parent::__construct();
        $this->nickname = $nickname;
        $this->age = $age;
        $this->gender = $gender;
        $this->breed = $breed;
    }


    public function getTable()
    {
        return 'pets';
    }

    public function getData()
    {
        $data['id_people'] = $this->id_people;
        $data['id_pets'] = $this->id_pets;
        $data['nickname'] = $this->nickname;
        $data['age'] = (int)$this->age;
        $data['gender'] = $this->gender;
        $data['breed'] = $this->breed;
        return $data;
    }

    public function getId(){
        $sql = "SELECT id FROM {$this->table} WHERE nickname = :nickname";
        return $this->db->queryOne($sql, [':nickname' => $this->nickname]);
}

}



?>