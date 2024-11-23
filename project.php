<?php include('includes/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <section class="project-detail">
            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'godrej');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetching the project ID from the URL parameter
            $projectId = $_GET['project'];

            // Query to get the project details
            $query = "SELECT * FROM projects WHERE id = $projectId";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                // Fetch the data for the selected project
                while($row = $result->fetch_assoc()) {
                    echo "<h1>" . $row['name'] . "</h1>";
                    echo "<p><strong>Location:</strong> " . $row['location'] . "</p>";
                    echo "<p>" . $row['description'] . "</p>";
                    echo "<img src='assets/images/" . $row['image'] . "' alt='" . $row['name'] . "'>";
                }
            } else {
                echo "<p>No project found.</p>";
            }

            $conn->close();
            ?>
        </section>
    </div>
    <?php include('includes/footer.php'); ?>
</body>
</html>
