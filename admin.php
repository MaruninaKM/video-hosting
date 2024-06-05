<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>A-17-20_Marunina_Kursovya_Video hosting</title>
<link rel="stylesheet" href="css/style_admin.css">

</head>
<body>


<?php 
    session_start();
    // Получение данных из сессии
    $login = $_SESSION['Log'];
    $ID = $_SESSION['ID'];
    $Email = $_SESSION['Email'];
    // Вывод данных
?>
  <!-- Footer -->
  <div class="footer">
      <p> ФГБОУ ВО Национальный исследовательский университет «МЭИ» </p>
      <p> КУРСОВАЯ РАБОТА </p>
      <p> Выполнила: Марунина К.М. </p>
      <p> Группа: А-17-20 </p>
  </div>

  <div>          
    <div class = "sidenav">

    <?php
    //---------------------------------------
      // Вывод данных
      echo '<span>ID пользователя: </span>';
      echo $ID;
      echo '<br>';
      echo '<span>Логин: </span>';
      echo $login;
      echo '<br>';    
      echo '<span>E-mail: </span>';
      echo $Email;
      echo '<br>';  echo '<br>';
    //--------------------------------------- 
    ?>
    
    
  <div id="exit">
        <form action="wind_registration.php" method="post">
            <button class="exit" type="submit">Выйти</button>
        </form>
  </div>

  <button class="wind" onclick="openWindow()">Удалить видео</button>
    <div id="myWindow" class="window">
      <div class="window-content">
        <span class="close-btn" onclick="closeWindow()">&times;</span>
        <h2>Удалить</h2>

        <div id="del">
            <form action="del.php" method="post" class="form">
            <p>Введите ID видео, которое собираетесь удалять</p>
                       <label for="delit">ID:</label>
                       <input type="text" id="dele" name="dele" required>
                       <br><br>
                       <input type="submit" value="Delete">    
            </form>
        </div>

      </div>
    </div> 

    <br>

    <div class="footer-content-right">
      <a href="https://www.php.net/"><img src="images/instagram.png" class="icon-style" alt="Github icon"></a>
      <a href="https://www.php.net/"><img src="images/twitter.png" class="icon-style" alt="Twitter icon"></a>
      <a href="https://www.php.net/"><img src="images/gmail.png" class="icon-style" alt="Emailicon"></a>
    </div>
  </div>

<span class = "had1">▶</span>
<span class = "had2"> KsuTube</span>
<br>
<h1>Администратор</h1>
<br>

<?php

if (!isset($_COOKIE["ksyadm"])) {
    header('Location: wind_registration.php');
    }

// Подключение к базе данных MySQL
$mysqli = mysqli_connect("localhost", "root", "", "kursach");
// Обработка ошибок подключения
if ($mysqli->connect_errno) {
echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// Выполнение запроса на выборку данных из таблицы
$result = $mysqli->query("SELECT * FROM video");
// Формирование таблицы на основе полученных данных


   // Выполнение запроса на выборку данных из таблицы
 $result6 = $mysqli->query(" SELECT * FROM video");

 // Формирование таблицы на основе полученных данных
 echo "<table>";
 echo "<thead><tr><th>ID</th><th>Название</th><th>Ссылка</th> </tr></thead>";
 echo "<tbody>";
 while ($row6 = $result6->fetch_assoc()) {
     echo "<tr>";
     echo "<td>" . $row6["video_id"] . "</td>";
     echo "<td>" . $row6["video_name"] . "</td>";
     echo "<td><a href=\"" . $row6["video_link"] . "\">" . $row6["video_name"] . "</a></td>";
     echo "</tr>";
 }
 echo "</tbody>";
 echo "</table>";


// Освобождение памяти, занятой результатом запроса
$result->free();

// Закрытие соединения с базой данных MySQL
$mysqli->close();
?>

<script> 
function openWindow() {
  document.getElementById("myWindow").style.display = "block";
}
function closeWindow() {
  document.getElementById("myWindow").style.display = "none";
}
</script>

</form>
</body>
</html>