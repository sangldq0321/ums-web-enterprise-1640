$(function () {
    var path = window.location.href;
    $('body header nav a.nav-link').each(function () {
        if (this.href === path) {
            $(this).addClass('active fw-bold');
        }
    });
});
$(function () {
    $('a').click(function (e) {
        var targetHref = $(this).prop('href');
        var currentHref = window.location.href;
        if (targetHref == currentHref) {
            e.preventDefault();
        }
    })
});
let topButton = document.getElementById("topBtn");
window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        topButton.style.display = "block";
    } else {
        topButton.style.display = "none";
    }
}
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
$('input').attr('autocomplete', 'off')
