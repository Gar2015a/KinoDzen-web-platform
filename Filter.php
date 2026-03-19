<?php
require_once 'connect.php';
$result = mysqli_query($connection, "SELECT * FROM `article`");

$result_view = mysqli_query($connection, "SELECT * FROM `article`");
$result_view2 = mysqli_query($connection, "SELECT * FROM `article`");

$result_like = mysqli_query($connection, "SELECT * FROM `article`");
$result_like2 = mysqli_query($connection, "SELECT * FROM `article`");

while ($arr = mysqli_fetch_assoc($result)) {
    $old['old'][$arr['title']] = array(
        'name' => $arr['title'],
        'date' => $arr['date']
    );
    $new['new'][$arr['title']] = array(
        'name' => $arr['title'],
        'date' => $arr['date']
    );
}
while ($arr = mysqli_fetch_assoc($result_view)) {
    while ($brr = mysqli_fetch_assoc($result_view2)) {
        $kolvo += $brr['view'];
    }
    $famous['famous'][$arr['title']] = array(
        'name' => $arr['title'],
        'kolvo' => $kolvo
    );
    $infamous['infamous'][$arr['title']] = array(
        'name' => $arr['title'],
        'kolvo' => $kolvo,
    );
    $kolvo = 0;
}

while ($arr = mysqli_fetch_assoc($result_like)) {
    $like1['like1'][$arr['title']] = array(
        'name' => $arr['title'],
        'like' => $arr['like']
    );

}

function cmp_function_like($a, $b)
{
    return ($a['like'] < $b['like']);
}uasort($like1['like1'], 'cmp_function_like');

function cmp_function_count_desc($a, $b)
{
    return ($a['kolvo'] < $b['kolvo']);
}uasort($famous['famous'], 'cmp_function_count_desc');

function cmp_function_count($a, $b)
{
    return ($a['kolvo'] > $b['kolvo']);
}uasort($infamous['infamous'], 'cmp_function_count');

function cmp_function($a, $b)
{
    return ($a['date'] > $b['date']);
}uasort($old['old'], 'cmp_function');

function cmp_function_desc($a, $b)
{
    return ($a['date'] < $b['date']);
}uasort($new['new'], 'cmp_function_desc');
?>
