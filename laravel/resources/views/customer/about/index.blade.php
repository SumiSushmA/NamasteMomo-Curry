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
    $mapUrl = 'https://maps.google.com/?q=' . urlencode(($site['address'] ?? '6211 Evergreen Way') . ', ' . ($site['city'] ?? 'Everett, WA 98203'));
@endphp

<div class="abt">

    <header class="abt-opening">
        <span class="abt-opening__side">{{ \App\Support\SiteContent::text('About eyebrow', 'Everett, WA') }}</span>
        <div class="abt-opening__copy">
            <span class="abt-opening__tag">{{ \App\Support\SiteContent::text('About tag', 'About us') }}</span>
            <h1 class="abt-opening__title">
                {{ \App\Support\SiteContent::text('About title line 1', 'Namaste MoMo') }}
                <em>{{ \App\Support\SiteContent::text('About title line 2', '& curry house') }}</em>
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
                <strong>{{ \App\Support\SiteContent::text('About caption title', 'On Evergreen Way') }}</strong>
                {{ \App\Support\SiteContent::text('About caption text', 'Open Tue–Sun, 11 AM – 9 PM. Closed Mondays.') }}
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
                <h2>{{ \App\Support\SiteContent::text('About journey title', 'Our kitchen story') }}</h2>
                <p>{{ \App\Support\SiteContent::text('About journey lead', 'From the first fold to the plate in front of you.') }}</p>
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
                <h2>{{ \App\Support\SiteContent::text('About values title', 'What we believe') }}</h2>
                <p>{{ \App\Support\SiteContent::text('About values lead', 'The standards behind every momo basket and curry bowl.') }}</p>
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

    {{-- Team section hidden for now — re-enable when team photos are ready --}}
    @if(false && count($about['team']))
        <section class="abt-team">
            <div class="abt-team__inner">
                <h2 class="abt-team__heading">{{ \App\Support\SiteContent::text('About team title', 'The people in our kitchen') }}</h2>
                <p class="abt-team__desc">{{ \App\Support\SiteContent::text('About team lead', 'Chefs, tandoor, and the team that greets you at the door.') }}</p>
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
                <h2 id="abt-locate-title">{{ \App\Support\SiteContent::text('About locate title', 'Visit us in Everett') }}</h2>
            </header>
            <div class="abt-locate__grid">
                <article class="abt-locate__card">
                    <div class="abt-locate__icon" aria-hidden="true">
                        <x-icon name="pin" :size="22" />
                    </div>
                    <h3>Address</h3>
                    <p>{{ $site['address'] ?? '6211 Evergreen Way' }}<br>{{ $site['city'] ?? 'Everett, WA 98203' }}</p>
                    <a href="{{ $mapUrl }}" target="_blank" rel="noopener" class="abt-locate__link">Open in Maps →</a>
                </article>
                <article class="abt-locate__card">
                    <div class="abt-locate__icon" aria-hidden="true">
                        <x-icon name="clock" :size="22" />
                    </div>
                    <h3>Hours</h3>
                    <p>{{ $site['hours'] ?? 'Tue–Sun · 11:00 AM – 9:00 PM' }}</p>
                    <p class="abt-locate__note">{{ $site['closed_days'] ?? 'Closed Mondays' }}</p>
                </article>
                <article class="abt-locate__card">
                    <div class="abt-locate__icon" aria-hidden="true">
                        <x-icon name="phone" :size="22" />
                    </div>
                    <h3>Contact us</h3>
                    <p><a href="tel:{{ preg_replace('/\D/', '', $site['phone'] ?? '') }}" class="abt-locate__phone">{{ $site['phone'] ?? '(253) 420-5566' }}</a></p>
                    <p><a href="mailto:{{ $site['email'] ?? 'Namastemomo6211@gmail.com' }}" class="abt-locate__phone">{{ $site['email'] ?? 'Namastemomo6211@gmail.com' }}</a></p>
                    <a href="{{ route('contact') }}" class="abt-locate__link">Contact page →</a>
                </article>
            </div>
        </div>
    </section>

</div>
@endsection
