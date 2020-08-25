<?php
if(isset($_POST['submit'])){
    echo "<pre>";
    print_r($_FILES['file_upload']);
    echo "<pre>";
}

$tmp_name = $_FILES['file_upload']['tmp_name'];
$file_name =  $_FILES['file_upload']['name'];
$directory = 'uploads';
if(move_uploaded_file($tmp_name, $directory . "/" . $file_name)){
    echo 'Great Success';
} else {
    echo "fail";
}

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file_upload"><br />
    <input type="submit" name="submit">
    </form>
</body>
</html>