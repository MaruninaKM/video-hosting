<?php
$mysqli = mysqli_connect("localhost", "root", "", "kursach");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$like = $_POST['idi'];
//---------------------------------------
session_start();
$ID = $_SESSION['ID'];
echo $ID;
echo $like;
//---------------------------------------

$query = "INSERT INTO likes (user_id, video_id) VALUES ('$ID', '$like')";
// Выполнение запроса
$result = $mysqli->query($query);

// Закрытие соединения
$mysqli = null;

header('Location: ksutube.php');
?>
