<?php
    if(isset($_POST['bestPG'])){
        $answer = $_POST['bestPG'];

        if(strlen($answer) < 2){
            echo "Please enter a name";
        } else if($answer === "Kyle Lowry") {
            echo "You have good taste!";
        } else {
            echo "Wrong. Its Kyle Lowry";
        }
    } 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice Section 6</title>
</head>
<body>
    <form action="practice_section_6.php" method="POST">
        <input type="text" name="bestPG" placeholder="Best NBA PG">
        <input type="submit" name="submit">
    </form>
</body>
</html>