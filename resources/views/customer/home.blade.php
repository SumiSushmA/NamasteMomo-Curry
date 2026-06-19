@extends('layouts.customer')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/home.css">
@endpush

@push('scripts')
    <script src="/js/home.js" defer></script>
@endpush

@section('content')

@php
    use App\Support\SiteContent;
    $marquee = SiteContent::text('Marquee text', 'Namaste MoMo & curry house · Indian & Nepali · Seattle · Momo & Curry · Himalayan flavors ·');
    $restaurantName = $site['restaurant_name'] ?? 'Namaste MoMo & curry house';
    $journeyTitle = SiteContent::text('Home journey title', 'Around Seattle, one plate at a time.');
    $stat1 = SiteContent::stat('Home journey stat 1', '20+', 'Momo styles');
    $stat2 = SiteContent::stat('Home journey stat 2', '4.9', 'Guest rating');
    $stat3 = SiteContent::stat('Home journey stat 3', '30 min', 'Pickup ready');
    $storyBullets = SiteContent::lines('Home story bullets', "Fresh momo made daily\nSmall-batch curry bases\nWarm family-style service");
    $tandoorTags = SiteContent::lines('Home tandoor tags', "Clay oven roasted\nHand-cut marination\nServed sizzling");
@endphp

<div class="gem">

    {{-- Fullscreen hero --}}
    <section class="gem-hero">
        <div class="gem-hero__bg" data-parallax style="background-image:url('{{ $heroImage }}')"></div>
        <div class="gem-hero__veil"></div>
        <div class="gem-hero__body">
            <h1 class="gem-hero__title gem-reveal" data-reveal>{{ $restaurantName }}.</h1>
            <p class="gem-hero__lead gem-reveal gem-reveal--delay-1" data-reveal>{{ SiteContent::text('Hero subtext', $content['Hero subtext'] ?? '') }}</p>
        </div>
    </section>

    {{-- Ticker --}}
    <div class="gem-ticker" aria-hidden="true">
        <div class="gem-ticker__track">
            @for($i = 0; $i < 4; $i++)
                <span>{{ $marquee }}</span>
            @endfor
        </div>
    </div>

    {{-- Story --}}
    <section class="gem-section gem-section--intro" id="story">
        <div class="gem-container gem-intro">
            <div class="gem-intro__copy">
                <p class="gem-eyebrow gem-reveal" data-reveal>{{ SiteContent::text('Home story eyebrow', 'Our story') }}</p>
                <h2 class="gem-display gem-reveal" data-reveal>{{ SiteContent::text('Home story title', $content['Home story title'] ?? '') }}</h2>
                <p class="gem-lead gem-reveal gem-reveal--delay-1" data-reveal>{{ SiteContent::text('Home story text', $content['Home story text'] ?? '') }}</p>
                <div class="gem-intro__points gem-reveal gem-reveal--delay-2" data-reveal>
                    @foreach($storyBullets as $bullet)
                        <span>{{ $bullet }}</span>
                    @endforeach
                </div>
            </div>
            <div class="gem-intro__media gem-reveal gem-reveal--delay-1" data-reveal>
                <img src="{{ SiteContent::image('Home story image', 'momo') }}" alt="Fresh momo platter">
                <div class="gem-intro__stamp">
                    <strong>{{ SiteContent::text('Home story stamp title', 'Since day one') }}</strong>
                    <p>{{ SiteContent::text('Home story stamp text', 'Indian & Nepali kitchen') }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="gem-ticker gem-ticker--alt" aria-hidden="true">
        <div class="gem-ticker__track gem-ticker__track--reverse">
            @for($i = 0; $i < 4; $i++)
                <span>{{ $marquee }}</span>
            @endfor
        </div>
    </div>

    {{-- Journey / menu --}}
    <section class="gem-section gem-section--journey">
        <div class="gem-container">
            <div class="gem-journey">
                <div class="gem-journey__copy gem-reveal" data-reveal>
                    <p class="gem-eyebrow">{{ SiteContent::text('Home journey eyebrow', 'Our menu') }}</p>
                    <h2 class="gem-display">{!! str_replace(', ', ',<br>', e($journeyTitle)) !!}</h2>
                    <p class="gem-body">{{ SiteContent::text('Hero headline', $content['Hero headline'] ?? '') }}</p>
                    <div class="gem-journey__stats">
                        <div class="gem-journey__stat">
                            <strong>{{ $stat1['value'] }}</strong>
                            <span>{{ $stat1['label'] }}</span>
                        </div>
                        <div class="gem-journey__stat">
                            <strong>{{ $stat2['value'] }}</strong>
                            <span>{{ $stat2['label'] }}</span>
                        </div>
                        <div class="gem-journey__stat">
                            <strong>{{ $stat3['value'] }}</strong>
                            <span>{{ $stat3['label'] }}</span>
                        </div>
                    </div>
                    <a href="{{ route('menu') }}" class="gem-cta">View our menu</a>
                </div>
                <div class="gem-journey__visual gem-reveal gem-reveal--delay-1" data-reveal>
                    <div class="gem-collage">
                        <div class="gem-collage__main">
                            <img src="{{ SiteContent::image('Home journey image main', 'jhol momo') }}" alt="Jhol momo">
                            <span class="gem-collage__label">Jhol momo</span>
                        </div>
                        <div class="gem-collage__stack">
                            <div class="gem-collage__tile">
                                <img src="{{ SiteContent::image('Home journey image 2', 'tandoori') }}" alt="Tandoori">
                                <span class="gem-collage__label">Tandoori</span>
                            </div>
                            <div class="gem-collage__tile">
                                <img src="{{ SiteContent::image('Home journey image 3', 'biryani') }}" alt="Biryani">
                                <span class="gem-collage__label">Biryani</span>
                            </div>
                        </div>
                    </div>
                    <div class="gem-journey__badge" aria-hidden="true">
                        <span class="gem-journey__badge-mark">◆</span>
                        <p>{{ SiteContent::text('Home journey badge', 'Hand-pleated fresh daily') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Signature dishes --}}
    <section class="gem-section gem-section--signatures">
        <div class="gem-container">
            <div class="gem-row gem-reveal" data-reveal>
                <div>
                    <p class="gem-eyebrow">{{ SiteContent::text('Home signatures eyebrow', 'Signature dishes') }}</p>
                    <h2 class="gem-display">{{ SiteContent::text('Home signatures title', $content['Home signatures title'] ?? 'Guest favorites') }}</h2>
                </div>
                <a href="{{ route('menu') }}" class="gem-cta">See full menu</a>
            </div>

            <div class="gem-signatures__viewport" id="gem-signatures-viewport">
                <div class="gem-signatures__fade gem-signatures__fade--right" id="gem-signatures-fade-right" aria-hidden="true"></div>
                <div class="gem-signatures__track" id="gem-signatures-track">
                @foreach($popularItems as $item)
                    @php $img = \App\Support\StockImages::resolve($item['img'] ?? $item['name'] ?? '', $item['image_path'] ?? null); @endphp
                    <a href="{{ route('menu', ['q' => $item['name']]) }}" class="gem-sig-card gem-reveal" data-reveal>
                        <div class="gem-sig-card__media">
                            <img src="{{ $img }}" alt="{{ $item['name'] }}" loading="lazy">
                            @if(!empty($item['popular']))
                                <span class="gem-sig-card__badge">Most loved</span>
                            @endif
                        </div>
                        <div class="gem-sig-card__body">
                            <h3>{{ $item['name'] }}</h3>
                            <p>{{ Str::limit($item['desc'] ?? '', 90) }}</p>
                            <span class="gem-sig-card__price">${{ number_format((float) $item['price'], 0) }}</span>
                        </div>
                    </a>
                @endforeach
                </div>
            </div>
            <p class="gem-signatures__hint" id="gem-signatures-hint">
                <span class="gem-signatures__hint-arrows" aria-hidden="true">→</span>
                Scroll for more
            </p>
        </div>
    </section>

    {{-- Tandoor feature --}}
    <section class="gem-band">
        <img src="{{ SiteContent::image('Home tandoor image', 'tandoori') }}" alt="Tandoor">
        <div class="gem-band__veil"></div>
        <div class="gem-band__inner">
            <div class="gem-band__copy gem-band__copy--hero gem-reveal" data-reveal>
                <p class="gem-eyebrow gem-eyebrow--light">{{ SiteContent::text('Home tandoor eyebrow', 'Charcoal-fired signature') }}</p>
                <h2 class="gem-display gem-band__title">{{ SiteContent::text('Home tandoori title', $content['Home tandoori title'] ?? '') }}</h2>
                <p class="gem-band__lead">{{ SiteContent::text('Home tandoor text', '') }}</p>
                <div class="gem-band__meta">
                    @foreach($tandoorTags as $tag)
                        <span>{{ $tag }}</span>
                    @endforeach
                </div>
                <div class="gem-band__actions gem-reveal gem-reveal--delay-1" data-reveal>
                    <a href="{{ route('menu') }}" class="gem-btn">Explore tandoori</a>
                    <a href="{{ route('menu') }}" class="gem-btn gem-btn--ghost">Order online</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Visit — reserve & catering cards --}}
    <section class="gem-section">
        <div class="gem-container">
            <h2 class="gem-display gem-display--center gem-reveal" data-reveal>{{ SiteContent::text('Home reserve title', $content['Home reserve title'] ?? '') }}</h2>
            <p class="gem-lead gem-lead--center gem-reveal gem-reveal--delay-1" data-reveal>{{ SiteContent::text('Delivery blurb', $content['Delivery blurb'] ?? '') }}</p>
            <div class="gem-cards">
                <a href="{{ route('reserve') }}" class="gem-card gem-reveal" data-reveal>
                    <div class="gem-card__img">
                        <img src="{{ SiteContent::image('Home reserve image', 'dining room') }}" alt="Dining room">
                    </div>
                    <div class="gem-card__body">
                        <h3>{{ SiteContent::text('Home reserve card title', 'Reserve a table') }}</h3>
                        <p>{{ SiteContent::text('Home reserve text', $content['Home reserve text'] ?? '') }}</p>
                        <span class="gem-card__link">Read more</span>
                    </div>
                </a>
                <a href="{{ route('catering') }}" class="gem-card gem-reveal gem-reveal--delay-1" data-reveal>
                    <div class="gem-card__img">
                        <img src="{{ SiteContent::image('Home catering image', 'catering spread') }}" alt="Catering">
                    </div>
                    <div class="gem-card__body">
                        <h3>{{ SiteContent::text('Home catering card title', 'Catering & events') }}</h3>
                        <p>{{ SiteContent::text('Catering blurb', $content['Catering blurb'] ?? '') }}</p>
                        <span class="gem-card__link">Read more</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- Gallery strip --}}
    <section class="gem-section gem-section--tight">
        <div class="gem-container">
            <div class="gem-row">
                <div class="gem-reveal" data-reveal>
                    <p class="gem-eyebrow">{{ SiteContent::text('Home gallery eyebrow', $content['Home gallery eyebrow'] ?? '') }}</p>
                    <h2 class="gem-display">{{ SiteContent::text('Home gallery title', $content['Home gallery title'] ?? '') }}</h2>
                </div>
                <a href="{{ route('gallery') }}" class="gem-cta gem-reveal gem-reveal--delay-1" data-reveal>Full gallery</a>
            </div>
            <div class="gem-gallery">
            @foreach($galleryPreview as $g)
                <a href="{{ route('gallery') }}" class="gem-gallery__item">
                    <img src="{{ $g['url'] }}" alt="{{ $g['label'] }}" loading="lazy">
                </a>
            @endforeach
            </div>
        </div>
    </section>

    <div class="gem-ticker" aria-hidden="true">
        <div class="gem-ticker__track">
            @for($i = 0; $i < 4; $i++)
                <span>{{ $marquee }}</span>
            @endfor
        </div>
    </div>

    {{-- Reviews --}}
    <section class="gem-section">
        <div class="gem-container">
            <p class="gem-eyebrow gem-eyebrow--center">{{ SiteContent::text('Home reviews eyebrow', $content['Home reviews eyebrow'] ?? '') }}</p>
            <h2 class="gem-display gem-display--center gem-reveal" data-reveal>{{ SiteContent::text('Home reviews title', $content['Home reviews title'] ?? '') }}</h2>
            <div class="gem-reviews">
                @foreach(array_slice($reviews, 0, 3) as $review)
                    <blockquote class="gem-quote gem-reveal" data-reveal>
                        <div class="gem-quote__mark" aria-hidden="true">"</div>
                        <p class="gem-quote__text">{{ $review['text'] }}</p>
                        <footer class="gem-quote__foot">
                            <div>
                                <strong>{{ $review['name'] }}</strong>
                                <span>{{ $review['tag'] }}</span>
                            </div>
                            <x-stars :value="$review['stars']" :size="12" />
                        </footer>
                    </blockquote>
                @endforeach
            </div>
        </div>
    </section>

</div>

@endsection
