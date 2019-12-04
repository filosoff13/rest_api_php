<?php

class Books
{
    private $connection;
    private $table = 'books';

    public $id;
    public $title;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function read() {
        
        $query = 'SELECT * FROM ' . $this->table;

        $stmt = $this->connection->prepare($query);
        $stmt->exec();
//        $stmt->execute();
        return $stmt;
    }

    public function read_single() {

        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';

        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->exec();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->id = $row['id'];

    }

    public function create() {

        $query = 'INSERT INTO ' . $this->table . ' SET title = :title';

        $stmt = $this->connection->prepare($query);
        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));

        $stmt->bindParam(':title', $this->title);

        if($stmt->exec()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function update() {

        $query = 'UPDATE ' . $this->table . ' SET title = :title WHERE id = :id';

        $stmt = $this->connection->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':id', $this->id);

        if($stmt->exec()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function delete() {

        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->connection->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if($stmt->exec()) {
            return true;
        }

//        printf("Error: %s.\n", $stmt->error);
        return false;
    }

}