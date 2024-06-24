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

// Fetch form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$identificationNo = $_POST['identificationNo'];
$race = $_POST['race'];
$countryOfResidence = $_POST['countryOfResidence'];
$provinceOfResidence = $_POST['provinceOfResidence'];
$citizenship = $_POST['citizenship'];
$physicalAddress = $_POST['physicalAddress'];
$code = $_POST['code'];
$homeTelephone = $_POST['homeTelephone'];
$emergencyTelephone = $_POST['emergencyTelephone'];
$learnerCell = $_POST['learnerCell'];
$learnerEmail = $_POST['learnerEmail'];
$homeLanguage = $_POST['homeLanguage'];
$preferredLanguage = $_POST['preferredLanguage'];
$religion = $_POST['religion'];
$deceasedParent = isset($_POST['deceasedMother']) ? 'Mother' : (isset($_POST['deceasedFather']) ? 'Father' : (isset($_POST['deceasedBoth']) ? 'Both' : 'None'));

// Check if uploads directory exists and is writable
if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true);
}

// Function to handle file upload
function handleFileUpload($fileKey, $firstName, $lastName) {
    $filePath = "";
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == UPLOAD_ERR_OK) {
        $fileExtension = pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION);
        $filename = $firstName . '_' . $lastName . '_' . $fileKey . '.' . $fileExtension;
        $filePath = 'uploads/' . $filename;
        if (!move_uploaded_file($_FILES[$fileKey]['tmp_name'], $filePath)) {
            echo "Failed to upload $fileKey.";
        }
    }
    return $filePath;
}

// Handle file uploads
$deathCertificatePath = handleFileUpload('deathCertificate', $firstName, $lastName);
$immunisationRecordsPath = handleFileUpload('immunisationRecords', $firstName, $lastName);
$birthCertificatePath = handleFileUpload('birthCertificate', $firstName, $lastName);
$progressReportPath = handleFileUpload('progressReport', $firstName, $lastName);
$transferLetterPath = handleFileUpload('transferLetter', $firstName, $lastName);

// Insert into LearnerPersonalInfo
$sql = "INSERT INTO LearnerPersonalInfo (
    LearnerID, FirstName, LastName, DateOfBirth, Gender, IdentificationNo, Race, 
    CountryOfResidence, ProvinceOfResidence, Citizenship, PhysicalAddress, Code, 
    HomeTelephone, EmergencyTelephone, LearnerCell, LearnerEmail, HomeLanguage, 
    PreferredLanguageOfInstruction, Religion, DeceasedParent, DeathCertificatePath,
    ImmunisationRecordsPath, BirthCertificatePath, ProgressReportPath, TransferLetterPath
) VALUES (
    UUID(), '$firstName', '$lastName', '$dob', '$gender', 
    '$identificationNo', '$race', '$countryOfResidence', '$provinceOfResidence', '$citizenship', 
    '$physicalAddress', '$code', '$homeTelephone', '$emergencyTelephone', '$learnerCell', 
    '$learnerEmail', '$homeLanguage', '$preferredLanguage', '$religion', '$deceasedParent', '$deathCertificatePath',
    '$immunisationRecordsPath', '$birthCertificatePath', '$progressReportPath', '$transferLetterPath'
)";

if ($conn->query($sql) === TRUE) {
    $learnerID = $conn->insert_id; // Fetch the last inserted ID
    echo "New record created successfully in LearnerPersonalInfo";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Insert into PreviousSchoolInfo
$prevSchoolName = $_POST['prevSchoolName'];
$prevSchoolAddress = $_POST['prevSchoolAddress'];
$prevSchoolCode = $_POST['prevSchoolCode'];
$prevSchoolProvince = $_POST['prevSchoolProvince'];
$prevSchoolCountry = $_POST['prevSchoolCountry'];

$sql = "INSERT INTO PreviousSchoolInfo (
    SchoolInfoID, LearnerID, NameOfPreviousSchool, PreviousSchoolAddress, 
    PreviousSchoolCode, PreviousSchoolProvince, PreviousSchoolCountry
) VALUES (
    UUID(), '$learnerID', 
    '$prevSchoolName', '$prevSchoolAddress', '$prevSchoolCode', '$prevSchoolProvince', '$prevSchoolCountry'
)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully in PreviousSchoolInfo";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Insert into LearnerMedicalInfo
$medicalAidNumber = $_POST['medicalAidNumber'];
$medicalAidName = $_POST['medicalAidName'];
$mainMember = $_POST['mainMember'];
$doctorName = $_POST['doctorName'];
$doctorAddress = $_POST['doctorAddress'];
$doctorPhone = $_POST['doctorPhone'];
$medicalCondition = $_POST['medicalCondition'];
$counselingNeeds = $_POST['counselingNeeds'];
$dexterity = $_POST['dexterity'];
$socialGrant = $_POST['socialGrant'];

