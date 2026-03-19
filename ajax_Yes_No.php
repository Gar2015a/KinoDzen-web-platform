<?php
session_start();
include "connect.php";
$error = false;
$topic = $_POST['id_topic'];
$userId = $_POST['user'];
$type = $_POST['type'];
$pql = mysqli_query($connection, "SELECT count(*) FROM `choice_news` WHERE `id_user` = '$userId' AND `id_article` = '$topic'") or die(mysqli_error());
$result_choice = mysqli_fetch_row($pql);
if ($result_choice[0] > 0) {
    $error = 'Вы уже голосовали';
} else {
    if ($type != '' && ($_SESSION['user'] != null)) {
        mysqli_query($connection, "INSERT INTO `choice_news` (`id_user`,`id_article`,`type`) VALUES ('$userId', '$topic','$type')");
        mysqli_query($connection, "UPDATE `article` SET `$type`=`$type`+ 1 where `id`='$topic'");
    }
}
if ($error && ($_SESSION['user'] != null)) {
    $sql = mysqli_query($connection, "SELECT `type` FROM `choice_news` WHERE `id_user` = '$userId' AND `id_article` = '$topic'");
    $result = mysqli_fetch_row($sql);
    if (($type == 'yes' && $result[0] == 'no') || ($type == 'no' && $result[0] == 'yes')) {
        mysqli_query($connection, "UPDATE `article` SET `$type`=`$type`+1 where `id`='$topic'");
        mysqli_query($connection, "UPDATE `article` SET `$result[0]`=`$result[0]`-1 where `id`='$topic'");
        mysqli_query($connection, "UPDATE `choice_news` SET `type`='$type'where `id_user` = '$userId' AND `id_article` = '$topic'");
    }
    echo json_encode(array('result' => 'error', 'msg' => $result[0]));
} else {
    echo json_encode(array('result' => 'success'));
}