<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Location.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog location object
  $location = new Location($db);

  // Get ID
  $location->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $location->read_single();

  // Create array
  $category_arr = array(
    'id' => $location->id,
    'location' => $location->location
  );

  // Make JSON
  print_r(json_encode($category_arr));
