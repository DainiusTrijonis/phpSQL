<?php
    class Actor {
        public $id;
        public $name;
        public $surname;
        public $age;
        public function __construct($id, $name, $surname, $age) {
            $this->id = $id;
            $this->name = $name;
            $this->surname = $surname;
            $this->age = $age;
        }
    }
?>