<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "godrej"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch project data
$sql = "SELECT name, website, image, location, price FROM projects"; // Your table name
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Godrej Projects</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (includes Popper.js for dropdowns and tooltips) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <link href="Assets/css/main.css" rel="stylesheet"> <!-- Custom styles -->
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Godrej Projects</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#projects">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>

                <!-- Dropdown Item -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cities
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Pune</a></li>
                        <li><a class="dropdown-item" href="#">Mumbai</a></li>
                        <li><a class="dropdown-item" href="#">Noida</a></li>
                    </ul>
                </li>

                <!-- Button Item -->
                <li class="nav-item">
                    <a class="btn btn-primary" href="admin/index.php" role="button">Admin Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
    <div>
        <h1>Discover Premium Godrej Projects</h1>
        <p>Explore luxurious homes in prime locations with unmatched amenities.</p>
    </div>
</section>

<!-- Two Div Section -->
<div class="container-fluid mt-5">
    <div class="row">
        <!-- First Row: Contact Form on the left -->
        <div class="col-md-3">
            <h4 class="fw-bold">Contact Us</h4>
            <form action="your-form-handler.php" method="POST">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Second Row: Full-Width Project Cards -->
        <div class="col-md-9" style="max-height: 600px; overflow-y: auto;"> <!-- Scrollable container -->
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-12 mb-4">';
                        echo '<div class="card shadow-sm d-flex flex-row">'; 
                        
                        // Image on the left side
                        echo '<div class="col-md-4 p-0">';
                        echo '<img src="' . $row['image'] . '" class="card-img-left" alt="' . $row['name'] . '" style="width: 100%; height: 100%; object-fit: cover;">';
                        echo '</div>';
                        
                        // Information on the right side
                        echo '<div class="col-md-8 card-body">';
                        echo '<h5 class="card-title">' . $row['name'] . '</h5>';
                        echo '<p><strong>Location:</strong> ' . $row['location'] . '</p>';
                        echo '<p><strong>Price:</strong> ' . $row['price'] . '</p>';
                        echo '<a href="' . $row['website'] . '" target="_blank" class="btn btn-primary">View Details</a>';
                        echo '</div>';
                        
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="text-center">No projects available.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center py-4">
    <p>&copy; <?php echo date("Y"); ?> Godrej. All rights reserved.</p>
</footer>

<script src="Assets/script/mainscript.js"></script>

</body>
</html>

<?php $conn->close(); ?>
