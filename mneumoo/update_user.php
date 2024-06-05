<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "UPDATE login SET username=?, password=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssi', $username, $password, $id);

if ($stmt->execute()) {
    echo "User updated successfully";
} else {
    echo "Error updating user: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
