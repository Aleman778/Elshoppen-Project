<?php
    if (!class_exists("MySQL")) {
        class MySQL {

            public $hostname = "utbweb.its.ltu.se";
            public $dbname = "db971229";
            public $username = "971229";
            public $password = "971229";
            public $conn = null;

            public function __construct() {
                try {
                    $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->dbname", $this->username, $this->password);
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);     
                } catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                } 
            }
            
            function query(string $sql) {
                return $this->conn->query($sql);
            }

            function fetch(string $sql) {
                return $this->conn->query($sql)->fetch();
            }

            function fetchAll(string $sql) {
                return $this->conn->query($sql)->fetchAll();
            }

            function prepare(string $sql) {
                return $this->conn->prepare($sql);
            }
        }
    }
?>