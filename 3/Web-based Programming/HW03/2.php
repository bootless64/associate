<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


     <form action="alu.php" method="POST" enctype="multipart/form-data">
        <label for="student_num">Enter your ID:</label><br>
        <input type="text" name="student_num" placeholder="ID"></input><br><br>
        <input type="file" name="pdfFile" accept=".pdf" ><br>
        <br>
        <br>
        <input type="submit" name="submit" value="Submit" ></input>
    </form>
</body>
</html>