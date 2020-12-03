<?php
namespace app\services;

use app\traits\Singleton;

class Db{

    use Singleton;

    private $connection = null;

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'db' => 'rgsu',
        'login' => 'root',
        'password' => 'root',
        'charset' => 'utf8'
    ];

    private function getDsnString()
    {
        return sprintf(
            '%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['db'],
            $this->config['charset']
        );
    }

    protected function getConnection()
    {
        if(is_null($this->connection)){
            $this->connection = new \PDO(
                $this->getDsnString(),
                $this->config['login'],
                $this->config['password']
            );
            return $this->connection;
        }
        return $this->connection;
    }

    /*public function lastId(){
        return $this->getConnection()->lastInsertId();
    }*/

    protected function query(string $sql, array $params = [])
    {   
        $this->getConnection()->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    public function queryAll(string $sql, array $params = [], $className = null)
    {
        $query = $this->query($sql, $params);
        if(isset($className)){
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $className);
        }
        return $query->fetchAll();
    }
    public function queryOne(string $sql, array $params = [], $className = null)
    {
        return $this->queryAll($sql, $params, $className)[0];
    
    }

    public function execute(string $sql, array $params = []) : int
    {
        return $this->query($sql, $params)->rowCount();
    }
}