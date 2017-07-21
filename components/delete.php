<?

require('../Gallery.php');
$user = new Gallery();

    // очищаем значение переменной, PHP фильтр FILTER_SANITIZE_NUMBER_INT
    // Удаляет все символы, кроме цифр и знаков плюса и минуса

$id = filter_var($_POST["recordToDelete"],FILTER_SANITIZE_NUMBER_INT);
$user->deletePicture($id);
//try deleting record using the record ID we received from POST
