/**
 * Sidebar menu toggle on click
 */
$(document).on('click', '#left-sidebar-menu .modtitle>a', function (data) {
    var closestli = $(this).closest('li');
    if (!closestli.hasClass('active')) {
        $('[data-parent="' + closestli.attr('data-toggle') + '"]').toggleClass('hidden');
    }
    return false;
});

/**
 * Modal window
 */
$(document).on('click', '[data-action="modal"]', function (data) {
    var modalID = '#modal-box';

    $(modalID + ' .modal-title').html($(this).data('title'));
    $(modalID + ' .modal-body').html($(this).data('body'));

    $(modalID + ' form').attr('action', $(this).attr('href'));

    $(modalID).modal('show');

    return false;
});


$(document).ready(function () {
    $(document).on('click', '.variant1_pict .kv-file-remove', function (data) {
        location.href="?r=business/img/update&id="+$(".business-pictured-form").attr("id")+"&source=picturedsearch&section=im1";
        return false;
    });
    $(document).on('click', '.variant2_pict .kv-file-remove', function (data) {
        location.href="?r=business/img/update&id="+$(".business-pictured-form").attr("id")+"&source=picturedsearch&section=im2";
        return false;
    });
    $(document).on('click', '.variant3_pict .kv-file-remove', function (data) {
        location.href="?r=business/img/update&id="+$(".business-pictured-form").attr("id")+"&source=picturedsearch&section=im3";
        return false;
    });
    $(document).on('click', '.business-variants-question-update .kv-file-remove', function (data) {
        location.href="?r=business/img/update&id="+$(".business-variants-question-update").attr("id")+"&source=vquest&section=";
        return false;
    });
});


/*
$(".delete-button").on("click",function(e){
    e.preventDefault();
    var modelId = $(this).data('id');
    // Run bootbox.alert() here!!
    // Based on the bootbox result, you can decide to fire the initial event again:
    // $(this).unbind('submit').submit()
});
*/