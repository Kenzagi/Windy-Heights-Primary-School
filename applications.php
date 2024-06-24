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


    <div class="content">
        <h3>Applications</h3>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['LearnerID']; ?></td>
                    <td><?php echo $row['FirstName'] . ' ' . $row['LastName']; ?></td>
                    <td><?php echo $row['ApplicationStatus']; ?></td>
                    <td>
                    <a href="view_learner.php?id=<?php echo $row['LearnerID']; ?>" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <a href="change_status.php?id=<?php echo $row['LearnerID']; ?>" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Change Status
                    </a>
                </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

<?php
include 'footer.php';
$conn->close();
?>
