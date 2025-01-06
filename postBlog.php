<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// File paths
$postsFile = 'posts.json';
$uploadDir = 'uploads/';

// Check if posts.json exists
if (!file_exists($postsFile)) {
    file_put_contents($postsFile, json_encode([]));
}

// Load existing posts
$posts = json_decode(file_get_contents($postsFile), true);
if ($posts === null) {
    die('Error reading posts.json');
}

// Validate POST data
if (empty($_POST['title']) || empty($_POST['content']) || !isset($_FILES['image'])) {
    die('Invalid input data');
}

// Save uploaded image
$imagePath = $uploadDir . basename($_FILES['image']['name']);
if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
    die('Error saving uploaded file');
}

// Get author name from session
$author = isset($_SESSION['username']) ? $_SESSION['username'] : 'Anonymous';

// Add new post
$posts[] = [
    'title' => $_POST['title'],
    'content' => $_POST['content'],
    'image' => $imagePath,
    'author' => $author
];

// Save posts back to JSON file
if (file_put_contents($postsFile, json_encode($posts)) === false) {
    die('Error writing to posts.json');
}

// Success response
http_response_code(200);
echo json_encode(['success' => true, 'message' => 'Blog post saved successfully']);
?>

