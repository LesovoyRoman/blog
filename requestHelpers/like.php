<?php

require_once'../clasess/User/User.php';
$status = session_status();
if($status == PHP_SESSION_NONE) {
    session_start();
};

if(isset($_SESSION['user'])) {
        $post_id = $_POST['post_id'];
        $user = User::getUser();
        $user_id = $user['id'];
        $like = Like::addLikes($post_id, $user_id);
    }

