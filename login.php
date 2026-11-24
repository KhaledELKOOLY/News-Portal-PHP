<!--<h1 style = "color:red;text-align:center"> تسجيل الدخول </h1>-->

<?php

$error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
       $username_login = $_POST['username'];
       $password_login = $_POST['password'];

      require "db_connection.php";


      $query = "SELECT * FROM users WHERE username = '$username_login' and password = '$password_login' limit 1;";

      $result = mysqli_query($conn, $query);
      $num = mysqli_num_rows($result);
      
      if($num == 1)
        {
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $row['name'];
            $_SESSION['userid'] = $row['id'];
            header("location:index.php");
            exit();
        }
        else
        {
            $error = "كلمه المرور او الباسورد خطا";
        }
    

    }





?>



<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="login-container">
        <p> <?php echo $error; ?> </p>


        <h2>تسجيل الدخول</h2>
        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="username">اسم المستخدم</label>
                <input type="text" id="username" name="username" placeholder="أدخل اسم المستخدم" required>
            </div>
            
            <div class="input-group">
                <label for="password">كلمة المرور</label>
                <input type="password" id="password" name="password" placeholder="أدخل كلمة المرور" required>
            </div>

            <div class="options">
                <label class="remember-me">
                    <input type="checkbox"> تذكرني
                </label>
                <a href="#" class="forgot-pass">نسيت كلمة المرور؟</a>
            </div>

            <button type="submit" class="login-btn">دخول</button>

            <p class="signup-link">ليس لديك حساب؟ <a href="#">سجل الآن</a></p>
        </form>
    </div>

</body>
</html>