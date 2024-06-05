<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>A-17-20_Marunina_Kursovya_Video hosting</title>
    <link rel="stylesheet" href="css/style_tub.css">
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

    <div class = "inline">
          <form action="like.php" method="post">
              <button class="like">Мои лайки</button>
          </form>
    </div> 
      
    <div class = "d">
      <button class="wind" onclick="openWindow()">О нас</button>
      <div id="myWindow" class="window">
        <div class="window-content">
          <span class="close-btn" onclick="closeWindow()">&times;</span>
          <h2>О KsuTube</h2>
          <p>Наша миссия - дать каждому высказаться и показать им мир.</p>
          <p>Мы верим, что каждый заслуживает права голоса и что мир становится лучше, когда мы слушаем, делимся и создаем сообщество с помощью наших историй.</p>
        </div>
      </div> 
    </div>
    
    <div class = "inline">
      <form action="wind_registration.php" method="post">
        <button class="exit" type="submit">Выйти</button>
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
    <br><br><br>

    
       
<?php
//---------------------------------------
    if (!isset($_COOKIE["ksyusha"])) {
        header('Location: wind_registration.php');
        }

    // Подключение к базе данных MySQL
    $mysqli = mysqli_connect("localhost", "root", "", "kursach");
    // Обработка ошибок подключения
    if ($mysqli->connect_errno) {
        echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
//---------------------------------------
    // Запрос для получения количества строк в базе данных
    $query1 = "SELECT COUNT(*) as total FROM video";
    $result1 = mysqli_query($mysqli, $query1);
    $row = mysqli_fetch_assoc($result1);
    $totalTabs = $row['total'];

    echo '<div class="tabs" id="tabs-1">';
    echo '  <div class="tabs__nav">';
  //---------------------------------------   
    // Генерация кнопок вкладок
    for ($i = 1; $i <= $totalTabs; $i++) {      
        $query4 = "SELECT video_id FROM video ORDER BY video_id LIMIT ".($i-1).", 1;";
        $result4 = mysqli_query($mysqli, $query4);
        $row3 = mysqli_fetch_assoc($result4);
        $videoId = $row3['video_id'];

        $query3 = "SELECT video_name FROM video WHERE video_id = '$videoId '";
        $result3 = mysqli_query($mysqli, $query3);
        $row2 = mysqli_fetch_assoc($result3);
        $videoName = $row2['video_name'];
        $activeClass = ($i === 1) ? "tabs__btn_active" : "";
        echo '<button class="tabs__btn ' . $activeClass . '">' . $videoName . '</button>';
    }
  //--------------------------------------- 
    echo '</div>';
    
    // Запрос для получения данных из базы данных
    $query2 = "SELECT * FROM video";
    $result2 = mysqli_query($mysqli, $query2);

    // Генерация блока с вкладками и контентом
    echo '<div class="tabs__content">';
    $j = 1;
    while ($row = mysqli_fetch_assoc($result2)) {
       
        $query8 = "SELECT video_id FROM video ORDER BY video_id LIMIT ".($j-1).", 1;";
        $result8 = mysqli_query($mysqli, $query8);
        $row8 = mysqli_fetch_assoc($result8);
        $videoI8 = $row8['video_id'];

        $videoLink = $row['video_link'];
        $activeClass = ($j === 1) ? "tabs__pane_show" : "";
            echo '  <div class="tabs__pane ' . $activeClass . '">
                    <div class="iframe">
                        <div class="player" id="player-' . $j . '" data-video-id="' . $videoLink . '"></div>
                    </div>
                                                            
                    <div id="lik">
                        <form action="my_like.php" method="post" class="form">                   
                        <button class = "li" name = "idi" > ♡ </button>  
                        <input type="hidden" name="idi" value="'. $videoI8 .'" >
                        </form>
                    </div>
                </div>';
        $j++;
    }
    echo '</div>';
    echo '</div>';

//---------------------------------------
    // Освобождение памяти, занятой результатом запроса
    $result4->free();
//---------------------------------------
    // Закрытие соединения с базой данных MySQL
    $mysqli->close();
?>
<br><br>
<script>
    class ItcTabs {
      constructor(target, config) {
        const defaultConfig = {};
        this._config = Object.assign(defaultConfig, config);
        this._elTabs = typeof target === 'string' ? document.querySelector(target) : target;
        this._elButtons = this._elTabs.querySelectorAll('.tabs__btn');
        this._elPanes = this._elTabs.querySelectorAll('.tabs__pane');
        this._init();
        this._events();
      }
      _init() {
        this._elTabs.setAttribute('role', 'tablist');
        this._elButtons.forEach((el, index) => {
          el.dataset.index = index;
          el.setAttribute('role', 'tab');
          this._elPanes[index].setAttribute('role', 'tabpanel');
        });
      }
      show(elLinkTarget) {
        const elPaneTarget = this._elPanes[elLinkTarget.dataset.index];
        const elLinkActive = this._elTabs.querySelector('.tabs__btn_active');
        const elPaneShow = this._elTabs.querySelector('.tabs__pane_show');
        if (elLinkTarget === elLinkActive) {
          return;
        }
        this._paneFrom = elPaneShow;
        this._paneTo = elPaneTarget;
        elLinkActive ? elLinkActive.classList.remove('tabs__btn_active') : null;
        elPaneShow ? elPaneShow.classList.remove('tabs__pane_show') : null;
        elLinkTarget.classList.add('tabs__btn_active');
        elPaneTarget.classList.add('tabs__pane_show');
        this._elTabs.dispatchEvent(new CustomEvent('tab.itc.change', {
          detail: {
            elTab: this._elTabs,
            paneFrom: this._paneFrom,
            paneTo: this._paneTo
          }
        }));
        elLinkTarget.focus();
      }
      showByIndex(index) {
        const elLinkTarget = this._elButtons[index];
        elLinkTarget ? this.show(elLinkTarget) : null;
      };
      _events() {
        this._elTabs.addEventListener('click', (e) => {
          const target = e.target.closest('.tabs__btn');
          if (target) {
            e.preventDefault();
            this.show(target);
          }
        });
      }
    }

    const elTab = document.querySelector('.tabs');
    new ItcTabs(elTab);

    const elScript = document.createElement('script');
    elScript.src = 'https://www.youtube.com/iframe_api';
    document.head.append(elScript);

    const players = {};
    function onYouTubeIframeAPIReady() {
      document.querySelectorAll('.player').forEach(el => {
        players[el.id] = new YT.Player(el.id, {
          height: el.dataset.height,
          width: el.dataset.width,
          videoId: el.dataset.videoId
        });
      })
    }
// остановка видео при переключении
    elTab.addEventListener('tab.itc.change', (e) => {
      const paneFrom = e.detail.paneFrom;
      if (paneFrom) {
        const player = paneFrom.querySelector('.player');
        player ? players[player.id].pauseVideo() : null;
      }
    })
  </script>
<script> 
function openWindow() {
  document.getElementById("myWindow").style.display = "block";
}
function closeWindow() {
  document.getElementById("myWindow").style.display = "none";
}
</script>

</body>
</html>