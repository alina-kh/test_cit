window.addEventListener('DOMContentLoaded', function () {
    'use strict';

    //показываем или скрываем описание блока
    var btn = document.querySelectorAll('.btn_tog');
    var checkAbout = document.querySelectorAll('.check_about');

    for (var i = 0; i < btn.length; i++) {
        (function (i) {
            btn[i].addEventListener('click', function (e) {
                e.preventDefault();
                checkAbout[i].classList.toggle('active');
            });
        })(i)

    }
})
