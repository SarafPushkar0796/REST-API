<?php 
  // Headers as API is public
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Instantiate DB object & connect
  $database = new Database();

  // from '../../config/Database.php' & function connect()
  $db = $database->connect();

  // Instantiate blog Category object
  $category = new Category($db);

  // Blog category query
  $result = $category->read();
  
  // Get row count when posts present
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {

    // Post array
    $category_arr = array();

    // Getting this as a JSON object i.e "data":[{ .. }]
    $category_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $category_item = array(
        'id' => $id,
        'name' => $name,
        'created_at' => $created_at
      );

      // Push to "data"
      array_push($category_arr['data'], $category_item);
    }

    // Turn data to JSON
    echo json_encode($category_arr);

  } else {

    // No Categories found
    echo json_encode(
      array('message' => 'No Categories Found')
    );
  }