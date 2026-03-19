<?
session_start();
require_once 'connect.php';
$userId = $_SESSION['user']['id'];
$topic = trim($_GET['table']);
$topic = htmlspecialchars($topic);
$view = $connection->prepare("SELECT `id` FROM article where `title`=?");
$view->bind_param('s', $topic);
$view->execute();
$view1 = $view->get_result();
$vie = mysqli_fetch_row($view1);
$pql = $connection->prepare("SELECT count(*) FROM view WHERE `id_user` = ? AND `id_article` = ?");
$pql->bind_param('ii', $userId, $vie[0]);
$pql->execute();
$pql1 = $pql->get_result();
$result_view = mysqli_fetch_row($pql1);
if ($result_view[0] == 0) {
    $pq = $connection->prepare("INSERT INTO `view` (`id_user`,`id_article`) VALUES (?,?)");
    $pq->bind_param('ii', $userId, $vie[0]);
    $pq->execute();
    $sql = $connection->prepare("update `article` set `view`=`view`+ 1 where `title`=?");
    $sql->bind_param('s', $topic);
    $sql->execute();
}
$reg = '/.(?:jp(?:e?g|e|2)|gif|png|tiff?|bmp|ico)$/i';
$resultTable = mysqli_query($connection, "SELECT * FROM `movies`");
$result_bar = $connection->prepare("SELECT * FROM `article` where `title`=?");
$result_bar->bind_param('s', $topic);
$result_bar->execute();
$kk = $result_bar->get_result();
while ($Yes_No = mysqli_fetch_assoc($kk)) {
    $kolvo_Yes = $Yes_No['yes'];
    $kolvo_No = $Yes_No['no'];
    $all = $kolvo_Yes + $kolvo_No;
}
$resultTitle = $connection->prepare("SELECT * FROM `article` where `title`=?");
$resultTitle->bind_param('s', $topic);
$resultTitle->execute();
$user_cek = 0;
if ($_SESSION['user'] != null) {
    $user_cek = 1;
}
json_encode($user_cek);
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="style/o.css">
<script src="/js/jquery-1.8.3.min.js"></script>
<style xmlns="http://www.w3.org/1999/html">
    .one_news span:hover {
        border: 1px solid;
    }

    .one_news span {
        border: 2px solid #292929;
        outline: 2px solid #e3e3e3;
        display: inline-block;
        color: #050a0a;
        font-family: sans-serif;
        font-weight: 600;
        font-size: 20px;
        background: white;
        margin: 6px;
        cursor: pointer;
    }

    .img_like {
        width: inherit;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .navbar li a, .navbar .navbar-brand {
        color: #d5d5d5 !important;
    }

    .navbar-nav li a:hover {
        color: #ef0808 !important;
    }

    .navbar-nav li.active a {
        color: #be2121 !important;
        background-color: #29292c !important;
    }

    .navbar-default {
        border-color: transparent;
    }

    .img {
        width: 100%;
        height: 200px;
    }

    h2 {
        font-family: 'Times New Roman', Times, serif; /* Гарнитура текста */
        font-size: 250%;
    }

    @media (max-width: 1279px) {
        .media {
            padding: 0px 20px 0px;
            padding-top: 0px;
            padding-right: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
            text-align: -webkit-center;
        }
    }

    .media {
        padding: 0px 20px 0px;
        padding-top: 0px;
        padding-right: 0px;
        padding-bottom: 0px;
        padding-left: 0px;
        text-align: -webkit-center;
    }
</style>
<!DOCTYPE HTML>
<style xmlns="http://www.w3.org/1999/html">
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }


    ul {
        list-style: none;
    }

    nav {
        height: 42px;
        margin-top: 6px;
        margin-bottom: 25px;
        background-color: rgba(0, 0, 0, 1);
        text-align: center;
        border-radius: 4px;
        border: 1px solid #ffffff;
    }

    .main {
        display: flex;
        justify-content: center;
    }

    .main > li {
        margin: 0 6%;
    }

    .main > li a {
        border-left: 1px solid rgb(0, 0, 0);
    }

    a, input {
        text-decoration: none;
        color: #fff;
        text-transform: capitalize;
        font-family: monospace;
        display: block;
        padding: 10px 15px;
        transition: background-color 0.5s ease-in-out;
        font-family: "Raleway", sans-serif;
    }

    a:hover {
        color: #ffffee;
        text-decoration: none;
    }

    input {
        background-color: rgba(0, 0, 0, 1);
        width: 400px;
        line-height: normal;
    }

    .drop li {

        transform-origin: top center;
    }

    .drop li a, .drop li input {
        background-color: rgba(0, 0, 0, 0.7);
        padding: 10px 0;
        text-align: center;
    }

    /*------------- menu1 animation -------------------*/
    .main li:hover .menu1 li:first-of-type {
        animation: menu1 0.3s ease-in-out forwards;
        animation-delay: 0.3s;
    }

    .main li:hover .menu1 li:nth-of-type(2) {
        animation: menu1 0.3s ease-in-out forwards;
        animation-delay: 0.6s;
    }

    .main li:hover .menu1 li:nth-of-type(3) {
        animation: menu1 0.3s ease-in-out forwards;
        animation-delay: 0.9s;
    }

    .main li:hover .menu1 li:last-of-type {
        animation: menu1 0.3s ease-in-out forwards;
        animation-delay: 1.2s;
    }

    @keyframes menu1 {
        from {
            opacity: 0;
            transform: translateX(30px) rotateY(90deg);
        }
        to {
            opacity: 1;
            transform: translateX(0) rotateY(0);
        }
    }

    /* my button style */
    .white-mode {
        text-decoration: none;
        padding: 7px 10px;
        background-color: #122;
        border-radius: 3px;
        color: #fff;
        transition: 0.35s ease-in-out;
        position: absolute;
        left: 15px;
        bottom: 15px;
        font-family: sans-serif;
    }

    .white-mode:hover {
        background-color: #fff;
        color: #122;
    }

    .form2 {
        padding-left: 16%;
        padding-right: 16%;
        padding-bottom: 3%;
        background-color: #2851c3;
        color: #ffffff;
        width: 100%;
        word-break: break-all;
        margin-bottom: 15px;
        background: url("фон.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        border-radius: 20px;
        border: 1px solid #ffffff;
        background-size: 107% 115%;
    }

    h1 {
        font-size: 38px;
        font-weight: 500;
        line-height: 44px;
        text-align: center;
        margin-bottom: 18px;
        text-align: center;
        color: #29b5ca;
        padding-top: 20px;
    }

    body {
        background-color: #1e1e1e;
        background-image: url(tumb.gif);
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
        letter-spacing: 1px;
    }



    #greyProgress {
        width: 100%;
        background-color: #626d71;
        border-radius: 10px;
        display: flex;
        border: 2px solid #000000;
    }

    #greenBar {
        height: 30px;
        background-color: #cdcdc0;
        text-align: center;
        line-height: 30px;
        color: #0e0606;
        border-radius: 10px;
    }

    #redBar {
        height: 30px;
        background-color: #626d71;
        text-align: center;
        line-height: 30px;
        color: white;
        border-radius: 10px;
    }

    #wrapper {
        max-width: 960px;
        margin: auto
    }

    a:hover {
        color: #29c5e6;
    }

    h4 {
        margin-top: 19px;
        margin-bottom: 0px;
        font-family: inherit;
        font-weight: 500;
        line-height: 1.8;
        font-size: 25px;
    }

    .view {
        width: 50%;
        height: 200px
    }
