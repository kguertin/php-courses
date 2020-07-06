<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice Section 3</title>
</head>
<body>
    <?php
        $like = "PHP";
        if($like === "HTML") {
            echo "I like HTML";
        } else if($like === "CSS"){
            echo "I like CSS";
        } else {
            echo "I love PHP";
        }

        echo "<br>";

        for($i = 1; $i <= 10; $i++){
            echo $i . "<br>";
        }

        echo "<br>";

        $best_pg = "Lonzo Ball";

        switch($best_pg){
            case "Steph Curry":
            echo "Thats a lie";
            break;
            case "John Wall": 
            echo "Thats a big lie";
            break;
            case "Chris Paul":
            echo "Maybe years ago";
            break;
            case "Gorin Dragic": 
            echo "Must be a heat fan";
            break;
            case "Kyle Lowry": 
            echo "Kyle Lowry is the GOAT";
            break;
            default:
            echo "Why didnt you put Kyle Lowry";
            break;
        }
    ?>
</body>
</html>