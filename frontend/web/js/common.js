$(document).ready(function () {
    $(document).on('click', 'a.change-language', actionChangeLanguage);
    $(document).on('click', '.animation_select', addAnimation);
    $(document).on('click', hideAnimation);
});


function actionChangeLanguage(e) {
    e.preventDefault();
    var language = $(this).data('lang');
    $.get('/site/set-language', {lang: language});
}

function addAnimation(e) {
    e.preventDefault();
    $('.animation-box-about').attr('class', 'animated animation-box-about hide');
    var animationBox = $(this).siblings('.animation-box-about');
    if (animationBox.is(':hidden')) {
        animationBox.removeAttr('class').attr('class', '');
        var animation = $(this).attr("data-animation");
        animationBox.addClass('animated animation-box-about');
        animationBox.addClass(animation);
        return false;
    }
}

function hideAnimation(event) {
    var animationBox = $('.animation-box-about');
    if (!$(event.target).closest('.animation-box-about').length) {
        animationBox.removeAttr('class').attr('class', '');
        animationBox.addClass('animated hidden animation-box-about');
    }
}