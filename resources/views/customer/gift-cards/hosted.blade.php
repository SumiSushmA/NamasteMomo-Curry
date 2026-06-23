@extends('layouts.customer')

@push('styles')
    <link rel="stylesheet" href="/css/gift-cards.css">
@endpush

@section('content')
<div class="gc-page">
    <div class="gc-shell">
        <div class="gc-success">
            <div class="gc-success__card gc-hosted">
                <h1>Gift cards</h1>
                <p class="gc-success__text">
                    Purchase eGift cards and check balances securely on Toast — our payment partner for Namaste MoMo &amp; Curry House.
                </p>
                <div class="gc-hosted__actions">
                    @if($purchaseUrl)
                        <a href="{{ $purchaseUrl }}" class="gc-submit gc-hosted__btn" target="_blank" rel="noopener noreferrer">
                            <x-icon name="tag" :size="18" color="#fff" />
                            Buy a gift card
                        </a>
                    @endif
                    @if($balanceUrl)
                        <a href="{{ $balanceUrl }}" class="gc-home-btn gc-hosted__btn gc-hosted__btn--secondary" target="_blank" rel="noopener noreferrer">
                            Check balance / add value
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
