<?php
/**
 * Created by PhpStorm.
 * User: prubaj
 * Date: 07.11.17
 * Time: 13:29
 */

class Image
{
    private $id;
    private $fileName;


    public function __construct($id, $fileName)
    {
        $this->id = $id;
        $this->fileName = $fileName;
    }


    public static function fileUpload($rawFile, $path, Database $db) {
        $fileName = time().'_'.basename($rawFile['image_path']['name']);
        $uploadFile = $path.$fileName;

        if (move_uploaded_file($rawFile['image_path']['tmp_name'], $uploadFile)) {
            //echo "File is valid, and was successfully uploaded.\n";
            $image = Image::saveToDb($fileName, $db);
            return new self($image['id'], $image['fileName']);
        } else {
            echo "Possible file upload attack!\n";
        }
    }

    public static function saveToDb($fileName, Database $db) {
        $datetime = date('Y-m-d G:i:s');
        $stmt = $db->dbh->prepare("INSERT INTO image (path, added) VALUES (:file, :datetime)");
        $stmt->bindParam(':file', $fileName);
        $stmt->bindParam(':datetime', $datetime);
        $stmt->execute();
        $img['fileName'] = $fileName;
        $img['id'] = $db->dbh->lastInsertId();
        return $img;
    }

    public function getId() {
        return $this->id;
    }

    public function getFileName() {
        return $this->fileName;
    }

}