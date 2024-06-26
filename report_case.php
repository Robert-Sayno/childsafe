<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChildSafe Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
        }

        .nav {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .nav a {
            color: #fff;
            text-decoration: none;
            padding: 0 10px;
        }

        .chat-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .chat-header {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .chat-messages {
            padding: 20px;
            overflow-y: auto;
            max-height: 300px;
        }

        .message {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-radius: 20px;
            margin-bottom: 10px;
            max-width: 70%;
            word-wrap: break-word;
        }

        .user-message {
            background-color: #dcf8c6;
            color: #000;
        }

        .message img,
        .message video,
        .message audio {
            max-width: 100%;
            border-radius: 10px;
        }

        .message.audio {
            background-color: #ffc107;
            color: #000;
            display: flex;
            align-items: center;
        }

        .message.audio audio {
            margin-right: 10px;
        }

        .input-box {
            padding: 15px;
            display: flex;
            align-items: center;
            background-color: #f9f9f9;
            border-top: 1px solid #ddd;
        }

        .input-box textarea {
            flex: 1;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ddd;
            outline: none;
            resize: none;
        }

        .input-box input[type="file"] {
            display: none;
        }

        .input-box label {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            margin-right: 10px;
        }

        .input-box label:hover {
            background-color: #0056b3;
        }

        .input-box label:active {
            background-color: #004080;
        }

        .input-box button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            outline: none;
        }

        .input-box button:hover {
            background-color: #0056b3;
        }

        .input-box button:active {
            background-color: #004080;
        }

        /* New styles for image container */
        .image-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .image-container img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>ChildSafe Chat</h1>
        <nav class="nav">
            <a href="index.php">Home</a>
            <a href="follow_up.php">FOllow up case</a>
            <a href="#">call</a>
        </nav>
    </header>
    
    <div class="image-container">
    <img src="images/childsafe.jpeg" alt="Image">
</div>


    <div class="chat-container">
        <div class="chat-header">Chat Room</div>
        <div class="chat-messages" id="chatMessages">
            <!-- Chat messages will be displayed here -->
        </div>
        <div class="image-container">
            <!-- Placeholder for image display -->
        </div>
        <div class="input-box">
            <textarea id="messageInput" placeholder="Type a message..."></textarea>
            <input type="file" id="mediaInput" accept="image/*, video/*, audio/*" capture="environment">
            <label for="mediaInput">+</label>
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script>
        const chatMessages = document.getElementById('chatMessages');
        const mediaInput = document.getElementById('mediaInput');
        const messageInput = document.getElementById('messageInput');

        function sendMessage() {
            const message = messageInput.value.trim();
            const file = mediaInput.files[0];

            // Create FormData object to send message and file data
            const formData = new FormData();
            formData.append('message', message);
            if (file) {
                formData.append('file', file);
            }

            // Send AJAX request to server-side script
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // If message sent successfully, display it in chat interface
                    displayMessage('You', message, file);
                    messageInput.value = '';
                    mediaInput.value = '';
                } else {
                    // If an error occurred, display an error message
                    console.error('Error while sending message:', xhr.responseText);
                }
            };
            xhr.send(formData);
        }

        function displayMessage(sender, message, file) {
            const messageContainer = document.createElement('div');
            messageContainer.className = 'message';
            if (sender === 'You') {
                messageContainer.classList.add('user-message');
            }
            if (message) {
                messageContainer.textContent = message;
            }
            if (file) {
                const mediaElement = document.createElement(getMediaType(file.type));
                mediaElement.src = URL.createObjectURL(file);
                mediaElement.controls = true;
                messageContainer.appendChild(mediaElement);
            }
            chatMessages.appendChild(messageContainer);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function getMediaType(type) {
            if (type.includes('image')) return 'img';
            if (type.includes('video')) return 'video';
            if (type.includes('audio')) return 'audio';
            return 'div';
        }
    </script>
</body>
</html>
``
