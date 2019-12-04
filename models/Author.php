<?php


class Author
{
    private $connection;
    private $table = 'authors';

    public $id;
    public $name;

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

        $this->name = $row['name'];
        $this->id = $row['id'];

    }

    public function create() {

        $query = 'INSERT INTO ' . $this->table . ' SET name = :name';

        $stmt = $this->connection->prepare($query);
        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(':title', $this->name);

        if($stmt->exec()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function update() {

        $query = 'UPDATE ' . $this->table . ' SET name = :name WHERE id = :id';

        $stmt = $this->connection->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name', $this->name);
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