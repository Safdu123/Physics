<?php
// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);
$index = $data['index'];

// Load existing posts
$posts = json_decode(file_get_contents('posts.json'), true);

// Check if the index is valid
if (isset($posts[$index])) {
    // Remove the post image file
    $imagePath = $posts[$index]['image'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    // Remove the post from the array
    array_splice($posts, $index, 1);

    // Save the updated posts back to the file
    file_put_contents('posts.json', json_encode($posts));

    http_response_code(200);
    echo json_encode(['message' => 'Blog deleted successfully']);
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid blog index']);
}
?>

