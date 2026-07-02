<!-- ****Register.php**** -->


<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'user_management';

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt the password
$gender = $_POST['gender'];

// Prepare SQL query to insert data
$stmt = $conn->prepare("INSERT INTO users (full_name, email, phone_number, username, password, gender) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $full_name, $email, $phone_number, $username, $password, $gender);

// Execute the query
if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
