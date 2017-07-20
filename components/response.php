<?php

require_once ('../Gallery.php');

$picture = Gallery::getPicturesjson();

    // Переводим массив в JSON
    echo json_encode($picture);

?>