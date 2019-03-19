<?php 
  class Database {

    // Database parameters
    private $host = 'localhost';
    private $db_name = 'myblog-php-rest-api';
    private $username = 'root';
    private $password = '';
    private $conn;

    // Database connection function
    public function connect() {
      $this->conn = null;

      // Database PDO connection
      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {

        // returns exception message in php
        echo 'Connection Error: ' . $e->getMessage();
      }
      return $this->conn;
    }
}