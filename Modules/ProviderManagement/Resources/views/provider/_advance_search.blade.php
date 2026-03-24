<div id="searchLoaderOverlay" class="search-loader-overlay d-none">
    <div class="loader-spinner"></div>
</div>

<div class="fs-14 fw-medium text-center text-body-light mb-3">
    @if ($recent)
        {{ translate('Recent_Search') }}
    @else
        {{ translate('Search_Result') }}
    @endif
</div>

<div class="search-list d-flex flex-column gap-2 w-100">
    @if (count($result) > 0)
            <?php
            function highlightKeyword($text, $keyword)
            {
                $escapedKeyword = preg_quote($keyword, '/');
                return preg_replace("/($escapedKeyword)/i", '<mark>$1</mark>', $text);
            }
            ?>

        @foreach ($result as $groupKey => $routes)
            <h6 class="fs-14 fw-bold text-body-light mt-3 mb-2">
                {{ ucfirst(translate($groupKey)) }}
            </h6>

            @foreach ($routes as $key => $item)
                @php
                    $provider = \Modules\ProviderManagement\Entities\Provider::where('user_id', auth()->user()->id)->first();
                    $providerId = $provider->id;
                    $subscriptionDetails = \Modules\BusinessSettingsModule\Entities\PackageSubscriber::where('provider_id', $providerId)->first();

                    if ($subscriptionDetails && $item['uri'] == 'provider/account-info?page_type=commission-info') continue;

                    $title = str_replace('_', ' ', $item['page_title_value']);
                    $title = str_replace('_', ' ', $item['page_title_value']);
                    $title = str_replace(',', '', $title);
                    $title = str_replace(':', '', $title);
                    $highlightedTitle = $keyword ? highlightKeyword($title, $keyword): $title;
                    $highlightedUri = $keyword? highlightKeyword($item['uri'], $keyword): $item['uri'];
                @endphp

                <form action="{{ route('provider.search.routing.store') }}" method="POST" class="w-100 d-block">
                    @csrf
                    <input type="hidden" name="page_title_value" value="{{ $item['page_title_value']?? $item['page_title'] }}">
                    <input type="hidden" name="uri" value="{{ $item['uri'] }}">
                    <input type="hidden" name="route_full_url" value="{{ url($item['full_route']) }}">
                    <input type="hidden" name="keyword" value="{{ $keyword }}">
                    <input type="hidden" name="response" value="{{ json_encode($item) }}">

                    <button type="submit"
                            class="w-100 btn bg-white border overflow-hidden text-nowrap text-truncate rounded-3 shadow-sm p-3 text-start d-flex align-items-center justify-content-between">
                        <span class="d-flex flex-column me-3 flex-grow-1 overflow-hidden">
                            <span class="fw-medium text-dark line-limit-1 text-wrap" style="font-size:14px;">{!! $highlightedTitle !!}</span>
                            <span class="text-muted mt-3 line-limit-1 text-wrap"
                                  style="font-size:12px;">
                                {!! $highlightedUri !!}
                            </span>
                        </span>
                    </button>

                </form>
            @endforeach
        @endforeach
    @else
        <div class="d-flex flex-column gap-3 align-items-center justify-content-center min-h-300 rounded text-body-light py-5 w-100">
            <span class="fs-16 fw-medium">{{ translate('No_result_found') }}</span>
        </div>
    @endif
</div>
