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

  // Get ID
  $post->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $post->readSinglePost();

  // Returning JSON data
  $post_arr = array(
  	'id' => $post->id,
  	'title' => $post->title,
  	'body' => $post->body,
  	'author' => $post->author,
  	'category_id' => $post->category_id,
  	'category_name' => $post->category_name
  );

  // Converting to JSON
  print_r(json_encode($post_arr));

?>