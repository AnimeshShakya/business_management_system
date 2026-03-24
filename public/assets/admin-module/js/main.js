/*---------------------------------------------
	Template name:  6amtechAdmin
	Version:        1.0
	Author:         6amtech
	Author url:     https://6amtech.com/

NOTE:
------
Please DO NOT EDIT THIS JS, you may need to use "custom.js" file for writing your custom js.
We may release future updates so it will overwrite this file. it's better and safer to use "custom.js".

[Table of Content]

    01: Main Menu
    02: Toggle Search
    03: Background Image
    04: togglePassword
    05: Preloader
    06: currentYear
    07: Perfect Scrollbar
    08: Dark, Light & RTL Switcher
    09: Settings Toggle
    10: trigger live toaster
    11: File Upload
    12: Filter Aside Toggle
    13: Edit Button Trigger Upload file
    14: Reset Button Trigger Upload file
    15: Enable tooltips
    16: Changing svg color
    17: Table Row Multi Select
    18: Collapse
----------------------------------------------*/

(function ($) {
    "use strict";

    /*===================
  01: Main Menu
  =====================*/
    /* Parent li add class */
    var body = $("body");
    $(".aside .aside-body")
        .find("ul li")
        .parents(".aside-body ul li")
        .addClass("has-sub-item");

    /* Submenu Opened */
    $(".aside .aside-body")
        .find(".has-sub-item > a")
        .on("click", function (event) {
            event.preventDefault();
            if (
                !body.hasClass("aside-folded") ||
                body.hasClass("open-aside-folded")
            ) {
                $(this).parent(".has-sub-item").toggleClass("sub-menu-opened");
                if ($(this).siblings("ul").hasClass("open")) {
                    $(this).siblings("ul").removeClass("open").slideUp("200");
                } else {
                    $(this).siblings("ul").addClass("open").slideDown("200");
                }
            }
        });

    /* Active Menu Open */
    $(window).on("load", function () {
        $(".aside .aside-body")
            .find(".sub-menu-opened a")
            .siblings("ul")
            .addClass("open")
            .show();
    });

    /* window resize trigger aide function */
    $(window).resize(function () {
        aside();
    });

    /* Aside function */
    function aside() {

        // Remove old events before re-binding
        $(".aside .aside-body").off("mouseenter mouseleave");
        $(".aside-toggle, .offcanvas-overlay").off("click");

        if ($(window).width() > 1199) {
            /* Remove siderbar-open */
            if (body.is(".aside-open")) {
                body.removeClass("aside-open");
            }

            /* Holded Aside on Mouseenter */
            $(".aside .aside-body").on("mouseenter", function () {
                body.addClass("open-aside-folded");
            });

            /* Holded aside on Mouseleave */
            $(".aside .aside-body").on("mouseleave", function () {
                body.removeClass("open-aside-folded");
                if (body.hasClass("aside-folded")) {
                    $(".aside")
                        .find(".aside-body .has-sub-item a")
                        .siblings("ul")
                        .removeClass("open")
                        .slideUp(0);
                }
            });

            /* Holded aside */
            $(".aside-toggle").on("click", function () {
                body.toggleClass("aside-folded");
                body.find(".aside-body .has-sub-item a")
                    .siblings("ul")
                    .removeClass("open")
                    .slideUp("fast");
            });
        } else {
            /* Remove aside-folded & open-aside-folded */
            if (body.is(".aside-folded, .open-aside-folded")) {
                body.removeClass("aside-folded open-aside-folded");
            }
            /* Open Aside */
            $(".aside-toggle, .offcanvas-overlay").on("click", function () {
                body.toggleClass("aside-open");
                $(".offcanvas-overlay").toggleClass("aside-active");
            });
        }
    }
    aside();

    // Re-run on resize (with debounce for performance)
    let resizeTimer;
    $(window).on("resize", function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(aside, 200);
    });

    /*========================
  02: Toggle Search
  ==========================*/
    $(".toggle-search-btn").on("click", function () {
        $(this).siblings(".search-form").toggleClass("active");
    });

    /*========================
  03: Background Image
  ==========================*/
    var $bgImg = $("[data-bg-img]");
    $bgImg
        .css("background-image", function () {
            return 'url("' + $(this).data("bg-img") + '")';
        })
        .removeAttr("data-bg-img")
        .addClass("bg-img");

    /*==================================
  04: togglePassword
  ====================================*/
    $(document).ready(function () {
        $(".togglePassword").on("click", function (e) {
            const password = $(this).siblings(".form-control");
            password.attr("type") === "password"
                ? $(this).html("visibility")
                : $(this).html("visibility_off");
            const type =
                password.attr("type") === "password" ? "text" : "password";
            password.attr("type", type);
        });
    });

    /*==================================
  05: Preloader
  ====================================*/
    $(window).on("load", function () {
        $(".preloader").fadeOut(200);
    });

    /*==================================
  06: currentYear
  ====================================*/
    var currentYear = new Date().getFullYear();
    $(".currentYear").html(currentYear);

    /*============================================
  07: Perfect Scrollbar
  ==============================================*/
    var $scrollBar = $('[data-trigger="scrollbar"]');
    if ($scrollBar.length) {
        $scrollBar.each(function () {
            var $ps, $pos;

            $ps = new PerfectScrollbar(this);

            $pos = localStorage.getItem("ps." + this.classList[0]);

            if ($pos !== null) {
                $ps.element.scrollTop = $pos;
            }
        });

        $scrollBar.on("ps-scroll-y", function () {
            localStorage.setItem("ps." + this.classList[0], this.scrollTop);
        });
    }

    /*============================================
  08: Dark, Light & RTL Switcher
  ==============================================*/
    $(document).ready(function () {
        const savedTheme = localStorage.getItem("theme") || "light";
        $("body").attr("data-bs-theme", savedTheme);
        $(".setting-box.light-mode, .setting-box.dark-mode").removeClass("active");
        $(`.setting-box.${savedTheme}-mode`).addClass("active");
    });

    function themeSwitcher(className, themeName) {
        $(className).on("click", function () {
            $(".setting-box.light-mode, .setting-box.dark-mode").removeClass("active");
            $(this).addClass("active");
            $("body").attr("data-bs-theme", themeName);
            localStorage.setItem("theme", themeName);
        });
    }
    themeSwitcher(".setting-box.light-mode", "light");
    themeSwitcher(".setting-box.dark-mode", "dark");

    function rtlSwitcher(className, dirName) {
        $(className).on("click", function () {
            $(".setting-box").removeClass("active");
            $(this).addClass("active");
            $("html").attr("dir", dirName);
            localStorage.setItem("dir", dirName);
        });
    }
    rtlSwitcher(".setting-box.ltr-mode", "ltr");
    rtlSwitcher(".setting-box.rtl-mode", "rtl");

    // $('body').attr('theme', localStorage.getItem("theme"));
    // $('html').attr('dir', localStorage.getItem("dir"));

    /*============================================
  09: Settings Toggle
  ==============================================*/
    $(document).ready(function () {
        $(document).on("click", ".settings-toggle-icon", function (e) {
            e.stopPropagation();
            $(".settings-sidebar").toggleClass("active");
        });
        $(document).on("click", "body", function (e) {
            if (!$(e.target).is(".settings-sidebar, .settings-sidebar *"))
                $(".settings-sidebar").removeClass("active");
        });
    });

    /*============================================
  10: trigger live toaster
  ==============================================*/
    const toastTrigger = document.getElementById("liveToastBtn");
    const toastLiveExample = document.getElementById("liveToast");
    if (toastTrigger) {
        toastTrigger.addEventListener("click", () => {
            const toast = new bootstrap.Toast(toastLiveExample);

            toast.show();
        });
    }

    /*============================================
  11: File Upload
  ==============================================*/
    $(document).ready(function () {
        if ($(".upload-file").length) {
            initFileUpload();
            checkPreExistingImages();
        }
    });

    function initFileUpload() {
        $(document).on("change", ".single_file_input", function (e) {
            handleFileChange($(this), e.target.files[0]);
        });

        $(document).on("click", ".remove_btn", function () {
            resetFileUpload($(this).closest(".upload-file"));
        });

        $(document).on("click", ".edit_btn", function (e) {
            e.stopImmediatePropagation();
            let $card = $(this).closest(".upload-file");

            $card.removeClass("input-disabled");
            let $input = $card.find(".single_file_input");
            $input.trigger("click");
        });

        $(document).on("click", "button[type=reset]", function () {
            $(this)
                .closest("form")
                .find(".upload-file")
                .each(function () {
                    resetFileUpload($(this));
                });
        });
    }

    function checkPreExistingImages() {
        $(".upload-file").each(function () {
            var $card = $(this);
            var $textbox = $card.find(".upload-file-textbox");
            var $imgElement = $card.find(".upload-file-img");
            var $removeBtn = $card.find(".remove_btn");
            let $overlay = $card.find(".overlay");

            // If there's already a valid image source
            if (
                $imgElement.attr("src") &&
                $imgElement.attr("src") !== window.location.href &&
                $imgElement.attr("src") !== ""
            ) {
                $textbox.hide();
                $imgElement.show();
                $overlay.addClass("show");
                $removeBtn.css("opacity", 1);
                $card.addClass("input-disabled");
            }
        });
    }

    function handleFileChange($input, file) {
        let $card = $input.closest(".upload-file");
        let $textbox = $card.find(".upload-file-textbox");
        let $imgElement = $card.find(".upload-file-img");
        let $removeBtn = $card.find(".remove_btn");
        let $overlay = $card.find(".overlay");
        $card.addClass("input-disabled");

        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $textbox.hide();
                $imgElement.attr("src", e.target.result).show();
                $removeBtn.css("opacity", 1);
                $overlay.addClass("show");
            };
            reader.readAsDataURL(file);
        }
    }

    function resetFileUpload($card) {
        let $input = $card.find(".single_file_input");
        let $imgElement = $card.find(".upload-file-img");
        let $textbox = $card.find(".upload-file-textbox");
        let $removeBtn = $card.find(".remove_btn");
        let $overlay = $card.find(".overlay");
        let defaultSrc = $imgElement.data("default-src") || "";

        $input.val("");

        if (defaultSrc) {
            $imgElement.attr("src", defaultSrc).show();
            $textbox.hide();
            $overlay.addClass("show");
            $removeBtn.css("opacity", 1);
            $card.addClass("input-disabled");
        } else {
            $imgElement.hide().attr("src", "");
            $textbox.show();
            $overlay.removeClass("show");
            $removeBtn.css("opacity", 0);
            $card.removeClass("input-disabled");
        }
    }

    $(window).on("load", function () {
        $(".upload-file__input").on("change", function () {
            if (this.files && this.files[0]) {
                let reader = new FileReader();
                let img = $(this).siblings(".upload-file__img").find("img");

                reader.onload = function (e) {
                    img.attr("src", e.target.result);
                };

                reader.readAsDataURL(this.files[0]);

                reader.addEventListener("progress", (event) => {
                    if (event.loaded && event.total) {
                        const percent = (event.loaded / event.total) * 100;
                        $("#uploadProgress").val(percent);
                        $("#progress-label").html(Math.round(percent) + "%");
                        $("#name_of_file").html(this.files[0].name);
                    }
                });

                var $uploadFile = $(this).parents(".upload-file");
                $uploadFile.parent().find(".file_error-message").remove();

                var file_size = this.files[0].size;

                // if (file_size > 2097152) {
                //     $uploadFile
                //         .parent()
                //         .append(
                //             "<div class='file_error-message text-danger mt-3'>File size is greater than 2MB</div>"
                //         );
                // }
                //
                // // Check if any error messages are present in the form
                // var hasErrors =
                //     $(this).parents("form").find(".file_error-message").length >
                //     0;
                //
                // // Enable or disable the submit button based on the presence of errors
                // $(this)
                //     .parents("form")
                //     .find('button[type="submit"]')
                //     .prop("disabled", hasErrors);
            }
        });
    });

    /*============================================
  12: Filter Aside Toggle
  ==============================================*/
    $(".filter-btn").on("click", function () {
        $(".filter-aside, .offcanvas-overlay").toggleClass("active");
        $("body").toggleClass("ov-hidden");
    });
    $(".offcanvas-overlay, .filter-aside .btn-close").on("click", function () {
        $(".filter-aside, .offcanvas-overlay").removeClass("active");
        $("body").removeClass("ov-hidden");
    });

    /*============================================
  13: Edit Button Trigger Upload file
  ==============================================*/

    $(document).on("click", ".upload-file__edit", function () {
        $(this).closest(".upload-file").find(".upload-file__input").click();
    });

    /*============================================
    14: Reset Button Trigger Upload file
    ==============================================*/
    var initialImages = [];
    $(window).on("load", function () {
        $("form")
            .find("img")
            .each(function (index, value) {
                initialImages.push(value.src);
            });
    });

    $(document).ready(function () {
        $("form").on("reset", function (e) {
            $("form")
                .find("img")
                .each(function (index, value) {
                    $(value).attr("src", initialImages[index]);
                });
            $("form").find("#uploadProgress").val(0);
            $("form").find("#progress-label").html("0%");
            $("form").find("#name_of_file").html("Name of the file");
        });
    });

    /*============================================
  15: Enable tooltips
  ==============================================*/
    $(document).ready(function () {
        const tooltipTriggerList = document.querySelectorAll(
            '[data-bs-toggle="tooltip"]'
        );
        const tooltipList = [...tooltipTriggerList].map(
            (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
        );
    });

    /*==================================
  16: Changing svg color
  ====================================*/
    $("img.svg").each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr("id");
        var imgClass = $img.attr("class");
        var imgURL = $img.attr("src");

        jQuery.get(
            imgURL,
            function (data) {
                // Get the SVG tag, ignore the rest
                var $svg = jQuery(data).find("svg");

                // Add replaced image's ID to the new SVG
                if (typeof imgID !== "undefined") {
                    $svg = $svg.attr("id", imgID);
                }
                // Add replaced image's classes to the new SVG
                if (typeof imgClass !== "undefined") {
                    $svg = $svg.attr("class", imgClass + " replaced-svg");
                }

                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr("xmlns:a");

                // Check if the viewport is set, else we gonna set it if we can.
                if (
                    !$svg.attr("viewBox") &&
                    $svg.attr("height") &&
                    $svg.attr("width")
                ) {
                    $svg.attr(
                        "viewBox",
                        "0 0 " + $svg.attr("height") + " " + $svg.attr("width")
                    );
                }

                // Replace image with new SVG
                $img.replaceWith($svg);
            },
            "xml"
        );
    });

    /*==================================
  17: Table Row Multi Select
  ====================================*/
    $(document).ready(function () {
        $(".multi-select-table td input[type=checkbox]").on(
            "change",
            function () {
                let checkedLength = $(
                    ".table td input[type=checkbox]:checked"
                ).length;
                if (this.checked) {
                    $(this).parents("tr").addClass("bg-light");
                } else {
                    $(this).parents("tr").removeClass("bg-light");
                }
                $(this)
                    .parents(".table-responsive")
                    .siblings(".multiple-select-actions")
                    .find(".checked-count")
                    .html(checkedLength);

                if (checkedLength >= 2) {
                    $(this)
                        .parents(".table-responsive")
                        .siblings(".multiple-select-actions")
                        .addClass("active");
                    $(this).parents("table").find("thead").hide();
                } else {
                    $(this)
                        .parents(".table-responsive")
                        .siblings(".multiple-select-actions")
                        .removeClass("active");
                    $(this).parents("table").find("thead").show();
                }
            }
        );
        $(".multi-checker").on("change", function () {
            let tableResponsive = $(this)
                .parents(".multiple-select-actions")
                .siblings(".table-responsive");
            if (this.checked) {
                tableResponsive
                    .find("input[type=checkbox]")
                    .prop("checked", true);
                tableResponsive.find("tr").addClass("bg-light");
                tableResponsive.find("thead").hide();
            } else {
                tableResponsive
                    .find("input[type=checkbox]")
                    .prop("checked", false);
                $(this)
                    .parents(".multiple-select-actions")
                    .removeClass("active");
                tableResponsive.find("tr").removeClass("bg-light");
                tableResponsive.find("thead").show();
            }
            $(this)
                .parents(".multiple-select-actions")
                .find(".checked-count")
                .html($(".table td input[type=checkbox]:checked").length);
        });
    });

    /*==================================
  18: Collapse
  ====================================*/
    function collapse() {
        $(document.body).on("click", '[data-toggle="collapse"]', function (e) {
            e.preventDefault();
            var target = "#" + $(this).data("target");

            $(this).toggleClass("collapsed");
            $(target).slideToggle();
        });
    }
    collapse();

    // $(".dropdown.hover").on("mouseenter", function () {
    //     $(this).find(".dropdown-hover-toggle").dropdown("toggle");
    // });

    // Switcher With Text
    $(document).ready(function () {
        $(".switcher.hasContent .switcher_input").on("change", function () {
            var statusText = $(this).prop("checked") ? "Active" : "Inactive";
            $(this)
                .parents(".switcher.hasContent")
                .attr("data-before", statusText);
        });
    });

    // Menu Search
    var $rows = $(".aside .aside-body > ul.nav > li");
    $("#search-bar-input").on("keyup", function () {
        let val = $.trim($(this).val()).replace(/ +/g, " ").toLowerCase();

        $rows
            .show()
            .filter(function () {
                let text = $(this).text().replace(/\s+/g, " ").toLowerCase();
                return !~text.indexOf(val);
            })
            .hide();
    });
    function selectAllValue(selectedValues) {
        if (selectedValues !== null && selectedValues.includes("all")) {
            $(this)
                .find("option")
                .not(":disabled")
                .prop("selected", "selected");
            $(this).find('option[value="all"]').prop("selected", false);
        }
    }

    // Select2 Dropdown Search Placeholder
    $(".js-select").one("select2:open", function (e) {
        $("input.select2-search__field").prop("placeholder", "Search Here...");
        $(".select2-search.select2-search--dropdown")
            .addClass("select2-search-has-icon")
            .append(
                "<span class='material-symbols-outlined select2-search__icon text-muted'>search</span>"
            );
    });

    // Search Modal Open Input Focus
    $(document).ready(function () {
        $("#staticBackdrop").on("shown.bs.modal", function () {
            $(this).find("#searchForm input[type=search]").val("");
            $("#searchResults").html(
                '<div class="text-center text-muted py-5">It appears that you have not yet searched.</div>'
            );
            $(this).find("#searchForm input[type=search]").focus();
        });

        const searchInput = document.getElementById("searchInput");
        searchInput.addEventListener("search", function () {
            if (!this.value.trim()) {
                $("#searchResults").html(
                    '<div class="text-center text-muted py-5">It appears that you have not yet searched.</div>'
                );
            }
        });

        let paymentMethod = $('input[name="payment_method"]');
        paymentMethod.on("change", function () {
            paymentMethod.closest("label").removeClass("active");
            $(this).closest("label").addClass("active");
        });

        let chooseBusinessPlan = $('input[name="choose_business_plan"]');
        chooseBusinessPlan.on("change", function () {
            chooseBusinessPlan.closest("label").removeClass("active");
            $(this).closest("label").addClass("active");
        });

        $(".number-validation").on("input", function () {
            this.value = this.value
                .replace(/[^0-9.]/g, "")
                .replace(/(\..*)\./g, "$1");
        });
    });

    //Text max limit
    document.addEventListener("DOMContentLoaded", function () {
        const textareas = document.querySelectorAll('textarea[data-maxlength]');
        textareas.forEach(function (textarea) {
        const maxLength = parseInt(textarea.getAttribute('data-maxlength'), 10);
        const counter = textarea.parentElement.querySelector('.letter-count');

        const updateCounter = () => {
            if (textarea.value.length > maxLength) {
            textarea.value = textarea.value.slice(0, maxLength);
            }
            if (counter) {
            counter.textContent = `${textarea.value.length}/${maxLength}`;
            }
        };
        textarea.addEventListener('input', updateCounter);
        // Set initial counter value on load
        updateCounter();
        });
    });
    //Text max limit

    // document.querySelectorAll('.upload-group').forEach(group => {
    //     const input = group.querySelector('input[type="file"]');
    //     const preview = group.querySelector('.image-preview');
    //     const placeholder = group.querySelector('.upload-content');

    //     // Common function to handle image preview
    //     function handleFile(file) {
    //         if (file && file.type.startsWith("image/")) {
    //             const reader = new FileReader();
    //             reader.onload = function (e) {
    //                 preview.src = e.target.result;
    //                 preview.style.display = "block";
    //                 placeholder.style.display = "none";
    //             };
    //             reader.readAsDataURL(file);
    //         } else {
    //             preview.src = "";
    //             preview.style.display = "none";
    //             placeholder.style.display = "block";
    //         }
    //     }

    //     // Handle file input change
    //     input.addEventListener('change', function () {
    //         handleFile(input.files[0]);
    //     });

    //     // Prevent default behavior for drag events
    //     ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    //         group.addEventListener(eventName, (e) => e.preventDefault());
    //         group.addEventListener(eventName, (e) => e.stopPropagation());
    //     });

    //     // Add visual feedback for drag events (optional)
    //     group.addEventListener('dragover', () => group.classList.add('dragging'));
    //     group.addEventListener('dragleave', () => group.classList.remove('dragging'));
    //     group.addEventListener('drop', () => group.classList.remove('dragging'));

    //     // Handle drop event
    //     group.addEventListener('drop', (e) => {
    //         const file = e.dataTransfer.files[0];
    //         handleFile(file);
    //     });
    // });

    // document.querySelectorAll('.upload-group').forEach(group => {
    //     const input = group.querySelector('input[type="file"]');
    //     const preview = group.querySelector('.image-preview');
    //     const placeholder = group.querySelector('.upload-content');
    //     const uploadBox = group.querySelector('.upload-box');

    //     function handleFile(file) {
    //         if (file && file.type.startsWith("image/")) {
    //             const reader = new FileReader();
    //             reader.onload = function (e) {
    //                 preview.src = e.target.result;
    //                 preview.style.display = "block";
    //                 placeholder.style.display = "none";
    //                 uploadBox.classList.add("has-image"); // Add hover-enabled class
    //             };
    //             reader.readAsDataURL(file);
    //         } else {
    //             preview.src = "";
    //             preview.style.display = "none";
    //             placeholder.style.display = "block";
    //             uploadBox.classList.remove("has-image"); // Remove hover-enabled class
    //         }
    //     }

    //     input.addEventListener('change', function () {
    //         handleFile(input.files[0]);
    //     });

    //     ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    //         group.addEventListener(eventName, (e) => e.preventDefault());
    //         group.addEventListener(eventName, (e) => e.stopPropagation());
    //     });

    //     group.addEventListener('dragover', () => group.classList.add('dragging'));
    //     group.addEventListener('dragleave', () => group.classList.remove('dragging'));
    //     group.addEventListener('drop', () => group.classList.remove('dragging'));

    //     group.addEventListener('drop', (e) => {
    //         const file = e.dataTransfer.files[0];
    //         input.files = e.dataTransfer.files; // Important: update input's files too
    //         handleFile(file);
    //     });
    // });

    document.querySelectorAll('.upload-group').forEach(group => {
    const input = group.querySelector('input[type="file"]');
    const preview = group.querySelector('.image-preview');
    const placeholder = group.querySelector('.upload-content');
    const uploadBox = group.querySelector('.upload-box');
    const removeIcon = group.querySelector('.uploaded-remove-icon');

    function handleFile(file) {
        if (file && file.type.startsWith("image/")) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = "block";
                placeholder.style.display = "none";
                uploadBox.classList.add("has-image");
            };
            reader.readAsDataURL(file);
        } else {
            resetImage();
        }
    }

    function resetImage() {
        input.value = ""; // Clear the input
        preview.src = "";
        preview.style.display = "none";
        placeholder.style.display = "block";
        uploadBox.classList.remove("has-image");
    }

    input.addEventListener('change', function () {
        handleFile(input.files[0]);
    });

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        group.addEventListener(eventName, (e) => e.preventDefault());
        group.addEventListener(eventName, (e) => e.stopPropagation());
    });

    group.addEventListener('dragover', () => group.classList.add('dragging'));
    group.addEventListener('dragleave', () => group.classList.remove('dragging'));
    group.addEventListener('drop', () => group.classList.remove('dragging'));

    group.addEventListener('drop', (e) => {
        const file = e.dataTransfer.files[0];
        input.files = e.dataTransfer.files;
        handleFile(file);
    });

    // Handle click on remove icon
    if (removeIcon) {
        removeIcon.addEventListener('click', function (e) {
            e.stopPropagation(); // prevent click from triggering label
            resetImage();
        });
    }
});




    //Table Custom td Show & Hide
    document.querySelectorAll('.table-toggle-btn').forEach(function(button) {
        button.addEventListener('click', function () {
            const tableWrap = this.nextElementSibling; // assumes .table-custom-wrap is right after the button
            const currentDisplay = window.getComputedStyle(tableWrap).display;

            if (currentDisplay === 'none') {
                tableWrap.style.display = 'block';
            } else {
                tableWrap.style.display = 'none';
            }

            this.classList.toggle('active');
        });
    });

    //Copy COde
    document.querySelectorAll(".copy-text").forEach(copyBlock => {
        const button = copyBlock.querySelector("button");
        const input = copyBlock.querySelector("input.text");

        button?.addEventListener("click", async () => {
            try {
                await navigator.clipboard.writeText(input.value);
                copyBlock.classList.add("active");

                setTimeout(() => {
                    copyBlock.classList.remove("active");
                }, 2500);
            } catch (err) {
                console.error("Failed to copy text: ", err);
            }
        });
    });

    //Text Change
    $(document).ready(function () {
        $('.payment__toggle').change(function () {
            let $label = $(this).closest('.payment-test__wrap').find('.payment-test');

            if ($(this).is(':checked')) {
                // Change to Live
                $label.text('Live');
                $label.removeClass('bg-primary text-primary').addClass('bg-danger text-danger');
            } else {
                // Change back to Test
                $label.text('Test');
                $label.removeClass('bg-danger text-danger').addClass('bg-primary text-primary');
            }
        });
    });

    // --- Tab Menu ---
    function checkNavOverflow() {
        try {
            $(".nav--tabs").each(function () {
                let $nav = $(this);
                let $btnNext = $nav
                    .closest(".position-relative")
                    .find(".nav--tab__next");
                let $btnPrev = $nav
                    .closest(".position-relative")
                    .find(".nav--tab__prev");
                let isRTL = $("html").attr("dir") === "rtl";
                let navScrollWidth = $nav[0].scrollWidth;
                let navClientWidth = $nav[0].clientWidth;
                let scrollLeft = Math.abs($nav.scrollLeft());

                if (isRTL) {
                    let maxScrollLeft = navScrollWidth - navClientWidth;
                    let scrollRight = maxScrollLeft - scrollLeft;

                    $btnNext.toggle(scrollRight > 1);
                    $btnPrev.toggle(scrollLeft > 1);
                } else {
                    $btnNext.toggle(
                        navScrollWidth > navClientWidth &&
                            scrollLeft + navClientWidth < navScrollWidth
                    );
                    $btnPrev.toggle(scrollLeft > 1);
                }
            });
        } catch (error) {
            console.error(error);
        }
    }
    $(".nav--tabs").each(function () {
        let $nav = $(this);
        checkNavOverflow($nav);

        $(window).on("resize", function () {
            checkNavOverflow($nav);
        });

        $nav.on("scroll", function () {
            checkNavOverflow($nav);
        });

        $nav.siblings(".nav--tab__next").on("click", function () {
            let scrollWidth = $nav.find("li").outerWidth(true);
            let isRTL = $("html").attr("dir") === "rtl";

            if (isRTL) {
                $nav.animate(
                    { scrollLeft: $nav.scrollLeft() - scrollWidth },
                    300,
                    function () {
                        checkNavOverflow($nav);
                    }
                );
            } else {
                $nav.animate(
                    { scrollLeft: $nav.scrollLeft() + scrollWidth },
                    300,
                    function () {
                        checkNavOverflow($nav);
                    }
                );
            }
        });

        $nav.siblings(".nav--tab__prev").on("click", function () {
            let scrollWidth = $nav.find("li").outerWidth(true);
            let isRTL = $("html").attr("dir") === "rtl";

            if (isRTL) {
                $nav.animate(
                    { scrollLeft: $nav.scrollLeft() + scrollWidth },
                    300,
                    function () {
                        checkNavOverflow($nav);
                    }
                );
            } else {
                $nav.animate(
                    { scrollLeft: $nav.scrollLeft() - scrollWidth },
                    300,
                    function () {
                        checkNavOverflow($nav);
                    }
                );
            }
        });
    });

    //---- global Image Upload -----
    $(document).on('change', '.global-image-upload input[type="file"]', function () {
        const file = this.files[0];
        const $container = $(this).closest('.global-image-upload');
        const $uploadBox = $container.find('.global-upload-box');
        const $imagePreview = $container.find('.global-image-preview');
        const $overlayIcons = $container.find('.overlay-icons');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $imagePreview.attr('src', e.target.result).removeClass('d-none');
                $uploadBox.hide();
                $overlayIcons.removeClass('d-none');
                $container.addClass('has-image'); // trigger hover icon logic
            };
            reader.readAsDataURL(file);
        }
    });
    // View icon - display the image in a specific container with a class
    $(document).on('click', '.view-icon', function (e) {
        e.stopPropagation();
        const src = $(this).closest('.global-image-upload').find('.global-image-preview').attr('src');
        if (src) {
            // Display the image in a container with the class .image-display-container
            const $imageDisplayContainer = $('.image-display-container'); // Find container by class
            $imageDisplayContainer.html('<img src="' + src + '" alt="Preview" style="max-width: 100%; max-height: 300px;" />');
        }
    });
    // Remove icon - reset upload
    $(document).on('click', '.remove-icon', function (e) {
        e.stopPropagation();
        const $container = $(this).closest('.global-image-upload');
        $container.find('.global-image-preview').attr('src', '').addClass('d-none');
        $container.find('.global-upload-box').show();
        $container.find('.overlay-icons').addClass('d-none');
        $container.find('input[type="file"]').val('');
        $container.removeClass('has-image');
    });
    // Edit icon - reopen file input
    $(document).on('click', '.edit-icon', function (e) {
        e.stopPropagation();
        $(this).closest('.global-image-upload').find('input[type="file"]').click();
    });
    // View icon - show image and image name in container with class
    $(document).on('click', '.view-icon', function (e) {
        e.stopPropagation();
        const $container = $(this).closest('.global-image-upload');
        const src = $container.find('.global-image-preview').attr('src');
        const fileInput = $container.find('input[type="file"]')[0];
        const fileName = fileInput.files[0]?.name || '';

        if (src) {
            const $imageDisplayContainer = $('.image-display-container'); // Target by class
            // Inject image + filename into the container
            $imageDisplayContainer.html(`
                <!-- inside show image name -->
                <div style="font-size: 14px; color: #000;">${fileName}</div>
                <!-- inside show image -->
                <img src="${src}" alt="Preview" style="display: height: 200px; aspect-ratio: 7/2; flex; justify-content: center; margin: 18px auto 6px; width: 100%; max-width: 100%; object-fit: cover;" />
            `);
        }
    });
    //------- Multiple Image Upload Box ---------
    $(document).ready(function () {
        $('.trigger-image-hit input[type="file"]').on('change', function (event) {
            const files = event.target.files;
            const uploadBox = $('.inside-upload-imageBox');

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imageHtml = `
                        <div class="uploaded-image-box position-relative bg-light rounded p-3 mb-md-3 mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <img src="${e.target.result}" alt="${file.name}" class="rounded" style="width: 24px; height: 24px; object-fit: cover;">
                                <div class="d-flex align-items-center w-100 justify-content-between gap-1 flex-wrap">
                                    <div class="fz-12">${file.name}</div>
                                    <div class="text-muted text-color fz-12">${(file.size / 1024 / 1024).toFixed(1)}MB</div>
                                </div>
                            </div>
                            <button class="btn btn-danger p-1 position-absolute top-0 end-cus-0 w-20 h-20 rounded-full d-center remove-uploaded-image">✕</button>
                        </div>
                    `;
                    uploadBox.append(imageHtml);
                };
                reader.readAsDataURL(file);
            }
        });
        $(document).on('click', '.remove-uploaded-image', function () {
            $(this).closest('.uploaded-image-box').remove();
        });
    });
    //------- File Upload Box --------
    $(document).ready(function () {
        $('.trigger-zip-hit input[type="file"]').on('change', function (event) {
            const files = event.target.files;
            const uploadBox = $('.inside-upload-zipBox');

            // Clear existing ZIP file display before adding the new one(s)
            uploadBox.empty();

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileName = file.name;
                const fileSizeMB = (file.size / 1024 / 1024).toFixed(1);

                // Allow only ZIP files
                if (!fileName.toLowerCase().endsWith('.zip')) {
                    alert('Only .zip files are allowed.');
                    continue;
                }

                const zipHtml = `
                    <div class="uploaded-zip-box position-relative bg-light rounded p-3 mb-md-3 mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="zip-icon mt-1">
                                <span class="material-symbols-outlined text-primary">folder</span>
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between gap-1 flex-wrap">
                                <div class="fz-12 text-break">${fileName}</div>
                                <div class="text-muted text-color fz-12">${fileSizeMB}MB</div>
                            </div>
                        </div>
                        <button class="btn btn-danger p-1 position-absolute top-0 end-cus-0 w-20 h-20 rounded-full d-center remove-uploaded-zip">✕</button>
                    </div>
                `;

                uploadBox.append(zipHtml);
            }
        });

        // Remove uploaded ZIP
        $(document).on('click', '.remove-uploaded-zip', function () {
            $(this).closest('.uploaded-zip-box').remove();
        });
    });


     //------- Custom Slider for card or tabs --------
    document.addEventListener("DOMContentLoaded", () => {
        const container = document.querySelector('.tabs-inner');
        if (!container) return;

        const btnPrevWrap = document.querySelector('.button-prev');
        const btnNextWrap = document.querySelector('.button-next');
        const item = document.querySelector('.tabs-slide_items');

        document.querySelectorAll('.tabs-slide_items').forEach(el => {
            el.style.flex = '0 0 auto';
        });

        function updateArrows() {
            const hasOverflow = container.scrollWidth > container.clientWidth;

            if (!hasOverflow) {
            btnPrevWrap.style.display = 'none';
            btnNextWrap.style.display = 'none';
            return;
            }

            const atStart = container.scrollLeft <= 0;
            const atEnd = container.scrollLeft + container.clientWidth >= container.scrollWidth - 1;

            btnPrevWrap.style.display = atStart ? 'none' : 'flex';
            btnNextWrap.style.display = atEnd ? 'none' : 'flex';
        }

        document.querySelector('.btn-click-prev')?.addEventListener('click', () => {
            const itemWidth = item?.offsetWidth || 0;
            container.scrollBy({ left: -itemWidth, behavior: 'smooth' });
        });

        document.querySelector('.btn-click-next')?.addEventListener('click', () => {
            const itemWidth = item?.offsetWidth || 0;
            container.scrollBy({ left: itemWidth, behavior: 'smooth' });
        });

        container.addEventListener('scroll', updateArrows);

        ['load', 'resize'].forEach(e =>
            window.addEventListener(e, updateArrows)
        );

        new MutationObserver(updateArrows).observe(container, { childList: true, subtree: true });
        new ResizeObserver(updateArrows).observe(container);

        updateArrows();
    });

})(jQuery);
