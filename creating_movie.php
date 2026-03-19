<?php
session_start();
if ($_SESSION['user'] == '') {
    header('Location: account.php');
}
require_once 'connect.php';
?>
<style>
    body {
        background-color: #1e1e1e;
        background-image: url(фон4.jpg);
        background-size: cover;
        font-family: "Raleway", sans-serif;
        letter-spacing: 1px;
        background-attachment: fixed;
        overflow-x: hidden;
    }

    dropdown {
        display: inline-block;
        position: relative;
        margin-bottom: 5px;
    }

    .dd-button {
        display: inline-block;
        border: 1px solid gray;
        border-radius: 4px;
        padding: 10px 30px 10px 20px;
        background-color: #ffffff;
        cursor: pointer;
        white-space: nowrap;
    }

    .dd-button:hover {
        background-color: #eeeeee;
    }

    .dd-input {
        display: none;
    }

    .dd-menu {
        top: 100%;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 0;
        margin: 2px 0 0 0;
        box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        list-style-type: none;
        z-index: 1;
    }

    .dd-input + .dd-menu {
        display: none;
    }

    .dd-input:checked + .dd-menu {
        display: block;
    }

    .dd-menu li {
        padding: 10px 20px;
        cursor: pointer;
        white-space: nowrap;
    }

    .dd-menu li:hover {
        background-color: #f6f6f6;
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
        for (var i = 0; i < 2; i++) {
            if (document.getElementsByName("radio_button")[i].checked) {
                var type = document.getElementsByName("radio_button")[i].value;
            }
        }
        if (type == "picture_file") {
            document.getElementById("picture_file").style.display = "block";
            document.getElementById("picture").style.display = 'none';

        }
        if (type == "picture") {
            document.getElementById("picture").style.display = 'block';
            document.getElementById("picture_file").style.display = "none";
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
<div>
    <button class="button_back" style="position: fixed;"><a href="account.php">Назад</a></button>
    <form class="form-signin form js-form-validate" name="contact_form" method="post" action="movies_crea.php"
          enctype="multipart/form-data">
        <h1 style="text-align: center;margin: 0">Создание фильма</h1>
        Выберите
        <div onclick="tort()" data-validate>
            <label for="opt1" class="radio">
                <input class="hidden" type="radio" name="radio_button" id="opt1" value="picture_file">
                <span class="label"></span>Файл<br>
            </label>
            <label for="opt2" class="radio">
                <input class="hidden" type="radio" name="radio_button" id="opt2" value="picture">
                <span class="label"></span>Ссылка<br>
            </label>
        </div>

        <div id="picture_file" style="display: none">
            <div>
                <input onchange="writefiles(this.files,this.name)" type="file" name="photoo">
                <img style="display: none;width:100% ;height:450px " id="photo" src="">
            </div>
        </div>

        <div id="picture" style="display: none">
            <input type="text" id="pict" name="pict" onchange="filetext(this.value)">
            <img style="display: none;width:100%;height:450px" id="phot" src="">
        </div>

        Название фильма:
        <div class="some-form__line">
            <input type="text" id="name_movie" name="name_movie" data-validate>
            <span class="some-form__hint">Required to fill in</span>
        </div>
        Режисер:
        <div class="some-form__line">
            <input type="text" id="name" name="name" data-validate>
            <span class="some-form__hint">Required to fill in</span>
        </div>
        Год выпуска фильма:
        <div class="some-form__line">
            <input type="number" min="1900" max="2099" step="1" value="2021" name="year" id="year"/>
            <span class="some-form__hint">Required to fill in</span>
        </div>
        Жанр:
        <br>
        <textarea style="width: 100%" type="text" id="mySearch" name="them" data-validate></textarea>
        <span class="some-form__hint">Required to fill in</span>
        <label class="dropdown">
            <div style="width: 100%" class="dd-button">
                Жанры:
            </div>
            <input style="width: 100%" type="checkbox" class="dd-input" id="test">
            <ul class="dd-menu">
                <?
                $resultTable = mysqli_query($connection, "SELECT * FROM `genres`");
                while ($search = mysqli_fetch_assoc($resultTable)) {
                    ?>
                    <li class="li-count" name="themes" onclick="getIdTopic(this)"
                        id="<?= $search['id'] ?>"><?= $search['title'] ?></li>
                    <?
                }
                ?>
            </ul>
        </label>
        Продолжительность фильма в мин.:
        <input type="number" min="0" max="1000" step="1" value="90" name="time" id="time">
        <br>
        <div class="some-form__submit">
            <input type="submit" name="button" class="button button_submit button_wide" id="sub" value="Создать">
        </div>
    </form>
</div>
</body>
<script>
    function writefiles(file, index) {
        console.log(file, index);
        var reader = new FileReader();
        reader.onload = function () {
            if (index == 'photoo') {
                document.getElementById('photo').src = reader.result;
                document.getElementById('photo').style.display = 'block';
            }
        }
        reader.readAsDataURL(file[0]);
    }

    function filetext(text) {
        document.getElementById('phot').src = text;
        document.getElementById('phot').style.display = 'block';
    }

    var arr = [];
    var k = 0;

    function getIdTopic(topic) {
        arr[k] = topic.innerText;
        k++;
        console.log(arr);
        document.getElementById('mySearch').value = arr;
    }
</script>
