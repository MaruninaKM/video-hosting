<!DOCTYPE html>
<html lang="ru">
<?php
    if (isset($_COOKIE["ksyusha"])) {
        setcookie("ksyusha", "", time() - 3600, "/");
        }
        if (isset($_COOKIE["ksyadm"])) {
            setcookie("ksyadm", "", time() - 3600, "/");
            }
?> 
<head>
    <meta charset="UTF-8">
    <title>A-17-20_Marunina_Kursovya_Video hosting</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="radiobox">

        <input type="radio" name="bot" id="ind" value=""checked>
        <label for="ind">Login to</label>
        <input type="radio" name="bot" id="reg" value="" >
        <label for="reg">Registration</label>
              
        <div id="ind1">
            <form action="log_in.php" method="post" class="form">
                <h2>Welcome back!</h2>
                <label for="login1">Login:</label>
                <input type="text" id="login1" name="login1" required>
                <br>
                <label for="password1">Password:</label>
                <input type="password" id="password1" name="password1" required>
                <br><br>
                <input type="submit" value="Login">
        </form>
        </div>

        <div id="reg1">
            <form action="log_req.php" method="post" class="form">
                <h2>Hello, this is your first time?</h2>
                       <label for="login2">Login:</label>
                       <input type="text" id="login2" name="login2" required>
                       <br>
                       <label for="password2">Password:</label>
                       <input type="password" id="password2" name="password2" required>
                       <br>
                       <label for="email">e-mail:</label>
                       <input type="email" id="email" name="email" required>
                       <br><br>
                       <input type="submit" value="Registration">    
               </form>
        </div>
    </div>
</body>
</head>
</html>