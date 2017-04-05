<?php

require_once(dirname(__FILE__).'/../Database/DB.php');
require_once(dirname(__FILE__).'/../../validator.php');
require_once(dirname(__FILE__).'/../Post/Post.php');
class User
{
    public $login;
    public $email;
    public $password;
    private $db;

    public function __construct(array $user)
    {
        $this->login = $user['login'];
        $this->email = isset($user['email']) ? $user['email'] : '';
        $this->password = md5($user['password']);

        $this->db = new DB('mazafaka', 'root', 'Ktcjdjq1997');
        $this->db->setDb('coworking');
        $this->db->connect();
    }

    public function login()
    {

        if (!empty($this->login) && !empty($this->password))
        {
            $sql = "SELECT DISTINCT * FROM user WHERE login = :login";
            $params = [
//                ':table_name' => 'user',
                ':login' => $this->login
            ];

            $user = $this->db->selectRow($sql, $params);
            if (empty($user)){
                echo "<h1 style='text-align: center'>".'User not found'."</h1>";
            } else {
                if ($this->password === $user['password'])
                {
                    session_start();
                    unset($user['password']);
                    $_SESSION['user'] = $user;
                    header("Location: index.php");
                } else {
                    echo "<h1 style='text-align: center'>"."Password isn't true"."</h1>";
                }
            }
        }
    }

    public function logout()
    {
        // 1) unset(S_SESSION['user']);
    }

    public function registration()
    {

        $validator_email = new Validator($this->email);
        $validator_email->isEmail();

        $validator_login = new Validator($this->login);
        $validator_login->valid_symbols();

        $validator_pass = new Validator($this->password);
        $validator_pass->between(6, 15);

        if (empty($validator_email->errors) && empty($validator_login->errors) && empty($validator_pass->errors))
        {
            $sql = "SELECT DISTINCT * FROM user WHERE login = :login";

            $params = [
//                ':table_name' => 'user',
                ':login' => $this->login
            ];

            $user = $this->db->selectRow($sql, $params);
            if (empty($user))
            {
                $sql = "INSERT INTO user (login, email, password) VALUES (:login, :email, :password)";

                $params = [
//                    ':table_name' => 'user',
                    ':login' => $this->login,
                    ':email' => $this->email,
                    ':password' => $this->password
                ];
                if ($this->db->insert($sql, $params))
                {
                    header("Location:login.php");
                };
            }
        }
    }

    public static function createPost(array $postData)
    {
        $user = self::getUser();
        if ($user) {
            $author_id = $user['id'];
            $postData['author_id'] = $author_id;
            $post = new Post($postData);
            $result = $post->create();
            if ($result){
                header("Location: index.php");
            }
        }
    }

    public static function getUser()
    {
        return isset($_SESSION['user']) ? $_SESSION['user'] : false;
    }

}