<?php

  // Headers as API is public
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');

  // 'X-Requested-With' helps to deal with cross-site scripting attack
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Instantiate DB object & connect
  $database = new Database();

  // from '../../config/Database.php' & function connect()
  $db = $database->connect();

  // Instantiate blog category object
  $category = new Category($db);

  // Get posted data
  $data = json_decode(file_get_contents('php://input'));

  // Assigning data to $category
  /* No 'id' and 'created_at' input required as the values are auto-inserted */
  $category->name = $data->name;

  // Create category
  if ($category->create()) {
  	echo json_encode(
  		array('message' => 'Category Created.')
  	);
  } else {
  	echo json_encode(
  		array('message' => 'Cannot create category.')
  	);
  }

?>