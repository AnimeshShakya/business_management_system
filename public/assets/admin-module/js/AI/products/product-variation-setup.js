$(document).ready(function () {
    tinymce.init({
        selector: 'textarea.ckeditor',
        setup: function (editor) {
            // Keep textarea value in sync with TinyMCE
            editor.on('change keyup', function () {
                tinymce.triggerSave();
            });
        }
    });
})

$(document).on('click', '.variation_setup_auto_fill', function () {
    const $button = $(this);
    const lang = $button.data('lang');
    const route = $button.data('route');
    const name = $('#' + lang + '_name').val();
    const descriptionId = lang + '_description';
    const categoryId = $('#category-id').val()

    const $container = $('.general_wrapper').find('.outline-wrapper');

    $container.addClass('outline-animating');
    $container.find('.bg-animate').addClass('active');
    $button.prop('disabled', true);
    $button.find('.btn-text').text('');
    const $aiText = $button.find('.ai-text-animation');
    $aiText.removeClass('d-none').addClass('ai-text-animation-visible');

    const editor = tinymce.get(descriptionId);
    const description = editor ? editor.getContent() : '';

    console.log(name)
    console.log(description)
    console.log(categoryId)


    $.ajax({
        url: route,
        type: 'GET',
        dataType: 'json',
        data: {
            name: name,
            description: description,
            category_id: categoryId,
        },
        success: function (response) {
            console.log('Success:', response);

            if (response.flag === 1) {
                $('#new-variations-table').show();
                $('#variation-table').html(response.template);
            } else {
                toastr.info('AI did not generate variations.');
            }


        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            if (xhr.responseJSON && xhr.responseJSON.message) {
                toastr.error(xhr.responseJSON.message);
            } else {
                toastr.error('An unexpected error occurred.');
            }
        },
        complete: function () {
            setTimeout(function () {
                $container.removeClass('outline-animating');
                $container.find('.bg-animate').removeClass('active');
            }, 500);

            $button.prop('disabled', false);
            $button.find('.btn-text').text('Re-generate');
            $aiText.addClass('d-none').removeClass('ai-text-animation-visible');
            $(".actions a[href='#next']").removeClass("proceed-to-next");
        }
    });
});


