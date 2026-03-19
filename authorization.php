<?php
session_start();
require_once 'connect.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/jquery.inputmask.min.js"></script>
<script src="js/button.js"></script>
<script>
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
<style>
    a {
        text-decoration: none;
        color: #ffffff;
    }

    .button_back {
        margin-left: 7%;
    }

    .some-form {
        margin: 0 auto;
    }
</style>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/button.css">
    <meta charset="utf-8">
</head>
<body>
<button class="button_back" style="position: fixed;"><a href="index.php">Назад</a></button>
<div class="some-form">
    <form method="post" class="form js-form-validate " name="contact_form">
        <div class="some-form__header title">Авторизация</div>
        <div class="some-form__line">
            <input type="text" name="user_name" placeholder="Имя пользователя *" data-validate>
            <span class="some-form__hint">Поле незаполнено</span>
        </div>
        <div class="some-form__line">
            <input type="password" name="password" placeholder="Пароль *" data-validate>
            <span class="some-form__hint">Поле незаполнено</span>
        </div>
        <div class="some-form__submit">
            <button style="padding-bottom: 25px" class="button button_submit button_wide" type="submit" name="submit"
                    value="Отправить данные">
                Войти
            </button>
        </div>
        <br>
        <div style="display: flex;justify-content: space-around;">
            <div class="some-form__submit">
                <a class="button button_submit button_wide" href="registration.php">Регистрация</a>
            </div>
            <div style="display" class="some-form__submit">
                <a class="button button_submit button_wide" href="reset_password.php">Забыл пароль</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
<?
if (isset($_POST['user_name']) && isset($_POST['password'])) {
    $user_name = trim($_POST['user_name']);
    $user_name = htmlspecialchars($user_name);
    $password = trim($_POST['password']);
    $password = htmlspecialchars($password);
    $check_user = $connection->prepare("SELECT * FROM user WHERE user_name = ? AND password = ?");
    $password = md5($password);
    $check_user->bind_param('ss', $user_name, $password);
    $check_user->execute();
    $top = $check_user->get_result();
    $user = mysqli_fetch_assoc($top);
    if ($user > 0) {
        $_SESSION['user'] = [
            "id" => $user['id'],
            "name" => $user['user_name'],
            "password" => $user['password'],
            "role" => $user['role']];
        echo '<script>window.location.href = "index.php";</script>';
    } else {
        $fail = "Вы ввели неправильный логин/пароль";
    }
}
?>