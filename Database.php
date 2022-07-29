<?php 
    class Database {
            public $dbhost = "localhost";
            public $dbuser = "yuko";
            public $dbpass = "root";
            public $db = "phpDatabases";
            public $table = "actors";
            public $conn;
            public function __construct() {
                $this->conn = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->db);
                if ($this->conn->connect_error) {
                    die("Connection failed: " . $this->conn->connect_error);
                }
            }
            public function getActors() {
                $sql = "SELECT * FROM " . $this->table;
                $result = $this->conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $actors[] = new Actor($row["id"], $row["name"], $row["surname"], $row["age"]);
                    }
                }
                return $actors;
            }
            public function addActor($actor) {
                $sql = "INSERT INTO " . $this->table . " (name, surname, age) VALUES ('" . $actor->name . "', '" . $actor->surname . "', '" . $actor->age . "')";
                return $this->conn->query($sql) === TRUE;
            }
            public function removeActor($id) {
                $sql = "DELETE FROM " . $this->table . " WHERE id = " . $id;
                return $this->conn->query($sql);
            }
            public function updateActor($actor) {
                $sql = "UPDATE " . $this->table . " SET name = '" . $actor->name . "', surname = '" . $actor->surname . "', age = '" . $actor->age . "' WHERE id = " . $actor->id;
                return $this->conn->query($sql);
            }
    }
?>