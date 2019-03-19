<?php

  // Headers as API is public
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');

  // 'X-Requested-With' helps to deal with cross-site scripting attack
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate DB object & connect
  $database = new Database();

  // from '../../config/Database.php' & function connect()
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Get posted data
  $data = json_decode(file_get_contents('php://input'));

  // Set the ID to update
  $post->id = $data->id;

  // Assigning data to post
  $post->title = $data->title;
  $post->body = $data->body;
  $post->author = $data->author;
  $post->category_id = $data->category_id;

  // Check if post Updated
  if ($post->update()) {
  	echo json_encode(
  		array('message' => 'Post Updated.')
  	);
  } else {
  	echo json_encode(
  		array('message' => 'Cannot update post.')
  	);
  }

?>