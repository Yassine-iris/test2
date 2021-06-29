<?php
class Task{
    private $table_name = "task";
    private $connection;
  
    public $id;
    public $user_id;
    public $title;
    public $description;
    public $date;
    public $status;
  
    public function __construct($db){
        $this->connection = $db;
    }

    function read(){
    
        $query = "SELECT
                    t.id, t.user_id, t.title, t.description, t.date, t.status
                FROM
                    " . $this->table_name . " t
                ORDER BY
                    t.id DESC";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create(){
    
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    user_id=:user_id, title=:title, description=:description, date=:date,
                    status=:status";
    
        $stmt = $this->connection->prepare($query);

        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->date=htmlspecialchars(strip_tags($this->date));
        $this->status=htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":status", $this->status);
    
        if($stmt->execute()){
            return true;
        }    
        return false; 
    }

    function readOne(){
    
        $query = "SELECT
                    t.id, t.user_id, t.title, t.description, t.date, t.status
                FROM
                    " . $this->table_name . " t
                WHERE
                    t.id = ?";
    
        $stmt = $this->connection->prepare( $query );
    
        $stmt->bindParam(1, $this->id);
    
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->user_id = $row['user_id'];
        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->date = $row['date'];
        $this->status = $row['status'];
    }

    function update(){
    
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    user_id =:user_id,
                    title =:title,
                    description =:description,
                    date =:date,
                    status =:status
                WHERE
                    id =:id"; 
    
        $stmt = $this->connection->prepare($query);
    
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->date=htmlspecialchars(strip_tags($this->date));
        $this->status=htmlspecialchars(strip_tags($this->status));
        
        $stmt->bindParam(':id', $this->id,PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $this->user_id,PDO::PARAM_INT);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':date', $this->date,PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status,PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        }
    
        return  $stmt->errorInfo();
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

    public function readPaging($record_num, $r_per_page){
    
        $query = "SELECT
                    t.id, t.user_id, t.title, t.description, t.date, t.status
                FROM
                    " . $this->table_name . " t
                ORDER BY t.id DESC
                LIMIT ?, ?";
    
        $stmt = $this->connection->prepare( $query );
    
        $stmt->bindParam(1, $record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $r_per_page, PDO::PARAM_INT);
    
        $stmt->execute();
    
        return $stmt;
    }

    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }
}
?>
