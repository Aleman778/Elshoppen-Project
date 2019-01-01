<?php
    if (!class_exists("MySQL")) {
        class MySQL {

            public $hostname = "alemen.se.mysql";
            public $dbname = "alemen_se";
            public $username = "alemen_se";
            public $password = "LoV3AnxRRBDGR3cTCr6zucEX";
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