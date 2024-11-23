<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "godrej";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $website = $_POST['website'];
    $image = $_POST['image'];
    $location = $_POST['location'];
    $price = $_POST['price'];

    $sql = "INSERT INTO projects (name, website, image, location, price) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $website, $image, $location, $price);

    if ($stmt->execute()) {
        header("Location: dashboard.php?success=1");
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>
