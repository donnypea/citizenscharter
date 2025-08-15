<?php
// admin.php
$conn = new mysqli("localhost", "root", "", "citizenscharterdb");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Handle Add News
if (isset($_POST['add_news'])) {
    $title = $conn->real_escape_string($_POST['title']);
    if (!empty($_FILES['image']['name'])) {
        $filename = time() . "_" . basename($_FILES['image']['name']);
        $target = "../uploads/" . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $conn->query("INSERT INTO news_updates (title, image) VALUES ('$title', '$filename')");
    }
}

// Handle Add Service
if (isset($_POST['add_service'])) {
    $name = $conn->real_escape_string($_POST['service_name']);
    $icon = $conn->real_escape_string($_POST['service_icon']);
    $file = $conn->real_escape_string($_POST['service_file']);
    $conn->query("INSERT INTO external_services (service_name, service_icon, service_file) VALUES ('$name', '$icon', '$file')");
}

// Handle Delete News
if (isset($_GET['delete_news'])) {
    $id = (int)$_GET['delete_news'];
    $conn->query("DELETE FROM news_updates WHERE id = $id");
}

// Handle Delete Service
if (isset($_GET['delete_service'])) {
    $id = (int)$_GET['delete_service'];
    $conn->query("DELETE FROM external_services WHERE id = $id");
}

// Fetch Data
$news = $conn->query("SELECT * FROM news_updates ORDER BY id DESC");
$services = $conn->query("SELECT * FROM external_services ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel - City Hall</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {margin:0; font-family: Arial, sans-serif; background:#f4f4f4;}
    .sidebar {width:250px; background:#2c3e50; height:100vh; position:fixed; color:#fff; padding-top:20px;}
    .sidebar h2 {text-align:center; margin-bottom:20px;}
    .sidebar a {display:block; padding:12px; color:#fff; text-decoration:none; transition:0.3s;}
    .sidebar a:hover {background:#1abc9c;}
    .content {margin-left:260px; padding:20px;}
    table {width:100%; border-collapse:collapse; background:#fff; margin-bottom:20px;}
    table th, table td {padding:10px; border:1px solid #ddd; text-align:left;}
    form {background:#fff; padding:15px; margin-bottom:20px; border:1px solid #ddd;}
    input, select {padding:8px; width:100%; margin-bottom:10px;}
    button {padding:10px; background:#1abc9c; color:#fff; border:none; cursor:pointer;}
    button:hover {background:#16a085;}
</style>
</head>
<body>

<div class="sidebar">
    <h2><i class="fas fa-user-shield"></i> Admin</h2>
    <a href="#news"><i class="fas fa-newspaper"></i> Manage News</a>
    <a href="#services"><i class="fas fa-cogs"></i> Manage Services</a>
</div>

<div class="content">
    <h1>City Hall Admin Dashboard</h1>

    <!-- NEWS MANAGEMENT -->
    <section id="news">
        <h2><i class="fas fa-newspaper"></i> News & Updates</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="News Title" required>
            <input type="file" name="image" accept="image/*" required>
            <button type="submit" name="add_news">Add News</button>
        </form>
        <table>
            <tr><th>Image</th><th>Title</th><th>Action</th></tr>
            <?php while($row = $news->fetch_assoc()): ?>
            <tr>
                <td><img src="../uploads/<?= htmlspecialchars($row['image']) ?>" width="100"></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><a href="?delete_news=<?= $row['id'] ?>" onclick="return confirm('Delete this news?')" style="color:red;"><i class="fas fa-trash"></i></a></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </section>

    <!-- SERVICES MANAGEMENT -->
    <section id="services">
        <h2><i class="fas fa-cogs"></i> External Services</h2>
        <form method="post">
            <input type="text" name="service_name" placeholder="Service Name" required>
            <input type="text" name="service_icon" placeholder="Font Awesome Icon Class (e.g., fas fa-money-check-alt)" required>
            <input type="text" name="service_file" placeholder="Service File (e.g., payment.html)" required>
            <button type="submit" name="add_service">Add Service</button>
        </form>
        <table>
            <tr><th>Icon</th><th>Name</th><th>File</th><th>Action</th></tr>
            <?php while($row = $services->fetch_assoc()): ?>
            <tr>
                <td><i class="<?= htmlspecialchars($row['service_icon']) ?>"></i></td>
                <td><?= htmlspecialchars($row['service_name']) ?></td>
                <td><?= htmlspecialchars($row['service_file']) ?></td>
                <td><a href="?delete_service=<?= $row['id'] ?>" onclick="return confirm('Delete this service?')" style="color:red;"><i class="fas fa-trash"></i></a></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </section>
</div>

</body>
</html>
