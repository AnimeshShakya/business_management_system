@extends('adminmodule::layouts.new-master')

@section('title',translate('page_setup'))

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="mb-20">
                <div>
                    <h2 class="page-title mb-2">{{translate('View Business Page')}}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                     <div class="tab-content">
                        <div class="tab-pane fade active show">
                            <div class="card">
                                <div class="card-body p-20">
                                    <section class="page-header business-page-view bg__img" data-img="{{ $page->imageFullPath }}">
                                        <h3 class="title">{{ $titles == '' ? $page->title : $titles }}</h3>
                                    </section>
                                    <div class="dynamic-page-wrapper py-5">
                                        {!! $contents == '' ? $page->content : $contents !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
            <script>
                $(window).on("load", () => {
                    var img = $(".bg__img");
                    img.css("background-image", function () {
                        var bg = "url(" + $(this).data("img") + ")";
                        var bg = `url(${$(this).data("img")})`;
                        return bg;
                    });
                });
            </script>
@endpush
