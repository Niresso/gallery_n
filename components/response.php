<?php

require('../Gallery.php');

$gallery = new Gallery();

if (!empty($_POST['date'])) { // sort date
    $a = $gallery->getPictures();

    function mysort($a, $b)
    {
        return strtotime($b['date']) - strtotime($a['date']);
    }

    usort($a, 'mysort');
    echo json_encode($a);

} elseif (!empty($_POST['size'])) { // sort size

    $a = $gallery->getPictures();
    function mysort($a, $b)
    {
        return ($b['size']) - ($a['size']);
    }

    usort($a, 'mysort');
    echo json_encode($a);
} elseif (!empty($_POST['recordToDelete'])) { // delete picture

    $id = filter_var($_POST["recordToDelete"], FILTER_SANITIZE_NUMBER_INT);
    $gallery->id = $id;
    $gallery->deletePicture();

} elseif (!empty($_POST['comm'])) { // update comment

    $gallery->id = $id = $_POST['id'];
    $gallery->comment = $comment = $_POST['comm'];
    $gallery->updateComment();

} elseif (!empty($_FILES['picture']['tmp_name'])) { // add picture

    $gallery->name = $_POST['name'];
    $gallery->comment = $_POST['comment'];
    $size = $gallery->size = $_FILES['picture']['size'];
    $gallery->type = array_pop(explode(".", @$_FILES['picture']['name']));
    $gallery->tmp = $_FILES['picture']['tmp_name'];
    $gallery->picturename = $_FILES['picture']['name'];
    $size_constant = 1000000;

    if (intval($size) <= $size_constant) {

        $gallery->addPictures();
        $gallery->checkPathImages();
        $result = [
            'id'=>$gallery->getTotalID()['id'],
            'date'=>$gallery->getTotalID()['date'],
            'format'=> $gallery->type,
            'comment'=>$_POST['comment'],
            'status' => 0,
        ];
        echo json_encode($result);
    } else {

        echo json_encode(['status' => 1]);
    }

}


?>