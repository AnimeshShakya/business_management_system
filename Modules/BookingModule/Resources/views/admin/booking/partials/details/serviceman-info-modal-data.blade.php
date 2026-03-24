<div class="modal-header border-0 pb-1 pb-lg-1 p-lg-5">
    <div class="d-flex flex-column gap-1">
        <h5>{{translate('Available Servicemen')}}</h5>
        <div class="fs-12">{{$servicemen->count()}} {{translate('servicemen are available right now')}}</div>
    </div>
    <button type="button" class="btn-close provider-cross" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-lg-5 pt-lg-3">
    <div class="d-flex gap-2">
        <form action="#" class="search-form flex-grow-1" autocomplete="off">
            <div class="input-group position-relative search-form__input_group rounded-3">
                                <span class="search-form__icon">
                                    <span class="material-icons">search</span>
                                </span>
                <input type="search" class="theme-input-style search-form__input search-form-input1"
                       id="search-form__input"
                       placeholder="{{translate('Search Here')}}'" value="{{$search ?? ''}}">
            </div>
        </form>
    </div>

    <div class="d-flex flex-column">
        @php
            $matchedServiceman = null;
            $otherServicemen = [];
        @endphp

        {{-- Separate the matching serviceman from others --}}
        @foreach($servicemen ?? [] as $serviceman)
            @if($booking->serviceman_id == $serviceman->id)
                @php $matchedServiceman = $serviceman; @endphp
            @else
                @php $otherServicemen[] = $serviceman; @endphp
            @endif
        @endforeach

        {{-- Display the matching serviceman at the top --}}
        @if($matchedServiceman)
            <div class="d-flex gap-2 justify-content-between align-items-center mt-4 pb-3 flex-wrap">
                <div class="media gap-2">
                    <img width="60" class="rounded"
                         src="{{$matchedServiceman?->user?->profile_image_full_path}}"
                         alt="{{ translate('serviceman-logo') }}">
                    <div class="media-body">
                        <h5 class="mb-2">{{$matchedServiceman->user->first_name . ' '. $matchedServiceman->user->last_name}}</h5>
                        <div class="mb-1 fs-12"><a href="tel:{{ $matchedServiceman->user->phone }}">{{$matchedServiceman->user->phone}}</a></div>
                        <div class="provider-devider">
                            <ol class="breadcrumb fs-12 mb-0">
                                <li class="breadcrumb-item active">{{translate('Bookings')}} - {{$matchedServiceman->bookings_count}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="text-success">{{translate('Currently Assigned')}}</div>
                </div>
            </div>
        @endif

        {{-- Display other serviceman --}}
        @foreach($otherServicemen as $serviceman)
            <div class="d-flex gap-2 justify-content-between align-items-center mt-4 pb-3 flex-wrap">
                <div class="media gap-2">
                    <img width="60" class="rounded"
                         src="{{$serviceman->user?->profile_image_full_path}}"
                         alt="{{ translate('serviceman-logo') }}">
                    <div class="media-body">
                        <h5 class="mb-2">{{$serviceman->user->first_name . ' '. $serviceman->user->last_name}}</h5>
                        <div class="mb-1 fs-12"><a href="tel:{{ $serviceman->user->phone }}">{{$serviceman->user->phone}}</a></div>
                        <div class="provider-devider">
                            <ol class="breadcrumb fs-12 mb-0">
                                <li class="breadcrumb-item active">{{translate('Bookings')}} - {{$serviceman->bookings_count}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-primary w-100 max-w320 reassign-serviceman"
                            data-serviceman-reassign="{{$serviceman->id}}"> {{$booking->serviceman_id ? translate('Re Assign') : 'Assign'}}
                    </button>
                </div>
            </div>
        @endforeach
    </div>

</div>
