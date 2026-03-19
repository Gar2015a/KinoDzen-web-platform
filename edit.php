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
$theme = trim($_POST['radio_topic']);
$theme = htmlspecialchars($theme);
$movies = trim($_POST['movies']);
$movies = htmlspecialchars($movies);

$movies2 = trim($_POST['movies222']);
$movies2 = htmlspecialchars($movies2);
$image1 = $_POST['image1_'];
$arr = explode(',', $_COOKIE['links']);

$video = $_COOKIE['videos'];
$id = $_SESSION['user']['id'];
$old_topic = $_SESSION['id']['topic'];
$old_fon = $_SESSION['id']['fon'];
$old_image1 = $_SESSION['id']['image1'];
$old_image2 = $_SESSION['id']['image2'];
$target_dir = 'files/' . $topic . '/';

$resultTable = $connection->prepare("SELECT * FROM `article` where `title`= ?");
$resultTable->bind_param('s', $old_topic);
$resultTable->execute();
$kk=$resultTable->get_result();
$id = mysqli_fetch_row($kk);
if ($_POST['radio_button'] == "image") {
    if ($_FILES['files1']['name'] != '') {
        unlink($old_image1);
    }
    if ($_FILES['files2']['name'] != '') {
        unlink($old_image2);
    }
}
if ($_FILES['fon']['name'] != '') {
    if ($old_fon != '') {
        unlink($old_fon);
    }
}
if ($old_topic != $topic) {
    $ren = "RENAME TABLE $old_topic TO $topic";
    mysqli_query($connection, $ren);
    rename("files/" . $old_topic, "files/" . $topic);
    $vis = "update `article` set `visible`= 0 where `id`='$old_topic'";
    mysqli_query($connection, $vis);
}
if ($theme != '') {
    $resultTheme = $connection->prepare("SELECT id FROM `topic` where `theme`= ?");
    $resultTheme->bind_param('s', $theme);
    $resultTheme->execute();
    $kl=$resultTheme->get_result();
    $theme_id = mysqli_fetch_row($kl);
    $sql = $connection->prepare("update `article` set `id_topic` = ? where `id` = ?");
    $sql->bind_param('ii',$theme_id[0],$id[0]);
    if (!$sql->execute()) { // Error handling
        echo "Something went wrong! :(";
    }
}
if ($movies != '') {
    $resultMovie = $connection->prepare("SELECT id FROM `movies` where `Фильм`= ?");
    $resultMovie->bind_param('s', $movies);
    $resultMovie->execute();
    $kp=$resultMovie->get_result();
    $movies_id = mysqli_fetch_row($kp);
    $sql = $connection->prepare("update `article` set `id_movies` = ? where `id` = ?") ;
    $sql->bind_param('ii',$movies_id[0],$id[0]);
    if (!$sql->execute()) {
        echo "Something went wrong! :(";
    }
}
if ($movies2 != '') {
    $resultMovie2 = $connection->prepare("SELECT id FROM `movies` where `Фильм`= ?");
    $resultMovie2->bind_param('s', $movies2);
    $resultMovie2->execute();
    $kp2=$resultMovie2->get_result();
    $movies_id2 = mysqli_fetch_row($kp2);
    $sql = $connection->prepare("update `article` set `id_movies2` = ? where `id` = ?") ;
    $sql->bind_param('ii',$movies_id2[0],$id[0]);
    if (!$sql->execute()) {
        echo "Something went wrong! :(";
    }
}
if ($text != '') {
    $sql = $connection->prepare("update `article` set `text` = ? where `id` = ?") ;
    $sql->bind_param('ss',$text,$id[0]);
    if (!$sql->execute()) {
        echo "Something went wrong! :(";
    }
}
if ($image1_text != '') {
    $sql = $connection->prepare("update `article` set `image1_text` = ? where `id` = ?");
    $sql->bind_param('ss', $image1_text, $id[0]);
    if (!$sql->execute()) {
        echo "Something went wrong! :(";
    }
}
if ($image2_text != '') {
    $sql = $connection->prepare("update `article` set `image2_text` = ? where `id` = ?") ;
    $sql->bind_param('ss',$image2_text,$id[0]);
    if (!$sql->execute()) {
        echo "Something went wrong! :(";
    }
}

