document.addEventListener('DOMContentLoaded', function() {
    fetchChatList();
    const urlParams = new URLSearchParams(window.location.search);
    const chatWith = urlParams.get('in_id');
    if (chatWith) {
        loadMessages(chatWith);
        setActiveChat(chatWith);
    }

    document.getElementById('sendButton').addEventListener('click', function() {
        sendMessage();
    });
});

function fetchChatList() {
    fetch('fetch_chat_list.php')
        .then(response => response.json())
        .then(users => {
            const chatList = document.querySelector('.chat-list');
            chatList.innerHTML = '';
            users.forEach(user => {
                const userDiv = document.createElement('div');
                userDiv.className = 'user';
                userDiv.textContent = user.acc_name;
                userDiv.dataset.userId = user.chat_user_id;
                userDiv.addEventListener('click', function() {
                    loadMessages(user.chat_user_id);
                    setActiveChat(user.chat_user_id);
                });
                chatList.appendChild(userDiv);
            });
        });
}

function loadMessages(userId) {
    fetch('fetch_messages.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'chat_with=' + userId
    })
    .then(response => response.json())
    .then(messages => {
        const chatArea = document.querySelector('.chat-area');
        chatArea.innerHTML = '';
        messages.forEach(message => {
            const msgDiv = document.createElement('div');
            msgDiv.className = message.outgoing_msg_id == userId ? 'outgoing' : 'incoming';
            msgDiv.textContent = message.msg;
            chatArea.appendChild(msgDiv);
        });
    });
}

function sendMessage() {
    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value;
    const chatWith = document.querySelector('.chat-list .user.active')?.dataset.userId;

    if (!message || !chatWith) {
        return;
    }

    fetch('send_message.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'chat_with=' + chatWith + '&msg=' + message
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            messageInput.value = '';
            loadMessages(chatWith);
        } else {
            console.error(data.message);
        }
    });
}

function setActiveChat(userId) {
    document.querySelectorAll('.chat-list .user').forEach(user => {
        user.classList.remove('active');
    });
    document.querySelector(`.chat-list .user[data-user-id="${userId}"]`).classList.add('active');
}
