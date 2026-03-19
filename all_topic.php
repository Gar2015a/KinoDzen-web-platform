<?php
session_start();
require_once 'connect.php';
require_once 'Filter.php';
$result = mysqli_query($connection, "SELECT * FROM `movies`");
$resultTable = mysqli_query($connection, "SELECT * FROM `movies`");
$reg = '/.(?:jp(?:e?g|e|2)|gif|png|tiff?|bmp|ico)$/i';
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<style xmlns="http://www.w3.org/1999/html">
    body {
        color: #ffffff;
        font: 12px Tahoma, sans-serif;
        margin: 0;
        margin-top: 6px;
        background: url("фоны.gif");
        background-color: #000000;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    img {
        border: 0;
    }

    input[type="text"] {
        background-color: #f3f3f3;
        border: 1px solid #e7e7e7;
        height: 30px;
        color: black;
        padding: 0 10px;
        vertical-align: top;
    }
    #heading {
        margin: 30px 0;
        padding-left: 20px;
    }

    h1 {
        display: inline-block;
        color: #29c5e6;
        font: 40px/40px 'Oswald', sans-serif;
        margin: 0;
        padding: 0 10px;
    }

    #wrapper {
        margin: auto;
    }

    header {
        padding: 20px 0;
    }

    aside {
        float: left;

        width: 18vw;
    }

    aside > h2 {
        background: #29c5e6;
        font: 14px 'Oswald', sans-serif;
        color: #fff;
        padding: 10px;
        margin: 30px 0 0 0;
    }

    aside > p {
        background: #f3f3f3;
        border: 1px solid #e7e7e7;
        padding: 10px;
        margin: 0;
    }

    section {
        /*margin-left: 280px;*/
        /*padding-bottom: 50px;*/
        width: 100vw;
        float: right;
    }

    form[name="search"] {
        float: right;
    }

    footer {
        background-color: #7e7e7e;
    }

    nav a {
        text-decoration: none;
    }

    nav ul {
        margin: 0;
        padding: 0;
        padding-left: 5px;
    }

    nav li {
        list-style-position: inside;
        font: 17px 'Oswald', sans-serif;
        padding: 10px;
    }

    .top-menu li {
        display: inline-block;
        padding: 10px 30px;
        margin: 0;
    }

    .top-menu li.active {
        background: #29c5e6;
        color: #fff;
        border-radius: 12px;
    }

    .top-menu a {
        color: #29c5e6;
    }

    .aside-menu li {
        font-weight: 300;
        list-style-type: square;
        border-top: 1px solid #e7e7e7;
    }

    .aside-menu li:first-child {
        border: none;
    }

    .aside-menu li.active {
        color: #29c5e6;
    }

    .aside-menu a {
        color: #29c5e6;
    }

    blockquote {
        margin: 0;
        background: #29c5e6;
        padding: 10px 20px;
        font-family: 'Oswald', sans-serif;
        font-weight: 300;
    }

    blockquote p {
        color: #fff;
        font-style: italic;
        font-size: 33px;
        margin: 0;
    }

    blockquote cite {
        display: block;
        font-size: 20px;
        font-style: normal;
        color: #1d8ea6;
        margin: 0;
        text-align: right;
    }

    figure {
        display: inline-block;
        margin: 0;
        font-family: 'Oswald', sans-serif;
        font-weight: 300;
    }

    figure img {
        display: block;
        border: 1px solid #fff;
        outline: 1px solid #c9c9c9;
    }

    section > figure + figure {
        margin-left: 28px;
    }


    .form2 {
        padding-left: 14%;
        padding-right: 14%;
        color: #ffffff;
        width: 95%;
        word-break: break-all;
        margin-bottom: 15px;
        background: url("фон.jpg");
        background-color: #000000;
        background-repeat: no-repeat;
        background-position: center;
        border-radius: 20px;
        border: 1px solid #ffffff;
        background-size: 107% 178%;
    }

    input[type="radio"] {
        display: none;
    }

    .fon_top {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        border-radius: 15px;
        margin-top: 7px;
        margin-right: -14px;
        margin-bottom: 7px;
        margin-left: -14px;
    }

    a:hover {
        color: #ffffff;
        text-decoration: none;
    }

    input {
        background-color: rgba(23, 23, 50, 0.7);
    }

    .drop li {
        transform-origin: top center;
        position: absolute;
        z-index: 600;
        padding: 1px;
        text-align: center;
        border: 1px solid #ffffff
    }

    .drop li a {
        background-color: rgb(5, 0, 0);
        padding: 10px 6px;
    }

    .drop li p {
        background-color: rgba(23, 23, 50, 1);
        padding: 10px 0;
    }

    nav {
        background: #000000;
        border: 1px solid #ffffff;
    }

    .back-help {
        position: relative;
    }

    a {
        color: #29c5e6;
        text-decoration: none;
    }
    .search_result>li{
        position: absolute;
        display: block;
    }
    table.text {
        width: 100%; /* Ширина таблицы */
        border-spacing: 0; /* Расстояние между ячейками */
    }

    table.text td {
        width: 50%; /* Ширина ячеек */
        vertical-align: top; /* Выравнивание по верхнему краю */
    }

    td.rightcol { /* Правая ячейка */
        text-align: right; /* Выравнивание по правому краю */
    }
