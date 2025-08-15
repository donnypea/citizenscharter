<?php
// insert_news.php

// Connect to DB
$conn = new mysqli("localhost", "root", "", "citizenscharterdb");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];

    // Save uploaded file to /uploads
    $uploadPath = 'uploads/' . basename($imageName);
    if (move_uploaded_file($imageTmp, $uploadPath)) {
        // Insert into DB
        $stmt = $conn->prepare("INSERT INTO news_updates (title, image) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $imageName);
        $stmt->execute();
        echo "<script>alert('News inserted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Failed to upload image.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert News</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f5;
            padding: 50px;
        }

        form {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #003366;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #003366;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #005599;
        }
    </style>
</head>
<body>

    <form method="POST" enctype="multipart/form-data">
        <h2>Insert News & Updates</h2>
        <input type="text" name="title" placeholder="Enter news title" required>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Submit News</button>
    </form>

</body>
</html>
