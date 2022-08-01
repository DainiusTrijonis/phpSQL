<?php 
    class Database {
            private $dbhost = "localhost";
            private $dbuser = "yuko";
            private $dbpass = "root";
            private $db = "phpDatabases";
            private $conn;
            public function __construct() {
                $this->conn = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->db);
                if ($this->conn->connect_error) {
                    die("Connection failed: " . $this->conn->connect_error);
                }
            }
            public function __destruct() {
                $this->conn->close();
            }

            // Insert a row/s in a Database Table
            public function Insert( $query = "" , $params = [] ){
                try{
                    $stmt = $this->executeStatement($query ,$params)->close();
                    return $this->conn->insert_id;
                }catch(Exception $e){
                    throw New Exception( $e->getMessage() );
                }
                return false;
            }

            public function Select( $query = "" , $params = []){
                try{
                    $stmt = $this->executeStatement( $query , $params );
                    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);			
                    $stmt->close();
                    return $result;
                } catch(Exception $e){
                    throw New Exception( $e->getMessage() );
                }
                return false;
            }
            
            // Update a row/s in a Database Table
            public function Update($query = "" , $params = [] ){
                try {
                    $this->executeStatement( $query , $params )->close();
                } catch(Exception $e){
                    throw New Exception( $e->getMessage() );
                }
                return false;
            }	
            
            // Remove a row/s in a Database Table
            public function Remove($query = "" , $params = []) {
                try {
                    $this->executeStatement($query , $params )->close();
                } catch(Exception $e){
                    throw New Exception( $e->getMessage() );
                }
                return false;
            }		
            
            // execute statement
            private function executeStatement($query = "" , $params = []) {
                $stmt = $this->conn->prepare($query);
                if(!$stmt) {
                    throw New Exception( $this->conn->error );
                }
                if(count($params) > 0) {
                    $stmt->bind_param(...$params);
                }
                $stmt->execute();
                return $stmt;
            }
    }
?>