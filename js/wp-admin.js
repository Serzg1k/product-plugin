jQuery(document).ready(function ($) {
    $('.status-store').click(function () {
        var id = $(this).attr('id');
        $.ajax({
            method: "POST",
            data: {
                action: 'plugin_ajax_func',
                checkId: id,
            },
            url: ajaxurl,
        });
    })
});