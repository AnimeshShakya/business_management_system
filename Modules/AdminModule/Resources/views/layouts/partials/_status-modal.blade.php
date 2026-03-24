<!-- Confirmation Modal for status -->
<div class="modal fade" id="confirmChangeModal" tabindex="-1" role="dialog" aria-labelledby="confirmChangeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close cancel-change" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mb-30 pb-0 text-center">
                <img width="80" src="{{ asset('public/assets/admin-module/img/icons/status-on.png') }}" alt="{{ translate('image') }}" class="mb-20">
                <h3 class="mb-3 confirmation-title-text">{{ translate('Are you sure') }}?</h3>
                <p class="mb-0 confirmation-description-text">{{ translate('Do you want to change the status') }}?</p>
                <div class="btn--container mt-30 justify-content-center">
                    <button type="button" class="btn btn--secondary rounded min-w-120 cancel-change" id="cancelChange">{{ translate('No') }}</button>
                    <button type="button" class="btn btn--primary rounded min-w-120" id="confirmChange">{{ translate('Yes') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
