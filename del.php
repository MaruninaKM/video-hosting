<?php
$mysqli = mysqli_connect("localhost", "root", "", "kursach");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$del = $_POST['dele'];

$query = "DELETE FROM video WHERE video_id = '$del'";
// Выполнение запроса
$result = $mysqli->query($query);

// Закрытие соединения
$mysqli = null;

header('Location: admin.php');
?>
