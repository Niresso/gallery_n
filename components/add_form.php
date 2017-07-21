<?php
require('../Gallery.php');
$user = new Gallery();

$user->name = $_POST['name'];
$user->comment = $_POST['comment'];
$size = $user->size = $_FILES['picture']['size'];
$user->type = array_pop(explode(".",@$_FILES['picture']['name']));
$user->tmp =  $_FILES['picture']['tmp_name'];
$size_constant = 1000000;

if (intval($size) <= $size_constant){

    $user->addPictures() ;
    $user->checkPathImages();
    echo json_encode(['status'=>0]);
}else{

    echo json_encode(['status'=>1]);
}



