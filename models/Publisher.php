<?php

class Publisher
{
    private $connection;
    private $table = 'publishers';

    public $id;
    public $name;
    public $book_id;
    public $tittle;//from books table

    public function __construct($db) {
        $this->connection = $db;
    }

    public function read() {

//        SELECT * FROM qatestlab.publishers left join qatestlab.books on book_id = qatestlab.books.id;
        $query = 'SELECT * FROM ' . $this->table . ' left join `qatestlab.books` on ' . $this->book_id . '= `qatestlab.books.id`';

        $stmt = $this->connection->prepare($query);
        $stmt->exec();
        return $stmt;
    }

    public function read_single() {

        $query = 'SELECT * FROM ' . $this->table . ' left join `qatestlab.books` on ' . $this->book_id . '= `qatestlab.books.id` WHERE id = ?';

        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->exec();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->book_id = $row['book_id'];
        $this->tittle = $row['tittle'];

    }

    public function create() {

        $query = 'INSERT INTO ' . $this->table . ' SET name = :name, book_id = :book_id';

        $stmt = $this->connection->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->book_id = htmlspecialchars(strip_tags($this->book_id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':book_id', $this->book_id);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function update() {

        $query = 'UPDATE ' . $this->table . ' SET name = :name, book_id = :book_id WHERE id = :id';

        $stmt = $this->connection->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->book_id = htmlspecialchars(strip_tags($this->book_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':title', $this->name);
        $stmt->bindParam(':body', $this->book_id);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
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

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

}