<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>A-17-20_Marunina_Kursovya_Video hosting</title>
    <link rel="stylesheet" href="css/style_like.css">
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
        <form action="ksutube.php" method="post">
            <button class="exit" type="submit">Назад</button>
        </form>
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
<h1>Мои лайки</h1>
    
<?php
$mysqli = mysqli_connect("localhost", "root", "", "kursach");
    
 // Выполнение запроса на выборку данных из таблицы
 $result6 = $mysqli->query(" SELECT video_name, video_link FROM video AS t1 JOIN likes AS t2 ON t1.video_id = t2.video_id
 WHERE t2.user_id = '$ID'");

 // Формирование таблицы на основе полученных данных
 echo "<table>";
 echo "<thead><tr><th>Название</th><th>Ссылка</th></tr></thead>";
 echo "<tbody>";
 while ($row6 = $result6->fetch_assoc()) {
     echo "<tr>";
     echo "<td>" . $row6["video_name"] . "</td>";
     echo "<td><a href=\" https://www.youtube.com/watch?v=". $row6["video_link"] ."  \" >" . $row6["video_name"] . "</a></td>";
     echo "</tr>";
 }
 echo "</tbody>";
 echo "</table>";
?>

</body>
</html>