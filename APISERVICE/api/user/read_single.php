<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog user object
  $user = new User($db);

  // Get ID
  $user->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $user->read_single();

  // Create array
  $category_arr = array(
    'id' => $user->id,
    'name' => $user->name,
      'location' => $user->location
  );

  // Make JSON
  print_r(json_encode($category_arr));