</style>
<script>
    var cek = <?=$user_cek?>;

    function setVote(type, element) {
        // получение данных из полей
        var id_topic = document.getElementById("id_topic").value;
        var id_user = document.getElementById("id_user").value;
        $.ajax({
            // метод отправки
            type: "POST",
            // путь до скрипта-обработчика
            url: "ajax_topic.php",
            // какие данные будут переданы
            data: {
                'id_topic': id_topic,
                'type': type,
                'user': id_user
            },
            // тип передачи данных
            dataType: "json",
            // действие, при ответе с сервера
            success: function (data) {
                // в случае, когда пришло success. Отработало без ошибок
                if (data.result == 'success' && cek == 1) {
                    // увеличим визуальный счетчик
                    if (bt == 'like') {
                        var count = parseInt(document.getElementById(bt).innerHTML);
                        document.getElementById(bt).innerHTML = count + 1;
                    }
                    if (bt == 'dislike') {
                        var count = parseInt(document.getElementById(bt).innerHTML);
                        document.getElementById(bt).innerHTML = count + 1;
                    }
                } else {
                    // вывод сообщения об ошибке
                    var bop = data.msg;
                    if ((bt == 'like' && bop == 'dislike') || (bt == 'dislike' && bop == 'like') && cek == 1) {
                        var count = parseInt(document.getElementById(bt).innerHTML);
                        document.getElementById(bt).innerHTML = count + 1;
                        var count2 = parseInt(document.getElementById(bop).innerHTML);
                        document.getElementById(bop).innerHTML = count2 - 1;
                    }
                }
            }
        });
    }

    function setYes(type, element) {
        // получение данных из полей
        var id_topic = document.getElementById("id_topic").value;
        var id_user = document.getElementById("id_user").value;
        $.ajax({
            // метод отправки
            type: "POST",
            // путь до скрипта-обработчика
            url: "ajax_Yes_No.php",
            // какие данные будут переданы
            data: {
                'id_topic': id_topic,
                'type': type,
                'user': id_user
            },
            // тип передачи данных
            dataType: "json",
            // действие, при ответе с сервера
            success: function (data) {
                // в случае, когда пришло success. Отработало без ошибок
                if (data.result == 'success' && cek == 1) {
                    // увеличим визуальный счетчик
                    if (el == 'yes') {
                        var count = parseInt(document.getElementById(el).innerHTML);
                        document.getElementById(el).innerHTML = count + 1;
                    }
                    if (el == 'no') {
                        var count = parseInt(document.getElementById(el).innerHTML);
                        document.getElementById(el).innerHTML = count + 1;
                    }
                } else {
                    var top = data.msg;
                    if ((el == 'yes' && top == 'no') || (el == 'no' && top == 'yes') && cek == 1) {
                        var count = parseInt(document.getElementById(el).innerHTML);
                        document.getElementById(el).innerHTML = count + 1;
                        var count2 = parseInt(document.getElementById(top).innerHTML);
                        document.getElementById(top).innerHTML = count2 - 1;
                    }
                }
            }
        });
    }
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>КИНОДЗЕН</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style/button.css">
    <link rel="stylesheet" type="text/css" href="style/media_photo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?require "serche.html"?>
