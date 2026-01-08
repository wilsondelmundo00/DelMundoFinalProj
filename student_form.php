<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "student_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];
    $age    = $_POST['age'];

    $stmt = $conn->prepare("INSERT INTO students (name, email, course, age) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sssi", $name, $email, $course, $age);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <div>
            <h2>Student Form Registration</h2>
            <form method="post">
                <label>Name:</label>
                <input type="text" name="name" required><br><br>
            
                <label>Email:</label>
                <input type="email" name="email" required><br><br>

                <label>Course:</label>
                <input type="text" name="course" required><br><br>

                <label>Age:</label>
                <input type="number" name="age" required><br><br>

                <input type="submit" value="Register">
            </form>
        </div>
    </div>

    <div class="table-container">
    <h2>Registered Students List</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Age</th><th>Actions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM students");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['course']}</td>
                <td>{$row['age']}</td>
                <td>
                    <a href='edit.php?id={$row['id']}'>Edit</a> | 
                    <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Delete this student?\")'>Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