if ($_FILES['fon']['name'] != '') {

    $fon = $target_dir . time() . "._." . $_FILES['fon']['name'];
    move_uploaded_file($_FILES['fon']['tmp_name'], $target_dir . time() . "._." . $_FILES['fon']['name']);
    $fon = trim($fon);
    $fon = htmlspecialchars($fon);
    $sql = $connection->prepare("update `article` set `fon` = ? where `id` = ?");
    $sql->bind_param('ss',$fon,$id[0]);
    if (!$sql->execute()) {
        echo "Something went wrong! :(";
    }

}

if ($_POST['radio_button'] == "image") {

    if ($_FILES['files1']['name'] != '') {
        $photo1 = $target_dir . time() . "._." . $_FILES['files1']['name'];
        move_uploaded_file($_FILES['files1']['tmp_name'], $target_dir . time() . "._." . $_FILES['files1']['name']);
        $photo1 = trim($photo1);
        $photo1 = htmlspecialchars($photo1);
        $sql = $connection->prepare("update `article` set `image1` = ? where `id` = ?");
        $sql->bind_param('ss',$photo1,$id[0]);
        if (!$sql->execute()) {
            echo "Something went wrong! :(";
        }
    }
    if ($_FILES['files2']['name'] != '') {
        $photo2 = $target_dir . time() . "._." . $_FILES['files2']['name'];
        move_uploaded_file($_FILES['files2']['tmp_name'], $target_dir . time() . "._." . $_FILES['files2']['name']);
        $photo2 = trim($photo2);
        $photo2 = htmlspecialchars($photo2);
        $sql = $connection->prepare("update `article` set `image2` = ? where `id` = ?");
        $sql->bind_param('ss',$photo2,$id[0]);
        if (!$sql->execute()) {
            echo "Something went wrong! :(";
        }
    }
    echo '<script>window.location.href = "account.php";</script>';
}

if ($_POST['radio_button'] == "visio") {
    if ($arr[0] != '') {
        $photo1 = trim($arr[0]);
        $photo1 = htmlspecialchars($photo1);
        $sql =$connection->prepare( "update `article` set `image1` = ? where `id` = ?");
        $sql->bind_param('ss',$photo1,$id[0]);
        if (!$sql->execute()) {
            echo "Something went wrong! :(";
        }
    }
    if ($arr[1] != '') {
        $photo2 = trim($arr[1]);
        $photo2 = htmlspecialchars($photo2);
        $sql =$connection->prepare( "update `article` set `image2` = ? where `id` = ?");
        $sql->bind_param('ss',$photo2,$id[0]);
        if (!$sql->execute()) {
            echo "Something went wrong! :(";
        }
    }
    echo '<script>window.location.href = "account.php";</script>';
}
if ($_POST['radio_button'] == "picture") {
    if ($_FILES['picture']['name'] != '') {
        $photo1 = $target_dir . time() . $_FILES['picture']['name'];
        move_uploaded_file($_FILES['picture']['tmp_name'], $target_dir . time() . $_FILES['picture']['name']);
        $photo1 = trim($photo1);
        $photo1 = htmlspecialchars($photo1);
        $sql = $connection->prepare("update `article` set `image1` = ? where `id` = ?");
        $sql->bind_param('ss',$photo1,$id[0]);
        if (!$sql->execute()) {
            echo "Something went wrong! :(";
        }
    }
    if ($video != '') {
        $photo2 = trim($video);
        $photo2 = htmlspecialchars($photo2);
        $sql =$connection->prepare( "update `article` set `image2` = ? where `id` = ?");
        $sql->bind_param('ss',$photo2,$id[0]);
        if (!$sql->execute()) {
            echo "Something went wrong! :(";
        }
    }
    echo '<script>window.location.href = "account.php";</script>';
}
?>