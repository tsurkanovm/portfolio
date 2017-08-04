(function ($) {
    $(document).ready(function () {
        var alertDiv = document.createElement("div");

        $('.js-remove-table-row').on('click', function (e) {
            e.preventDefault();
            var $el = $(this).closest('.js-table-row');
            $(this).find('.fa-close')
                .removeClass('glyphicon-remove')
                .addClass('fa-spinner')
                .addClass('fa-spin');

            $.ajax({
                url: $(this).data('url'),
                method: 'DELETE'
            }).done(
                function () {
                    $el.fadeOut();
                    $(alertDiv).fadeOut();
                }
            ).fail(
                function (jqXHR) {
                    //@todo msg not working, fixed
                    $(alertDiv).text = jqXHR.responseText;
                    $(alertDiv).addClass("alert alert-danger");
                    $(".container").prepend(alertDiv);
                }
            );
        });
    });
})($);
