<?
$data = "https://www.googleapis.com/books/v1/volumes?q=東野圭吾";
$json = file_get_contents($data);
$json_decode = json_decode($json);

// jsonデータ内の『entry』部分を複数取得して、postsに格納
$posts = $json_decode->items;
// var_dump($posts['thumbnail']);
echo $posts;


?>




