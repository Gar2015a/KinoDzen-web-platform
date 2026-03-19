<?php
require_once'connect.php';

$pict = trim($_POST['pict']);
$pict = htmlspecialchars($pict);
$name_movie = trim($_POST['name_movie']);
$name_movie = htmlspecialchars($name_movie);
$name = trim($_POST['name']);
$name = htmlspecialchars($name);
$year = trim($_POST['year']);
$year = htmlspecialchars($year);
$them = trim($_POST['them']);
$them = htmlspecialchars($them);
$time = trim($_POST['time']);
$time = htmlspecialchars($time);
$theme = trim($_POST['radio_button']);
$theme = htmlspecialchars($theme);
$resultgenre = $connection ->prepare("SELECT `id` FROM `genres` where `title`= ?");
$resultgenre->bind_param('s',$them);
$resultgenre->execute();
$kk = $resultgenre->get_result();
$genre_id = mysqli_fetch_row($kk);
if ($theme=="picture_file") {
    $target_dir = 'movie_photo/';
    $photo1 = $target_dir . time() . "._." .$_FILES['photoo']['name'];
    move_uploaded_file($_FILES['photoo']['tmp_name'], $target_dir . time() . "._." .$_FILES['photoo']['name']);
    $sql = $connection ->prepare("insert into movies (`Фильм`,`Режисер`,`Время`,`id_genres`,`Дата`,`photo`)values(?,?,?,?,?,?)");
    $sql->bind_param('sssiss',$name_movie,$name,$time,$genre_id[0],$year,$photo1);
    if (!$sql->execute()) { // Error handling
        echo "Something went wrong! :(";
    } else {
        echo '<script>window.location.href = "account.php";</script>';
    }
}
if ($theme=="picture") {
    $sql = $connection ->prepare("insert into movies (`Фильм`,`Режисер`,`Время`,`id_genres`,`Дата`,`photo`)values(?,?,?,?,?,?)");
    $sql->bind_param('sssiss',$name_movie,$name,$time,$genre_id[0],$year,$pict);
    if (!$sql->execute()) { // Error handling
        echo "Something went wrong! :(";
    } else {
        echo '<script>window.location.href = "account.php";</script>';
    }
}
?>
