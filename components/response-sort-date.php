<?php

require_once ('../Gallery.php');

$a = Gallery::getPicturesjson();

function mysort($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
}

usort($a, 'mysort');

    // Переводим массив в JSON
echo json_encode($a);

?>