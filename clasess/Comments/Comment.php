<?php

require_once(dirname(__FILE__).'/../Database/DB.php');
require_once(dirname(__FILE__).'/../User/User.php');
require_once(dirname(__FILE__).'/../Post/Post.php');

$status = session_status();
if($status == PHP_SESSION_NONE) {
    session_start();
}

class Comment
{
    /*public function __construct(array $commentData)
    {
        $this->comment = $commentData['comment'];
        $this->post_id = $commentData['post_id'];
    }*/

    public static function createComment($commentData){
        $sql = "INSERT INTO comments (id_author, comment, id_post) VALUES (:id_author, :comment, :id_post)";

        $params = [
            ':id_author' => $_SESSION['user']['id'],
            ':comment' => $commentData['comment'],
            ':id_post' => $commentData['id_post']
        ];

        $db = self::getDb();

        return $db->insert($sql, $params);
    }

    public static function getComments($id_post){
        $sql = "SELECT id_author, time, comment  FROM comments WHERE id_post = :id_post";

        $params = [
            ':id_post' => $id_post
        ];

        $db = self::getDb();

        return $db->select($sql, $params);
    }

    public function getDb()
    {
        $db = new DB('mazafaka', 'root', 'Ktcjdjq1997');
        $db->setDb('coworking');
        $db->connect();

        return $db;
    }

    public static function getUsers($id_user)
    {
        $sql = "SELECT login FROM user WHERE id = :id_user";

        $params = [
            ':id_user' => $id_user
        ];
        $db = self::getDb();
        return $db->select($sql, $params);
    }
}
