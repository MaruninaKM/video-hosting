<?php 
    $mysqli = mysqli_connect("localhost", "root", "", "kursach");
    
    $login = $_POST['login1'];
    $password = $_POST['password1'];  
      
    $result = $mysqli->query("SELECT user_password FROM users WHERE user_login =  '$login'");
    $result = $result->fetch_assoc();
    $hashed_password = $result["user_password"];
    
    $admi = "admin";

    if (password_verify($password, $hashed_password)) {
        if ($login === $admi) {

            // устанавливает файл cookie и перенаправляет пользователя на страницу adnin.php
            //Срок действия файла cookie - 3600 секунд.
            setcookie("ksyadm", "$login", time() + 3600, "/");
            header('Location: admin.php');

            $query1 = "SELECT user_id FROM users WHERE user_login =  '$login'";
            $result1 = mysqli_query($mysqli, $query1);
            $row1 = mysqli_fetch_assoc($result1);
            $userId = $row1['user_id'];

            session_start();
            // Сохранение данных в сессию
            $_SESSION['Log'] = $login;
            $_SESSION['ID'] = $userId;
        } else { 
 //--------------------------------------- 
    $query1 = "SELECT user_id FROM users WHERE user_login =  '$login'";
    $result1 = mysqli_query($mysqli, $query1);
    $row1 = mysqli_fetch_assoc($result1);
    $userId = $row1['user_id'];

    $query2 = "SELECT user_email FROM users WHERE user_login =  '$login'";
    $result2 = mysqli_query($mysqli, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $userEmail = $row2['user_email'];

    session_start();
    // Сохранение данных в сессию
    $_SESSION['Log'] = $login;
    $_SESSION['ID'] = $userId;
    $_SESSION['Email'] = $userEmail;
//---------------------------------------
    //Срок действия файла cookie - 3600 секунд.
    setcookie("ksyusha", "$login", time() + 3600, "/");
    header('Location: ksutube.php');};
    } //Если пароли не совпадают, код перенаправляет пользователя на wind_registration.php
    else {
        header('Location: wind_registration.php');
    };
?>