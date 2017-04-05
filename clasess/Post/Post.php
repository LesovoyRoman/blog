<?php

require_once(dirname(__FILE__).'/../Database/DB.php');
require_once(dirname(__FILE__).'/../User/User.php');
require_once(dirname(__FILE__).'/../Likes/Likes.php');

class Post
{
    public $title;
    public $text;
    public $author_id;
    public $post_id;

    public function __construct(array $post)
    {
        $this->title = $post['title'];
        $this->text = $post['text'];
        $this->author_id = $post['author_id'];
        $post_id = $_GET['remove_id'];
    }
    public function create()
    {
        $sql = "INSERT INTO posts (title, text, id_user) VALUES (:title, :text, :id_user)";

        $params = [
            ":title" => $this->title,
            ":text" => $this->text,
            ":id_user" => $this->author_id
        ];

        return $this->getDb()->insert($sql, $params);
    }
    public static function updatePost(array $post, $post_id)
    {
        $sql = "UPDATE posts SET title = :title, text = :text WHERE posts.id = :post_id";

        $params = [
            ":title" => $post['title'],
            ":text" => $post['text'],
            ":post_id" => $post_id
        ];
        $update = self::getDb();
        return $update->update($sql, $params);
    }

    public static function deletePost($post_id)
    {
        $sql = "DELETE FROM posts WHERE id = :post_id";

        $params = [
          ":post_id" => $post_id
        ];
        $delete = self::getDb();
        return $delete->delete($sql, $params);
    }

    public function getDb()
    {
        $db = new DB('mazafaka', 'root', 'Ktcjdjq1997');
        $db->setDb('coworking');
        $db->connect();

        return $db;
    }

    public static function getPosts()
    {
        $sql = "SELECT user.login as author, posts.title, posts.text, posts.time, posts.id FROM 
posts LEFT JOIN user ON(user.id = posts.id_user) WHERE :all ORDER BY time DESC";

        $params = [
          ':all' => 1
        ];
        $db = self::getDb();


        return $db->select($sql, $params);
    }

    public static function getPost($id)
    {
        $sql = "SELECT user.login as author, posts.title, posts.text, posts.created_at FROM 
    posts LEFT JOIN user ON(user.id = posts.id_user) WHERE id = :id";

        $params = [
            ':id' => $id
        ];
        $db = self::getDb();

        return $db->selectRow($sql, $params);
    }


}



