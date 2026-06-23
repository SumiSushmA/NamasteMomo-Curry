@extends('layouts.customer')

@php
    $bodyPage = 'offline';
    $pageTitle = 'Offline';
@endphp

@push('styles')
    <link rel="stylesheet" href="/css/offline.css">
@endpush

@push('scripts')
<script>
document.getElementById('offline-retry')?.addEventListener('click', function () {
    window.location.reload();
});
window.addEventListener('online', function () {
    window.location.reload();
});
</script>
@endpush

@section('content')
<div class="off">
    <div class="off-main" role="region" aria-labelledby="offline-title">
        <div class="off-visual" aria-hidden="true">
            <x-lottie-player src="/animations/offline.lottie" class="off-lottie" />
        </div>

        <div class="off-copy">
            <span class="off-eyebrow">No connection</span>
            <h1 id="offline-title">Looks like you're <em>offline.</em></h1>
            <p>We can't reach the kitchen right now. Check your Wi‑Fi or mobile data, then try loading the page again.</p>
            <div class="off-tip">
                <strong>Tip:</strong> If you were browsing the menu, your connection dropped before the page could load.
            </div>
            <div class="off-actions">
                <button type="button" class="off-btn off-btn--primary" id="offline-retry">Try again</button>
                <a href="{{ route('home') }}" class="off-btn off-btn--ghost">Go to home</a>
            </div>
        </div>
    </div>
</div>
@endsection
