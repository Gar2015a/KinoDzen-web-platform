<?php
session_start();
require_once 'connect.php';
$topic = $_GET['table'];
$sql_choice_news = "delete from `choice_news` where `id_article`='$topic'";
$sql_votes_news2user = "delete from `votes_news2user` where `id_article`='$topic'";
$sql_view = "delete from `view` where `id_article`='$topic'";
$sql = "delete from `article` where `id`='$topic'";
mysqli_query($connection, $sql_choice_news);
mysqli_query($connection, $sql_view);
mysqli_query($connection, $sql_votes_news2user);
mysqli_query($connection, $sql);
function RDir($path)
{
    // если путь существует и это папка
    if (file_exists($path) and is_dir($path)) {
        // открываем папку
        $dir = opendir($path);
        while (false !== ($element = readdir($dir))) {
            // удаляем только содержимое папки
            if ($element != '.' and $element != '..') {
                $tmp = $path . '/' . $element;
                chmod($tmp, 0700);
                // если элемент является папкой, то
                // удаляем его используя нашу функцию RDir
                if (is_dir($tmp)) {
                    RDir($tmp);
                    // если элемент является файлом, то удаляем файл
                } else {
                    unlink($tmp);
                }
            }
        }
        // закрываем папку
        closedir($dir);
        // удаляем саму папку
        if (file_exists($path)) {
            rmdir($path);
        }
    }
}

$path = "files/" . $topic;
RDir($path);
echo '<script>window.location.href = "account.php";</script>';
?>