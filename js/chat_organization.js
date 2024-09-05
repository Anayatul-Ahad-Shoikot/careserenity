
const searchBar = document.querySelector(".search input"),
    searchlist = document.querySelector(".search-list"),
    chatArea = document.querySelector(".chat-area"),
    inboxlist = document.querySelector(".inbox-list");

searchBar.onkeyup = () => {
    let searchTerm = searchBar.value;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/BackEnd/chat_user_search_BE.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                searchlist.innerHTML = data;

                document.querySelectorAll('.search-list a').forEach(link => {
                    link.onclick = (e) => {
                        e.preventDefault();
                        const outId = link.getAttribute('data-out_id');
                        const inId = link.getAttribute('data-in_id');
                        loadChat(outId, inId);
                    }
                });
            }
        }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
};

const addClickListenersToInboxList = () => {
    inboxlist.querySelectorAll('a').forEach(link => {
        link.onclick = (e) => {
            e.preventDefault();
            const outId = link.getAttribute('data-out_id');
            const inId = link.getAttribute('data-in_id');
            loadChat(outId, inId);
        };
    });
};

function loadChat(outId, inId) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/BackEnd/fetch_chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                chatArea.innerHTML = xhr.response;
                initializeChatScripts();
            }
        }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("out_id=" + outId + "&in_id=" + inId);
}

function initializeChatScripts() {
    const form = document.querySelector(".typing-area"),
        incoming_id = form.querySelector(".incoming_id").value,
        inputField = form.querySelector(".input-field"),
        sendBtn = form.querySelector("button"),
        chatBox = document.querySelector(".chat-box");

    form.onsubmit = (e) => {
        e.preventDefault();
    };

    inputField.focus();
    inputField.onkeyup = () => {
        if (inputField.value != "") {
            sendBtn.classList.add("active");
        } else {
            sendBtn.classList.remove("active");
        }
    };

    sendBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/BackEnd/chat_insert.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    inputField.value = "";
                    scrollToBottom();
                }
            }
        };
        let formData = new FormData(form);
        xhr.send(formData);
    };

    chatBox.onmouseenter = () => {
        chatBox.classList.add("active");
    };

    chatBox.onmouseleave = () => {
        chatBox.classList.remove("active");
    };

    setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/BackEnd/chat_get.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                    if (!chatBox.classList.contains("active")) {
                        scrollToBottom();
                    }
                }
            }
        };
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("incoming_id=" + incoming_id);
    }, 500);

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
}
