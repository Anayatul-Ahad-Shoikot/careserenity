$(document).ready(function() {
    $('#check-account').click(function() {
        var email = $('#acc_email').val();
        var name = $('#acc_name').val();
        $.ajax({
            type: 'POST',
            url: '/BackEnd/forgetpass_BE.php',
            data: { action: 'check_account', acc_email: email, acc_name: name },
            success: function(response) {
                if (response.includes('Account found')) {
                    slideToNext();
                } else {
                    alert('Account not found.');
                }
            }
        });
    });

    $('#check-answer').click(function() {
        var email = $('#acc_email').val();
        var question = $('#security_question').val();
        var answer = $('#security_answer').val();
        $.ajax({
            type: 'POST',
            url: '/BackEnd/forgetpass_BE.php',
            data: { action: 'check_answer', acc_email: email, security_question: question, security_answer: answer },
            success: function(response) {
                if (response.includes('Answer correct')) {
                    $('#acc_email_hidden').val(email);
                    slideToNext();
                } else {
                    alert('Incorrect answer.');
                }
            }
        });
    });

    function slideToNext() {
        var currentSlide = $('.slide:not(.hidden)').first();
        currentSlide.addClass('hidden');
        currentSlide.next('.slide').removeClass('hidden');
        var slideIndex = currentSlide.index();
        $('#form-container').css('transform', 'translateX(-' + (slideIndex + 1) * (-2.5) + '%)');
    }
});