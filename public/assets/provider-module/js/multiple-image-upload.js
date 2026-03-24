$(document).ready(function () {
    function checkNavOverflow($picker) {
        try {
            let $btnNext = $picker.find(".imageSlide_next");
            let $btnPrev = $picker.find(".imageSlide_prev");
            let isRTL = $("html").attr("dir") === "rtl";
            let el = $picker[0];

            let scrollLeft = el.scrollLeft;
            let scrollWidth = el.scrollWidth;
            let clientWidth = el.clientWidth;

            // Normalize scrollLeft in RTL mode
            let normalizedScrollLeft = isRTL
                ? Math.abs(scrollWidth - clientWidth - scrollLeft)
                : scrollLeft;

            let maxScroll = scrollWidth - clientWidth;

            let showNext = normalizedScrollLeft < maxScroll - 1;
            let showPrev = normalizedScrollLeft > 1;

            $btnNext.toggle(showNext);
            $btnPrev.toggle(showPrev);
        } catch (error) {
            console.error("Error checking nav overflow:", error);
        }
    }

    $(".multi_image_picker").each(function () {
        let $picker = $(this);
        let ratio = $picker.data("ratio");
        let fieldName = $picker.data("field-name");
        let maxCount = $picker.data("max-count") || Infinity;

        $picker.spartanMultiImagePicker({
            fieldName: fieldName,
            maxCount: maxCount,
            rowHeight: "100px",
            groupClassName: "",
            maxFileSize: "2048",
            allowedExt: "webp|jpg|jpeg|png|gif",
            dropFileLabel: `<div class="drop-label text-center">
                                <i class="fi fi-sr-camera text-primary"></i>
                                <div class="mt-1 fs-10">
                                    Add images
                                </div>
                            </div>`,
            placeholderImage: {
                image: '',
                // image: placeholderImageUrl,
                // width: "30px",
                // height: "30px",
            },
            onAddRow: function (index) {
                checkNavOverflow($picker);
                setAspectRatio($picker, ratio);
            },
            onRemoveRow: function (index) {
                checkNavOverflow($picker);
                setAspectRatio($picker, ratio);
            },
        });

        function setAspectRatio($picker, ratio) {
            if (ratio) {
                $picker.find(".file_upload").css("aspect-ratio", ratio);
            }
        }

        // Remove any previous handlers to avoid duplication
        $picker.find(".imageSlide_next").off("click").on("click", function () {
            let scrollWidth = $picker.find(".spartan_item_wrapper").outerWidth(true);
            let isRTL = $("html").attr("dir") === "rtl";

            $picker.animate(
                { scrollLeft: $picker.scrollLeft() + (isRTL ? -scrollWidth : scrollWidth) },
                300,
                function () {
                    checkNavOverflow($picker);
                }
            );
        });

        $picker.find(".imageSlide_prev").off("click").on("click", function () {
            let scrollWidth = $picker.find(".spartan_item_wrapper").outerWidth(true);
            let isRTL = $("html").attr("dir") === "rtl";

            $picker.animate(
                { scrollLeft: $picker.scrollLeft() + (isRTL ? scrollWidth : -scrollWidth) },
                300,
                function () {
                    checkNavOverflow($picker);
                }
            );
        });
    });

    let resizeTimeout;
    $(window).on("resize", function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function () {
            $(".multi_image_picker").each(function () {
                checkNavOverflow($(this));
            });
        }, 200);
    });

    $(".multi_image_picker").on("scroll", function () {
        checkNavOverflow($(this));
    });
});
