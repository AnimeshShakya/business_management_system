"use strict";
function initializePhoneInput(selector, outputSelector) {
    const phoneInput = document.querySelector(selector);
    const phoneNumber = phoneInput.value;
    const countryCodeMatch = phoneNumber.replace(/[^0-9]/g, "");
    const initialCountry = countryCodeMatch
        ? `+${countryCodeMatch}`
        : "bn".toLowerCase();

    let phoneInputInit = window.intlTelInput(phoneInput, {
        initialCountry: initialCountry.toLowerCase(),
        showSelectedDialCode: true,
    });
    if (!phoneInputInit.selectedCountryData.dialCode) {
        phoneInputInit.destroy();
        phoneInputInit = window.intlTelInput(phoneInput, {
            initialCountry: "bn".toLowerCase(),
            showSelectedDialCode: true,
        });
    }
    $(outputSelector).val(
        "+" +
            phoneInputInit.selectedCountryData.dialCode +
            phoneInput.value.replace(/[^0-9]/g, "")
    );

    $(".iti__country").on("click", function () {
        $(outputSelector).val(
            "+" +
                $(this).data("dial-code") +
                phoneInput.value.replace(/[^0-9]/g, "")
        );
    });

    $(selector).on("keyup keypress change", function () {
        $(outputSelector).val(
            "+" +
                phoneInputInit.selectedCountryData.dialCode +
                phoneInput.value.replace(/[^0-9]/g, "")
        );
        $(selector).val(phoneInput.value.replace(/[^0-9]/g, ""));
    });
}
$(document).ready(function () {
    try {
        initializePhoneInput(
            ".phone-input-with-country-picker",
            ".country-picker-phone-number"
        );
        initializePhoneInput(
            ".phone-input-with-country-picker2",
            ".country-picker-phone-number"
        );

        initializePhoneInput(
            ".phone-input-with-country-picker3",
            ".country-picker-phone-number3"
        );
        initializePhoneInput(
            ".phone-input-with-country-picker4",
            ".country-picker-phone-number4"
        );
        initializePhoneInput(
            ".phone-input-with-country-picker5",
            ".country-picker-phone-number5"
        );
        initializePhoneInput(
            ".phone-input-with-country-picker6",
            ".country-picker-phone-number6"
        );

    } catch (error) {
        console.log(error)
    }
});



// Only Country Code
function updateSelectedFlagDisplay(itiInstance, $phoneInput) {
    const $selectedFlag = $phoneInput.closest(".iti").find(".iti__selected-flag");
    const countryData = itiInstance.getSelectedCountryData();
    const iso2 = countryData.iso2.toUpperCase();

    let $countryDisplay = $selectedFlag.find(".custom-country-display");
    if ($countryDisplay.length === 0) {
        $countryDisplay = $("<span>")
            .addClass("custom-country-display")
            .css("margin-left", "8px");
        $selectedFlag.append($countryDisplay);
    }

    $countryDisplay.text(iso2);
}
function initializeCountryCodeInput(selector, outputSelector, options = {}) {
    const $phoneInput = $(selector);
    if ($phoneInput.length === 0) return;

    const phoneNumber = $phoneInput.val();
    const countryCodeMatch = phoneNumber.replace(/[^0-9]/g, "");
    const initialCountry = countryCodeMatch ? `+${countryCodeMatch}` : "bd";

    let itiInstance = window.intlTelInput($phoneInput[0], {
        initialCountry: initialCountry.toLowerCase(),
        showSelectedDialCode: true,
    });

    if (!itiInstance.selectedCountryData.dialCode) {
        itiInstance.destroy();
        itiInstance = window.intlTelInput($phoneInput[0], {
            initialCountry: "bd",
            showSelectedDialCode: true,
        });
    }

    updateSelectedFlagDisplay(itiInstance, $phoneInput);

    function updateOutput() {
        const dialCode = itiInstance.selectedCountryData.dialCode;
        const inputDigits = $phoneInput.val().replace(/[^0-9]/g, "");

        const outputValue = options.onlyCountryCode
            ? "+" + dialCode
            : "+" + dialCode + inputDigits;

        $(outputSelector).val(outputValue);

        if (!options.onlyCountryCode) {
            $phoneInput.val(inputDigits);
        }
    }

    updateOutput();

    $(".iti__country").on("click", function () {
        setTimeout(function () {
            updateSelectedFlagDisplay(itiInstance, $phoneInput);
            updateOutput();
        }, 100);
    });

    $phoneInput.on("keyup keypress change", function () {
        updateOutput();
    });
}
$(document).ready(function () {
    try {
        // New: Only show country code label
        initializeCountryCodeInput(
            ".only-input-with-country-picker",
            ".only-picker-countrylabel",
            { onlyCountryCode: true }
        );
        initializeCountryCodeInput(
            ".only-input-with-country-picker2",
            ".only-picker-countrylabel2",
            { onlyCountryCode: true }
        );
        initializeCountryCodeInput(
            ".only-input-with-country-picker3",
            ".only-picker-countrylabel3",
            { onlyCountryCode: true }
        );
        initializeCountryCodeInput(
            ".only-input-with-country-picker4",
            ".only-picker-countrylabel4",
            { onlyCountryCode: true }
        );
        initializeCountryCodeInput(
            ".only-input-with-country-picker5",
            ".only-picker-countrylabel5",
            { onlyCountryCode: true }
        );
    } catch (error) {
        console.error("Phone input init failed:", error);
    }
});
