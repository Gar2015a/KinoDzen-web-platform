<?php
session_start();
require_once 'connect.php';
if ($_SESSION['user']['role'] != '1') {
    header("Location: index.php");
}
$reg = '/.(?:jp(?:e?g|e|2)|gif|png|tiff?|bmp|ico)$/i';
?>
<style>
    .form11 {
        background: #000000;
        color: #ffffff;
        border-radius: 10px;
        width: 57%;
        word-break: break-all;
        padding: 6px;
        border: 4px solid #ffffff;
        margin: 0 auto;
    }
    .button_rad {
        margin-bottom: 1%;
        text-decoration: none;
        font-size: 14px;
    }

    body {
        background-color: #1e1e1e;
        background-image: url(1y.gif);
        background-attachment: fixed;
        background-size: cover;
        height: 100%;
        font-family: "Raleway", sans-serif;
        letter-spacing: 1px;

        overflow-x:hidden;
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

    h3 {
        margin: 6px 4px 0px 10px;;
        letter-spacing: 5px;
        font-size: 15px;
        color: #29c5e6;;
    }

    .fon_top {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        border-radius: 5px;
    }

    nav {
        height: 63px;
        margin: 34px auto;
        background-color: rgba(0, 0, 0, 1);
        text-align: center;
        border-radius: 12px;
        border: 4px solid #ffffff;
        padding-top: 12px;
        width: 79vw;
    }

    a {
        color: #29c5e6;
        text-decoration: none;
    }

    a:hover {
        color: white;
    }

    h1:hover {
        color: #29c5e6;
    }

    p:hover {
        color: red;
    }

    h1 {
        margin: 6px 4px 0px 10px;;
        letter-spacing: 5px;
        font-size: 50px;
        color: #29c5e6;;
    }
    a{
        text-decoration: none;
        color: #29c5e6;
    }
    a:hover{
        color: #ffffee;
    }
    .button_back{
        margin-left: 7%;
    }
</style>
<head>
    <link rel="stylesheet" type="text/css" href="style/button.css">
</head>
<body>
<button class="button_back"style="position: fixed;"><a  href="account.php">Назад</a></button>
<div style="text-align: center;margin: 0 auto">
    <?php
    $resultTable = mysqli_query($connection, "SELECT * FROM `article`");
    while ($pr = mysqli_fetch_assoc($resultTable)) {
        if ($pr['visible'] == '0') {
            $resultMovie = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$pr'");
            $movies_id = mysqli_fetch_row($resultMovie); ?>
            <div class="form11">
                <a <a href="deleting%20a%20topic.php?table=<?= $pr['id'] ?>" style="float: right;"><h2
                            style="margin: 0">X</h2></a>
                <h1><?= $pr['title']; ?></h1>
                <div>
                    <h2 class="text"><?= $pr['text'] ?></h2>
                    <? if (preg_match($reg, $pr['image1']) != null && preg_match($reg, $pr['image2']) != null) {
                        ?>
                        <img width="49%" height="25%"" class="img" src="<?= $pr['image1'] ?>">
                        <img width="49%" height="25%" class="img" src="<?= $pr['image2'] ?>">
                    <? }
                    if (preg_match($reg, $pr['image1']) == null && preg_match($reg, $pr['image2']) == null) {
                        ?>
                        <iframe width="49%" height="25%" src="https://www.youtube.com/embed/<?= $pr['image1'] ?>"
                                frameborder="0" allowfullscreen></iframe>
                        <iframe width="49%" height="25%" src="https://www.youtube.com/embed/<?= $pr['image2'] ?>"
                                frameborder="0" allowfullscreen></iframe>
                    <? } ?>
                    <? if (preg_match($reg, $pr['image1']) != null && preg_match($reg, $pr['image2']) == null) {
                        ?>
                        <img width="49%" height="25%" class="img" src="<?= $pr['image1'] ?>">
                        <iframe width="49%" height="25%" src="https://www.youtube.com/embed/<?= $pr['image2'] ?>"
                                frameborder="0" allowfullscreen></iframe>
                    <? } ?>
                    <button><a href="approval.php?table=<?= $pr['id'] ?>">Разместить</a></button>
                    <button><a href="editing%20topics.php?table=<?= $pr['title'] ?>">Редактировать</a></button>
                </div>
            </div>
            <?
        }
    } ?>
</div>

</body>