</style>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="stylesheet" type="text/css" href="style/style_radio.css">
    <link rel="stylesheet" type="text/css" href="style/for_movie.css">
    <link rel="stylesheet" type="text/css" href="style/button.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300" type="text/css">
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <title>КИНОДЗЕН</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <?require "serche.html"?>
</head>
<body>
<div id="wrapper">

    <aside>
        <nav style="border-radius: 10px;
    margin-top: 15px;
    margin-bottom: 25px;
    position: fixed;
    width: 18%;
    margin-left: 6px;">
            <ul class="aside-menu">
                <button style="width: 98%"><a href="account.php">Профиль</a></button>
                <h3>Статьи</h3>
                <ul onclick="tort()">
                    <label for="new" class="radio">
                        <input class="hidden" type="radio" name="radio_button" id="new" value="new" checked>
                        <span class="label"></span>Новые<br>
                    </label>
                    <label for="view" class="radio">
                        <input class="hidden" type="radio" name="radio_button" id="view" value="view">
                        <span class="label"></span>Просматриваемые<br>
                    </label>
                    <label for="old" class="radio">
                        <input class="hidden" type="radio" name="radio_button" id="old" value="old">
                        <span class="label"></span>Старые<br>
                    </label>
                    <label for="like" class="radio">
                        <input class="hidden" type="radio" name="radio_button" id="like" value="like">
                        <span class="label"></span>Понравившиеся<br>
                    </label>
                </ul>
            </ul>
        </nav>
    </aside>
    <section>
        <div id="new_theme" style="text-align: center;width: 60vw;margin: 0 auto">
            <?
            foreach ($new as $dbmame => $massiv){
                foreach ($massiv as $value){
                    $value_date=$value['name'];
                    $result = mysqli_query($connection, "SELECT * FROM `article` where title = '$value_date'");
                    while ($pr = mysqli_fetch_assoc($result)) {
                            $id_theme = $pr['id_topic'];
                            $resultTheme = mysqli_query($connection, "SELECT `theme` FROM `topic` where `id`= '$id_theme'");
                            $theme_id = mysqli_fetch_row($resultTheme);
                            $id_movies = $pr['id_movies'];
                            $resultMovie = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies'");
                            $movies_id = mysqli_fetch_row($resultMovie);
                            $id_movies2 = $pr['id_movies2'];
                            $resultMovie2 = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies2'");
                            $movies_id2= mysqli_fetch_row($resultMovie2);
                        if ($pr['visible'] == "1") {
                            $approval = "Одобрино";
                        }
                        if ($pr['visible'] == "0") {
                            $approval = "Не одобрено";
                        }
                            ?>
                            <div class="form2 fon <?= $theme_id[0] ?> <?= $movies_id[0] ?>" style="margin-top: 15px"
                                 name="<?= $theme_id[0] ?>">
                                <div class="fon_top" style="background-image:<? if ($pr['fon'] != '') {
                                    ?> url('<?=$pr['fon']?>')<? } else { ?>url('1155.jpg')<? } ?>">
                                    <div style="background-color: rgb(33 30 30 / 50%);}">
                                        <table class="text">
                                            <tr>
                                                <td class="rightcol"><h3 style="margin: 3px 10px 0px 0px"><?= $approval ?></h3>
                                                </td>
                                            </tr>
                                        </table>
                                        <div>
                                            <button><a style="padding: 0px 15px;margin: 0"
                                                       href="media.php?table=<?= $pr['title'] ?>"><?= $pr['title'] ?></a>
                                            </button>
                                        </div>
                                        <div>
                                            <h3 class="text"><?= $pr['text'] ?></h3>
                                            <h3>Просмотров: <?= $pr['view'] ?></h3>
                                            <button><a href="deleting%20a%20topic.php?table=<?= $pr['id'] ?>">Удалить</a></button>
                                            <button><a href="editing%20topics.php?table=<?= $pr['title'] ?>">Редактировать</a></button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?
                        }
                    }
            }
            ?>
        </div>
        <div id="old_theme" style="text-align: center;width: 60vw;margin: 0 auto;display: none">
            <?
            foreach ($old as $dbmame => $massiv){
                foreach ($massiv as $value){
                    $value_date=$value['name'];
                    $result = mysqli_query($connection, "SELECT * FROM `article` where title = '$value_date'");
                    while ($pr = mysqli_fetch_assoc($result)) {
                            $id_theme = $pr['id_topic'];
                            $resultTheme = mysqli_query($connection, "SELECT `theme` FROM `topic` where `id`= '$id_theme'");
                            $theme_id = mysqli_fetch_row($resultTheme);
                            $id_movies = $pr['id_movies'];
                            $resultMovie = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies'");
                            $movies_id = mysqli_fetch_row($resultMovie);
                            $id_movies2 = $pr['id_movies2'];
                            $resultMovie2 = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies2'");
                            $movies_id2= mysqli_fetch_row($resultMovie2);

                        if ($pr['visible'] == "1") {
                            $approval = "Одобрино";
                        }
                        if ($pr['visible'] == "0") {
                            $approval = "Не одобрено";
                        } ?>
                            <div class="form2 fon <?= $theme_id[0] ?> <?= $movies_id[0] ?>" style="margin-top: 15px"
                                 name="<?= $theme_id[0] ?>">
                                <div class="fon_top" style="background-image:<? if ($pr['fon'] != '') {
                                    ?> url('<?=$pr['fon']?>')<? } else { ?>url('1155.jpg')<? } ?>">
                                    <div style="background-color: rgb(33 30 30 / 50%);}">
                                        <table class="text">
                                            <tr>
                                                <td class="rightcol"><h3 style="margin: 3px 10px 0px 0px"><?= $approval ?></h3>
                                                </td>
                                            </tr>
                                        </table>
                                        <div>
                                            <button><a style="padding: 0px 15px;"
                                                       href="media.php?table=<?= $pr['title'] ?>"><?= $pr['title'] ?></a>
                                            </button>
                                        </div>
                                        <div>
                                            <h3 class="text"><?= $pr['text'] ?></h3>
                                            <h3>Просмотров: <?= $pr['view'] ?></h3>
                                            <h3>Тема: <?= $theme_id[0] ?></h3>
                                            <div>
                                                <?
                                                $id_movies = $pr['id_movies'];
                                                $resultMovie = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies'");
                                                $movies_id = mysqli_fetch_row($resultMovie);
                                                ?>
                                                <H3 STYLE="display: contents;">Фильм:</H3>
                                                <button><a style="padding: 2px 15px;"
                                                           href="movies.php?table=<?= $movies_id[0] ?>"><?= $movies_id[0] ?></a>
                                                </button>
                                                <?if($pr['id_movies2']!=''){?> <button><a style="padding: 2px 15px;"
                                                                                          href="movies.php?table=<?= $movies_id2[0] ?>"><?= $movies_id2[0] ?></a>
                                                    </button><?}?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?
                        }
                    }
            }
            ?>
        </div>
        <div id="view_theme" style="text-align: center;width: 60vw;margin: 0 auto;display: none">
            <?
            foreach ($famous as $dbmame => $massiv){
                foreach ($massiv as $value){
                    $value_date=$value['name'];
                    $result = mysqli_query($connection, "SELECT * FROM `article` where title = '$value_date'");
                    while ($pr = mysqli_fetch_assoc($result)) {
                            $id_theme = $pr['id_topic'];
                            $resultTheme = mysqli_query($connection, "SELECT `theme` FROM `topic` where `id`= '$id_theme'");
                            $theme_id = mysqli_fetch_row($resultTheme);
                            $id_movies2 = $pr['id_movies2'];
                            $resultMovie2 = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies2'");
                            $movies_id2= mysqli_fetch_row($resultMovie2);
                        if ($pr['visible'] == "1") {
                            $approval = "Одобрино";
                        }
                        if ($pr['visible'] == "0") {
                            $approval = "Не одобрено";
                        } ?>
                            <div class="form2 fon <?= $theme_id[0] ?> <?= $movies_id[0] ?>" style="margin-top: 15px"
                                 name="<?= $theme_id[0] ?>">
                                <div class="fon_top" style="background-image:<? if ($pr['fon'] != '') {
                                    ?> url('<?=$pr['fon']?>')<? } else { ?>url('1155.jpg')<? } ?>">
                                    <div style="background-color: rgb(33 30 30 / 50%);}">
                                        <table class="text">
                                            <tr>
                                                <td class="rightcol"><h3 style="margin: 3px 10px 0px 0px"><?= $approval ?></h3></td>
                                            </tr>
                                        </table>
                                        <div>

                                            <button><a style="padding: 0px 15px;"
                                                       href="media.php?table=<?= $pr['title'] ?>"><?= $pr['title'] ?></a>
                                            </button>
                                        </div>
                                        <div>
                                            <h3 class="text"><?= $pr['text'] ?></h3>
                                            <h3>Просмотров: <?= $pr['view'] ?></h3>
                                            <h3>Тема: <?= $theme_id[0] ?></h3>
                                            <div>
                                                <?
                                                $id_movies = $pr['id_movies'];
                                                $resultMovie = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies'");
                                                $movies_id = mysqli_fetch_row($resultMovie);

                                                $id_movies2 = $pr['id_movies2'];
                                                $resultMovie2 = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies2'");
                                                $movies_id2= mysqli_fetch_row($resultMovie2);
                                                ?>
                                                <div>
                                                    <H3 STYLE="display: contents;">Фильм:</H3>
                                                    <button><a style="padding: 2px 15px;" href="movies.php?table=<?= $movies_id[0] ?>"><?= $movies_id[0] ?></a></button><?if($pr['id_movies2']!=''){?> <button><a style="padding: 2px 15px;" href="movies.php?table=<?= $movies_id2[0] ?>"><?= $movies_id2[0] ?></a>
                                                        </button><?}?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?
                        }
                    }
            }
            ?>
        </div>
        <div id="like_theme" style="text-align: center;width: 60vw;margin: 0 auto;display: none">
            <?
            foreach ($like1 as $dbmame => $massiv){
                foreach ($massiv as $value){
                    $value_date=$value['name'];
                    $result = mysqli_query($connection, "SELECT * FROM `article` where title = '$value_date'");
                    while ($pr = mysqli_fetch_assoc($result)) {
                            $id_theme = $pr['id_topic'];
                            $resultTheme = mysqli_query($connection, "SELECT `theme` FROM `topic` where `id`= '$id_theme'");
                            $theme_id = mysqli_fetch_row($resultTheme);
                            $id_movies = $pr['id_movies'];
                            $resultMovie = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies'");
                            $movies_id = mysqli_fetch_row($resultMovie);
                            $id_movies2 = $pr['id_movies2'];
                            $resultMovie2 = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies2'");
                            $movies_id2= mysqli_fetch_row($resultMovie2);
                        if ($pr['visible'] == "1") {
                            $approval = "Одобрино";
                        }
                        if ($pr['visible'] == "0") {
                            $approval = "Не одобрено";
                        }?>
                            <div class="form2 fon <?= $theme_id[0] ?> <?= $movies_id[0] ?>" style="margin-top: 15px"
                                 name="<?= $theme_id[0] ?>">
                                <div class="fon_top" style="background-image:<? if ($pr['fon'] != '') {
                                    ?> url('<?=$pr['fon']?>')<? } else { ?>url('1155.jpg')<? } ?>">
                                    <div style="background-color: rgb(33 30 30 / 50%);}">
                                        <table class="text">
                                            <tr>
                                                <td class="rightcol"><h3 style="margin: 3px 10px 0px 0px"><?= $approval ?></h3></td>
                                            </tr>
                                        </table>
                                        <div>

                                            <button><a style="padding: 0px 15px;"
                                                       href="media.php?table=<?= $pr['title'] ?>"><?= $pr['title'] ?></a>
                                            </button>
                                        </div>
                                        <div>
                                            <h3 class="text"><?= $pr['text'] ?></h3>
                                            <h3>Просмотров: <?= $pr['view'] ?></h3>
                                            <h3>Тема: <?= $theme_id[0] ?></h3>
                                            <div>
                                                <?
                                                $id_movies = $pr['id_movies'];
                                                $resultMovie = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies'");
                                                $movies_id = mysqli_fetch_row($resultMovie);
                                                ?>
                                                <H3 STYLE="display: contents;">Фильм:</H3>
                                                <button><a style="padding: 2px 15px;"
                                                           href="movies.php?table=<?= $movies_id[0] ?>"><?= $movies_id[0] ?></a>
                                                </button>
                                                <?if($pr['id_movies2']!=''){?> <button><a style="padding: 2px 15px;"
                                                                                          href="movies.php?table=<?= $movies_id2[0] ?>"><?= $movies_id2[0] ?></a>
                                                    </button><?}?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?
                        }
                    }
            }
            ?>
        </div>
        <!-- Modal -->
        <div id="modal" class="modal modal__bg" role="dialog" aria-hidden="true">
            <div class="modal__dialog">
                <div class="modal__content">
                    <h1>Modal</h1>
                    <p>Church-key American Apparel trust fund, cardigan mlkshk small batch Godard mustache pickled
                        bespoke meh seitan. Wes Anderson farm-to-table vegan, kitsch Carles 8-bit gastropub paleo YOLO
                        jean shorts health goth lo-fi. Normcore chambray locavore Banksy, YOLO meditation master cleanse
                        readymade Bushwick.

                    </p>
                    <!-- modal close button -->
                    <a href="" class="modal__close demo-close">
                        <svg class="" viewBox="0 0 24 24">
                            <path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/>
                            <path d="M0 0h24v24h-24z" fill="none"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>
