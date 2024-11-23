<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "godrej"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $website = $_POST['website'];

    // Handle the uploaded image
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
    }

    $imageName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . uniqid('project_') . '.' . pathinfo($imageName, PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
        // Insert project details into the database
        $sql = "INSERT INTO projects (name, image, location, price, description, website) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $name, $targetFilePath, $location, $price, $description, $website);

        if ($stmt->execute()) {
            echo "Project added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Project</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Project Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" class="form-control" id="location" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" id="price" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
        </div>
        <!-- <div class="mb-3">
            <label for="website" class="form-label">Website URL</label>
            <input type="url" name="website" class="form-control" id="website" required>
        </div> -->
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" name="image" class="form-control" id="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Project</button>
    </form>
</div>
</body>
</html>
