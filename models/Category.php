<?php 
  class Category {
    
    // DB stuff
    private $conn;
    private $table = 'categories';

    // Post Properties
    public $id;
    public $name;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function read() {

      // Create query
      $query = 'SELECT id, name, created_at FROM ' . $this->table . ' ORDER BY created_at DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();
      return $stmt;
    }

    // create a new Category
    public function create(){

      // Create query 
      /* No 'id' and 'created_at' input required as the values are auto-inserted */
       $query = 'INSERT INTO ' . $this->table . ' SET name = :name';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data 
      $this->name = htmlspecialchars(strip_tags($this->name));

      // Bind the ':data'
      $stmt->bindParam('name', $this->name);

      // Execute query
      if ($stmt->execute()) {
         return true;
      }
      
      // Error
      printf('Error %s. \n', $stmt->error);
      return false;
    }

    // Delete category
    public function delete(){
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id ';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data 
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Binding
      $stmt->bindParam(':id', $this->id);

      // Execute query
      if ($stmt->execute()) {
         return true;
      }
      
      // Error
      printf('Error %s. \n', $stmt->error);
      return false;
    }
}