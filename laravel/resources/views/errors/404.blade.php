@extends('layouts.customer')

@php
    $bodyPage = 'error404';
    $pageTitle = 'Page not found';
@endphp

@push('styles')
    <link rel="stylesheet" href="/css/error-404.css">
@endpush

@section('content')
<div class="e404">
    <div class="e404-main" role="region" aria-labelledby="e404-title">
        <div class="e404-visual">
            <x-lottie-player src="/animations/404.lottie" class="e404-lottie" />
        </div>

        <div class="e404-copy">
            <span class="e404-eyebrow">Error 404</span>
            <h1 id="e404-title">This page isn't on <em>the menu.</em></h1>
            <p>The link may be broken, outdated, or the page may have moved. Let's get you back to something good.</p>
            <div class="e404-actions">
                <a href="{{ route('home') }}" class="e404-btn e404-btn--primary">Back to home</a>
                <a href="{{ route('menu') }}" class="e404-btn e404-btn--ghost">Browse menu</a>
            </div>
        </div>
    </div>
</div>
@endsection
