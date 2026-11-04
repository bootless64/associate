<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="background-color:<?php if (isset($_GET['back'])){
    if($_GET['back']==1)
    echo 'red';
else if($_GET['back']==2)
echo 'blue';
elseif($_GET['back']==3)
echo 'green';
else
echo 'gray';
}?>;text-align:center">

<h1>Choose an option :</h1><br>
    
<a href="?back=1" style="color:red">Revenge</a><br>
<a href="?back=2" style="color:blue">Loyalty </a><br>
<a href="?back=3" style="color:green">Growth</a><br>
</body>
</html>