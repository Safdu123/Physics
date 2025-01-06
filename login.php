<?php
session_start();

// Set valid username and password
$validUsername = 'safdu';
$validPassword = 'Safdal123';

// List of CAPTCHA questions and answers
$captchaQuestions = [
    "What is the color of the sky?" => "blue",
    "What is 2 + 2?" => "4",
    "What is the capital of France?" => "paris",
    "What is the opposite of 'up'?" => "down"
];

// Select a random question
if (!isset($_SESSION['captcha_question'])) {
    $randomQuestion = array_rand($captchaQuestions);
    $_SESSION['captcha_question'] = $randomQuestion;
    $_SESSION['captcha_answer'] = $captchaQuestions[$randomQuestion];
}

// Handle login submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $captcha = strtolower(trim($_POST['captcha'])); // Convert to lowercase for comparison

    // Check CAPTCHA
    if ($captcha !== $_SESSION['captcha_answer']) {
        echo "Error: Incorrect CAPTCHA answer!";
        exit;
    }

    // Validate username and password
    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['logged_in'] = true;
        echo "Success: Logged in!";
        exit;
    } else {
        echo "Error: Invalid username or password!";
        exit;
    }
}
