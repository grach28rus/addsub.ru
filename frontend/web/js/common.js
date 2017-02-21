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
    var animationBoxNav = $(this).siblings('.animation-box-nav');
    var animation = $(this).attr("data-animation");
    if (animationBox.length > 0 && animationBox.is(':hidden')) {
        animationBox.removeAttr('class').attr('class', '');
        animationBox.addClass('animated animation-box-about');
        animationBox.addClass(animation);
        return false;
    }
    if (animationBoxNav.length > 0 && animationBoxNav.is(':hidden')) {
        animationBoxNav.removeAttr('class').attr('class', '');
        animationBoxNav.addClass('animated animation-box-nav');
        animationBoxNav.addClass(animation);
        return false;
    }
}

function hideAnimation(event) {
    var animationBox = $('.animation-box-about');
    var animationBoxNav = $('.animation-box-nav');
    if (!$(event.target).closest('.animation-box-about').length) {
        animationBox.removeAttr('class').attr('class', '');
        animationBox.addClass('animated hidden animation-box-about');
    }
    if (!$(event.target).closest('.animation-box-nav').length) {
        animationBoxNav.removeAttr('class').attr('class', '');
        animationBoxNav.addClass('animated hidden animation-box-nav');
    }
}