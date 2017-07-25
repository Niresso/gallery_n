<?php

require('../Gallery.php');

$user = new Gallery();

if (!empty($_POST['update'])) { // sort update
    // Переводим массив в JSON
    echo json_encode($user->getPictures());

} elseif (!empty($_POST['date'])) { // sort date
    $a = $user->getPictures();

    function mysort($a, $b)
    {
        return strtotime($b['date']) - strtotime($a['date']);
    }

    usort($a, 'mysort');
    echo json_encode($a);

} elseif (!empty($_POST['size'])) { // sort size

    $a = $user->getPictures();
    function mysort($a, $b)
    {
        return ($b['size']) - ($a['size']);
    }

    usort($a, 'mysort');
    echo json_encode($a);
} elseif (!empty($_POST['recordToDelete'])) { // delete picture

    $id = filter_var($_POST["recordToDelete"], FILTER_SANITIZE_NUMBER_INT);
    $user->deletePicture($id);

} elseif (!empty($_POST['comm'])) { // update comment

    $user->id = $id = $_POST['id'];
    $user->comment = $comment = $_POST['comm'];
    $user->updateComment();

} elseif (!empty($_FILES['picture'])) { // add picture

    $user->name = $_POST['name'];
    $user->comment = $_POST['comment'];
    $size = $user->size = $_FILES['picture']['size'];
    $user->type = array_pop(explode(".", @$_FILES['picture']['name']));
    $user->tmp = $_FILES['picture']['tmp_name'];
    $user->picturename = $_FILES['picture']['name'];
    $size_constant = 1000000;

    if (intval($size) <= $size_constant) {

        $user->addPictures();
        $user->checkPathImages();
        echo json_encode(['status' => 0]);
    } else {

        echo json_encode(['status' => 1]);
    }

}


?>