<?php
if (isset($_POST["student_num"])&& isset($_FILES["pdfFile"])) {
    $file = $_FILES["pdfFile"];
    $customName = $_POST["student_num"];
    if ($file["error"] != 0) {
        die("failed to upload");
    }

    $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    if ($ext != "pdf") {
        die("You can only upload pdf files");
    }

    if ($file["size"] > 2 * 1024 * 1024) {
        die("your file size shouldn't be more than 2MB!!");
    }
    if (!is_dir("mydoc")) {
        mkdir("mydoc");
    }
    
    $newName = "mydoc/" . $customName . ".pdf";
    if (move_uploaded_file($file["tmp_name"], $newName)) {
        echo "File uploaded ;)" . $customName . ".pdf";
    } else {
        echo "Failed to save file in server";
    }


}else{
    echo "<script>alert('invalid data goback')</script>";
    
}
?>