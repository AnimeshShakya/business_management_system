(function () {
    'use strict';

    const lastValidFiles = new Map();

    function parseAccept(accept) {
        if (!accept) return [];
        return accept.split(',').map(s => s.trim().toLowerCase()).filter(Boolean);
    }

    function fileMatchesAccept(file, accepted) {
        if (!accepted || !accepted.length) return true;
        const fileType = (file.type || '').toLowerCase();
        const name = file.name || '';
        const ext = '.' + name.split('.').pop().toLowerCase();
        for (const a of accepted) {
            if (a.startsWith('.') && ext === a) return true;
            if (a.includes('/') && a.endsWith('/*') && fileType.startsWith(a.split('/')[0] + '/')) return true;
            if (a === fileType) return true;
            if (a === ext) return true;
        }
        return false;
    }

    function getMaxBytes(input) {
        const m = $(input).attr('data-maxFileSize');
        const mb = (m && !isNaN(parseFloat(m))) ? parseFloat(m) : 20;
        return mb * 1024 * 1024;
    }

    function showError(msg) {
        if (typeof toastr !== 'undefined' && toastr.error) toastr.error(msg);
        else { console.error(msg); alert(msg); }
    }

    function restorePreview(input, file) {
        const previewImg = document.querySelector(`[data-preview-for="${input.id}"]`);
        if (!previewImg) return;
        if (file) previewImg.src = URL.createObjectURL(file);
        else {
            const placeholder = input.getAttribute('data-placeholder');
            previewImg.src = placeholder || '';
        }
    }

    function validatingChangeHandler(ev) {
        if (!ev || !ev.target || ev.target.tagName !== 'INPUT' || ev.target.type !== 'file') return;

        const input = ev.target;
        const files = Array.from(input.files || []);
        if (!files.length) return;

        const accepted = parseAccept(input.getAttribute('accept') || '');
        const maxBytes = getMaxBytes(input);

        let validFile = null;
        let anyInvalid = false;

        for (const file of files) {
            const name = file.name || 'file';
            if (!fileMatchesAccept(file, accepted)) {
                showError(`"${name}" is not an allowed file type.`);
                anyInvalid = true;
                break;
            }

            if (file.size > maxBytes) {
                const mb = Math.round((maxBytes / (1024 * 1024)) * 100) / 100;
                showError(`"${name}" exceeds ${mb}MB limit.`);
                anyInvalid = true;
                break;
            } else{
                validFile = file; // last valid
            }
        }

        if (anyInvalid) {
            const lastFile = lastValidFiles.get(input);
            if (lastFile) {
                const dt = new DataTransfer();
                dt.items.add(lastFile);
                input.files = dt.files;
            } else {
                input.value = '';
            }
            restorePreview(input, lastValidFiles.get(input));
            ev.stopImmediatePropagation();
            ev.preventDefault();
            return false;
        }

        if (validFile) {
            const dt = new DataTransfer();
            dt.items.add(validFile);
            input.files = dt.files;
            lastValidFiles.set(input, validFile);
            restorePreview(input, validFile);
        }

        return true;
    }

    document.addEventListener('change', function (e) {
        if (e.target && e.target.type === 'file') {
            validatingChangeHandler(e);
        }
    }, true);

})();


