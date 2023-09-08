<?php
$db = new mysqli("localhost", "root", "", "chat_db_sec");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$message = $_POST['message'];
$username = $_POST['username'];

$sql = "INSERT INTO chat_messages (username, message) VALUES (?, ?)";
$stmt = $db->prepare($sql);
$stmt->bind_param("ss", $username, $message);

if ($stmt->execute()) {
    echo "Message sent successfully.";
} else {
    echo "Error sending message.";
}

$stmt->close();
$db->close();
?>
