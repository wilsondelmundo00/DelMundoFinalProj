<?php
session_start();
require_once 'config.php'; 

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: student_form.php");
exit();
?>
