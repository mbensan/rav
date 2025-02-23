<?php
$json_file = 'rbfdb.json';

$db = json_decode(file_get_contents($json_file), true);

function save_db () {
  global $db, $json_file;
  file_put_contents($json_file, json_encode($db));
}

//print_r($db['ig_id']);

$now = time();
$secs_per_day = 86400;

// if last call was over one day, make another request loading current feed
if ($now - $db['timestamp'] > 86400) {
  $url = "https://graph.instagram.com/me/media?fields=id,caption,media_url,media_type&limit=10&access_token={$db['access_token']}";
  $feed = json_decode(file_get_contents($url), true);

  $db['timestamp'] = $now;
  $db['feed'] = $feed;

  save_db();
  header("Content-Type: application/json");
  echo json_encode($feed);
}
else {
  header("Content-Type: application/json");
  echo json_encode($db['feed']);
}
exit();




?>