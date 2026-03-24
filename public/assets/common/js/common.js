(function ($) {
    ("use strict");

    $(document).ready(function () {
        // When Select2 opens
        $(document).on('select2:open', function () {
            $('.down-icon').addClass('active');
        });

        // When Select2 closes
        $(document).on('select2:close', function () {
            $('.down-icon').removeClass('active');
        });
    });
    


    // --- Fixed Action Button ---
    let isFixed = false;

    function checkContentHeight() {
        let windowHeight = $(window).height();
        let contentHeight = $(document).height();
        let scrollPosition = $(window).scrollTop();
        let $actionWrapper = $(".action-btn-wrapper");
        let $parent = $actionWrapper.parent();

        setTimeout(() => {
            if (contentHeight > windowHeight) {
                if (!isFixed) {
                    $parent.addClass("fixed-bottom");
                    $actionWrapper.addClass("fixed");
                    isFixed = true;
                }

                if (scrollPosition + windowHeight >= contentHeight - 100) {
                    if (isFixed) {
                        $actionWrapper.removeClass("fixed");
                        $parent.removeClass("fixed-bottom");
                        isFixed = false;
                    }
                }
            } else {
                if (isFixed) {
                    $actionWrapper.removeClass("fixed");
                    $parent.removeClass("fixed-bottom");
                    isFixed = false;
                }
            }
        }, 500);
    }

    checkContentHeight();

    $(window).on("resize scroll", function() {
        checkContentHeight();
    });

    // --- Easy setup guide
    $(document).ready(function () {
        $('.view-guideline-btn').on('click', function () {
            $('.easy-setup-dropdown').addClass('show');
            $(this).removeClass('show'); 
        });

        $('.easy-setup-dropdown_close').on('click', function () {
            $('.easy-setup-dropdown').removeClass('show');
            $('.view-guideline-btn').addClass('show'); 
        });
    });
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.easy-setup-dropdown, .view-guideline-btn').length) {
            $('.easy-setup-dropdown').removeClass('show');
            $('.view-guideline-btn').addClass('show'); 
        }
    });


})(jQuery);


