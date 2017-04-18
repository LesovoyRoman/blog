<?php

require_once(dirname(__FILE__).'/../Database/DB.php');
require_once(dirname(__FILE__).'/../User/User.php');


class Messages
{

    public function __construct(array $messageData)
    {
        $this->title = $messageData['title'];
        $this->text = $messageData['message'];
        $this->author_id = $messageData['author_id'];
        $this->receiver_id = $messageData['receiver_id'];
        /*$this->receiver_name = $messageData['receiver_name'];*/

    }

    public function createMessage()
    {
            $sql = "INSERT INTO messages (id_transmitter, id_receiver, text_message, title_message) 
        VALUES (:id_transmitter, :id_receiver, :text_message, :title_message)";


        $params = [
            ":id_transmitter" => $this->author_id,
            ":id_receiver" => $this->receiver_id,
            ":text_message" => $this->text,
            ":title_message" =>$this->title
        ];
        return $this->getDb()->insert($sql, $params);
    }

    public static function getMessagesInbox()
    {
        $status = session_status();
        if($status == PHP_SESSION_NONE){
            session_start();
        }

        $limit = $_SESSION['curr_limit'];

        $sql = "SELECT  id_message, id_transmitter, id_receiver, text_message, title_message, `time` FROM 
        messages  WHERE id_receiver = :curr_id ORDER BY `time` DESC LIMIT {$limit}";

        $params = [
            ':curr_id' => $_SESSION['user']['id']
        ];
        $db = self::getDb();

        return $db->select($sql, $params);
    }

    public static function getMessagesOutbox()
    {
        $status = session_status();
        if($status == PHP_SESSION_NONE){
            session_start();
        }

        $limit = $_SESSION['curr_limit'];

        $sql = "SELECT  id_transmitter, id_receiver, text_message, title_message, `time` FROM 
        messages  WHERE id_transmitter = :curr_id ORDER BY `time` DESC LIMIT {$limit}";

        $params = [
            ':curr_id' => $_SESSION['user']['id']
        ];
        $db = self::getDb();

        return $db->select($sql, $params);
    }

    public static function getMessage($id_message)
    {
        $sql = "SELECT title_message, text_message, id_transmitter, `time` FROM messages  
        WHERE id_message = :id_message";

        $params = [
            ':id_message' => $id_message
        ];
        $db = self::getDb();
        return $db->select($sql, $params);
    }

    public static function getUser($id)
    {
        $sql = "SELECT login FROM user WHERE id = :id";

        $params = [
          ':id' => $id
        ];

        $db = self::getDb();

        return $db->selectRow($sql, $params);
    }

    public static function getUsers()
    {
        $sql = "SELECT id, login FROM user WHERE id != :id_user";

        $params = [
            ':id_user' => $_SESSION['user']['id']
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

}


// 1) the same receiver & author
// 2) select by name for message
// 3) max_opened messages (read more)