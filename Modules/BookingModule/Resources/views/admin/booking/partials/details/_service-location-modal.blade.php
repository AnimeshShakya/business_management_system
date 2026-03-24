<div class="modal fade" id="serviceLocationModal--{{$booking['id']}}" tabindex="-1"
     aria-labelledby="serviceLocationModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{route('admin.booking.change-service-location', [$booking['id']])}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <h4 class="font-weight-bold mb-2">{{ translate('Change Service Location') }}</h4>
                    <p class="text-muted">{{ translate('Select where to provide services for this booking. Contact the customer before making changes') }}</p>

                    <div class="bg-light p-3 rounded">
                        <h6 class="font-weight-bold">{{ translate('Select Service Location') }}</h6>
                        <div class="rbg-body border d-flex justify-content-between mt-2 p-3 rounded">
                            <div class="flex-grow-1">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="service_location" value="customer" id="customer_location"
                                    {{ $booking->service_location == 'customer' ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-bold" for="customer_location">
                                        {{ translate('At Customer Location') }}
                                        <p class="text-muted small mb-0">{{ translate('Provider has to go to customer place') }}</p>
                                    </label>

                                </div>
                            </div>
                            @if($serviceAtProviderPlace == 1)
                                <div class="flex-grow-1">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="service_location" value="provider" id="provider_location"
                                            {{ $booking->service_location == 'provider' ? 'checked' : '' }}>
                                        <label class="custom-control-label font-weight-bold" for="provider_location">
                                            {{ translate('At Provider Location') }}
                                            <p class="text-muted small mb-0">{{ translate('Customer has to go to provider place') }}</p>
                                        </label>

                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="customer-details mt-3">
                            <!-- Hidden Fields in Service Location Modal -->
                            <input type="hidden" name="contact_person_name" value="{{ $booking->service_address->contact_person_name ?? '' }}">
                            <input type="hidden" name="contact_person_number" value="{{ $booking->service_address->contact_person_number ?? '' }}">
                            <input type="hidden" name="address_label" value="{{ $booking->service_address->label ?? '' }}">
                            <input type="hidden" name="address" value="{{ $booking->service_address->address ?? '' }}">
                            <input type="hidden" name="latitude" value="{{ $booking->service_address->latitude ?? '' }}">
                            <input type="hidden" name="longitude" value="{{ $booking->service_address->longitude ?? '' }}">
                            <input type="hidden" name="city" value="{{ $booking->service_address->city ?? '' }}">
                            <input type="hidden" name="street" value="{{ $booking->service_address->street ?? '' }}">
                            <input type="hidden" name="zip_code" value="{{ $booking->service_address->zip_code ?? '' }}">
                            <input type="hidden" name="country" value="{{ $booking->service_address->country ?? '' }}">

                            <h6 class="font-weight-bold">{{ translate('Customer Details') }}</h6>
                            <div class="media gap-2 flex-wrap p-3 rounded bg-card mt-3">
                                @if (!$booking?->is_guest && $booking?->customer)
                                    <img width="58" height="58"
                                         class="rounded-circle border border-white aspect-square object-fit-cover"
                                         src="{{ $booking?->customer?->profile_image_full_path }}"
                                         alt="{{ translate('user_image') }}">
                                @else
                                    <img width="58" height="58"
                                         class="rounded-circle border border-white aspect-square object-fit-cover"
                                         src="{{ asset('public/assets/provider-module/img/user2x.png') }}"
                                         alt="{{ translate('user_image') }}">
                                @endif
                                    <div class="media-body d-flex justify-content-between">
                                        <div>
                                            <h5 class="c1 mb-3">
                                                @if (!$booking?->is_guest && $booking?->customer)
                                                    <span class="c1 updated_customer_name">{{ Str::limit($customer_name, 30) }}</span>
                                                @else
                                                    <span class="updated_customer_name">{{ Str::limit($customer_name ?? '', 30) }}</span>
                                                @endif
                                            </h5>
                                            <ul class="list-info">
                                                @if ($customer_phone)
                                                    <li>
                                                        <span class="material-icons">phone_iphone</span>
                                                        <a href="tel:{{ $customer_phone }}" id="updated_customer_phone">{{ $customer_phone }}</a>
                                                    </li>
                                                @endif
                                                    <li>
                                                        <span class="material-icons">map</span>
                                                        <p id="customer_service_location" class="{{ empty($booking?->service_address?->address) ? 'text-danger' : '' }}">
                                                            {{ Str::limit($booking?->service_address?->address ?: translate('Customer Address required'), 100) }}
                                                        </p>
                                                    </li>

                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <div data-bs-toggle="modal"
                                                 data-bs-target="#customerAddressModal--{{ $booking['id'] }}"
                                                 data-toggle="tooltip" data-placement="top">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="material-symbols-outlined">edit_square</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div class="modal-footer d-flex justify-content-end gap-3 border-0 pt-0 pb-4 m-4">
                                <button type="button" class="btn btn--secondary customer-address-reset-btn">{{translate('Reset')}}</button>
                                <button type="submit" class="btn btn--primary customer-address-update-btn" {{ empty($booking?->service_address?->address) ? 'disabled' : '' }}>{{translate('Update')}}</button>
                            </div>
                        </div>

                        <div class="provider-details mt-3">
                            <h6 class="font-weight-bold">{{ translate('Provider Details') }}</h6>
                            @if($booking->provider)
                                <div class="media gap-2 flex-wrap p-3 rounded bg-card mt-3">
                                    <img width="58" height="58"
                                         class="rounded-circle border border-white aspect-square object-fit-cover"
                                         src="{{ $booking?->provider?->logo_full_path }}"
                                         alt="{{ translate('provider') }}">
                                    <div class="media-body">
                                        <a href="{{ route('admin.provider.details', [$booking?->provider?->id, 'web_page' => 'overview']) }}">
                                            <h5 class="c1 mb-3">
                                                {{ Str::limit($booking->provider->company_name ?? '', 30) }}
                                            </h5>
                                        </a>
                                        <ul class="list-info">
                                            <li>
                                                <span class="material-icons">phone_iphone</span>
                                                <a href="tel:{{ $booking->provider->contact_person_phone ?? '' }}">{{ $booking->provider->contact_person_phone ?? '' }}</a>
                                            </li>
                                            <li>
                                                <span class="material-icons">map</span>
                                                <p>{{ Str::limit($booking->provider->company_address ?? '', 100) }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <p class="mt-2">{{ translate('The Service Location will be available after this booking assign to a provider') }}</p>
                            @endif

                            <div class="modal-footer d-flex justify-content-end gap-3 border-0 pt-0 pb-4 m-4">
                                <button type="button" class="btn btn--secondary" data-bs-dismiss="modal" aria-label="Close">{{translate('Close')}}</button>
                                <button type="submit" class="btn btn--primary">{{translate('Update')}}</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
