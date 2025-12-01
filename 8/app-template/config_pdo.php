<?php

$servername ="localhost";
$username ="root";
$password ="";
$dbname ="php_course_blog";
try{
    $conn =new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
}
catch(PDOException $e)
{
    echo"Connection failed: ".$e->getMessage();
}


?>