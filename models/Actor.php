<?php
    class Actor {
        public $id;
        public $name;
        public $surname;
        public $age;

        public static $db = null;

        public static function db(){
            if( !isset(static::$db) ){
             static::$db = new Database();
            }
            return static::$db;
        }
        
        public function __construct($id, $name, $surname, $age) {
            $this->id = $id;
            $this->name = $name;
            $this->surname = $surname;
            $this->age = $age;
        }

        public static function getAll() {
            $dbResult = self::db()->Select("SELECT * FROM actors");
            $actors = [];
            foreach($dbResult as $row) {
                $actors[] = new Actor($row["id"], $row["name"], $row["surname"], $row["age"]);
            }
            return $actors;
        }
        public static function add() {
            $id = self::db()->Insert(
                "INSERT INTO actors (name, surname, age) VALUES (?, ?, ?)", 
                ["ssi",$_POST['name'], $_POST['surname'], $_POST['age']]
            );
            return $id;
        }
        public static function remove() {
            if($_POST['index']==false) {
                self::db()->Remove(
                    "DELETE FROM actors WHERE id = ?",
                    ["i", $_POST['index']]
                );
            }
        }
        public static function update() {
            if($_POST['index']!==false) {
                self::db()->Update(
                    "UPDATE actors SET name = ?, surname = ?, age = ? WHERE id = ?",
                    ["sssi", $_POST['name'], $_POST['surname'], $_POST['age'], $_POST['index']]
                );
            }
        }
    }
?>