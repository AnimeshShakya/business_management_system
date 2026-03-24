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
$(document).on('click', '.auto_fill_description', function () {
    const $button = $(this);
    const lang = $button.data('lang');             // e.g. "en", "fr"
    const route = $button.data('route');
    const name = $('#' + lang + '_name').val();    // product name field
    const descriptionId = lang + '_description';   // matches textarea ID
    const itemData = $button.data('item') || {};
    const existingDescription = itemData.description ?? '';
    const $imageRemoveButton = $("#removeImageBtn")
    const $chooseImageBtn = $("#chooseImageBtn")

    const $container = $button.closest('.lang-form2');
    const $default_description = $container.find('.' + lang + '_description');

    $default_description.closest('.outline-wrapper').addClass('outline-animating');

    $button.prop('disabled', true);
    const $btnText = $button.find('.btn-text');
    const $aiText = $button.find('.ai-text-animation');
    $btnText.text('');
    $aiText.removeClass('d-none').addClass('ai-text-animation-visible');
    const editor = tinymce.get(descriptionId);
    const modifiedLang = lang == 'default' ? 'en' : lang;

    $.ajax({
        url: route,
        type: 'GET',
        dataType: 'json',
        data: { name: name, langCode: modifiedLang },
        success: function (response) {
            const enEditor = tinymce.get('en_description')

            if (editor) {
                editor.setContent(response.data);
                enEditor.setContent(response.data);
                if (lang == 'default'){
                    $('.' + descriptionId).val(response.data);
                    $('.en_description').val(response.data);
                }else{
                    $('.' + descriptionId).val(response.data);
                }
            }
            if ($button.data('next-action')?.toString() === 'generate-general-setup') {
                // $('html, body').animate({
                //     // scrollTop: $('.en_description').offset().top - 200
                //     scrollTop: $('.service-description-wrapper').offset().top - 240
                // }, 800);
                // console.log("long description", 100);
                // console.log("long description offset ", $('.service-description-wrapper').offset().top - 240);

                scrollServiceDescriptionWrapperElement(300);
                console.log(3)
            }

        },
        error: function (xhr) {
            editor.setContent(existingDescription);
            $('.' + descriptionId).val(existingDescription);
            if (xhr.responseJSON && xhr.responseJSON.message) {
                toastr.error(xhr.responseJSON.message);
            } else {
                toastr.error('An unexpected error occurred.');
            }
        },
        complete: function () {
            if ($button.data('next-action')?.toString() === 'generate-general-setup') {
                setTimeout(function (){
                    const target = document.querySelector('.general_setup_auto_fill[data-lang="' + lang + '"]');
                    if (target) {
                        target.click();
                    }
                },1000);
                setTimeout(function () {
                    $imageRemoveButton.prop('disabled', false);
                    $chooseImageBtn.prop('disabled', false);
                    $button.prop('disabled', false);
                    $button.find('.btn-text').text('Generate Service Description');
                    $button.find('.ai-btn-animation').addClass('d-none');
                    $button.find('i').removeClass('d-none');
                    const modalEl = document.getElementById('aiAssistantModal');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                }, 4000);
            }


            const target = document.querySelector('.auto_fill_description[data-lang="' + lang + '"]');
            if (target && target.hasAttribute('data-next-action')) {
                target.removeAttribute('data-next-action');
            }
            $button.prop('disabled', false);
            $btnText.text('Re-generate');
            $aiText.addClass('d-none').removeClass('ai-text-animation-visible');
            $default_description.closest('.outline-wrapper').removeClass('outline-animating');
        }
    });
});
