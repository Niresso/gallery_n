<?php
include "Gallery.php";
$user = new Gallery();
$gallery = $user->getPictures();



?>
<!doctype html>
<html lang="ru" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="#" />
    <meta name="description" content="#" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Online gallery</title>
    <link rel="stylesheet" href="/template/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/template/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/template/style/main.css">
    <script type="text/javascript" src="/template/script/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/template/bootstrap/js/bootstrap.min.js"></script>



</head>
    <body>
        <div class="jumbotron" >
            <div class="container">
                <h1>Онлайн галерея:</h1>
            </div>
        </div>

        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Меню</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="#" id="btn-sort-date">Сортировка по дате</a></li>
                            <li><a href="#" id="btn-sort-size">Сортировка по размеру</a></li>
                            <li><a href="#" id="btn-sort">Обновить</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right" id="btn-close">
                            <li><a href="#" id="btn-add-picture">Добавить изображение</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>

        <div class="container">
            <div id="add-pictures" >
                <form class="form-add-pictures" method="post" id="ajax_form" enctype="multipart/form-data" style="">
                    <div class="form-group" id="f1">
                        <label>Название картинки:</label>
                        <input type="text" class="form-control" name="name" id="exampleInputName" placeholder="Enter name">
                    </div>
                    <div class="form-group" id="f3">
                        <label>Файл:</label>
                        <input type="file" name="picture" id="exampleInputFile" max>
                    </div>
                    <div class="form-group" id="f2">
                        <label >Коментарий:</label>
                        <textarea class="form-control" name="comment" rows="3" id="exampleInputTextarea" title="0"></textarea>
                    </div>
                    <input type="submit" class="btn btn-default" name="submit" id="btn-add">
                </form>
            </div>
        </div>
        <script type="text/javascript" src="/template/script/common.js"></script>
        <div class="container">
            <div class="container">
                <div id="gallery" >
                    <? foreach ($gallery as $items):?>
                        <div class="col-lg-4" id="helped_<?= $items['id'] ;?>">
                            <div ><?= $items['date'] ;?></div>
                            <p><img src="/template/images/pic<?php echo $items['id'] ;?>.<?php echo $items['format'] ;?>" width="300" height="220" alt="" /></p>
                            <p><?= $items['comment'] ;?> </p><br />
                            <a href='#' class='btn btn-primary' id="del-<?= $items['id'] ;?>">Delete</a>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>

    </body>
</html>


