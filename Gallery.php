<?php


class Gallery
{
    public $name;
    public $size;
    public $format = array('image/jpg', 'image/png', 'image/jpeg');
    public $comment;
    public $type;
    public $path = '../template/images/';
    public $id;
    public $tmp;

    public function getConnection()
    {
        $params = array(
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
    public function getPictures()
    {

        $db = $this->getConnection();
        $gallery = array();
        $sql = 'SELECT * FROM pictures ORDER BY id DESC';
        @$result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch()) {
            $gallery[$i] = $row;
            $i++;
        }
        return $gallery;
    }

    /**
     * @return bool
     */
    public function addPictures()
    {

        $db = $this->getConnection();
        $sql = 'INSERT INTO pictures (name,format,size,comment) VALUE (?,?,?,?)';
        $result = $db->prepare($sql);
        $result->bindParam(1, htmlspecialchars($this->name));
        $result->bindParam(2, $this->type);
        $result->bindParam(3, $this->size);
        $result->bindParam(4, htmlspecialchars($this->comment));

        return $result->execute();
    }

    /**
     * @return mixed
     */
    public function getTotalID()
    {

        $db = $this->getConnection();
        $result = $db->query('SELECT * FROM pictures ORDER BY id DESC LIMIT  1 ');

        return $result->fetch();
    }

    /**
     * @return bool
     */
    public function checkPathImages()
    {
        $tmp_name = 'pic' . $this->getTotalID()['id'] . '.' . $this->type;
        if (@copy($this->tmp, $this->path . $tmp_name)) {
            return true;
        }
        return false;
    }

    public function deletePicture()
    {
        $id = intval($this->id);

        $db = $this->getConnection();
        $sql = "DELETE FROM pictures WHERE id =:id ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;

    }

    public function updateComment()
    {

        $db = $this->getConnection();
        $sql = "UPDATE pictures SET comment = ? WHERE id = ?";
        $result = $db->prepare($sql);
        $result->bindParam(1, htmlspecialchars($this->comment));
        $result->bindParam(2, $this->id);
        return $result->execute();
    }

}