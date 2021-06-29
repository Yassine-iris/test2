<?php
class User{
    private $table_name = "user";
    private $connection;

    public $id;
    public $name;
    public $email;

    public function __construct($db){
        $this->connection = $db;
    }

    function read(){

        $query = "SELECT
                    u.id, u.name, u.email
                FROM
                    " . $this->table_name . " u
                ORDER BY
                    u.id DESC";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function create(){

        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, email=:email";

        $stmt = $this->connection->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);

        if($stmt->execute()){
            return true;
        }

        return false;

    }

    function readOne(){

        $query = "SELECT
                    u.id, u.name, u.email
                FROM
                    " . $this->table_name . " u
                WHERE
                    u.id = ?";

        $stmt = $this->connection->prepare( $query );

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->email = $row['email'];
    }

    function update(){

        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name =:name,
                    email =:email
                WHERE
                    id =:id";

        $stmt = $this->connection->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name', $this->name,PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email,PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id,PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function delete(){

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->connection->prepare($query);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id,PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function readPaging($from_record_num, $records_per_page){

        $query = "SELECT
                    u.id, u.name, u.email
                FROM
                    " . $this->table_name . " u
                ORDER BY u.id DESC
                LIMIT ?, ?";

        $stmt = $this->connection->prepare( $query );

        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt;
    }

    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->connection->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

}
?>