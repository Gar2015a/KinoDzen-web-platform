<?php
session_start();
require_once'connect.php';
$pict=$_POST['pict'];
$name_movie =$_POST['name_movie'];
$name=$_POST['name'];
$year=$_POST['year'];
$them=$_POST['them'];
$time=$_POST['time'];
$theme=$_POST['radio_button'];
$old_movies=$_SESSION['id']['topic'];
$old_image1=$_SESSION['id']['image'];
$id=$_SESSION['id']['id'];

if ($theme=="picture_file") {
    if ($_FILES['photoo']['name'] != '') {
    unlink($old_image1);
    }
}
$result = mysqli_query($connection, "SHOW TABLES");
if($name!=''){
    $sql = "update `movies1` set `Режисер` = '$name' where `id` = '$id'";
    if (!mysqli_query($connection, $sql)) { // Error handling
        echo "Something went wrong! :(";
    }
}
if($name_movie!=''){
while ($arr = mysqli_fetch_assoc($result))
{
    $table = $arr['Tables_in_movies'];
    $resultTable = mysqli_query($connection, "SELECT * FROM `$table`");

        while ($pr = mysqli_fetch_assoc($resultTable))
        {
            if($pr['movies']==$old_movies ){

            $opt= "update `$table` set `movies` = '$name_movie'";
                if (!mysqli_query($connection, $opt))
                { // Error handling
                    echo "Something went wrong! :(";
                }
            }
        }
    }
        $sql = "update `movies1` set `Фильм` = '$name_movie' where `id` = '$id'";
        if (!mysqli_query($connection, $sql)) { // Error handling
            echo "Something went wrong! :(";
        }
}
if($year!=''){
    $sql = "update `movies1` set `Дата` = '$year' where `id` = '$id'";
    if (!mysqli_query($connection, $sql)) { // Error handling
        echo "Something went wrong! :(";
    }
}
if($time!=''){
    $sql = "update `movies1` set `Время` = '$time' where `id` = '$id'";
    if (!mysqli_query($connection, $sql)) { // Error handling
        echo "Something went wrong! :(";
    }
}
if($theme!=''){
    $sql = "update `movies1` set `id_Жанр` = '$them' where `id` = '$id'";
    if (!mysqli_query($connection, $sql)) { // Error handling
        echo "Something went wrong! :(";
    }
}
if ($theme=="picture_file") {
    $target_dir = 'movie_photo/';
    $photo1 = $target_dir . time() . "._." .$_FILES['photoo']['name'];
    move_uploaded_file($_FILES['photoo']['tmp_name'], $target_dir . time() . "._." .$_FILES['photoo']['name']);
    if (!mysqli_query($connection, $sql)) { // Error handling
        echo "Something went wrong! :(";
    } else {
        echo '<script>window.location.href = "account.php";</script>';
    }
}
if ($theme=="picture") {
    $sql = "update `movies1` set `photo` = '$pict' where `id` = '$id'";
    if (!mysqli_query($connection, $sql)) { // Error handling
        echo "Something went wrong! :(";
    } else {
        echo '<script>window.location.href = "account.php";</script>';
    }
}
?>