@extends('layouts.customer')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/promos.css">
@endpush

@section('content')
@php
    $featured = $promos[0] ?? null;
    $rest = array_slice($promos, 1);
@endphp

<div class="offers-page">

    <header class="offers-hero">
        <div class="offers-hero__inner">
            <div class="offers-hero__copy">
                <span class="offers-hero__eyebrow">{{ \App\Support\SiteContent::text('Promos eyebrow', 'Offers & specials') }}</span>
                @if(empty($promos))
                    <h1>Offers &amp; specials</h1>
                    <p>Limited-time deals, combo specials, and dine-in perks will appear here when they are live.</p>
                @else
                    <h1>{{ \App\Support\SiteContent::text('Promos title', 'Deals going on now') }}</h1>
                    <p>{{ \App\Support\SiteContent::text('Promos subtitle', '') }}</p>
                @endif
            </div>
            @if(count($promos))
                <div class="offers-hero__badge" aria-hidden="true">
                    <strong>{{ count($promos) }}</strong>
                    <span>{{ count($promos) === 1 ? 'active offer' : 'active offers' }}</span>
                </div>
            @endif
        </div>
    </header>

    <div class="offers-body">
        @if(session('error'))
            <div class="offers-alert" role="alert">{{ session('error') }}</div>
        @endif

        @if(empty($promos))
            <div class="offers-empty">
                <x-icon name="tag" :size="40" color="var(--offers-muted)" />
                <h2>No offers right now</h2>
                <p>When we run a promotion, you will see it here. In the meantime, browse the full menu or sign up below to hear about future deals.</p>
                <a href="{{ route('menu') }}" class="offers-btn offers-btn--primary">Browse menu</a>
            </div>
        @else
            <div class="offers-grid">
                @if($featured)
                    @include('customer.promos.partials.deal-card', ['p' => $featured, 'featured' => true])
                @endif
                @foreach($rest as $p)
                    @include('customer.promos.partials.deal-card', ['p' => $p, 'featured' => false])
                @endforeach
            </div>
        @endif

        <aside class="offers-newsletter">
            <div class="offers-newsletter__copy">
                <h2>{{ \App\Support\SiteContent::text('Promos newsletter title', 'Join the table') }}</h2>
                <p>{{ \App\Support\SiteContent::text('Promos newsletter text', '') }}</p>
            </div>
            <form action="{{ route('newsletter.store') }}" method="POST" class="offers-newsletter__form">
                @csrf
                <div class="offers-newsletter__field">
                    <input class="offers-newsletter__input" name="email" placeholder="you@email.com" type="email" required value="{{ old('email') }}">
                    <button type="submit" class="offers-btn offers-btn--subscribe">Subscribe</button>
                </div>
            </form>
        </aside>
    </div>
</div>
@endsection