</head>
<body id="wrapper" style="text-align:center">

<nav>
    <ul class="main">
        <li>
            <a href="index.php">Главная</a>
        </li>
        <li style="text-align:left "><input class="who" type="text" id="mySearch" onkeyup="myFunction(),display()"
                                            placeholder="Поиск..">
            <ul class="search_result" style="display: none" id="myMenu">
            </ul>
        </li>
        <? if (!$_SESSION['user']) { ?>
            <li><a href="authorization.php">Войти</a></li>
        <? } else { ?>
            <li><a href="account.php">Профиль</a></li><? } ?>
    </ul>
</nav>
<div class="media">
    <?php
    $result = $resultTitle->get_result();
    while ($pr = mysqli_fetch_assoc($result)){
    ?>
    <div class="form2 fon" style="background-color: dimgrey;">
        <h1><?= $pr['title'] ?></h1>
        <hr/>
        <div style="width: 100%">
            <h4 class="text"><?= $pr['text'] ?></h4>
            <hr/>
            <div>
                <h2 style=" color: #29b5ca;">Похожи?</h2>
                <div class="one_news">
                    <input type="hidden" id="id_user_choise" value="<?= $userId ?>"/>
                    <span style="background-color: #cdcdc0; padding: 4px;" class="yes_no" id="yes1">
                                    Да(<b id="yes"><?= $pr['yes'] ?></b>)
                                </span>
                    <span style="background-color: #cdcdc0;padding:4px;" class="yes_not" id="no1">
                                    Нет(<b id="no"><?= $pr['no'] ?></b>)
                                </span>
                    <input type="hidden" id="id_topic" value="<?= $pr['id'] ?>"/>
                </div>
                <br>
                <div <? if ($pr['yes'] == '0' && $pr['no'] == '0'){ ?> style="display: none">
                    <div id="greyProgress">
                        <div id="greenBar" style="width: <?= $pr['yes'] / $all * 100 ?>%;">
                            <b><?= round($pr['yes'] / $all * 100, 2) ?>%</b></div>
                        <div id="redBar" style="width: <?= $pr['no'] / $all * 100 ?>%;">
                            <b><?= round($pr['no'] / $all * 100, 2) ?>%</b></div>
                    </div>
                </div><?
                }else{ ?>
                <div>
                    <div id="greyProgress">
                        <div id="greenBar"
                             style="<? if ($pr['yes'] == '0') { ?>display: none;<? } ?>;width: <?= $pr['yes'] / $all * 100 ?>%;">
                            <b><?= round($pr['yes'] / $all * 100, 2) ?>%</b></div>
                        <div id="redBar"
                             style="<? if ($pr['no'] == '0') { ?>display: none;<? } ?>width:<?= $pr['no'] / $all * 100 ?>%;">
                            <b><?= round($pr['no'] / $all * 100, 2) ?>%</b></div>
                    </div><?
                    } ?>
                </div>
            </div>
            <? if (preg_match($reg, $pr['image1']) != null && preg_match($reg, $pr['image2']) != null) { ?>
                <div style="display: flex">
                    <div class="photobox photobox_rounded">
                        <div class="photobox__previewbox media-placeholder">
                            <img width="100%" height="200px" class="img" src="<?= $pr['image1'] ?>"
                                 class="photobox__preview media-placeholder__media" alt>
                        </div>
                        <div class="photobox__info-wrapper">
                            <div class="photobox__info"><span><?= $pr['image1_text'] ?></span></div>
                        </div>
                    </div>
                    <div class="photobox photobox_rounded">
                        <div class="photobox__previewbox media-placeholder">
                            <img width="100%" height="200px" class="img" src="<?= $pr['image2'] ?>"
                                 class="photobox__preview media-placeholder__media" alt>
                        </div>
                        <div class="photobox__info-wrapper">
                            <div class="photobox__info"><span><?= $pr['image2_text'] ?></span></div>
                        </div>
                    </div>
                </div>
            <? }
            if (preg_match($reg, $pr['image1']) == null && preg_match($reg, $pr['image2']) == null) { ?>
                <div style="display: flex">
                    <iframe class="view" src="https://www.youtube.com/embed/<?= $pr['image1'] ?>" frameborder="0"
                            allowfullscreen></iframe>
                    <iframe class="view" src="https://www.youtube.com/embed/<?= $pr['image2'] ?>" frameborder="0"
                            allowfullscreen></iframe>
                </div>
            <? } ?>
            <? if (preg_match($reg, $pr['image1']) != null && preg_match($reg, $pr['image2']) == null) { ?>
                <div style="display: flex;
                        justify-content: center;width: 100%;">
                    <div class="photobox photobox_rounded">
                        <div class="photobox__previewbox media-placeholder">
                            <img class="img " src="<?= $pr['image1'] ?>"
                                 class="photobox__preview media-placeholder__media" alt>
                        </div>
                        <div class="photobox__info-wrapper">
                            <div class="photobox__info"><span><?= $pr['image1_text'] ?></span></div>
                        </div>
                    </div>
                    <iframe class="view" src="https://www.youtube.com/embed/<?= $pr['image2'] ?>" frameborder="0"
                            allowfullscreen></iframe>
                </div>
            <? } ?>
            <div>
                <div class="one_news">
                    <input type="hidden" id="id_user" value="<?= $userId; ?>"/>
                    <div class="con-tooltip bottom">
                                    <span class="img_like">
                                        <img id="like2" width="100px" src="li.jpg">
                                    </span>
                        <div class="tooltip">
                            <p><b id="like"><?= $pr['like'] ?></b></p>
                        </div>
                    </div>
                    <div class="con-tooltip bottom">
                                <span class="img_like">
                                    <img id="dislike2" width="100px" src="dis.jpg">
                                </span>
                        <div class="tooltip ">
                            <p><b id="dislike"><?= $pr['dislike'] ?></b></p>
                        </div>
                    </div>
                    <input type="hidden" id="id_topic" value="<?= $pr['id']; ?>"/>
                </div>
            </div><?
            $id_movies = $pr['id_movies'];
            $resultMovie = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies'");
            $movies_id = mysqli_fetch_row($resultMovie);

            $id_movies2 = $pr['id_movies2'];
            $resultMovie2 = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies2'");
            $movies_id2= mysqli_fetch_row($resultMovie2);
            ?>
            <H3 STYLE="display: contents;">Фильм:</H3>
            <button><a style="padding: 2px 15px;" href="movies.php?table=<?= $movies_id[0] ?>"><?= $movies_id[0] ?></a>
            </button>
            <?if($pr['id_movies2']!=''){?> <button><a style="padding: 2px 15px;"
                                                      href="movies.php?table=<?= $movies_id2[0] ?>"><?= $movies_id2[0] ?></a>
                </button><?}?>
        </div>
    </div>

</div>
<?
}
?>
</div>
</div>
</body>
</html>
<script>
    var el = "";
    var bt = "";
    document.addEventListener("click", function (e) {

        if (e.target.id == "like2") {
            bt = 'like';
            setVote('like', document.getElementById('like'));
        }
        if (e.target.id == "dislike2") {
            bt = 'dislike';
            setVote('dislike', document.getElementById('dislike'));
        }
        if (e.target.id == "yes1") {
            el = 'yes';
            setYes('yes', document.getElementById('yes1'));
        }
        if (e.target.id == "no1") {
            el = 'no'
            setYes('no', document.getElementById('no1'));
        }
    })

    function myFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("mySearch");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myMenu");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

    function display() {
        var input, filter, ul, li, a, i;
        ul = document.getElementById("myMenu");
        li = ul.getElementsByTagName("li");
        if (document.getElementById('mySearch').value == '') {
            document.getElementById('myMenu').style.display = 'none';
        } else {
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                a.style.display = 'block';
            }
            document.getElementById('myMenu').style.display = 'block';
        }
    }
</script>

