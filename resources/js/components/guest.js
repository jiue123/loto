$(document).on('click', '.guest-container table tr td', (e) => {
    const $target = $(e.target);

    if ($target.hasClass('bg-danger')) {
        $target.removeClass('bg-danger');
    } else {
        $target.addClass('bg-danger');
    }
});
