@extends('layouts.customer')

@push('styles')
    <link rel="stylesheet" href="/css/about.css">
@endpush

@push('scripts')
    <script src="/js/about.js" defer></script>
@endpush

@section('content')
@php
    $pullQuote = $about['story'][0] ?? '';
    $storyRest = array_slice($about['story'], 1);
    $mapUrl = 'https://maps.google.com/?q=' . urlencode(($site['address'] ?? '13754 Aurora Ave N') . ', ' . ($site['city'] ?? 'Seattle, WA'));
    $teamSizes = ['lg', 'lg', 'sm', 'sm', 'sm', 'sm'];
@endphp

<div class="abt">

    <header class="abt-opening">
        <span class="abt-opening__side">{{ \App\Support\SiteContent::text('About eyebrow', 'Seattle · Indian & Nepali') }}</span>
        <div class="abt-opening__copy">
            <span class="abt-opening__tag">{{ \App\Support\SiteContent::text('About tag', 'Our story') }}</span>
            <h1 class="abt-opening__title">
                {{ \App\Support\SiteContent::text('About title line 1', 'Indian & Nepali') }}
                <em>{{ \App\Support\SiteContent::text('About title line 2', 'on Aurora Avenue') }}</em>
            </h1>
            <p class="abt-opening__lead">{{ \App\Support\SiteContent::text('About lead', '') }}</p>
            <a href="#abt-story" class="abt-opening__scroll">{{ \App\Support\SiteContent::text('About scroll CTA', 'Read our story ↓') }}</a>
        </div>
        <div class="abt-opening__visual">
            <div class="abt-opening__block" aria-hidden="true"></div>
            <div class="abt-opening__photo">
                <img src="{{ $about['hero_image'] }}" alt="Founders at the pass" loading="eager">
            </div>
            <div class="abt-opening__caption">
                <strong>Family-run kitchen</strong>
                Momo craft & curry house warmth on Aurora Avenue.
            </div>
        </div>
    </header>

    @if($pullQuote)
        <aside class="abt-pullquote" aria-label="Quote">
            <blockquote>“{{ $pullQuote }}”</blockquote>
            <cite>{{ $site['restaurant_name'] ?? 'Namaste MoMo & curry house' }}</cite>
        </aside>
    @endif

    <section class="abt-story" id="abt-story">
        <div class="abt-story__inner">
            <div class="abt-story__aside">
                <h2>The journey</h2>
                <p>From our first momo basket to every plate we serve today.</p>
            </div>
            <div class="abt-timeline">
                @foreach($storyRest as $i => $p)
                    <article class="abt-chapter">
                        <span class="abt-chapter__num">Chapter {{ str_pad($i + 2, 2, '0', STR_PAD_LEFT) }}</span>
                        <p class="abt-chapter__text">{{ $p }}</p>
                    </article>
                @endforeach
                @if(empty($storyRest))
                    @foreach($about['story'] as $i => $p)
                        @if($i > 0)
                            <article class="abt-chapter">
                                <span class="abt-chapter__num">Chapter {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <p class="abt-chapter__text">{{ $p }}</p>
                            </article>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    @if(count($about['stats']))
        <section class="abt-stats" aria-label="Restaurant highlights">
            <div class="abt-stats__grid">
                @foreach($about['stats'] as $s)
                    <div class="abt-stat">
                        <span class="abt-stat__val">{{ $s[0] }}</span>
                        <span class="abt-stat__label">{{ $s[1] }}</span>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if(count($about['values']))
        <section class="abt-values">
            <header class="abt-values__head">
                <h2>How we cook</h2>
                <p>What we stand by in the kitchen and at the table.</p>
            </header>
            @foreach($about['values'] as $i => $v)
                <article class="abt-value">
                    <span class="abt-value__num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="abt-value__body">
                        <h3>{{ $v['title'] }}</h3>
                        <p>{{ $v['text'] }}</p>
                    </div>
                    <div class="abt-value__icon" aria-hidden="true">
                        <x-icon :name="$v['icon']" :size="26" />
                    </div>
                </article>
            @endforeach
        </section>
    @endif

    @if(count($about['team']))
        <section class="abt-team">
            <div class="abt-team__inner">
                <h2 class="abt-team__heading">Meet the amazing team</h2>
                <p class="abt-team__desc">The people behind every momo basket and curry.</p>
                <div class="abt-team__mosaic">
                    @foreach($about['team'] as $i => $t)
                        @php $size = $teamSizes[$i % count($teamSizes)]; @endphp
                        <article class="abt-team-card abt-team-card--{{ $size }}">
                            <img src="{{ $t['image'] }}" alt="{{ $t['name'] }}" loading="lazy">
                            <div class="abt-team-card__meta">
                                <strong>{{ $t['name'] }}</strong>
                                <span>{{ $t['role'] }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="abt-locate" aria-labelledby="abt-locate-title">
        <div class="abt-locate__inner">
            <header class="abt-locate__head">
                <span class="abt-locate__eyebrow">Find us</span>
                <h2 id="abt-locate-title">Visit us on Aurora Avenue</h2>
            </header>
            <div class="abt-locate__grid">
                <article class="abt-locate__card">
                    <div class="abt-locate__icon" aria-hidden="true">
                        <x-icon name="pin" :size="22" />
                    </div>
                    <h3>Address</h3>
                    <p>{{ $site['address'] ?? '13754 Aurora Ave N, Suite D' }}<br>{{ $site['city'] ?? 'Seattle, WA 98133' }}</p>
                    <a href="{{ $mapUrl }}" target="_blank" rel="noopener" class="abt-locate__link">Open in Maps →</a>
                </article>
                <article class="abt-locate__card">
                    <div class="abt-locate__icon" aria-hidden="true">
                        <x-icon name="clock" :size="22" />
                    </div>
                    <h3>Hours</h3>
                    <p>{{ $site['hours'] ?? 'Daily · 10:00 AM – 9:30 PM' }}</p>
                    <p class="abt-locate__note">{{ $site['closed_days'] ?? 'Walk-ins welcome' }}</p>
                </article>
                <article class="abt-locate__card">
                    <div class="abt-locate__icon" aria-hidden="true">
                        <x-icon name="phone" :size="22" />
                    </div>
                    <h3>Call us</h3>
                    <p><a href="tel:{{ preg_replace('/\D/', '', $site['phone'] ?? '') }}" class="abt-locate__phone">{{ $site['phone'] ?? '(206) 397-3211' }}</a></p>
                    <a href="{{ route('contact') }}" class="abt-locate__link">Contact page →</a>
                </article>
            </div>
        </div>
    </section>

</div>
@endsection
