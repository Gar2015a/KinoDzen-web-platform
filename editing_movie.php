<?php
session_start();
if($_SESSION['user']=='')
{
    header('Location: index.php');
}
require_once'connect.php';
$movies = $_GET['table'];
$result = mysqli_query($connection, "SELECT * FROM `movies` where `Фильм`='$movies'");
$result_movie = mysqli_query($connection, "SELECT * FROM `movies`where `Фильм`='$movies'");

while ($dr=mysqli_fetch_assoc($result_movie)){
    if($movies==$dr['Фильм']){
    $_SESSION['id'] = [
            "id"=> $dr['id'],
            "topic" => $movies,
            "image"=>$dr['photo']
    ];
        $pic1 = explode("._.",$dr['photo']);
    }
}
$https = mysqli_query($connection, "SELECT * FROM `movies` where `Фильм` = '$movies'");
$row = mysqli_fetch_row($https);
$pic = explode("/",$row[6]);
?>
<style>
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
        box-shadow: 0 0 6px 0 rgba(0,0,0,0.1);
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
    img{
        width:100% ;
        height:450px
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
    $(document).ready(function(){
        $('.js-form-validate').submit(function () {
            var form = $(this);
            var field = [];
            form.find('input[data-validate]').each(function () {
                field.push('input[data-validate]');
                var value = $(this).val(),
                    line = $(this).closest('.some-form__line');
                for(var i=0;i<field.length;i++) {
                    if( !value ) {
                        line.addClass('some-form__line-required');
                        setTimeout(function() {
                            line.removeClass('some-form__line-required')
                        }.bind(this),2000);
                        event.preventDefault();
                    }
                }
            });
        });
    });
</script>
<head>
    <link rel="stylesheet"type="text/css" href="style/style.css">
    <link rel="stylesheet"type="text/css" href="style/style_radio.css">
    <link rel="stylesheet" type="text/css" href="style/button.css">
    <title>КИНОДЗЕН</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<button class="button_back"style="position: fixed;"><a  href="account.php">Назад</a></button>
<div>
    <?while ($pr=mysqli_fetch_assoc($result)){?>
    <form class="form-signin form js-form-validate" name="contact_form" method="post" action="movie_editing.php" enctype="multipart/form-data">
        <h1 style="text-align: center">Редактирование</h1>
        Выберите
        <div onclick="tort()" data-validate>
            <label for="opt1" class="radio">
                <input class="hidden" type="radio" name="radio_button" id="opt1" value="picture_file" <?if($pic[0]=='movie_photo'){?>checked<?}?>>
                <span class="label"></span>Файл<br>
            </label>
            <label for="opt2" class="radio">
                <input class="hidden" type="radio" name="radio_button" id="opt2" value="picture" <?if($pic[0]!='movie_photo'){?>checked<?}?>>
                <span class="label"></span>Ссылка<br>
            </label>
        </div>

        <div id="picture_file"<?if($pic[0]=='movie_photo'){?>style="display: block"<?}else{?>style=" display: none"<?}?>>
                <input disabled type="text"name="files1" value="<?=$pic1[1]?>">
                <input onchange="writefiles(this.files,this.name)" type="file" name="photoo">
                <img id="photo" src="<?if($pic[0]=='movie_photo'){echo $pr['photo'];}?>"<?if($pic[0]!='https:'||$pic[0]=='http:'){?>style="display: block"<?}else{?>style="display: none"<?}?>>
        </div>

        <div id="picture" <?if($pic[0]!='movie_photo'){?>style=" display: block"<?}else{?>style="display:none"<?}?>>
                <input type="text" id="pict" name="pict" onchange="filetext(this.value)" <?if($pic[0]!='movie_photo'){?>value="<?=$pr['photo']?>"<?}?>>
                <img id="phot" src="<?if($pic[0]=='https:'|| $pic[0]=='http:'){echo $pr['photo'];}?>"<?if($pic[0]=='https:'|| $pic[0]=='http:'){?>style="display: block"<?}else{?>style="display: none"<?}?>>
        </div>

        Название фильма:
        <div class="some-form__line">
            <input type="text" id="name_movie" name="name_movie" value="<?=$pr['Фильм']?>" data-validate>
            <span class="some-form__hint" >Required to fill in</span>
        </div>
        Режисер:
        <div class="some-form__line">
            <input type="text" id="name"name="name" value="<?=$pr['Режисер']?>" data-validate>
            <span class="some-form__hint" >Required to fill in</span>
        </div>
        Год выпуска фильма:
        <div class="some-form__line">
            <input type="number" min="1900" max="2099" step="1" value="<?=$pr['Дата']?>" name="year" id="year"/>
            <span class="some-form__hint" >Required to fill in</span>
        </div>
        Жанр:
        <br>
        <textarea style="width: 100%" type="text" id="mySearch" name="them" data-validate><?=$pr['id_Жанр']?></textarea>
        <span class="some-form__hint" >Required to fill in</span>
        <label class="dropdown">
            <div style="width: 100%" class="dd-button">
                Жанры:
            </div><?
            $id_theme = $pr['id_genres'];
            $resultTheme = mysqli_query($connection, "SELECT `title` FROM `genres` where `id`= '$id_theme'");
            $theme_id = mysqli_fetch_row($resultTheme);?>
            <input style="width: 100%" type="checkbox" class="dd-input" id="test" value="<?$theme_id?>">
            <ul class="dd-menu">
                <?
                $resultTable = mysqli_query($connection, "SELECT * FROM `genres`");
                while ($search = mysqli_fetch_assoc($resultTable)) {
                    ?>
                    <li class="li-count" name="themes" onclick="getIdTopic(this)" id="<?=$search['id']?>"><?=$search['title']?></li>
                    <?
                }
                ?>
            </ul>
        </label>
        Продолжительность фильма в мин.:
        <input type="number" min="0" max="1000" step="1" value="<?=$pr['Время']?>" name="time" id="time">
        <br>
        <div class="some-form__submit">
            <input type="submit" name="button" class="button button_submit button_wide" id="sub" value="Изменить">
        </div>
    </form>
    <?
    }
    ?>
</div>
</body>
<script>
    function writefiles(file,index)
    {
        var reader = new FileReader();
        reader.onload = function()
        {
            if(index=='photoo'){
                document.getElementById('photo').src = reader.result;
                document.getElementById('photo').style.display = 'block';
            }
        }
        reader.readAsDataURL(file[0]);
    }
    function filetext(text)
    {
        document.getElementById('phot').src = text;
        document.getElementById('phot').style.display = 'block';
    }
    var arr=[];
    var k=0;
    function getIdTopic(topic)
    {
        arr[k]= topic.innerText;
        k++;
        document.getElementById('mySearch').value = arr;
    }
</script>
