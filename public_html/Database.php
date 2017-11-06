<?php
/**
 * Created by PhpStorm.
 * User: prubaj
 * Date: 06.11.17
 * Time: 12:09
 */

class Database
{
    private $name = "cars";
    private $user = "caruser";
    private $password = "carpassword";
    private $host = "127.0.0.1";
    public $dbh;

    public function __construct()
    {
        $dsn = 'mysql:dbname='.$this->name.';host='.$this->host;

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password);

        } catch (PDOException $e) {
            echo 'MySQL: Nie działa: '.$e->getMessage();
        }
    }

    public function checkIfExists($tableName, $column, $value)
    {
        $table = "";
        switch ($tableName) {
            case "color" : $table = "color";
                break;
            case "color" : $table = "color";
                break;
            case "color" : $table = "color";
                break;
            case "color" : $table = "color";
                break;
            case "color" : $table = "color";
                break;
        }


        $stmt = $this->dbh->prepare('SELECT * FROM '.$tableName.' WHERE '.$column.' = :value');
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);

        $stmt->execute();
        //print_r($stmt->errorInfo());
        print_r($stmt->fetchAll());
    }

}