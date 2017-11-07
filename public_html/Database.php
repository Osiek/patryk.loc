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
        $dsn = 'mysql:dbname='.$this->name.';charset=utf8;host='.$this->host;

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password);

        } catch (PDOException $e) {
            echo 'MySQL: '.$e->getMessage();
        }
    }

    public function getRowIdFromRecordIfExists($tableName, $column, $value)
    {
        $table = "";
        switch ($tableName) {
            case "color" : $table = "color";
                break;
            case "equipment" : $table = "equipment";
                break;
            case "make" : $table = "make";
                break;
            case "model" : $table = "model";
                break;
            case "version" : $table = "version";
                break;
        }


        $stmt = $this->dbh->prepare('SELECT id, '.$column.' FROM '.$table.' WHERE '.$column.' = :value LIMIT 1');
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);

        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $rows = $stmt->fetchAll();
            return $rows[0];
        } else {
            return false;
        }

    }

    public function getRowNameFromId($tableName, $id) {
        $table = "";
        switch ($tableName) {
            case "color" : $table = "color";
                break;
            case "equipment" : $table = "equipment";
                break;
            case "make" : $table = "make";
                break;
            case "model" : $table = "model";
                break;
            case "version" : $table = "version";
                break;
        }


        $stmt = $this->dbh->prepare('SELECT id, name FROM '.$table.' WHERE id = :value LIMIT 1');
        $stmt->bindParam(':value', $id);

        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $rows = $stmt->fetchAll();
            return $rows[0];
        } else {
            return false;
        }
    }

}