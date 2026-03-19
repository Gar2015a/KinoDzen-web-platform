<?php
session_start();
require_once 'connect.php';
$table = trim($_GET['table']);
$table = htmlspecialchars($table);
$sql = $connection->prepare("update `article` set `visible`= 1 where `id`=?");
$sql->bind_param('s', $table);
$sql->execute();
echo '<script>window.location.href = "admin.php";</script>';
?>