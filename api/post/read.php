<?php 
  // Headers as API is public
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate DB object & connect
  $database = new Database();

  // from '../../config/Database.php' & function connect()
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Blog post query
  $result = $post->read();
  
  // Get row count when posts present
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {

    // Post array
    $posts_arr = array();

    // Getting this as a JSON object i.e "data":[{ .. }]
    $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
        'id' => $id,
        'title' => $title,

        // Since the body part is wrapped around HTML
        'body' => html_entity_decode($body),
        'author' => $author,
        'category_id' => $category_id,
        'category_name' => $category_name
      );

      // Push to "data"
      //array_push($posts_arr, $post_item);
      array_push($posts_arr['data'], $post_item);
    }

    // Turn data to JSON
    echo json_encode($posts_arr);

  } else {

    // No Posts found
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }