<!DOCTYPE html>
<html lang="fa">

<head>
    <?php
    include "config_pdo.php";
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه لاگین</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .input-field {
            margin-bottom: 15px;
        }

        .input-field input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .login-btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-btn:hover {
            background-color: #45a049;
        }

        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #4CAF50;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<?php
$lockCookie = "login_lock";
$lockTime = 5; 
$locked = false;

if (isset($_COOKIE[$lockCookie])) {
    $locked = true;
    echo "<script>alert('تلاش زیاد انجام داده‌اید، تا 1 دقیقه دسترسی ندارید');</script>";
} else {
    $locked = false;
}

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password`=?");
    $stmt->execute([$username, $password]);

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($users) > 0) {
        header("Location:dash.html");
    } else  {
?>
        <script>
            alert("دسترسی ندارید");
        </script>
    <?php
    setcookie($lockCookie, "1", time() + ( 60), "/");
    echo "<script>alert('اطلاعات اشتباه است. تا 1 دقیقه دسترسی ندارید');</script>";
    $locked = true;
    }
} else {
    ?>
    <script>
        alert("لطفاْ فیلد ها را کامل کنید‍");
    </script>
<?php
}
?>

<body>
    <div class="login-container">
        <h2>ورود به حساب کاربری</h2>
        <form action="" method="POST">
            <div class="input-field">
                <input <?php if(isset($locked) && $locked) echo "disabled"; ?>  type="text" name="username" placeholder="نام کاربری" required>
            </div>
            <div class="input-field">
                <input <?php if(isset($locked) && $locked) echo "disabled"; ?>  type="password" name="password" placeholder="رمز عبور" required>
            </div>
            <button  <?php if(isset($locked) && $locked) echo "disabled"; ?> type="submit" name="submit" class="login-btn">ورود</button>
        </form>
        <div class="forgot-password">
            <a href="#">فراموشی رمز عبور؟</a>
        </div>
    </div>
</body>

</html>