$(document).ready(function () {
    const $select = $('.select2');

    $select.select2({
        placeholder: 'Select Role'
    });

    // IMPORTANT: sync selected values for edit form
    $select.trigger('change');
});
