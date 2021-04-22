<?php 
  class Database {
    // DB Params
    private $host = 'z5zm8hebixwywy9d.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
    private $db_name = 'wbbisdlfwg5x4cs3';
    private $username = 'ixm7dqikuu4lu1kz';
    private $password = 'ft2o7s7u6pht36li';
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }