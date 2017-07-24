<?

require('../Gallery.php');
$user = new Gallery();



$user->id = $id = $_POST['id'];
$user->comment = $comment = $_POST['comm'];
$user->updateComment();


