<?php
    // import actor
    require_once "models/Actor.php";
    class ActorController {
        public static function get() {
            return Actor::getAll();
        }
        public static function add() {
            return Actor::add();
        }
        public static function remove() {
            return Actor::remove();
        }
        public static function update() {
            return Actor::update();
        }
    }
?>