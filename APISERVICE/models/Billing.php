<?php
  class Billing {
    // DB Stuff
    private $conn;
    private $table = 'billing';

    // Properties
    public $id;
    public $description;
    public $id_user;
    public $debt;
    public $credit;
    public $date_billing;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Billing
    public function read() {
      // Create query
      $query = 'SELECT
        id,
        description,
        id_user,
        debt,
        credit,
        date_billing
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

    // Get Single Billing
  public function read_single(){
    // Create query
    $query = 'SELECT
        id,
        description,
        id_user,
        debt,
        credit,
        date_billing
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
      $this->description = $row['description'];
      $this->id_user = $row['id_user'];
      $this->debt = $row['debt'];
       $this->credit = $row['credit'];
      $this->date_billing = $row['date_billing'];
  }

  // Create Billing
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      description = :description,
      id_user = :id_user,
      debt = :debt,
      credit = :credit,
      date_billing = :date_billing';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->description = htmlspecialchars(strip_tags($this->description));
  $this->id_user = htmlspecialchars(strip_tags($this->id_user));
  $this->debt = htmlspecialchars(strip_tags($this->debt));
  $this->credit = htmlspecialchars(strip_tags($this->credit));
  $this->date_billing = htmlspecialchars(strip_tags($this->date_billing));

  // Bind data
  $stmt-> bindParam(':description', $this->description);
  $stmt-> bindParam(':id_user', $this->id_user);
  $stmt-> bindParam(':debt', $this->debt);
  $stmt-> bindParam(':credit', $this->credit);
  $stmt-> bindParam(':date_billing', $this->date_billing);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update Billing
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      description = :description,
      id_user = :id_user,
      debt = :debt,
      credit = :credit,
      date_billing = :date_billing
      WHERE
      id = :id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data 
  $this->id = htmlspecialchars(strip_tags($this->id));
  $this->description = htmlspecialchars(strip_tags($this->description));
  $this->id_user = htmlspecialchars(strip_tags($this->id_user));
  $this->debt = htmlspecialchars(strip_tags($this->debt));
  $this->credit = htmlspecialchars(strip_tags($this->credit));
  $this->date_billing = htmlspecialchars(strip_tags($this->date_billing));

  // Bind data
  $stmt-> bindParam(':id', $this->id);
  $stmt-> bindParam(':description', $this->description);
  $stmt-> bindParam(':id_user', $this->id_user);
  $stmt-> bindParam(':debt', $this->debt);
  $stmt-> bindParam(':credit', $this->credit);
  $stmt-> bindParam(':date_billing', $this->date_billing);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete Billing
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
