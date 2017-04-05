<?php

require_once'./clasess/User/User.php';
session_start();

if(isset($_SESSION['user'])) {
        $post_id = $_GET['post_id'];
        $user = User::getUser();
        $user_id = $user['id'];
        $like = Like::addLikes($post_id, $user_id);
        header("Location:index.php");
    }
header("Location:index.php");
