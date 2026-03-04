$(document).ready(function () {
    const $select = $('.select2');

    $select.select2({
        placeholder: 'Select Categories'
    });

    // IMPORTANT: sync selected values for edit form
    $select.trigger('change');

    var input = document.querySelector('#tags');

    var tagify = new Tagify(input, {
        enforceWhitelist: false,
        tagTextProp: 'name', // display name instead of value
        dropdown: {
            enabled: 2,
            maxItems: 5
        }
    });

    tagify.on('input', function (e) {

        var query = e.detail.value;

        if (query.length < 2) return;

        $.ajax({
            url: searchTagsRoute,
            method: "GET",
            data: { q: query },
            success: function (response) {
                let data = response.data;
                tagify.settings.whitelist = data.map(function (tag) {
                    return {
                        value: tag.name, // Tagify uses this for filtering & display
                        id: tag.id
                    };
                });

                tagify.dropdown.show(query);
            }
        });
    });
});
