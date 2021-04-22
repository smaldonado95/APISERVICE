<?php
  class User {
    // DB Stuff
    private $conn;
    private $table = 'user_account';

    // Properties
    public $id;
    public $name;
    public $location;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get user
    public function read() {
      // Create query
      $query = 'SELECT
        id,
        name,
        location
      FROM
        ' . $this->table . '
      ORDER BY
        id ASC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single user
  public function read_single(){
    // Create query
    $query = 'SELECT
        id,
        name,
        location
        FROM
          ' . $this->table . '
      WHERE id = ?';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id = $row['id'];
      $this->name = $row['name'];
      $this->location = $row['location'];
  }

  // Create user
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      name = :name,
      location = :location';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->name = htmlspecialchars(strip_tags($this->name));
  $this->location = htmlspecialchars(strip_tags($this->location)); 

  // Bind data
  $stmt-> bindParam(':name', $this->name);
  $stmt-> bindParam(':location', $this->location); 

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update user
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      name = :name,
      location = :location
      WHERE
      id = :id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data 
  $this->id = htmlspecialchars(strip_tags($this->id));
  $this->name = htmlspecialchars(strip_tags($this->name));
  $this->location = htmlspecialchars(strip_tags($this->location));

  // Bind data
  $stmt-> bindParam(':id', $this->id);
  $stmt-> bindParam(':name', $this->name);
  $stmt-> bindParam(':location', $this->location); 

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete user
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $stmt-> bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
  }