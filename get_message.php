<?php
$db = new mysqli("localhost", "root", "", "chat_db_sec");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$sql = "SELECT username, message, timestamp FROM chat_messages ORDER BY timestamp DESC LIMIT 10";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<strong>" . $row['username'] . ":</strong> " . $row['message'] . " (" . $row['timestamp'] . ")<br>";
    }
} else {
    echo "No messages yet.";
}

$db->close();
?>
