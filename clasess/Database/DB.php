<?php

class DB
{
    private $host;
    private $login;
    private $pass;
    private $db;
    private $connection;
    private $charset = 'utf8';

    private $options = [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    public function __construct($host, $login, $pass)
    {
        $this->host = $host;
        $this->login = $login;
        $this->pass = $pass;
    }

    public function setDb($db)
    {
        $this->db = $db;
    }
    public function connect()
    {
        try {
            $this->connection = new PDO
            (
                "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}",
                $this->login,
                $this->pass,
                $this->options
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function select($sql, $params)
    {
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function query($sql, $params)
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert($sql, $params)
    {
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute($params);

        return $result;
    }
    public function update($sql, $params)
    {
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute($params);

        return $result;
    }
    public function selectRow($sql, $params)
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function delete($sql, $params)
    {
        $stmt = $this->connection->prepare($sql);
        $result =$stmt->execute($params);

        return $result;
    }
}

