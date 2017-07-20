<?php

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
    <div id="add-pictures">

    </div>
</div>

</body>
</html>


