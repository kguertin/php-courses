<?php

function confirm_query($result) { 
    global $connection;
    
    if(!$result){
        die("Query Failed" . mysqli_error($connection));
    }
}

function query($query){
    global $connection;

    return mysqli_query($connection, $query);
}

function users_online() {

    if(isset($_GET['online_users'])){
        global $connection;

        if(!$connection){
            session_start();
            include('../includes/db.php');

            $session = session_id();
            $time = time();
            $time_out_in_sec = 30;
            $time_out = $time - $time_out_in_sec;
    
            $query = "SELECT * FROM users_online WHERE session = '{$session}'";
            $send_query = mysqli_query($connection, $query);
            confirm_query($send_query);
            $count = mysqli_num_rows($send_query);
    
            if ($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('{$session}', '{$time}')");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time = '{$time}' WHERE session = '{$session}'");
            }
    
            $users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $user_count = mysqli_num_rows($users_online);
        }
    }
}
users_online();

function insert_categories(){
    global $connection;

    if(isset($_POST['submit'])){
        $cat_title = $_POST["cat_title"];
        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        } else {
            $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?)");
            mysqli_stmt_bind_param($stmt, 's', $cat_title);
            mysqli_stmt_execute($stmt);
            
            if(!$stmt){
                die('Query Failed' .  mysqli_error($connection));
            }
            
            mysqli_stmt_close($stmt);
        }
    }
}

function find_all_categories(){
    global $connection;

    $query = "SELECT * FROM categories";
    $select_catagories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_catagories)){
        $cat_id = $row["id"];
        $cat_title = $row["cat_title"];
        
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function delete_category(){
    global $connection;
    
    if(isset($_GET['delete'])){
        $cat_id_delete = $_GET["delete"];
        
    $query = "DELETE FROM categories WHERE id = {$cat_id_delete}";
    
    $delete_query = mysqli_query($connection, $query);

    header("Location: categories.php");
    }
}

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));

}

function record_count($table) {
    global $connection;

    $query = "SELECT * FROM " . $table;
    $select_all_posts = mysqli_query($connection, $query);

    $result = mysqli_num_rows($select_all_posts);
    confirm_query($result);

    return $result;
}

function check_status($table, $col_name, $status) {
    global $connection;

    $query = "SELECT * FROM  $table WHERE $col_name = '$status' ";
    $result = mysqli_query($connection, $query);
    confirm_query($result);

    return mysqli_num_rows($result);
}

function is_admin($username){
    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '{$username}' ";
    $result = mysqli_query($connection, $query);

    confirm_query($result);

    $user_data = mysqli_fetch_array($result);

    if($user_data['user_role'] == 'admin'){
        return true;
    } else {
        return false;
    }

}

function check_user($username){
    global $connection;

    $query = "SELECT username FROM users WHERE username = '{$username}' ";
    $result = mysqli_query($connection, $query);
    confirm_query($result);

    if(mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }
}

function check_email($email) {
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '{$email}' ";
    $result = mysqli_query($connection, $query);
    confirm_query($result);

    if(mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }
}

function redirect($location){
    header("Location: " . $location);
    exit;
}

function check_method($method = null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    return false;
}

function is_logged_in() {
    if(isset($_SESSION['user_role'])){
        return true;
    } 
    return false;
}

function check_logged_in_and_redirect($path=null) { 
    if(is_logged_in()){
        redirect($path);
    }
}

function register_user($username, $email, $password){
    global $connection;

        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
        $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber')";
        $register_user_query = mysqli_query($connection, $query);
        
        confirm_query($register_user_query);
}

function login_user($username, $password){
    global $connection;

    $username = trim($username);
    $password = trim($password);

    // Cleans data and protects against sql injection
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);

    confirm_query($select_user_query);

    $query_user_table = mysqli_fetch_array($select_user_query);

    if($query_user_table){
        $db_id = $query_user_table['user_id'];
        $db_first_name = $query_user_table['user_first_name'];
        $db_last_name = $query_user_table['user_last_name'];
        $db_user_role = $query_user_table['user_role'];
        $db_username = $query_user_table['username'];
        $db_password = $query_user_table['user_password'];

        
        // $password = crypt($password, $db_password); // We are using password varify rather than comparing the crypt
        
        
        if(password_verify($password, $db_password)){
            $_SESSION['username'] = $db_username;
            $_SESSION['first_name'] = $db_first_name;
            $_SESSION['last_name'] = $db_last_name;
            $_SESSION['user_role'] = $db_user_role;
            redirect('/php-courses/php-basics/cms_project/admin'); 
        } else {
            return false;
        }
    }
    return true;
}

function get_user_id() {
    if(is_logged_in()){
        $result = query("SELECT * FROM users WHERE username ='" . $_SESSION['username'] . "'"); 
        $user= mysqli_fetch_array($result);

        if(mysqli_num_rows($result) >= 1){
            return $user["user_id"];
        }

    }

    return false;
}

function placeholder_image($image = null) {
    if(!$image){
        return 'placeholder.jpg';
    } else {
        return $image;
    }
}