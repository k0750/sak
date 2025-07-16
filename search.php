<?php
include_once("config.php");

// Retrieve GET parameters
$county = isset($_GET['county']) ? $_GET['county'] : null;
$ageParam = isset($_GET['age']) ? $_GET['age'] : null;
$gender = isset($_GET['gender']) ? $_GET['gender'] : null;

// Build base query and prepare parameters
$sql = "SELECT * FROM children WHERE 1=1";
$params = array();
$types = "";

// Filter by county if provided
if ($county) {
    $sql .= " AND county = ?";
    $params[] = $county;
    $types .= "s";
}

// Filter by age
if ($ageParam) {
    // Check if age is a range in the format min-max
    if (strpos($ageParam, "-") !== false) {
        list($minAge, $maxAge) = explode("-", $ageParam);
        $sql .= " AND age BETWEEN ? AND ?";
        $params[] = (int)$minAge;
        $params[] = (int)$maxAge;
        $types .= "ii";
    } else {
        // If it's not a range, treat it as an exact value
        $sql .= " AND age = ?";
        $params[] = (int)$ageParam;
        $types .= "i";
    }
}

// Filter by gender if provided
if ($gender) {
    $sql .= " AND gender = ?";
    $params[] = $gender;
    $types .= "s";
}

// Prepare and execute the statement
$stmt = $conn->prepare($sql);
if(!$stmt){
    die(json_encode(array("error" => $conn->error)));
}

if(count($params) > 0){
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$children = array();
while ($child = $result->fetch_assoc()) {
    $children[] = $child;
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($children);

$stmt->close();
$conn->close();
?>


