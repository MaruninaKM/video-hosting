<?php 
 // позволяет подключать файл только один раз, даже если вызывать инструкцию несколько раз с одним именем файла
 require_once 'config/connect.php';     
 $connect->set_charset("utf8"); // кодировка
//--- Проверка соединения (при успехе - вывод информации о хосте) ---
// Подключение к базе данных MySQL
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = mysqli_connect("localhost", "root", "", "kursach");
if ($mysqli == false){
    printf("Ошибка: Невозможно подключиться к MySQL" . mysqli_connect_error());     }
else {

    printf("Соединение установлено успешно. ");
        $login = $mysqli->query("SELECT user_login FROM users WHERE user_login='{$_POST['login2']}'");
        if ($login->num_rows==0){
            // соление паролей 
            $salt_pass = password_hash($_POST['password2'], PASSWORD_DEFAULT);
            $mysqli->query("INSERT INTO users(user_login, user_password, user_email)  VALUES ('{$_POST['login2']}', '{$salt_pass}', '{$_POST['email']}')");
            header('Location: wind_registration.php');
        }
        else{
            printf("Вернитесь на страницу назад. ");
            echo '<script> alert("Такой логин уже используется"); </script>';
            exit();
        }
}
?> 
