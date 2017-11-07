<?php
/**
 * Created by PhpStorm.
 * User: prubaj
 * Date: 07.11.17
 * Time: 10:35
 */

class BaseModel
{
    protected $id;
    protected $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

}