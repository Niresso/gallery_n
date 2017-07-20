<?php


class Gallery
{
    public $name;
    public $size = 1000000;
    public $format  = array('image/jpg', 'image/png', 'image/jpeg');
    public $comment;
    public $type;
    public $path = 'template/images/';




    public function checkTypePicture(){

        if (in_array($_FILES['picture']['type'], $this->format)){
            return true;
        }
        return false;
    }
    public function checkSizePicture(){

        if ($_FILES['film']['size'] <= $this->size){
            return true;
        }
        return false;
    }
    public function getConnection()
    {
        $params =  array(
            'host' => 'localhost',
            'dbname' => 'gallery',
            'user' => 'root',
            'password' => '',
        );

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        return $db;
    }
    /**
     * @return array
     */
    public function getPictures(){

        $db = $this->getConnection();
        $gallery = array();
        $sql = 'SELECT * FROM pictures ORDER BY id DESC';
        @$result = $db->query($sql);

        $i = 0;
        while($row = $result->fetch( )) {
            $gallery[$i] = $row;
            $i++;
        }
        return  $gallery;
    }

    public static function getPicturesjson(){

        $params =  array(
            'host' => 'localhost',
            'dbname' => 'gallery',
            'user' => 'root',
            'password' => '',
        );

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        $gallery = array();
        $sql = 'SELECT * FROM pictures ORDER BY id DESC';
        @$result = $db->query($sql);

        $i = 0;
        while($row = $result->fetch( )) {
            $gallery[$i] = $row;
            $i++;
        }
        return  $gallery;
    }
    /**
     * @return bool
     */
    public function addPictures(){

        $db = $this->getConnection();
            $result = $db->prepare('INSERT INTO pictures (name,format,size,comment) VALUE (?,?,?,?)');
        $result->bindParam(1,$this->name);
        $result->bindParam(2,$this->type);
        $result->bindParam(3,$this->size);
        $result->bindParam(4,$this->comment);

        return  $result->execute();
    }


    /**
     * @return mixed
     */
    public function getTotalID(){

        $db = $this->getConnection();
        $TotalID = array();
        $result = $db->query('SELECT id FROM pictures ORDER BY id DESC LIMIT  1 ');
        $i = 0;
        while($row = $result->fetch( )) {
            $TotalID[$i]['id'] = $row['id'];
            $i++;
        }
        return @$TotalID[0]['id'];
    }

    /**
     * @return bool
     */
    public function checkPathImages(){
        $tmp_name = 'pic'.$this->getTotalID().'.'.$this->type;
        if (@copy($_FILES['picture']['tmp_name'], $this->path . $_FILES['name'].$tmp_name)){
            return true;
        }
        return false;
    }
    public function deletePicture($id){
        $id = intval($id);

        $db = $this->getConnection();
        $sql = "DELETE FROM pictures WHERE id =:id ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id',$id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;

    }



}