<?php
session_start();
require_once 'connect.php';
$topic = trim($_GET['table']);
$topic = htmlspecialchars($topic);
$sql = $connection->prepare("SELECT * FROM `article` where `title`=?");
$sql->bind_param('s', $topic);
$sql->execute();
$pp = $sql->get_result();
$row = mysqli_fetch_row($pp);
$str = explode("._.", $row[12]);
$pic = explode("._.", $row[4]);
$pic2 = explode("._.", $row[6]);
$reg = '/.(?:jp(?:e?g|e|2)|gif|png|tiff?|bmp|ico)$/i';
$id = $_SESSION['user']['id'];
$_SESSION['id'] = [
    "topic" => $topic,
    "fon" => $row[12],
    "image1" => $row[4],
    "image2" => $row[6]
];
if (preg_match($reg, $row[4]) != null && preg_match($reg, $row[6]) == null) {
    $vera = "visio and picture";
}
if (preg_match($reg, $row[4]) == null && preg_match($reg, $row[6]) == null) {
    $vera = "video";
}
if (preg_match($reg, $row[4]) != null && preg_match($reg, $row[6]) != null) {
    $vera = "picture";
}
?>
<style>
    .main li:hover .menu4 li:first-of-type {
        animation: menu4 0.3s ease-in-out forwards;
        animation-delay: 0.3s;
    }

    .main li:hover .menu4 li:nth-of-type(2) {
        animation: menu4 0.3s ease-in-out forwards;
        animation-delay: 0.6s;
    }

    .main li:hover .menu4 li:nth-of-type(3) {
        animation: menu4 0.3s ease-in-out forwards;
        animation-delay: 0.9s;
    }

    .main li:hover .menu4 li:last-of-type {
        animation: menu4 0.3s ease-in-out forwards;
        animation-delay: 1.2s;
    }

    @keyframes menu4 {
        0% {
            opacity: 0;
            transform: translateX(50px) rotate(-90deg);
        }
        100% {
            opacity: 1;
            transform: translateX(0) rotate(0);
        }
    }

    ul {
        list-style: none;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    ul {
        list-style: none;
    }

    .main {
        display: flex;
        justify-content: center;
    }

    .main > li {
        margin: 0 2%;
    }

    .main > li p {
        border-left: 1px solid #ffffee;
    }

    .drop li {
        opacity: 1;
        transform-origin: top center;
    }

    .drop li a {
        text-align: center;
        border-radius: 4px;
        color: #ffffff;
        background-color: #19b5ca;
        padding: 8px 0;
    }

    .drop li a:hover {
        background-color: #4778ac;
        cursor: pointer;

    .body {
        background-color: #1e1e1e;
        background-image: url(1155.jpg);
        background-size: cover;
        height: 100%;
        font-family: "Raleway", sans-serif;
        letter-spacing: 1px;
    }

    }
    .icon-info {
        width: 20px;
        height: 20px;
        float: right;
    }

    .back-help:hover .text {
        opacity: 1 !important;
        visibility: visible !important;
        transition-delay: 0s;
    }

    .radio:hover .text1 {
        opacity: 1 !important;
        visibility: visible !important;
        transition-delay: 0s;
    }

    svg:hover {
        fill: #19b5ca;
    }

    .text {
        opacity: 0;
        visibility: hidden;
        padding: 20px 10px;
        padding-bottom: 40px;
        position: absolute;
        background-color: rgba(56, 59, 61, 0.7);
        border-radius: 3px;
        top: 18%;
        bottom: 0;
        height: 20px;
        color: #f1f1f1;
        text-align: center;
        transition: opacity 0.3s, margin-top 0.3s, visibility 0s linear 0.3s;
        white-space: nowrap;
        left: 150%;
        margin-top: -55%;
    }

    .text:before {
        content: "";
        border: solid transparent;
        position: absolute;
        right: 100%;
        top: 8px;
        border-right-color: #3e3e3e;
        border-width: 9px;
        margin-top: -1px;
    }

    .text1 {
        opacity: 0;
        visibility: hidden;
        padding: 20px 10px;
        padding-bottom: 40px;
        position: absolute;
        background-color: rgba(56, 59, 61, 0.7);
        border-radius: 3px;
        top: 18%;
        bottom: 0;
        height: max-content;
        color: #f1f1f1;
        text-align: center;
        transition: opacity 0.3s, margin-top 0.3s, visibility 0s linear 0.3s;
        right: 104%;
        margin-top: -9%;
        word-wrap: break-word;
        width: 80%;
    }


    .text1:before {
        content: "";
        border: solid transparent;
        position: absolute;
        left: 100%;
        top: 8px;
        border-left-color: #3e3e3e;
        border-width: 9px;
        margin-top: -1px;
    }

    .back-help {
        position: relative;
    }

    a {
        text-decoration: none;
        color: #ffffff;
    }

    .button_back {
        margin-left: 7%;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/jquery.inputmask.min.js"></script>
<script>
    function tort() {
        for (var i = 0; i < 3; i++) {
            if (document.getElementsByName("radio_button")[i].checked) {
                var type = document.getElementsByName("radio_button")[i].value;
            }
        }
        if (type == "visio") {
            document.getElementById("video").style.display = "block";
            document.getElementById("image").style.display = 'none';
            document.getElementById("picture").style.display = 'none';
        }
        if (type == "image") {
            document.getElementById("image").style.display = 'block';
            document.getElementById("video").style.display = "none";
            document.getElementById("picture").style.display = 'none';
        }
        if (type == "picture") {
            document.getElementById("picture").style.display = 'block';
            document.getElementById("image").style.display = 'none';
            document.getElementById("video").style.display = "none";
        }
    }

    function tort1() {
        for (var i = 0; i < 2; i++) {
            if (document.getElementsByName("radio_button1")[i].checked) {
                var type = document.getElementsByName("radio_button1")[i].value;
            }
        }
        if (type == "movies1") {
            document.getElementById("movies11").style.display = "block";
            document.getElementById("movies12").style.display = 'none';
        }
        if (type == "movies2") {
            document.getElementById("movies11").style.display = 'block';
            document.getElementById("movies12").style.display = "block";
        }
    }


    $(document).ready(function () {
        $('.js-form-validate').submit(function () {
            var form = $(this);
            var field = [];
            form.find('input[data-validate]').each(function () {
                field.push('input[data-validate]');
                var value = $(this).val(),
                    line = $(this).closest('.some-form__line');
                for (var i = 0; i < field.length; i++) {
                    if (!value) {
                        line.addClass('some-form__line-required');
                        setTimeout(function () {
                            line.removeClass('some-form__line-required')
                        }.bind(this), 2000);
                        event.preventDefault();
                    }
                }
            });
        });
    });

    function videoLink() {
        var reg = /http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?/;
        var score = 0;
        for (var i = 0; i < 2; i++) {
            var str = document.getElementsByName("video")[i].value;
            var found = str.match(reg);
            if (found != null) {
                score++;
            }
        }
        if (score == 2) {
            var links = [];
            for (var j = 0; j < 2; j++) {
                var link = document.getElementsByName("video")[j].value;
                links[j] = link.match(/(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/user\/\S+|\/ytscreeningroom\?v=|\/sandalsResorts#\w\/\w\/.*\/))([^\/&]{10,12})/)[1];
            }
            console.log(links);
            document.cookie = 'links=' + links.toString();
        }

        if (document.getElementById('videos')) {
            console.log(document.getElementById('videos'));
            var links1;
            var link = document.getElementById('videos').value;
            links1 = link.match(/(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/user\/\S+|\/ytscreeningroom\?v=|\/sandalsResorts#\w\/\w\/.*\/))([^\/&]{10,12})/)[1];
            console.log(links1);
            document.cookie = 'videos=' + links1.toString();
        }
    }
</script>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/style_radio.css">
    <link rel="stylesheet" type="text/css" href="style/button.css">
</head>
<body class="body">
<button class="button_back" style="position: fixed;"><a href="account.php">Назад</a></button>
<form class="form-signin form js-form-validate" name="contact_form" method="post" action="edit.php"
      enctype="multipart/form-data">
    <h2 style="text-align: center">Редактирование статьи</h2>
    <h4>Введите название темы</h4>
    <div class="some-form__line">
        <input TYPE="text" name="topic" value="<?= $row[1] ?>" data-validate>
        <span class="some-form__hint">Поле незаполнено</span>
    </div>
    <h4>Загрузите фон по желанию</h4>
    <div>
        <input disabled name="fon" type="text" value="<?= $str[1] ?>">
        <input onchange="writefiles(this.files,this.name),filetext(this.files[0].name,this.name)" type="file" name="fon"
               value="">
        <img <? if ($row[12] == '') { ?> style="display: none"<? } ?> id="image_fon" width="100%" height="25%"
                                                                      src="<?= $row[12] ?>"><br>
    </div>
    <br>

    Количество фильмов
    <div onclick="tort1()" data-validate>
        <label for="opt11" class="radio">
            <input class="hidden" type="radio" name="radio_button1" id="opt11" value="movies1"
                   <? if (($row[10] != null) && $row[11] == null){ ?>checked<? } ?>>
            <span class="label"></span>1<br>
        </label>
        <label for="opt12" class="radio">
            <input class="hidden" type="radio" name="radio_button1" id="opt12" value="movies2"
                   <? if (($row[10] != null) && $row[11] != null){ ?>checked<? } ?>>
            <span class="label"></span>2<br>
        </label>
    </div>

    <div class="some-form__line" id="movies11" >
        Выбирите фильм
        <? $id_movies = $row[10];
        $resultMovie = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies'");
        $movies_id = mysqli_fetch_row($resultMovie); ?>
        <input type="text" id="mySearch" name="movies" onkeyup="myFunction(),display()" placeholder="Поиск.."
               value="<?= $movies_id[0] ?>" data-validate>
        <ul class="main drop menu4" style="display: none" id="myMenu">
            <?
            $resultTable = mysqli_query($connection, "SELECT * FROM `movies`");
            while ($pr = mysqli_fetch_assoc($resultTable)) {
                ?>
                <li><a name="movie" id="<?= $pr['Фильм'] ?>"><?= $pr['Фильм'] ?></a></li>
                <?
            }
            ?>
        </ul>
        <span class="some-form__hint">Поле незаполнено</span>
    </div>
    <div class="some-form__line" id="movies12" <? if (($row[10] != null) && $row[11] != null){ ?>style="display: block"
         <? } else { ?>style="display: none"<? } ?>>
        Выбирите фильм
        <? $id_movies = $row[11];
        $resultMovie = mysqli_query($connection, "SELECT `Фильм` FROM `movies` where `id`= '$id_movies'");
        $movies_id22 = mysqli_fetch_row($resultMovie); ?>
        <input type="text" id="mySearch1" name="movies222" onkeyup="myFunction1(),display1()" placeholder="Поиск.."
               value="<?= $movies_id22[0] ?>"
               >
        <ul class="main drop menu4" style="display: none" id="myMenu1">
            <?
            $resultTable4 = mysqli_query($connection, "SELECT * FROM `movies`");
            while ($pr = mysqli_fetch_assoc($resultTable4)) {
                ?>
                <li><a name="mov1" id="<?= $pr['Фильм'] ?>"><?= $pr['Фильм'] ?></a></li>
                <?
            }
            ?>
        </ul>
        <span class="some-form__hint">Поле незаполнено</span>
    </div>


    <h4>Введите свою информацию</h4>
    <div>
        <textarea style="width:100%; height:10% " name="review-text" rows="7" id="review-text"><?= $row[8] ?></textarea>
    </div>
    <div class="counter">Осталось символов: <span id="counter"></span>
    </div>
    <br>
    <h4>Выбирете тему:</h4><?
    $resultTable = mysqli_query($connection, "SELECT * FROM `topic`");
    $id_theme = $pr['id_topic'];
    $resultTheme = mysqli_query($connection, "SELECT `theme` FROM `topic` where `id`= '$id_theme'");
    $theme_id = mysqli_fetch_row($resultTheme);
    while ($pr = mysqli_fetch_assoc($resultTable)) {
        ?>
        <label for="<?= $pr['theme'] ?>" class="radio">
            <input class="hidden" type="radio" name="radio_topic" id="<?= $pr['theme'] ?>" value="<?= $pr['theme'] ?>"
                   <? if ($pr['id'] == $row[9]){ ?>checked<?
            } ?>>
            <span class="label"></span><?= $pr['theme'] ?><br>
            <div class="back-help">
                <div class="text1"><?= $pr['text'] ?>
                </div>
            </div>
        </label>
        <?
    }
    ?>
    <br>
    <h4>Выбирете</h4>
    <div onclick="tort()" data-validate>
        <label for="opt1" class="radio">
            <input class="hidden" type="radio" name="radio_button" id="opt1" value="image"
                   <? if (preg_match($reg, $row[4]) != null && preg_match($reg, $row[6]) != null){ ?>checked<? } ?>>
            <span class="label"></span>Картинки<br>
        </label>
        <label for="opt2" class="radio">
            <input class="hidden" type="radio" name="radio_button" id="opt2" value="visio"
                   <? if (preg_match($reg, $row[4]) == null && preg_match($reg, $row[6]) == null){ ?>checked<? } ?>>
            <span class="label"></span>Видео<br>
        </label>
        <label for="opt3" class="radio">
            <input class="hidden" type="radio" name="radio_button" id="opt3" value="picture"
                   <? if (preg_match($reg, $row[4]) != null && preg_match($reg, $row[6]) == null){ ?>checked<? } ?>>
            <span class="label"></span>Картинки и Видео<br>
        </label>
    </div>

    <div onchange="videoLink()" id="video" <? if ($vera == 'video'){ ?>style=" display: block"
         <? }else{ ?>style=" display: none"<? } ?>>
        video1<br>
        <input id="video_video" onchange="videosos(this.value,this.id)" name="video" value="">
        <iframe <? if (preg_match($reg, $row[4]) == null && preg_match($reg, $row[6]) == null) { ?> style="display: block"<? } else { ?>style="display: none"<? } ?>
                width="100%" height="25%" id="video_vide" src="https://www.youtube.com/embed/<?= $row[4] ?>"
                frameborder="0" allowfullscreen></iframe>
        <br>
        video2<br>
        <input id="videos_video2" onchange="videosos(this.value,this.id)" name="video" value="">
        <iframe <? if (preg_match($reg, $row[4]) == null && preg_match($reg, $row[6]) == null) { ?> style="display: block"<? } else { ?>style="display: none"<? } ?>
                width="100%" height="25%" id="video_vid" src="https://www.youtube.com/embed/<?= $row[6] ?>"
                frameborder="0" allowfullscreen></iframe>
        <br>
    </div>

    <div id="image" <? if ($vera == 'picture'){ ?>style=" display: block" <? }else{ ?>style=" display: none"<? } ?>>
        image1<br>
        <input disabled type="text" name="files1" value="<?= $pic[1] ?>">
        <input onchange="writefiles(this.files,this.name),filetext(this.files[0].name,this.name)" type="file"
               name="files1" value=""><br>
        <img <? if (preg_match($reg, $row[4]) != null && preg_match($reg, $row[6]) != null){ ?> style="display: block"
                                                                                                <? }else{ ?>style="display: none"
                                                                                                <? } ?>id="image1"
                                                                                                width="100%"
                                                                                                height="25%"
                                                                                                src="<?= $row[4] ?>">
        Описание:
        <div>
            <textarea style="width:100%; height:6% " name="image1_text" rows="7"
                      id="review-text"><?= $row[5] ?></textarea>
        </div>
        image2<br>
        <input disabled type="text" name="files2" value="<?= $pic2[1] ?>">
        <input onchange="writefiles(this.files,this.name),filetext(this.files[0].name,this.name)" type="file"
               name="files2" value="">
        <img <? if (preg_match($reg, $row[4]) != null && preg_match($reg, $row[6]) != null) { ?> style="display: block"<? } else { ?>style="display: none"<? } ?>
                id="image2" width="100%" height="25%" src="<?= $row[6] ?>">
        Описание:
        <div>
            <textarea style="width:100%; height:6% " name="image2_text" rows="7"
                      id="review-text"><?= $row[7] ?></textarea>
        </div>
    </div>

    <div onchange="videoLink()" id="picture" <? if ($vera == 'visio and picture'){ ?>style=" display: block"
         <? }else{ ?>style=" display: none"<? } ?>>
        image<br>
        <input disabled type="text" name="picture" value="<?= $pic[1] ?>">
        <input onchange="writefiles(this.files,this.name),filetext(this.files[0].name,this.name)" type="file"
               name="picture" value=""><br>
        <img <? if (preg_match($reg, $row[4]) != null && preg_match($reg, $row[6]) == null){ ?> style="display: block"
                                                                                                <? }else{ ?>style="display: none"
                                                                                                <? } ?>id="image3"
                                                                                                width="100%"
                                                                                                height="25%"
                                                                                                src="<?= $row[4] ?>">
        Описание:
        <div>
            <textarea style="width:100%; height:6% " name="image1_" rows="7" id="review-text"><?= $row[5] ?></textarea>
        </div>
        video<br>
        <input width="100%" id="videos" onchange="videosos(this.value,this.id)" value="">
        <iframe <? if (preg_match($reg, $row[4]) != null && preg_match($reg, $row[6]) == null) { ?> style="display: block"<? } else { ?>style="display: none"<? } ?>
                width="100%" height="25%" id="video_1" src="https://www.youtube.com/embed/<?= $row[6] ?>"
                frameborder="0" allowfullscreen></iframe>
    </div>
    <br>
    <div class="some-form__submit">
        <input type="submit" name="button" class="button button_submit button_wide" id="sub" value="Редактировать">
    </div>
</form>
</body>
<script>
    function myFunction1() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("mySearch1");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myMenu1");
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

    function display1() {
        var input, filter, ul, li, a, i;
        ul = document.getElementById("myMenu1");
        li = ul.getElementsByTagName("li");
        if (document.getElementById('mySearch1').value == '') {
            document.getElementById('myMenu1').style.display = 'none';
        } else {
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                a.style.display = 'block';
            }
            document.getElementById('myMenu1').style.display = 'block';
        }
    }

    document.addEventListener("click", function (e) {
        if (e.target.name == "mov1") {
            document.getElementById('mySearch1').value = e.target.id;
            document.getElementById('myMenu1').style.display = 'none';
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

    document.addEventListener("click", function (e) {
        if (e.target.name == "movie") {
            document.getElementById('mySearch').value = e.target.id;
            document.getElementById('myMenu').style.display = 'none';
        }
    })

    function writefiles(file, index) {
        console.log(file, index);
        var reader = new FileReader();
        reader.onload = function () {
            if (index == 'fon') {
                document.getElementById('image_fon').src = reader.result;
                document.getElementById('image_fon').style.display = 'block';
            }
            if (index == 'files1') {
                document.getElementById('image1').src = reader.result;
                document.getElementById('image1').style.display = 'block';
            }
            if (index == 'files2') {
                document.getElementById('image2').src = reader.result;
                document.getElementById('image2').style.display = 'block';
            }
            if (index == 'picture') {
                document.getElementById('image3').src = reader.result;
                document.getElementById('image3').style.display = 'block';
            }
        }
        reader.readAsDataURL(file[0]);
    }

    function videosos(file, index) {
        var links12;
        links12 = file.match(/(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/user\/\S+|\/ytscreeningroom\?v=|\/sandalsResorts#\w\/\w\/.*\/))([^\/&]{10,12})/)[1];
        if (index == 'videos') {
            document.getElementById('video_1').src = "https://www.youtube.com/embed/" + links12;
            document.getElementById('video_1').style.display = 'block';
        }
        if (index == 'video_video') {
            document.getElementById('video_vide').src = "https://www.youtube.com/embed/" + links12;
            document.getElementById('video_vide').style.display = 'block';
        }
        if (index == 'videos_video2') {
            document.getElementById('video_vid').src = "https://www.youtube.com/embed/" + links12;
            document.getElementById('video_vid').style.display = 'block';
        }
    }

    function filetext(file, name) {
        document.getElementsByName(name)[0].value = file;
    }

    $(document).ready(function () {
        var maxCount = 250;

        $("#counter").html(maxCount);

        $("#review-text").keyup(function () {
            var revText = this.value.length;

            if (this.value.length > maxCount) {
                this.value = this.value.substr(0, maxCount);
            }
            var cnt = (maxCount - revText);
            if (cnt <= 0) {
                $("#counter").html('0');
            } else {
                $("#counter").html(cnt);
            }

        });
    });
</script>
