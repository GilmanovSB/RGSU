<?php

namespace app\engine;

use app\services\Db;


abstract class Record {
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = Db::getInstanse();
        $this->table = $this->getTable();
    }
    protected function prepare($data)
    {
        
        foreach($data as $key => $value){
            $prepare_data[':'. $key] = $value;
        }
        return $prepare_data;
    }
    public function getAll(array $arr = [])
    {
        $where = '';
        if(!empty($arr)){
            $str = implode(', ', $arr);
            $where = "WHERE id IN ({$str})";
        }
        $sql = "SELECT * FROM {$this->table} $where";
        return $this->db->queryAll($sql, [], get_called_class());
    }

    public function getOne(array $vall = [])
    {
        $row = array_keys($vall)[0];
        $prepare_row = ':'.$row;
        $sql = "SELECT * FROM {$this->table} WHERE $row = $prepare_row";
        return $this->db->queryOne($sql, [$prepare_row => $vall[$row]], get_called_class());
    }

    public function insert()
    {               
        $data = $this->getData();
        $placeholder = implode(',', array_keys($this->prepare($data)));
        $columns = implode(',', array_keys($this->getData()));
        $sql = "INSERT IGNORE INTO {$this->table} ($columns) VALUES ($placeholder)";
        return $this->db->execute($sql, $this->prepare($data));
    }

    public function update()
    {
        $data = $this->getData();
        foreach(array_keys($data) as $arr){
            $placeholder[] = "$arr = :$arr";
        }

        $placeholder_str = implode((','), $placeholder);
        $data['id'] = $this->id;
        $sql = "UPDATE {$this->table} SET {$placeholder_str} WHERE id = :id";
        return $this->db->execute($sql, $this->prepare($data));
    }
    
    public function delete()
    {
        $id = $this->id;
        
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->db->execute($sql, [':id' => $id]);
    }

    public function customQuery($sql){
        return $this->db->queryAll($sql);
    }

    abstract function getTable();
    abstract function getData();

}
