<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Location.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $location = new Location($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $location->id = $data->id;

  // Delete post
  if($location->delete()) {
    echo json_encode(
      array('message' => 'Location deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Location not deleted')
    );
  }
