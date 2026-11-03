<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script>
        fetch('head.html')
          .then(response => response.text())
          .then(data => {
            document.head.innerHTML += data;
          });
      </script>
</head>
<body>
    <div id="navbar-placeholder"></div>
    
    
    <script>
      fetch('nav_bar.html')
        .then(res => res.text())
        .then(data => {
          document.getElementById('navbar-placeholder').innerHTML = data;
        });
    </script>
<div class="register-box">
  <h2>Register</h2>
  <form id="register-form" action="register.php" method="POST" onsubmit="return validateForm()">
  <input type="text" name="fname" id="fname" placeholder="First Name" required />
  <input type="text" name="lname" id="lname" placeholder="Last Name" required />
  <input type="text" name="username" id="username" placeholder="Username" required />
  <input type="password" name="password" id="password" placeholder="Password" />
  <input type="email" name="email" id="email" placeholder="Email" required />
  <input type="text" name="phone" id="phone" placeholder="Phone (optional)" />
  <button type="submit">Register</button>
</form>

<?php 
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $fname = trim($_POST["fname"] ?? '');
      $lname = trim($_POST["lname"] ?? '');
      $username = trim($_POST["username"] ?? '');
      $password = $_POST["password"] ?? ''; 
      $email = trim($_POST["email"] ?? ''); 
      $phone = trim($_POST["phone"] ?? '');
      $isPremium = "false"; 
      if (!preg_match("/^[a-zA-Z]+$/", $fname)) { 
        echo "<script>alert('First name must contain only letters.'); window.history.back();</script>";
         exit; }
      if (!preg_match("/^[a-zA-Z]+$/", $lname)) {
        echo "<script>alert('Last name must contain only letters.'); window.history.back();</script>";
          exit;
       }
       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         echo "<script>alert('Invalid email address.'); window.history.back();</script>";
         exit; 
        } 
        if (!empty($phone) && !preg_match("/^\d{11}$/", $phone)) { 
          echo "<script>alert('Phone number must be 11 digits.'); window.history.back();</script>";
           exit; 
           }
         $file = "users.txt"; 
         if (file_exists($file)) {
           $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
           foreach ($lines as $line) { 
            $parts = explode(",", $line);
            if (trim($parts[0]) === $username) {
               echo "<script>alert('Username already exists. Please choose another.'); window.history.back();</script>"; 
               exit; 
               }
             } 
          }
        $newLine = $username . "," . $password . "," . $fname . "," . $lname . "," . $email . "," . $phone . "," . $isPremium . PHP_EOL;
        file_put_contents($file, $newLine, FILE_APPEND);
        echo "<script>alert('Registration successful!'); window.location.href='login.html';</script>";
         exit;
          }
     ?>



      
</body>
<footer>
  <div id="footer-placeholder"></div>

</footer>
</html>