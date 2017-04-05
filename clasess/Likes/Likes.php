<?php

require_once(dirname(__FILE__).'/../Database/DB.php');
require_once(dirname(__FILE__).'/../User/User.php');
require_once(dirname(__FILE__).'/../Post/Post.php');

class Like
{
    public function getDb()
    {
        $db = new DB('mazafaka', 'root', 'Ktcjdjq1997');
        $db->setDb('coworking');
        $db->connect();

        return $db;
    }

    public static function addLikes($post_id, $user_id)
    {
        $sql = "SELECT DISTINCT * FROM likes WHERE id_post = :id_post AND id_user = :id_user";
        $params = [
            ':id_post' => $post_id,
            ':id_user' => $user_id
        ];
        $db = self::getDb();
        $likes = $db->selectRow($sql, $params);


        if (empty($likes)) {
            $sql = "INSERT INTO likes(id_post, id_user) VALUES(:id_post, :id_user)";
            $params = [
                ':id_post' => $post_id,
                ':id_user' => $user_id
            ];

            $result = $db->insert($sql, $params);
        } else {
            $sql = 'DELETE FROM likes WHERE id_post = :id_post AND id_user = :id_user';
            $params = [
                ':id_user' => $user_id,
                ':id_post' => $post_id
            ];

            $result = $db->delete($sql, $params);
        }

        return $result;
    }

    public static function getLikes($post_id)
    {
        $sql = "SELECT COUNT(id_user) FROM likes WHERE id_post = :id_post";

        $params = [
            ':id_post' => $post_id
        ];


        $db = self::getDb();
        return $db->selectRow($sql, $params);
    }

    public static function checkLikes($post_id)
    {
        $sql_check = "SELECT id_user FROM likes WHERE id_post = :id_post";
        $params_check = [
            ':id_post' => $post_id
        ];
        $db = self::getDb();
        $result = $db->select($sql_check, $params_check);

        $success = false;

        if(isset($_SESSION['user'])) {
            foreach ($result as $data_id) {
                if ($data_id['id_user'] == $_SESSION['user']['id']) {
                    $success = true;
                }
            }
            return $success;
        }
    }
}



