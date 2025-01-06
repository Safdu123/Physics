<?php
session_start();

// Set the valid username and password
$validUsername = 'safdu';
$validPassword = 'Safdal123';

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];

// Check if the credentials are correct
if ($username === $validUsername && $password === $validPassword) {
    $_SESSION['logged_in'] = true; // Set login session
    http_response_code(200);
    echo json_encode(['success' => true]);
} else {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Invalid username or password']);

}
?>

