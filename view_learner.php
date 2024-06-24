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

// Fetch learner details
$sql = "SELECT * FROM LearnerPersonalInfo WHERE LearnerID='$learnerID'";
$result = $conn->query($sql);
$learner = $result->fetch_assoc();

// Fetch previous school info
$sql = "SELECT * FROM PreviousSchoolInfo WHERE LearnerID='$learnerID'";
$prevSchool = $conn->query($sql)->fetch_assoc();

// Fetch medical info
$sql = "SELECT * FROM LearnerMedicalInfo WHERE LearnerID='$learnerID'";
$medicalInfo = $conn->query($sql)->fetch_assoc();

// Fetch sibling info
$sql = "SELECT * FROM SiblingInfo WHERE LearnerID='$learnerID'";
$siblings = $conn->query($sql);

// Fetch parent/guardian info
$sql = "SELECT * FROM ParentGuardianInfo WHERE LearnerID='$learnerID'";
$parentInfo = $conn->query($sql)->fetch_assoc();

// Fetch correspondence details
$sql = "SELECT * FROM CorrespondenceDetails WHERE ParentID='".$parentInfo['ParentID']."'";
$correspondence = $conn->query($sql)->fetch_assoc();

// Fetch other contact details
$sql = "SELECT * FROM OtherContactDetails WHERE ParentID='".$parentInfo['ParentID']."'";
$otherContacts = $conn->query($sql)->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Learner</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>View Learner</h3>
    <table class="table">
        <tr>
            <th>ID</th>
            <td><?php echo $learner['LearnerID']; ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?php echo $learner['FirstName'] . ' ' . $learner['LastName']; ?></td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td><?php echo $learner['DateOfBirth']; ?></td>
        </tr>
        <!-- Add more fields as needed -->
    </table>
    <h4>Previous School Information</h4>
    <table class="table">
        <tr>
            <th>Previous School</th>
            <td><?php echo $prevSchool['NameOfPreviousSchool']; ?></td>
        </tr>
        <!-- Add more fields as needed -->
    </table>
    <h4>Medical Information</h4>
    <table class="table">
        <tr>
            <th>Medical Aid Number</th>
            <td><?php echo $medicalInfo['MedicalAidNumber']; ?></td>
        </tr>
        <!-- Add more fields as needed -->
    </table>
    <h4>Siblings</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            <?php while($sibling = $siblings->fetch_assoc()): ?>
            <tr>
                <td><?php echo $sibling['FullName']; ?></td>
                <td><?php echo $sibling['Grade']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <h4>Parent/Guardian Information</h4>
    <table class="table">
        <tr>
            <th>Name</th>
            <td><?php echo $parentInfo['FirstName'] . ' ' . $parentInfo['Surname']; ?></td>
        </tr>
        <!-- Add more fields as needed -->
    </table>
    <h4>Correspondence Details</h4>
    <table class="table">
        <tr>
            <th>Title</th>
            <td><?php echo $correspondence['Title']; ?></td>
        </tr>
        <!-- Add more fields as needed -->
    </table>
    <h4>Other Contact Details</h4>
    <table class="table">
        <tr>
            <th>Home Telephone</th>
            <td><?php echo $otherContacts['HomeTelephone']; ?></td>
        </tr>
        <!-- Add more fields as needed -->
    </table>
    <a href="generate_pdf.php?id=<?php echo $learnerID; ?>" class="btn btn-primary">Download PDF</a>
</div>
</body>
</html>

<?php
$conn->close();
?>
