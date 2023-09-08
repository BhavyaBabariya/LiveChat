<?php
// Database connection code here

$db = new mysqli("localhost", "root", "", "chat_db_sec");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"]; // In a real-world application, hashed passwords should be used.

    // Check user credentials in the 'users' table (replace with your table name)
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) == 1) {
        session_start();
        $_SESSION["username"] = $username;
        header("Location: index.php"); // Redirect to the chat page after successful login.
    } else {
        echo "Login failed. Invalid username or password.";
    }
}

// Close the database connection
mysqli_close($db);
?>
