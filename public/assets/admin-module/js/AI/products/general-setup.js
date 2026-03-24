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
});

$(document).on('click', '.general_setup_auto_fill', function () {
    const $button = $(this);
    const lang = $button.data('lang');
    const route = $button.data('route');
    const name = $('#' + lang + '_name').val();
    const descriptionId = lang + '_description';
    const $container = $('.general_wrapper').find('.outline-wrapper');

    $container.addClass('outline-animating');
    $container.find('.bg-animate').addClass('active');
    $button.prop('disabled', true);
    $button.find('.btn-text').text('');
    const $aiText = $button.find('.ai-text-animation');
    $aiText.removeClass('d-none').addClass('ai-text-animation-visible');

    const editor = tinymce.get(descriptionId);
    if (editor) {
        editor.save();
    }
    const description = editor ? editor.getContent() : '';

    $.ajax({
        url: route,
        type: 'GET',
        dataType: 'json',
        data: {
            name: name,
            description: description,
        },
        success: function (response) {
            console.log(response)
            const data = response.data || {};

            if (data.category_id) {
                $('#category-id').val(data.category_id).trigger('change');
                if (data.sub_category_id) {
                    setTimeout(() => {
                        $('#sub-category-id')
                            .val(data.sub_category_id)
                            .trigger('change');
                    }, 2000);
                }
            }
            if (typeof data.tax_percentage !== 'undefined') {
                $('input[name="tax"]').val(data.tax_percentage);
            }

            if (typeof data.minimum_bidding_price !== 'undefined') {
                $('input[name="min_bidding_price"]').val(data.minimum_bidding_price);
            }

            if (data.search_tags && Array.isArray(data.search_tags)) {
                var $tagsInput = $('[name="tags"]');
                $tagsInput.tagsinput('removeAll');
                data.search_tags.forEach(function(tag) {
                    $tagsInput.tagsinput('add', tag);
                });
            }
        },
        error: function (xhr, status, error) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                Object.values(xhr.responseJSON.errors).forEach(errorArray => {
                    errorArray.forEach(errorMsg => {
                        toastr.error(errorMsg);
                    });
                });
            }else if(xhr.responseJSON.message) {
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
        }
    });
});
