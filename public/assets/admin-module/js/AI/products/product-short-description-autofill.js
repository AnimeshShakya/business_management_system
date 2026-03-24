$(document).on('click', '.auto_fill_short_description', function () {

    const $button = $(this);
    const lang = $button.data('lang');
    const route = $button.data('route');
    const itemData = $button.data('item') || {};
    const existingShortDescription = itemData.short_description ?? "";

    const $container = $button.closest('.lang-form2');
    const $shortDescription = $container.find('.' + lang + '_short_description');
    const previousValue = $shortDescription.val();
    const name = $('#' + lang + '_name').val() || '';

    $shortDescription.closest('.outline-wrapper').addClass('outline-animating');

    $button.prop('disabled', true);
    $button.find('.btn-text').text('');
    const $aiText = $button.find('.ai-text-animation');
    $aiText.removeClass('d-none').addClass('ai-text-animation-visible');

    const modifiedLang = lang === 'default' ? 'en' : lang;

    $.ajax({
        url: route,
        type: 'GET',
        dataType: 'json',
        data: {
            name: name,
            langCode: modifiedLang
        },
        success: function (response) {
            const plainText = $('<div>').html(response.data).text();
            if (lang === 'default') {
                $('.default_short_description').val(plainText);
                $('.en_short_description').val(plainText);
            } else {
                $('.' + lang + '_short_description').val(plainText);
            }
            if ($button.data('next-action')?.toString() === 'generate-long-description') {
                scrollServiceDescriptionWrapperElement(200);

            }
        },
        error: function (xhr, status, error) {
            $shortDescription.val(existingShortDescription || previousValue);

            if (xhr.responseJSON && xhr.responseJSON.errors) {
                Object.values(xhr.responseJSON.errors).forEach(fieldErrors => {
                    fieldErrors.forEach(errorMessage => {
                        toastr.error(errorMessage);
                    });
                });
            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                toastr.error(xhr.responseJSON.message);
            } else {
                toastr.error('An unexpected error occurred.');
            }
        },
        complete: function () {

            if ($button.data('next-action')?.toString() === 'generate-long-description') {
                setTimeout(function () {
                    const target = document.querySelector('.auto_fill_description[data-lang="' + lang + '"]');
                    if (target) {
                        target.setAttribute('data-next-action', 'generate-general-setup');
                        target.click();
                    }
                }, 2000);
            }


            const target = document.querySelector('.auto_fill_short_description[data-lang="' + lang + '"]');
            if (target && target.hasAttribute('data-next-action')) {
                target.removeAttribute('data-next-action');
            }
            setTimeout(() => {
                $shortDescription.closest('.outline-wrapper').removeClass('outline-animating');
            }, 500);
            $button.prop('disabled', false);
            $button.find('.btn-text').text('Re-generate');
            $aiText.addClass('d-none').removeClass('ai-text-animation-visible');

        }
    });
});
