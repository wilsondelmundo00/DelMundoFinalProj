<?php
session_start();
require_once 'config.php';

// Get student by ID
$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM students WHERE id = $id");
$student = $result->fetch_assoc();

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = trim($_POST['name']);
    $course = trim($_POST['course']);
    $age    = intval($_POST['age']);
    $email  = trim($_POST['email']);


    $stmt = $conn->prepare("UPDATE students SET name=?, course=?, age=?, email=? WHERE id=?");
    $stmt->bind_param("ssisi", $name, $course, $age, $email, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: student_form.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student Info</title>
</head>
<body>
    <h2>Edit Student Information</h2>
<form method="POST" action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>

    <label for="course">Course:</label>
    <input type="text" id="course" name="course" value="<?= htmlspecialchars($student['course']) ?>" required>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" value="<?= htmlspecialchars($student['age']) ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required>
    
    <button type="submit">Update Student</button>
</form>

</body>
</html>
