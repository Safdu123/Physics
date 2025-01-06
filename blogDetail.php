<?php
// Get the post ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : -1;

// Load the posts from the JSON file
$postsFile = 'posts.json';
if (!file_exists($postsFile)) {
    die('Error: posts.json file not found.');
}

$posts = json_decode(file_get_contents($postsFile), true);
if ($posts === null) {
    die('Error: Failed to read posts.json or invalid JSON format.');
}

// Check if the post exists
if ($id < 0 || $id >= count($posts)) {
    die('Error: Invalid post ID.');
}

$post = $posts[$id]; // Fetch the specific post

// Decode content safely
$title = isset($post['title']) ? htmlspecialchars($post['title']) : 'Untitled';
$content = isset($post['content']) ? htmlspecialchars_decode($post['content']) : 'No content available.';
$image = isset($post['image']) ? $post['image'] : '';
$author = isset($post['author']) ? htmlspecialchars($post['author']) : 'Unknown';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #00509e;
        }
        img {
            max-width: 100%;
            margin: 1rem 0;
        }
        p {
            font-size: 1rem;
            line-height: 1.6;
        }
        .author {
            font-style: italic;
            color: #555;
        }
        a {
            color: #00509e;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $title; ?></h1>
        <p class="author">By <?php echo $author; ?></p>
        <?php if ($image): ?>
            <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
        <?php endif; ?>
        <p><?php echo nl2br($content); ?></p>
        <a href="index.html">Back to Home</a>
    </div>
</body>
</html>

