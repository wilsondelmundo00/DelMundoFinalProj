<?php
$conn = new mysqli("localhost", "root", "", "student_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM students");

echo "<h2>Registered Students</h2>";
echo "<table border='1'>
<tr><th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Age</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['name']}</td>
    <td>{$row['email']}</td>
    <td>{$row['course']}</td>
    <td>{$row['age']}</td>
    </tr>";
}
echo "</table>";

$conn->close();
?>
