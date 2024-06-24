<?php
require('fpdf/fpdf.php');

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

$learnerID = isset($_GET['id']) ? $_GET['id'] : null;

if (!$learnerID) {
    die("Learner ID is required.");
}

// Fetch learner details
$sql = "SELECT * FROM LearnerPersonalInfo WHERE LearnerID='$learnerID'";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching learner details: " . $conn->error);
}

$learner = $result->fetch_assoc();

if (!$learner) {
    die("No learner found with the given ID.");
}

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,'Learner Application',0,1,'C');
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Learner Details',0,1);

$pdf->SetFont('Arial','',10);
foreach($learner as $key => $value) {
    $pdf->Cell(50,10,ucwords(str_replace('_', ' ', $key)),1);
    $pdf->Cell(0,10,$value,1,1);
}

$pdf->Output();

$conn->close();
?>
