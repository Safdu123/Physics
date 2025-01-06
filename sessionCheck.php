<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    http_response_code(401);
    echo json_encode(['message' => 'Not logged in']);
} else {
    http_response_code(200);
    echo json_encode(['message' => 'Logged in']);
}
?>

