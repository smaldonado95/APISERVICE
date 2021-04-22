<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
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

  $billing->description = $data->description;
  $billing->id_user = $data->id_user;
  $billing->debt = $data->debt;
  $billing->credit = $data->credit;
  $billing->date_billing = $data->date_billing;

  // Create Billing
  if($billing->create()) {
    echo json_encode(
      array('message' => 'Billing Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Billing Not Created')
    );
  }
