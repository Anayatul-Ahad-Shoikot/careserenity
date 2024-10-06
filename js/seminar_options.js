function showForm(button) {
    const form = document.getElementById('seminarForm');
    const divs = document.querySelectorAll('.seminarBlock');
    if(form.style.display == 'block'){
        form.style.display = 'none';
        button.innerHTML = "Create Seminar";
        divs.forEach(div => {
            div.style.display = 'block';
        });
    } else {
        form.style.display = 'block';
        button.innerHTML = "Close Form";
        divs.forEach(div => {
            div.style.display = 'none';
        });
    }
}

function toggleLocatoinField() {
    const type = document.getElementById("type").value;
    const locationField = document.getElementById("locationField");
    if (type == "offline") {
        locationField.style.display = 'flex';
    } else {
        locationField.style.display = 'none';
    }
}

function removeSeminar(seminarId){
    if(confirm("Are you sure you want to remove this seminar?")){
        window.location.href = `./O_seminar_remove_BE.php?id=${seminarId}`;
    }
}

function toggleSeminarVisibilty(seminarId){
    window.location.href = `toggle_seminar_visibilty.php?id=${seminarId}`;
}


function isValidDate(day, month, year) {
    if (month < 1 || month > 12) return false;
    const daysInMonth = [31, (isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    return day > 0 && day <= daysInMonth[month - 1];
}
function isLeapYear(year) {
    return (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
}
