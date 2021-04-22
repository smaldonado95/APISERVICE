<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Billing.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog billing object
  $billing = new Billing($db);

  // Get ID
  $billing->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $billing->read_single();

  // Create array
  $category_arr = array(
    'id' => $billing->id,
    'description' => $billing->description,
      'id_user' => $billing->id_user,
    'debt' => $billing->debt,
      'credit' => $billing->credit,
    'date_billing' => $billing->date_billing
  );

  // Make JSON
  print_r(json_encode($category_arr));
