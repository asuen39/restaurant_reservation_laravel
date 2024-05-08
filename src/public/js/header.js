$(function () {
    $(".header__openbtn").click(function () {
        $(this).toggleClass('active');
        $('.header__inner').toggleClass('active');
        $('body').toggleClass('active');

        //class取得
        if ($('.nav_global').hasClass('is_close')) {
            console.log('is_close クラスが存在します。');
            $('.nav_global').toggleClass('is_close is_open');

        } else {
            console.log('is_close クラスが存在しません。');
            $('.nav_global').toggleClass('is_open is_close');
        }

    });
});