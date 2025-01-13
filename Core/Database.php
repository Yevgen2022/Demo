<?php


namespace Core;

use PDO;
class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = '')
    {

        /*$config = [
            'host' => 'localhost',
            'port' => 3306,
            'dbname' => 'demo',
            'charset' => 'utf8mb4',
        ];*/

        $dsn = 'mysql:' . http_build_query($config, '', ';');  //example.com?host=localhost&port=3306&dbname=demo

        //$dsn = "mysql:host={$config['host']}; port={$config['port']}; dbname={$config['dbname']}; charset={$config['charset']}";
        //$pdo = new PDO($dsn);

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {


//        $statement = $pdo->prepare($query);
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

//        return $statement->fetch(PDO::FETCH_ASSOC);
//        return $statement;
        return $this;
    }


    public function get(){
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (!$result) {
            abort();
        }
        return $result;
    }


}