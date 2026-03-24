@extends('layouts.landing.app')

@section('title', $page->title)

@section('content')

    <div class="container pt-3">
        <section class="page-header bg__img" data-img="{{ $page->imageFullPath }}">
            <h3 class="title">{{ $page->title }}</h3>
        </section>
    </div>
    <section class="container py-5">
        <div class="dynamic-page-wrapper">
            {!! $page->content !!}
        </div>
    </section>
@endsection
