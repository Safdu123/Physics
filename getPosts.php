<?php
header('Content-Type: application/json');
$posts = json_decode(file_get_contents('posts.json'), true);

// Decode content before sending
foreach ($posts as &$post) {
    $post['content'] = htmlspecialchars_decode($post['content']);
}
echo json_encode($posts);
?>

