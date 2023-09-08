<!DOCTYPE html>
<html>
<head>
    <title>Live Chat</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="chat-box">
            <a href="logout.php">Logout</a>
            <div id="chat"></div>
            
            <?php
            // Start the session
            session_start();
                echo '';
            // Check if the user is logged in
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                echo '<input type="text" id="username" placeholder="Your Name" value="' . $username . '" disabled>';
            } else {
                header("Location: login.php");
                exit();
            }
            ?>
            <input type="text" id="message" placeholder="Type your message">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function sendMessage() {
            var message = $("#message").val();
            var username = "<?php echo $_SESSION['username']; ?>";

            // Send the message to the server for processing and display
            $.ajax({
                url: "send_message.php",
                method: "POST",
                data: { message: message, username: username },
                success: function () {
                    $("#message").val("");
                    updateChat();
                }
            });
        }

        function updateChat() {
            // Retrieve and display chat messages from the server
            $.ajax({
                url: "get_message.php",
                method: "GET",
                success: function (data) {
                    $("#chat").html(data);
                }
            });
        }

        $(document).ready(function () {
            // Load chat messages when the page loads and update every 2 seconds
            updateChat();
            setInterval(updateChat, 1000);
        });
    </script>
</body>
</html>
