<?php
require_once 'connect.php';
if (isset($_POST['user_name']) && isset($_POST['mail']) && isset($_POST['phone']) && isset($_POST['password'])) {
    $user_name = trim($_POST['user_name']);
    $user_name = htmlspecialchars($user_name);
    $mail = trim($_POST['mail']);
    $mail = htmlspecialchars($mail);
    $phone = trim($_POST['phone']);
    $phone = htmlspecialchars($phone);
    $password = trim($_POST['password']);
    $password = htmlspecialchars($password);
    $query =$connection->prepare("INSERT INTO user (user_name,mail,phone,password) VALUES (?,?,?,?)");
    $query->bind_param('ssss', $user_name,$mail,$phone,$password);
    $password = md5($password);
    if ($query->execute()) {
        echo '<script>window.location.href = "authorization.php";</script>';
    } else {
        $fsmsg = "Ошибка";
    }
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/jquery.inputmask.min.js"></script>
<script>
    $(document).ready(function () {

        $('input[type="tel"]').inputmask('+7 (999) 999 99 99', {
            clearMaskOnLostFocus: true,
        });

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
<style>
    a{
        text-decoration: none;
        color: #ffffff;
    }
    .button_back{
        margin-left: 7%;
    }
    .some-form{
        margin: 0 auto;
    }
</style>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/button.css">
    <meta charset="utf-8">
</head>
<button class="button_back"style="position: fixed;"><a  href="index.php">Назад</a></button>
<div class="some-form">
    <form action="" method="post" class="form js-form-validate" name="contact_form">
        <div class="some-form__header title">Регистрация</div>
        <div class="some-form__line">
            <input type="text" name="user_name" placeholder="Имя пользователя *" data-validate>
            <span class="some-form__hint">Поле незаполнено</span>
        </div>
        <div class="some-form__line">
            <input type="email" name="mail" placeholder="E-mail *" data-validate>
            <span class="some-form__hint">Поле незаполнено</span>
        </div>
        <div class="some-form__line">
            <input type="tel" name="phone" placeholder="Телефон *" data-validate>
            <span class="some-form__hint">Поле незаполнено</span>
        </div>
        <div class="some-form__line">
            <input type="password" name="password" placeholder="Пароль *" data-validate>
            <span class="some-form__hint">Поле незаполнено</span>
        </div>
        <div class="some-form__submit">
            <button style="padding-bottom: 25px" class="button button_submit button_wide" type="submit" value="Отправить данные">Зарегистрироваться
            </button>
        </div>
    </form>
</div>
</html>

