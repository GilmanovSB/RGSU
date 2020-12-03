<?php
namespace app\engine;

class People extends Record{

    public $name;


    public function __construct($name = null)
    {
        parent::__construct();
        $this->name = $name;
    }


    public function getTable()
    {
        return 'people';
    }

    public function getData()
    {
        $data['people_name'] = $this->name;
        return $data;
    }

    public function getId(){
        $sql = "SELECT id_people FROM {$this->table} WHERE people_name = :name";
        return $this->db->queryOne($sql, [':name' => $this->name])['id_people'];
}

}



?>