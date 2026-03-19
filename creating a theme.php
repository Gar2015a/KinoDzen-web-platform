<?php
if ($_SESSION['user'] != '') {
    header('Location: index.php');
}
require_once 'connect.php';
//$result = mysqli_query($connection, "SHOW TABLES");
//$result1_search = mysqli_query($connection, "SHOW TABLES");
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
        padding: 10px 10px;
        padding-bottom: 60px;
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
        padding-bottom: 60px;
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
    a{
        text-decoration: none;
        color: #ffffff;
    }
    .button_back{
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
        } else if ((type == "image") || (type == "gif")) {
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
            var links1;
            var link = document.getElementById('videos').value;
            links1 = link.match(/(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/user\/\S+|\/ytscreeningroom\?v=|\/sandalsResorts#\w\/\w\/.*\/))([^\/&]{10,12})/);
            console.log(links1);
            document.cookie = 'videos=' + links1.toString();
        }
    }
</script>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/style_radio.css">
    <link rel="stylesheet" type="text/css" href="style/button.css">
    <title>КИНОДЗЕН</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<svg data-duration="10" data-delay="45" display="none" width="0" height="0" version="1.1"
     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink%22%3E">
    <defs>
        <symbol id="icon-info" width="20" height="20" viewBox="0 0 24 24">
            <path class="cls-1"
                  d="M3142.01,162a12,12,0,1,1,12-12A12.01,12.01,0,0,1,3142.01,162Zm-0.02-21.989A9.992,9.992,0,1,0,3152,150,10,10,0,0,0,3141.99,140.011Zm1.02,15.994h-2v-8.014h2v8.014Zm0-10h-2v-2h2v2Z"
                  transform="translate(-3130 -138)"></path>
        </symbol>
    </defs>
</svg>
<button class="button_back"style="position: fixed;"><a  href="account.php">Назад</a></button>
<form class="form-signin form js-form-validate" name="contact_form" method="post" action="creating.php"
      enctype="multipart/form-data">
    <h1 style="text-align: center">Создание статьи</h1>
    <div style="display: flex;justify-content: space-between ">
        Введите название статьи
        <div class="back-help">
            <svg class="icon-info">
                <use xlink:href="#icon-info"></use>
            </svg>
            <div class="text">
                Это поле являеся обязатильным
            </div>
        </div>
    </div>
    <div class="some-form__line">
        <input TYPE="text" name="topic" data-validate>
        <span class="some-form__hint">Поле незаполнено</span>
    </div>
    <div style="display: flex;justify-content: space-between ">
        Загрузите фон
        <div class="back-help">
            <svg class="icon-info">
                <use xlink:href="#icon-info"></use>
            </svg>
            <div class="text">
                Это поле не обязатильно
            </div>
        </div>
    </div>
    <div>
        <input onchange="writefiles(this.files,this.name)" type="file" name="fon">
        <img style="display: none" id="image_fon" width="100%" height="25%" src="">
    </div>
    <br>

    Количество фильмов
    <div onclick="tort1()" data-validate>
        <label for="opt11" class="radio" >
            <input class="hidden" type="radio" name="radio_button1" id="opt11" value="movies1" checked>
            <span class="label"></span>1<br>
        </label>
        <label for="opt12" class="radio">
            <input class="hidden" type="radio" name="radio_button1" id="opt12" value="movies2">
            <span class="label"></span>2<br>
        </label>
    </div>

    <div class="some-form__line" id="movies11" >

        <div style="display: flex;justify-content: space-between ">
            Выбирите фильм
            <div class="back-help">
                <svg class="icon-info">
                    <use xlink:href="#icon-info"></use>
                </svg>
                <div class="text">
                    Это поле являеся обязатильным.<p>
                    Если вашего фильма нет нужно его создать
                </div>
            </div>
        </div>
        <input type="text" id="mySearch" name="movies" onkeyup="myFunction(),display()" placeholder="Поиск.." data-validate>
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
    <div  id="movies12" style="display: none">
        Выбирите фильм
        <input type="text" id="mySearch1" name="movies222" onkeyup="myFunction1(),display1()" placeholder="Поиск..">
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
    </div>
    <div style="display: flex;justify-content: space-between ">
        Введите свою информацию
        <div class="back-help">
            <svg class="icon-info">
                <use xlink:href="#icon-info"></use>
            </svg>
            <div class="text">
                Это поле является обязатильным
                для заполнения
            </div>
        </div>
    </div>
    <div>
        <textarea style="width:100%; height:10% " name="review-text" rows="7" id="review-text"></textarea>
    </div>
    <div class="counter">Осталось символов: <span id="counter"></span><br>
        Тема:
    </div>
    <?
    $resultTable = mysqli_query($connection, "SELECT * FROM `topic`");
    while ($pr = mysqli_fetch_assoc($resultTable)) {
        ?>

        <label for="<?= $pr['theme'] ?>" class="radio">
            <input class="hidden" type="radio" name="radio_topic" id="<?= $pr['theme'] ?>" value="<?= $pr['theme'] ?>">
            <span class="label"></span><?= $pr['theme'] ?><br>
            <div class="back-help">
                <div class="text1">
                    <?= $pr['text'] ?>
                </div>
            </div>
        </label>
        <?
    }
    ?>
    <br>
    Ввставте картики
    <br>
    <div onclick="tort()" data-validate>
        <label for="opt1" class="radio">
            <input class="hidden" type="radio" name="radio_button" id="opt1" value="image">
            <span class="label"></span>Картинки<br>
        </label>
        <label for="opt2" class="radio">
            <input class="hidden" type="radio" name="radio_button" id="opt2" value="visio">
            <span class="label"></span>Видео<br>
        </label>
        <label for="opt3" class="radio">
            <input class="hidden" type="radio" name="radio_button" id="opt3" value="picture">
            <span class="label"></span>Картинки и Видео<br>
        </label>
    </div>
    <div onchange="videoLink()" style="display: none" id="video">
        video1<br>
        <input id="video_video" onchange="videosos(this.value,this.id)" name="video">
        <iframe style="display: none" width="100%" height="25%" id="video_vide" src="" frameborder="0"
                allowfullscreen></iframe>
        <br>
        video2<br>
        <input id="videos_video2" onchange="videosos(this.value,this.id)" name="video">
        <iframe style="display: none" width="100%" height="25%" id="video_vid" src="" frameborder="0"
                allowfullscreen></iframe>
    </div>

    <div style="display:none" id="image">
        image1<br>
        <input onchange="writefiles(this.files,this.name)" type="file" name="files1"><br>
        <img style="display: none" id="image1" width="100%" height="25%" src="">
        Описание:
        <div>
            <textarea style="width:100%; height:6% " name="image1_text" rows="7" id="review-text"></textarea>
        </div>
        image2<br>
        <input onchange="writefiles(this.files,this.name)" type="file" name="files2">
        <img style="display: none" id="image2" width="100%" height="25%" src="">
        Описание:
        <div>
            <textarea style="width:100%; height:6% " name="image2_text" rows="7" id="review-text"></textarea>
        </div>
    </div>
    <div onchange="videoLink()" style="display:none" id="picture">
        image<br>
        <input onchange="writefiles(this.files,this.name)" type="file" name="picture"><br>
        <img style="display: none" id="image3" width="100%" height="25%" src="">
        Описание:
        <div>
            <textarea style="width:100%; height:6% " name="picture_text" rows="7" id="review-text"></textarea>
        </div>
        video<br>
        <input id="videos" onchange="videosos(this.value,this.name)" name="video_1">
        <iframe style="display: none" width="100%" height="25%" id="video_1" src="" frameborder="0"
                allowfullscreen></iframe>
    </div>
    <br>
    <div class="some-form__submit">
        <input type="submit" name="button" class="button button_submit button_wide" id="sub" value="Создать">
    </div>
</form>
</body>
</html>
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
        console.log(file);
        var links12;
        links12 = file.match(/(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/user\/\S+|\/ytscreeningroom\?v=|\/sandalsResorts#\w\/\w\/.*\/))([^\/&]{10,12})/)[1];
        if (index == 'video_1') {
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