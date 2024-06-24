<?php
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

$learnerID = $_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    $rejectionReason = $_POST['rejectionReason'];

    $sql = "UPDATE LearnerPersonalInfo SET ApplicationStatus='$status', RejectionReason='$rejectionReason' WHERE LearnerID='$learnerID'";

    if ($conn->query($sql) === TRUE) {
        echo "Status updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch learner details
$sql = "SELECT * FROM LearnerPersonalInfo WHERE LearnerID='$learnerID'";
$result = $conn->query($sql);
$learner = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Status</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Change Status for <?php echo $learner['FirstName'] . ' ' . $learner['LastName']; ?></h3>
    <form method="post">
        <div class="form-group">
            <label for="status">Application Status</label>
            <select class="form-control" id="status" name="status">
                <option value="Accepted" <?php if ($learner['ApplicationStatus'] == 'Accepted') echo 'selected'; ?>>Accepted</option>
                <option value="Rejected" <?php if ($learner['ApplicationStatus'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
            </select>
        </div>
        <div class="form-group">
            <label for="rejectionReason">Rejection Reason</label>
            <textarea class="form-control" id="rejectionReason" name="rejectionReason"><?php echo $learner['RejectionReason']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
</body>
</html>

<?php
$conn->close();
?>
