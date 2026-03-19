<?php
session_start();
require_once 'connect.php';
$topic = trim($_POST['topic']);
$topic = htmlspecialchars($topic);
$text = trim($_POST['review-text']);
$text = htmlspecialchars($text);
$image1_text = trim($_POST['image1_text']);
$image1_text = htmlspecialchars($image1_text);
$image2_text = trim($_POST['image2_text']);
$image2_text = htmlspecialchars($image2_text);
$picture_text = trim($_POST['picture_text']);
$picture_text = htmlspecialchars($picture_text);

$movies = trim($_POST['movies']);
$movies = htmlspecialchars($movies);

$movies2 = trim($_POST['movies222']);
$movies2 = htmlspecialchars($movies2);

$theme = trim($_POST['radio_topic']);
$theme = htmlspecialchars($theme);
$video = trim($_COOKIE['videos']);
$id = $_SESSION['user']['id'];
$arr = explode(',', $_COOKIE['links']);
$d = getdate(); // использовано текущее время
foreach ($d as $key => $val) {
    $date = $d[year] . "-" . $d[mon] . "-" .$d[mday] ;
    $time = $d[hours] . ":" . $d[minutes];
}
$resultMovie = $connection->prepare("SELECT id FROM `movies` where `Фильм`= ?");
$resultMovie->bind_param('s', $movies);
$resultMovie->execute();
$movies_id = mysqli_fetch_row($resultMovie->get_result());

$resultMovie2 = $connection->prepare("SELECT id FROM `movies` where `Фильм`= ?");
$resultMovie2->bind_param('s', $movies2);
$resultMovie2->execute();
$movies_id2 = mysqli_fetch_row($resultMovie2->get_result());

$resultTopic = $connection->prepare("SELECT id FROM `topic` where `theme`= ?");
$resultTopic->bind_param('s', $theme);
$resultTopic->execute();
$theme_id = mysqli_fetch_row($resultTopic->get_result());
$like = 0;
$dislike = 0;
$yes = 0;
$no = 0;
$view = 0;
$visible = 0;
$pd = explode(',', $video);

if ($_POST['radio_button'] == "image") {
    mkdir("files/" . $topic, 0700);
    $target_dir = 'files/' . $topic . '/';
    if ($_FILES['fon']['name'] != '') {
        $fon = $target_dir . time() . "._." . $_FILES['fon']['name'];
        $fon = trim($fon);
        $fon = htmlspecialchars($fon);
        move_uploaded_file($_FILES['fon']['tmp_name'], $target_dir . time() . "._." . $_FILES['fon']['name']);
    } else {
        $fon = '';
    }
    $photo1 = $target_dir . time() . "._." . $_FILES['files1']['name'];
    $photo1 = trim($photo1);
    $photo1 = htmlspecialchars($photo1);
    $photo2 = $target_dir . time() . "._." . $_FILES['files2']['name'];
    $photo2 = trim($photo2);
    $photo2 = htmlspecialchars($photo2);
    move_uploaded_file($_FILES['files1']['tmp_name'], $target_dir . time() . "._." . $_FILES['files1']['name']);
    move_uploaded_file($_FILES['files2']['tmp_name'], $target_dir . time() . "._." . $_FILES['files2']['name']);
    $sql = $connection->prepare("insert into `article` (`title` , `id_user`, `date`, `image1`, `image1_text`, `image2`, `image2_text`, `text`, `id_topic`, `id_movies`,`id_movies2`, `fon` , `view` , `like`, `dislike` , `yes` , `no`, `visible`)value (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $sql->bind_param('sissssssiiisiiiiii', $topic, $id, $date, $photo1, $image1_text, $photo2, $image2_text, $text, $theme_id[0], $movies_id[0],$movies_id2[0],  $fon, $view, $like, $dislike, $yes, $no, $visible);
    if (!$sql->execute()) { // Error handling
        echo "Something went wrong! :(";
    } else {
        echo '<script>window.location.href = "index.php";</script>';
    }
}
if ($_POST['radio_button'] == "visio") {
    mkdir("files/" . $topic, 0700);
    $target_dir = 'files/' . $topic . '/';
    if ($_FILES['fon']['name'] != '') {
        $fon = $target_dir . time() . "._." . $_FILES['fon']['name'];
        move_uploaded_file($_FILES['fon']['tmp_name'], $target_dir . time() . "._." . $_FILES['fon']['name']);
    } else {
        $fon = '';
    }
    $photo1 = trim($arr[0]);
    $photo1 = htmlspecialchars($photo1);
    $photo2 = trim($arr[1]);
    $photo2 = htmlspecialchars($photo2);
    $sql = $connection->prepare("insert into `article` (`title` , `id_user`, `date`, `image1`, `image1_text`, `image2`, `image2_text`, `text`, `id_topic`, `id_movies`,`id_movies2`, `fon` , `view` , `like`, `dislike` , `yes` , `no`, `visible`)value (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $sql->bind_param('sissssssiiisiiiiii', $topic, $id, $date, $photo1, $image1_text, $photo2, $image2_text, $text, $theme_id[0], $movies_id[0],$movies_id2[0],  $fon, $view, $like, $dislike, $yes, $no, $visible);
    if (!$sql->execute()) { // Error handling
        echo "Something went wrong! :(";
    } else {
        echo '<script>window.location.href = "index.php";</script>';
    }
}

if ($_POST['radio_button'] == "picture") {
    mkdir("files/" . $topic, 0700);
    $target_dir = 'files/' . $topic . '/';
    if ($_FILES['fon']['name'] != '') {
        $fon = $target_dir . time() . "._." . $_FILES['fon']['name'];
        move_uploaded_file($_FILES['fon']['tmp_name'], $target_dir . time() . "._." . $_FILES['fon']['name']);
    } else {
        $fon = '';
    }
    $photo1 = $target_dir . time() . "._." . $_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'], $target_dir . time() . "._." . $_FILES['picture']['name']);
    $photo2 = $pd[1];
    $sql = $connection->prepare("insert into `article` (`title` , `id_user`, `date`, `image1`, `image1_text`, `image2`, `image2_text`, `text`, `id_topic`, `id_movies`,`id_movies2`, `fon` , `view` , `like`, `dislike` , `yes` , `no`, `visible`)value (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $sql->bind_param('sissssssiiisiiiiii', $topic, $id, $date, $photo1, $image1_text, $photo2, $image2_text, $text, $theme_id[0], $movies_id[0],$movies_id2[0],  $fon, $view, $like, $dislike, $yes, $no, $visible);
    if (!$sql->execute()) { // Error handling
        echo "Something went wrong! :(";
    } else {
        echo '<script>window.location.href = "index.php";</script>';
    }
}
?>