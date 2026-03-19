<?php
require_once 'connect.php';
if (isset($_POST['mail'])) {
    $mail = trim($_POST['mail']);
    $mail = htmlspecialchars($mail);
    $check_user = $connection->prepare("SELECT user_name FROM user WHERE mail = ?");
    $check_user->bind_param('s', $mail);
    $check_user->execute();
    $user = $check_user->get_result();
    $user_name = mysqli_fetch_row($user);

//    $sql = $connection->prepare("update user set `password` = ? where `user_name` = ?");
//    $sql->bind_param('ss',$new_password,$user_name[0]);

    $email_admin ="apasnyi.vito.ru@gmail.com";
    $address_site ="КиноДзен";
    $new_password = substr(time(),0,10);
    $password = md5($new_password);
//Обновляем пароль в БД.
    $result_query_insert_password =$connection->prepare("update user set `password` = ? where `user_name` = ?");
    $result_query_insert_password->bind_param('ss',$password,$user_name[0]);
    $result_query_insert_password->execute();
//Составляем заголовок письма
    $subject = "Восстановление пароля от сайта ".$_SERVER['HTTP_HOST'];
//Устанавливаем кодировку заголовка письма и кодируем его
    $subject = "Заголовок";
//Составляем тело сообщения
    $message = 'Здравствуйте! <br/> <br/> Ваш новый пароль от сайта '.$_SERVER['HTTP_HOST'].' : '.$new_password;
//Составляем дополнительные заголовки для почтового сервиса mail.ru
//Отправляем сообщение с ссылкой для подтверждения регистрации на указанную почту и проверяем отправлена ли она успешно или нет.
    if(mail($mail, $subject, $message)){
        $_SESSION["success_messages"] = "<p ><h3 style='text-align: center'>Новый пароль сгенерирован и отправлен на указанный E-mail ($mail) или ($new_password)</h3></p>";
        //Отправляем пользователя на страницу регистрации и убираем форму регистрации
        echo  $_SESSION["success_messages"];
        exit();
    }else{
        $_SESSION["error_messages"] = "<p style='text-align: center'>Ошибка при отправки письма с новым паролем, на почту ".$mail." </p>";
        echo  $_SESSION["success_messages"];

        exit();
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
<button class="button_back" style="position: fixed;"><a href="authorization.php">Назад</a></button>
<div class="some-form">
    <form action="" method="post" class="form js-form-validate" name="contact_form">
        <div class="some-form__header title">Востановление пароля</div>
        <div class="some-form__line">
            <input type="email" name="mail" placeholder="E-mail *" data-validate>
            <span class="some-form__hint">Поле незаполнено</span>
        </div>
        <div class="some-form__submit">
            <button style="padding-bottom: 25px" class="button button_submit button_wide" type="submit"
                    value="Отправить данные">Востановление
            </button>
        </div>
    </form>
</div>
</html>

