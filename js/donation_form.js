function togglePopup() {
    const popup = document.getElementById("popupForm");
    popup.style.display = popup.style.display === "block" ? "none" : "block";
}

document.querySelector('section').querySelectorAll('a[id^="button-30"]').forEach(button => {
    if (button.classList.contains('fund')) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            togglePopup();
        });
    }
});

const creditCardInputs = document.getElementById("creditCardInputs");
const bkashInputs = document.getElementById("bkashInputs");
const bkashRadio = document.getElementById("bc2");
const creditCardRadio = document.getElementById("bc1");

function handlePaymentMethodChange() {
    if (bkashRadio.checked) {
        creditCardInputs.style.display = "none";
        bkashInputs.style.display = "block";
        document.getElementsByName("bkash_no")[0].setAttribute("required", "required");
        document.getElementsByName("Bkash_trans")[0].setAttribute("required", "required");
        document.getElementsByName("card_no")[0].removeAttribute("required");
        document.getElementsByName("card_cvc")[0].removeAttribute("required");
        document.getElementsByName("card_exp_month")[0].removeAttribute("required");
        document.getElementsByName("card_exp_year")[0].removeAttribute("required");
    } else if (creditCardRadio.checked) {
        creditCardInputs.style.display = "block";
        bkashInputs.style.display = "none";
        document.getElementsByName("card_no")[0].setAttribute("required", "required");
        document.getElementsByName("card_cvc")[0].setAttribute("required", "required");
        document.getElementsByName("card_exp_month")[0].setAttribute("required", "required");
        document.getElementsByName("card_exp_year")[0].setAttribute("required", "required");
        document.getElementsByName("bkash_no")[0].removeAttribute("required");
        document.getElementsByName("Bkash_trans")[0].removeAttribute("required");
    }
}

const paymentRadios = document.querySelectorAll('input[name="pay"]');
paymentRadios.forEach((radio) => {
    radio.addEventListener("change", handlePaymentMethodChange);
});
handlePaymentMethodChange();