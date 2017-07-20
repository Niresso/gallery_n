<?php

require_once ('../Gallery.php');

$a = Gallery::getPicturesjson();

function mysort($a, $b) {
    return ($b['size']) - ($a['size']);
}

usort($a, 'mysort');

    // Переводим массив в JSON
    echo json_encode($a);

?>