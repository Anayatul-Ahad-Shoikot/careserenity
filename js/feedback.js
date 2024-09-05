document.addEventListener("DOMContentLoaded", function () {
    const alerts = document.querySelectorAll(".feedback > div");
    alerts.forEach(function (alert) {
        setTimeout(function () {
            alert.style.opacity = "1";
            setTimeout(function () {
                alert.style.opacity = "0";
                setTimeout(function () {
                    alert.style.display = "none";
                }, 500);
            }, 6000);
        }, 600);
    });
});
