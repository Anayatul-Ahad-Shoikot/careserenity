var box = document.getElementById('box');
var show = false;
function toggleNotifi() {
    if (show) {
        box.style.display = 'none';
        show = false;
    } else {
        box.style.display = 'block';
        show = true;
    }
}

function markAsRead(notificationId, element) {
    if (element.classList.contains('unseen')) {
        element.style.background = 'white';
    }
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            location.reload();
        }
    };
    xhr.open("GET", "/BackEnd/notification_update_BE.php?id=" + notificationId, true);
    xhr.send();
}