function sendMessage() {
    const message = document.getElementById('message').value;
    fetch('send_msg.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'message=' + message
    }).then(response => response.text())
      .then(data => {
          document.getElementById('chat-box').innerHTML += '<div>You: ' + message + '</div>';
          document.getElementById('message').value = '';
      });
}

function loadMessages() {
    fetch('receive_msg.php')
        .then(response => response.text())
        .then(data => document.getElementById('chat-box').innerHTML = data);
}

setInterval(loadMessages, 2000); // Refresh messages every 2 seconds