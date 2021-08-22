<?php

class Connection {
    public PDO $pdo;

    public function __construct() {
        // *connection database
        $this->pdo = new PDO(
            "mysql:host=sql6.freemysqlhosting.net;port=3306;dbname=sql6431367", "sql6431367", "hmlJ5CVNuK"
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // *get note data form database
    public function getNotes() {
        $statement = $this->pdo->prepare("SELECT * FROM notes_app ORDER BY create_date DESC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // *add new note at database
    public function addNotes($note) {
        $statement = $this->pdo->prepare("INSERT INTO `notes_app` (`title`, `description`, `create_date`)
                                            VALUES (:title, :description, :date)");

        $statement->bindValue('title', $note['title']);
        $statement->bindValue('description', $note['description']);
        $statement->bindValue('date', date('Y-m-d H:i:s'));

        return $statement->execute();
    }

    // *get data using by id at database
    public function getNoteById($id) {
        $statement = $this->pdo->prepare("SELECT * FROM `notes_app` WHERE id = :id");
        $statement->bindValue('id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    // *update notes by id at database
    public function updateNote($id, $note) {
        $statement = $this->pdo->prepare("UPDATE notes_app SET title = :title, description = :description WHERE id = :id");
        $statement->bindValue('id', $id);
        $statement->bindValue('title', $note['title']);
        $statement->bindValue('description', $note['description']);
        return $statement->execute();
    }

    // *delete a note by id at database
    public function deleteNote($id) {
        $statement = $this->pdo->prepare("DELETE FROM notes_app WHERE id = :id");
        $statement->bindValue('id', $id);
        return $statement->execute();
    }
}

return new Connection();
