@extends('layouts.customer')

@push('styles')
    <link rel="stylesheet" href="/css/contact.css">
@endpush

@section('content')
@php
    $phone = $site['phone'] ?? '(253) 420-5566';
    $email = $site['email'] ?? 'Namastemomo6211@gmail.com';
    $address = $site['address'] ?? '6211 Evergreen Way';
    $city = $site['city'] ?? 'Everett, WA 98203';
    $hours = $site['hours'] ?? 'Tue–Sun · 11:00 AM – 9:00 PM';
    $closedDays = $site['closed_days'] ?? 'Closed Mondays';
    $mapsQuery = urlencode(trim($address.', '.$city));
    $mapsLink = 'https://maps.google.com/?q='.$mapsQuery;
    $phoneTel = 'tel:'.preg_replace('/[^\d+]/', '', $phone);
@endphp

<div class="ct">

    <header class="ct-hero">
        <div class="ct-hero__inner">
            <div>
                <span class="ct-hero__eyebrow">{{ \App\Support\SiteContent::text('Contact eyebrow', 'Contact') }}</span>
                <h1>{{ \App\Support\SiteContent::text('Contact title', "We'd love to hear from you") }}</h1>
                <p class="ct-hero__lead">{{ \App\Support\SiteContent::text('Contact lead', '') }}</p>
            </div>
            <div class="ct-hero__card">
                <div class="ct-hero__card-label">Find us</div>
                <p class="ct-hero__address">
                    {{ $address }}
                    <span class="ct-hero__city">{{ $city }}</span>
                </p>
                <a href="{{ $mapsLink }}" target="_blank" rel="noopener" class="ct-hero__map-link">
                    Get directions <x-icon name="arrow" :size="14" />
                </a>
            </div>
        </div>
    </header>

    <nav class="ct-actions" aria-label="Quick contact">
        <div class="ct-actions__inner">
            <a href="{{ $mapsLink }}" target="_blank" rel="noopener" class="ct-action">
                <span class="ct-action__icon"><x-icon name="pin" :size="18" color="#fff" /></span>
                Directions
            </a>
            <a href="{{ $phoneTel }}" class="ct-action">
                <span class="ct-action__icon"><x-icon name="phone" :size="18" color="#fff" /></span>
                {{ $phone }}
            </a>
            <a href="mailto:{{ $email }}" class="ct-action">
                <span class="ct-action__icon"><x-icon name="mail" :size="18" color="#fff" /></span>
                {{ $email }}
            </a>
        </div>
    </nav>

    <div class="ct-body">
        @if($submitted)
            <div class="ct-success" role="status">
                <div class="ct-success__icon">
                    <x-icon name="check" :size="22" />
                </div>
                <div>
                    <h2>Message sent</h2>
                    <p>Thanks for reaching out — we'll get back to you soon. <a href="{{ route('account.login') }}">Sign in</a> with the same email to see our reply in your account.</p>
                </div>
            </div>
        @endif

        <div class="ct-grid">
            <div class="ct-form-wrap">
                <h2>Send a message</h2>
                <p class="ct-form-wrap__sub">Tell us what's on your mind. For large parties or catering, mention your date and guest count.</p>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="ct-fields">
                        <label class="ct-field">
                            <span>Name</span>
                            <input class="ct-inp" name="name" placeholder="Your name" required value="{{ old('name') }}">
                        </label>
                        <label class="ct-field">
                            <span>Email</span>
                            <input class="ct-inp" name="email" type="email" placeholder="you@email.com" required value="{{ old('email') }}">
                        </label>
                        <label class="ct-field">
                            <span>Topic <span style="font-weight:400;text-transform:none;letter-spacing:0">(optional)</span></span>
                            <select class="ct-inp" name="subject">
                                <option value="">General inquiry</option>
                                <option value="Reservation" @selected(old('subject') === 'Reservation')>Reservation</option>
                                <option value="Catering" @selected(old('subject') === 'Catering')>Catering</option>
                                <option value="Feedback" @selected(old('subject') === 'Feedback')>Feedback</option>
                                <option value="Other" @selected(old('subject') === 'Other')>Other</option>
                            </select>
                        </label>
                        <label class="ct-field">
                            <span>Message</span>
                            <textarea class="ct-inp ct-inp--area" name="message" placeholder="How can we help?" required>{{ old('message') }}</textarea>
                        </label>
                    </div>
                    <button type="submit" class="ct-submit">
                        <x-icon name="mail" :size="18" color="#fff" />
                        Send message
                    </button>
                </form>
            </div>

            <aside class="ct-aside">
                <div class="ct-info">
                    <h3>Hours</h3>
                    <div class="ct-hours">
                        <div class="ct-hours__row">
                            <span>Open</span>
                            <span>{{ $hours }}</span>
                        </div>
                        @if($closedDays)
                            <div class="ct-hours__row">
                                <span>Closed</span>
                                <span>{{ $closedDays }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="ct-info">
                    <h3>Call or email</h3>
                    <a href="{{ $phoneTel }}" class="ct-info__phone">{{ $phone }}</a>
                    <a href="mailto:{{ $email }}" class="ct-info__email">{{ $email }}</a>
                </div>

                <div class="ct-map">
                    <x-map-embed :h="320" :r="0" />
                </div>
            </aside>
        </div>
    </div>

</div>
@endsection
