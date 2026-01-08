<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Correct SQL statement
$sql = "INSERT INTO students (name, email, course, age) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// ✅ Check if prepare() succeeded
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssi", $name, $email, $course, $age);

$name = $_POST['name'];
$email = $_POST['email'];
$course = $_POST['course'];
$age = $_POST['age'];

if ($stmt->execute()) {
    echo "New student registered successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
