<div class="modal fade" id="customerAddressModal--{{$booking['id']}}" tabindex="-1" aria-labelledby="customerAddressModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <form class="flex-grow-1" id="customerAddressModalSubmit">
            @csrf
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="font-weight-bold">{{ translate('Change Service Location') }}</h4>

                    <div class="row mt-4">
                        <div class="col-md-6 col-12">
                            <div class="col-md-12 col-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="contact_person_name"
                                               placeholder="{{translate('contact_person_name')}} *"
                                               value="{{$booking->service_address?->contact_person_name}}" required>
                                        <label>{{translate('contact_person_name')}} *</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control"
                                               name="contact_person_number"
                                               id="contact_person_number"
                                               placeholder="{{translate('contact_person_number')}} *"
                                               value="{{$booking->service_address?->contact_person_number}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div id="location_map_div" class="location_map_class">
                                    <input id="address_pac-input" class="form-control w-auto"
                                           data-toggle="tooltip"
                                           data-placement="right"
                                           data-original-title="{{ translate('search_your_location_here') }}"
                                           type="text" placeholder="{{ translate('search_here') }}"/>
                                    <div id="address_location_map_canvas"
                                         class="overflow-hidden rounded canvas_class">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 row">
                            <div class="col-md-12 col-12">
                                <div class="mb-30">
                                    <select class="js-select theme-input-style w-100" name="address_label">
                                        <option selected disabled>{{translate('Select_address_label')}}*</option>
                                        <option value="home" {{$booking->service_address?->address_label == 'home' ? 'selected' : ''}}>{{translate('Home')}}</option>
                                        <option value="office" {{$booking->service_address?->address_label == 'office' ? 'selected' : ''}}>{{translate('Office')}}</option>
                                        <option value="others" {{$booking->service_address?->address_label == 'others' ? 'selected' : ''}}>{{translate('others')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="address" id="address_address"
                                               placeholder="{{translate('address')}} *"
                                               value="{{$booking->service_address?->address}}" required>
                                        <label>{{translate('address')}} *</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="latitude" id="address_latitude"
                                               placeholder="{{translate('lat')}} *"
                                               value="{{$booking->service_address?->lat}}" required readonly
                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                               title="{{translate('Select from map')}}">
                                        <label>{{translate('lat')}} *</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="longitude" id="address_longitude"
                                               placeholder="{{translate('long')}} *"
                                               value="{{$booking->service_address?->lon}}" required readonly
                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                               title="{{translate('Select from map')}}">
                                        <label>{{translate('long')}} *</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="city"
                                               placeholder="{{translate('city')}}"
                                               value="{{$booking->service_address?->city}}">
                                        <label>{{translate('city')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="street"
                                               placeholder="{{translate('street')}}"
                                               value="{{$booking->service_address?->street}}">
                                        <label>{{translate('street')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="zip_code"
                                               placeholder="{{translate('zip_code')}}"
                                               value="{{$booking->service_address?->zip_code}}">
                                        <label>{{translate('zip_code')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="mb-30">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="country"
                                               placeholder="{{translate('country')}}"
                                               value="{{$booking->service_address?->country}}">
                                        <label>{{translate('country')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end gap-3 border-0 pt-0 pb-4 m-4">
                    <button type="button" class="btn btn--secondary" data-bs-dismiss="modal" aria-label="Close">
                        {{translate('Cancel')}}</button>
                    <button type="submit" class="btn btn--primary">{{translate('Update')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>

