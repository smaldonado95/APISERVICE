<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Billing.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $billing = new Billing($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $billing->id = $data->id;

  // Delete post
  if($billing->delete()) {
    echo json_encode(
      array('message' => 'Billing deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Billing not deleted')
    );
  }
