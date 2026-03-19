<?php
session_start();
require_once 'connect.php';
$movies = trim($_GET['table']);
$movies = htmlspecialchars($movies);
$result = $connection ->prepare( "SELECT * FROM `movies` where `Фильм`= ?");
$result->bind_param('s', $movies);
$result->execute();
?>
<style>
    .button_rad {
        text-align: center;
        margin-bottom: 1%;
        text-decoration: none;
    }

    body {
        background-image: url(фон_фильм.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    h2 {
        color: #333333;
        font-family: ‘Bitter’, serif;
        font-size: 25px;
        font-weight: normal;
        line-height: 28px;
        margin: 0px 0 -10px;
    }
    a{
        text-decoration: none;
        color: #ffffff;
    }
    .button_back{
        margin-left: 7%;
    }
</style>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/button.css">
</head>
<body class="body">
<button class="button_back"style="position: fixed;"><a  href="account.php">Назад</a></button>
<div>
    <?
    $top = $result->get_result();
    while ($pr = mysqli_fetch_assoc($top)){
        $id_movies = $pr['id_genres'];
        $resultMovie = mysqli_query($connection, "SELECT `title` FROM `genres` where `id`= '$id_movies'");
        $movies_id = mysqli_fetch_row($resultMovie);
        ?>
            <form style="padding-right: 65px;padding-left: 65px;max-width: 500px" class="form-signin form js-form-validate" name="contact_form" enctype="multipart/form-data">
                <img style="width:100% ;height:450px;" src="<?=$pr['photo'] ?>">
                <h2 name="movie" id="<?=$movies ?>">Название фильма: <?=$movies?></h2><br>
                <h2>Режисер: <?=$pr['Режисер']?></h2><br>
                <h2>Продолжительность: <?=$pr['Время'] ?> мин </h2><br>
                <h2>Жанр: <?=$movies_id[0]?></h2><br>
                <h2>Дата: <?=$pr['Дата'] ?></h2>
                <hr/>
                <? if ($_SESSION['user']['role'] == '1') { ?>
                    <a class="button button_rad button_submit button_wide" style="text-align:center;display: block"
                       href="editing_movie.php?table=<?=$movies ?>">Редактировать</a>
                    <?
                } ?>
            </form>
            <?
    }
    ?>
</div>
</body>
