import AOS from 'aos';

jQuery(document).ready(function ($) {
    "use strict";

    AOS.init();

    // Generic helper function to allow for data-links to open menus/popups
    $('[data-link]').on('click', function (e) {
        e.preventDefault();
        var did = $(this).data('link');
        $('div' + did).toggleClass('is-active');
    });

});
