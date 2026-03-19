<?php
session_start();
if ($_SESSION['user'] == '') {
    echo '<script>window.location.href = "account.php";</script>';
}
require_once 'connect.php';
$reg = '/.(?:jp(?:e?g|e|2)|gif|png|tiff?|bmp|ico)$/i';
?>
<style>
    .form11 {
        background: #000000;
        color: #d61313;
        border-radius: 10px;
        width: 50%;
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
        background-image: url(фон2.gif);
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
</style>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/button.css">
    <title>КИНОДЗЕН</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="text-align:center">
<nav>
    <a class="button button_rad button_submit button_wide" href="index.php">Главная</a>
    <a class="button button_rad button_submit button_wide" href="creating%20a%20theme.php">Создание темы</a>
    <? if ($_SESSION['user']['role'] == '1') { ?>
        <a class="button button_rad button_submit button_wide" href="admin.php">Одобрение статей</a>
        <a class="button button_rad button_submit button_wide" href="all_topic.php">Все статьи</a>
    <? } ?>
    <a class="button button_rad button_submit button_wide" href="creating_movie.php">Добавление фильма</a>
    <a class="button button_rad button_submit button_wide" href="logout.php">Выход</a>
</nav>
    <div style="width: 100vw;margin: 0 auto">
        <?
        $id_user=$_SESSION['user']['id'];
        $resultTable = mysqli_query($connection, "SELECT * FROM `article` where `id_user`='$id_user'");
        while ($pr = mysqli_fetch_assoc($resultTable)) {

            if ($pr['visible'] == "1") {
                $approval = "V";
            }
            if ($pr['visible'] == "0") {
                $approval = "Не одобрено";
            }
            $id_movies = $pr['id_movies'];
            $resultMovie = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies'");
            $movies_id = mysqli_fetch_row($resultMovie);
            $id_movies2 = $pr['id_movies2'];
            $resultMovie2 = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies2'");
            $movies_id2= mysqli_fetch_row($resultMovie2);
            ?>
            <div class="form11">
                <div class="fon_top" style="background-image:<? if ($pr['fon'] != '') {
                    ?> url('<?=$pr['fon']?>')<? } else {
                    ?>url('1155.jpg')<? } ?>">
                    <div style="background-color: rgb(33 30 30 / 50%);}">
                        <table class="text">
                            <tr>
                                <td><h3><?= $pr['date']; ?></h3></td>
                                <td class="rightcol"><h3><?= $approval ?></h3></td>
                            </tr>
                        </table>
                        <div style="text-align: center">
                            <h1><a href="media.php?table=<?= $pr['title'] ?>"><?= $pr['title'] ?></a></h1>
                        </div>
                        <button><a href="movies.php?table=<?=$movies_id[0]?>"><?="$movies_id[0]"?></a></button>
                        <?if($pr['id_movies2']!=''){?><button><a href="movies.php?table=<?=$movies_id2[0]?>"><?="$movies_id2[0]"?></a></button><?}?>
                        <hr/>
                        <button><a href="deleting%20a%20topic.php?table=<?= $pr['id'] ?>">Удалить</a></button>
                        <button><a href="editing%20topics.php?table=<?= $pr['title'] ?>">Редактировать</a></button>
                    </div>
                </div>
            </div><br>
            <?
        } ?>
    </div>
</body>
</html>
