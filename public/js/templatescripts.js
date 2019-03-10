$(document).ready(function () {
    $('.w3ls_agile').textFx({
        type: 'fadeIn',
        iChar: 100,
        iAnim: 1000
    });
    $('.w3_text').textFx({
        type: 'fadeIn',
        iChar: 100,
        iAnim: 1000
    });
    $('#horizontalTab').easyResponsiveTabs({
        type: 'default', //Types: default, vertical, accordion
        width: 'auto', //auto or any width like 600px
        fit: true, // 100% fit in a container
        closed: 'accordion', // Start closed if in accordion view
        activate: function (event) { // Callback function if tab is switched
            var $tab = $(this);
            var $info = $('#tabInfo');
            var $name = $('span', $info);
            $name.text($tab.text());
            $info.show();
        }
    });
    $('#verticalTab').easyResponsiveTabs({
        type: 'vertical',
        width: 'auto',
        fit: true
    });
    $(".scroll").click(function (event) {
        event.preventDefault();

        $('html,body').animate({
            scrollTop: $(this.hash).offset().top
        }, 1000);
    });
    $().UItoTop({
        easingType: 'easeOutQuart'
    });

});
<!-- password-script -->
window.onload = function () {
    document.getElementById("password1").onchange = validatePassword;
    document.getElementById("password2").onchange = validatePassword;
}

function validatePassword() {
    var pass2 = document.getElementById("password2").value;
    var pass1 = document.getElementById("password1").value;
    if (pass1 != pass2)
        document.getElementById("password2").setCustomValidity("Passwords Don't Match");
    else
        document.getElementById("password2").setCustomValidity('');
    //empty string means no validation error
}
<!-- password-script -->