$sql = "INSERT INTO LearnerMedicalInfo (
    MedicalInfoID, LearnerID, MedicalAidNumber, MedicalAidName, MedicalAidMainMember, 
    DoctorName, DoctorAddress, DoctorPhone, MedicalCondition, CounselingNeeds, 
    Dexterity, RegisteredForSocialGrant
) VALUES (
    UUID(), '$learnerID', 
    '$medicalAidNumber', '$medicalAidName', '$mainMember', '$doctorName', 
    '$doctorAddress', '$doctorPhone', '$medicalCondition', '$counselingNeeds', '$dexterity', '$socialGrant'
)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully in LearnerMedicalInfo";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Insert into SiblingInfo
if (isset($_POST['siblingName']) && is_array($_POST['siblingName'])) {
    foreach ($_POST['siblingName'] as $index => $siblingName) {
        $siblingGrade = $_POST['siblingGrade'][$index];
        $sql = "INSERT INTO SiblingInfo (
            SiblingID, LearnerID, FullName, Grade
        ) VALUES (
            UUID(), '$learnerID', 
            '$siblingName', '$siblingGrade'
        )";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully in SiblingInfo";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Insert into ParentGuardianInfo
$parentTitle = $_POST['parentTitle'];
$parentInitials = $_POST['parentInitials'];
$parentSurname = $_POST['parentSurname'];
$parentFirstName = $_POST['parentFirstName'];
$parentGender = $_POST['parentGender'];
$parentHomeLanguage = $_POST['parentHomeLanguage'];
$parentRace = $_POST['parentRace'];
$parentID = $_POST['parentID'];
$accountPayer = $_POST['accountPayer'];
$parentAddress = $_POST['parentAddress'];
$parentCity = $_POST['parentCity'];
$parentCode = $_POST['parentCode'];
$parentOccupation = $_POST['parentOccupation'];
$parentEmployer = $_POST['parentEmployer'];
$spouseSurname = $_POST['spouseSurname'];
$spouseFirstName = $_POST['spouseFirstName'];
$spouseOccupation = $_POST['spouseOccupation'];
$residesWithParent = $_POST['residesWithParent'];
$spouseID = $_POST['spouseID'];
$relationshipToLearner = $_POST['relationshipToLearner'];
$maritalStatus = $_POST['maritalStatus'];

$sql = "INSERT INTO ParentGuardianInfo (
    ParentID, LearnerID, Title, Initials, Surname, FirstName, Gender, HomeLanguage, 
    Race, IdentificationNo, AccountPayer, ResidentialAddress, CitySuburb, Code, 
    Occupation, Employer, SpouseSurname, SpouseFirstName, SpouseOccupation, 
    LearnerResidesWithParent, SpouseID, RelationshipToLearner, MaritalStatus
) VALUES (
    UUID(), '$learnerID', 
    '$parentTitle', '$parentInitials', '$parentSurname', '$parentFirstName', '$parentGender', '$parentHomeLanguage', 
    '$parentRace', '$parentID', '$accountPayer', '$parentAddress', '$parentCity', '$parentCode', 
    '$parentOccupation', '$parentEmployer', '$spouseSurname', '$spouseFirstName', '$spouseOccupation', 
    '$residesWithParent', '$spouseID', '$relationshipToLearner', '$maritalStatus'
)";

if ($conn->query($sql) === TRUE) {
    $parentID = $conn->insert_id; // Fetch the last inserted ID
    echo "New record created successfully in ParentGuardianInfo";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Insert into CorrespondenceDetails
$correspondenceTitle = $_POST['correspondenceTitle'];
$correspondenceSurname = $_POST['correspondenceSurname'];
$correspondenceAddress = $_POST['correspondenceAddress'];
$correspondenceCity = $_POST['correspondenceCity'];
$correspondenceCode = $_POST['correspondenceCode'];

$sql = "INSERT INTO CorrespondenceDetails (
    CorrespondenceID, ParentID, Title, Surname, PostalAddress, CitySuburb, Code
) VALUES (
    UUID(), '$parentID', 
    '$correspondenceTitle', '$correspondenceSurname', '$correspondenceAddress', '$correspondenceCity', '$correspondenceCode'
)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully in CorrespondenceDetails";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Insert into OtherContactDetails
$homePhone = $_POST['homePhone'];
$workPhone = $_POST['workPhone'];
$faxNumber = $_POST['faxNumber'];
$cellNumber = $_POST['cellNumber'];
$spouseWorkPhone = $_POST['spouseWorkPhone'];
$spouseCell = $_POST['spouseCell'];
$emailAddress = $_POST['emailAddress'];
$spouseEmail = $_POST['spouseEmail'];

$sql = "INSERT INTO OtherContactDetails (
    ContactID, ParentID, HomeTelephone, WorkTelephone, FaxNumber, CellNumber, 
    SpouseWorkPhone, SpouseCell, EmailAddress, SpouseEmailAddress
) VALUES (
    UUID(), '$parentID', 
    '$homePhone', '$workPhone', '$faxNumber', '$cellNumber', 
    '$spouseWorkPhone', '$spouseCell', '$emailAddress', '$spouseEmail'
)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully in OtherContactDetails";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
