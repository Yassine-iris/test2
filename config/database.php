<?php
class Database{
    private $host = "localhost";
    private $database = "managerone_test2";
    private $username = "root";
    private $password = "";
    public $connection;

    public function getConnection(){

        $this->connection = null;

        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection Error To The Database : " . $exception->getMessage();
        }

        return $this->connection;
    }
}