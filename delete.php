
<?php

require_once './clasess/Post/Post.php';
session_start();
if (!empty($_GET['remove_id']) && isset($_SESSION['user'])) {
    Post::deletePost($_GET['remove_id']);
    header("Location:index.php");
}
header("Location:index.php");