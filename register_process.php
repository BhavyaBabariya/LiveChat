<?php
// Database connection code here

$db = new mysqli("localhost", "root", "", "chat_db_sec");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"]; // In a real-world application, hash the password for security.

    // Insert user data into the 'users' table (replace with your table name)
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($db, $sql)) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}

// Close the database connection
mysqli_close($db);
?>
