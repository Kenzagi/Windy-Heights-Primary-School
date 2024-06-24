<?php
include 'header.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WindyHeightsDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all learners
$sql = "SELECT * FROM LearnerPersonalInfo";
$result = $conn->query($sql);
?>



<div class="main">
    <h1>Welcome to the Admin Dashboard</h1>
    <p>Here you can manage applications and view uploads.</p>
</div>
 


<?php
include 'footer.php';
$conn->close();
?>
