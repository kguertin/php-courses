<?php

class User {
    public function find_all_users(){
        global $db;

        $get_users = $db->query("SELECT * FROM users");
        return get_users;
    }
}