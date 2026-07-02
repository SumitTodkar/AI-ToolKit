


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

// Get login data
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare SQL query to fetch user data
$stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        echo "Login successful!";
    } else {
        echo "Invalid password!";
    }
} else {
    echo "Username not found!";
}

// Close connection
$stmt->close();
$conn->close();
?>