<script>

    function tort() {
        for (var i = 0; i < 4; i++) {
            if (document.getElementsByName("radio_button")[i].checked) {
                var type = document.getElementsByName("radio_button")[i].value;
            }
        }
        if (type == "new") {
            document.getElementById("new_theme").style.display = 'block';
            document.getElementById("view_theme").style.display = 'none';
            document.getElementById("old_theme").style.display = 'none';
            document.getElementById("like_theme").style.display = 'none';
        }
        if (type == "old") {
            document.getElementById("old_theme").style.display = 'block';
            document.getElementById("new_theme").style.display = 'none';
            document.getElementById("view_theme").style.display = 'none';
            document.getElementById("like_theme").style.display = 'none';
        }
        if (type == "view") {
            document.getElementById("view_theme").style.display = 'block';
            document.getElementById("new_theme").style.display = 'none';
            document.getElementById("old_theme").style.display = 'none';
            document.getElementById("like_theme").style.display = 'none';
        }
        if (type == "like") {
            document.getElementById("like_theme").style.display = 'block';
            document.getElementById("view_theme").style.display = 'none';
            document.getElementById("new_theme").style.display = 'none';
            document.getElementById("old_theme").style.display = 'none';
        }
    }

    document.addEventListener("click", function (e) {
        if (e.target.id == "Оммаж") {
            for (var i = 0; i < document.getElementsByName("Отсылка").length; i++) {
                document.getElementsByName("Отсылка")[i].style.display = 'none';
            }
            for (var i = 0; i < document.getElementsByName("Пародия").length; i++) {
                document.getElementsByName("Пародия")[i].style.display = 'none';
            }
            for (var i = 0; i < document.getElementsByName("Оммаж").length; i++) {
                document.getElementsByName("Оммаж")[i].style.display = 'block';
            }
        }
        if (e.target.id == "Пародия") {
            for (var i = 0; i < document.getElementsByName("Отсылка").length; i++) {
                document.getElementsByName("Отсылка")[i].style.display = 'none';
            }
            for (var i = 0; i < document.getElementsByName("Пародия").length; i++) {
                document.getElementsByName("Пародия")[i].style.display = 'block';
            }
            for (var i = 0; i < document.getElementsByName("Оммаж").length; i++) {
                document.getElementsByName("Оммаж")[i].style.display = 'none';
            }
        }
        if (e.target.id == "Отсылка") {
            for (var i = 0; i < document.getElementsByName("Отсылка").length; i++) {
                document.getElementsByName("Отсылка")[i].style.display = 'block';
            }
            for (var i = 0; i < document.getElementsByName("Пародия").length; i++) {
                document.getElementsByName("Пародия")[i].style.display = 'none';
            }
            for (var i = 0; i < document.getElementsByName("Оммаж").length; i++) {
                document.getElementsByName("Оммаж")[i].style.display = 'none';
            }
        }
        if (e.target.id == "RESET") {
            for (var i = 0; i < document.getElementsByClassName("form2").length; i++) {
                document.getElementsByClassName("form2")[i].style.display = 'block';
            }
        }
    })

    var Modal = (function () {
        var trigger = $qsa('.modal__trigger');
        var modals = $qsa('.modal');
        var modalsbg = $qsa('.modal__bg');
        var content = $qsa('.modal__content');
        var closers = $qsa('.modal__close');
        var w = window;
        var isOpen = false;
        var contentDelay = 400;
        var len = trigger.length;

        function $qsa(el) {
            return document.querySelectorAll(el);
        }

        var getId = function (event) {
            event.preventDefault();
            var self = this;
            // get the value of the data-modal attribute from the button
            var modalId = self.dataset.modal;
            var len = modalId.length;
            // remove the '#' from the string
            var modalIdTrimmed = modalId.substring(1, len);
            // select the modal we want to activate
            var modal = document.getElementById(modalIdTrimmed);
            // execute function that creates the temporary expanding div
            makeDiv(self, modal);
        };
        var makeDiv = function (self, modal) {
            var fakediv = document.getElementById('modal__temp');
            if (fakediv === null) {
                var div = document.createElement('div');
                div.id = 'modal__temp';
                self.appendChild(div);
                moveTrig(self, modal, div);
            }
        };
        var moveTrig = function (trig, modal, div) {
            var trigProps = trig.getBoundingClientRect();
            var m = modal;
            var mProps = m.querySelector('.modal__content').getBoundingClientRect();
            var transX, transY, scaleX, scaleY;
            var xc = w.innerWidth / 2;
            var yc = w.innerHeight / 2;
            trig.classList.add('modal__trigger--active');
            scaleX = mProps.width / trigProps.width;
            scaleY = mProps.height / trigProps.height;
            scaleX = scaleX.toFixed(3);
            scaleY = scaleY.toFixed(3);
            transX = Math.round(xc - trigProps.left - trigProps.width / 2);
            transY = Math.round(yc - trigProps.top - trigProps.height / 2);
            if (m.classList.contains('modal--align-top')) {
                transY = Math.round(mProps.height / 2 + mProps.top - trigProps.top - trigProps.height / 2);
            }
            trig.style.transform = 'translate(' + transX + 'px, ' + transY + 'px)';
            trig.style.webkitTransform = 'translate(' + transX + 'px, ' + transY + 'px)';
            div.style.transform = 'scale(' + scaleX + ',' + scaleY + ')';
            div.style.webkitTransform = 'scale(' + scaleX + ',' + scaleY + ')';
            window.setTimeout(function () {
                window.requestAnimationFrame(function () {
                    open(m, div);
                });
            }, contentDelay);
        };
        var open = function (m, div) {
            if (!isOpen) {
                var content = m.querySelector('.modal__content');
                m.classList.add('modal--active');
                content.classList.add('modal__content--active');
                content.addEventListener('transitionend', hideDiv, false);
                isOpen = true;
            }

            function hideDiv() {
                div.style.opacity = '0';
                content.removeEventListener('transitionend', hideDiv, false);
            }
        };
        var close = function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            var target = event.target;
            var div = document.getElementById('modal__temp');
            if (isOpen && target.classList.contains('modal__bg') || target.classList.contains('modal__close')) {
                div.style.opacity = '1';
                div.removeAttribute('style');
                for (var i = 0; i < len; i++) {
                    modals[i].classList.remove('modal--active');
                    content[i].classList.remove('modal__content--active');
                    trigger[i].style.transform = 'none';
                    trigger[i].style.webkitTransform = 'none';
                    trigger[i].classList.remove('modal__trigger--active');
                }
                div.addEventListener('transitionend', removeDiv, false);
                isOpen = false;
            }

            function removeDiv() {
                setTimeout(function () {
                    window.requestAnimationFrame(function () {
                        div.remove();
                    });
                }, contentDelay - 50);
            }
        };
        var bindActions = function () {
            for (var i = 0; i < len; i++) {
                trigger[i].addEventListener('click', getId, false);
                closers[i].addEventListener('click', close, false);
                modalsbg[i].addEventListener('click', close, false);
            }
        };
        var init = function () {
            bindActions();
        };
        return {
            init: init
        };
    }());
    Modal.init();
</script>
