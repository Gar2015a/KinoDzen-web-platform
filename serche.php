<?php
require_once 'connect.php';

if (!empty($_POST["referal"])) {
    $referal = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["referal"]))));
    $referal = '%' . $referal . '%';
    $statement = $connection->prepare("SELECT * from article WHERE title LIKE ?");
    $statement->bind_param('s', $referal);
    $statement->execute();
    $data = $statement->get_result();
    while ($row = mysqli_fetch_array($data)) {
        echo "\n<li><a class='zagolovok' href='media.php?table=".$row['title']."'>".$row['title']."</a></li>";
    }
}
?>