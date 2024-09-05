const searchBar = document.querySelector(".search input"),
usersList = document.querySelector(".users-list");

searchBar.onkeyup = () => {
    let searchTerm = searchBar.value;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/BackEnd/chat_user_search_BE.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
};
