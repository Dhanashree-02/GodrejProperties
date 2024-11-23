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
$sql = "SELECT name, CONCAT('admin/uploads/project_674197969ba92.jpg', image) AS image_path, location, price, description, website FROM projects";

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
                    <a class="nav-link" href="#projects" data-bs-toggle="modal" data-bs-target="#aboutUsModal">Projects</a>
                </li>
                <li class="nav-item">
                    <!-- Updated About Us Link -->
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#aboutUsModal">About Us</a>
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
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#aboutUsModal" >Pune</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#aboutUsModal" >Mumbai</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#aboutUsModal" >Noida</a></li>
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
        <!-- Contact Form on the left -->
        <div class="col-md-4">
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

        <!-- Project Cards -->
             <div class="col-md-8" style="max-height: 600px; overflow-y: auto;">
                <div class="row">
                    <?php
                     if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col-md-12 mb-4">
                                <div class="card h-100 shadow-sm d-flex flex-row">
                                     <img src="<?= htmlspecialchars($row['image_path']) ?>" 
                                      class="card-img-left" 
                                        alt="<?= htmlspecialchars($row['name']) ?>" 
                                        style="width: 40%; object-fit: cover; max-height: 200px;">
                                        <div class="card-body" style="flex: 1; padding: 20px;">
                                        <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                                        <p class="card-text"><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
                                        <p><strong>Price:</strong> ₹<?= htmlspecialchars($row['price']) ?></p>
                                        <p><?= htmlspecialchars($row['description']) ?></p>
                                        <a href="<?= htmlspecialchars($row['website']) ?>" class="btn btn-primary" target="_blank">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<p>No projects available.</p>';
                        }
                        ?>
                    </div>
            </div>
        </div>
    </div>

    <!-- Modal for About Us -->
<div class="modal fade" id="aboutUsModal" tabindex="-1" aria-labelledby="aboutUsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutUsModalLabel">Contact Us</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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
