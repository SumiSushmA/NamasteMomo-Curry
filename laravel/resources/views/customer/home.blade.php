@extends('layouts.customer')

@push('styles')
    <link rel="stylesheet" href="/css/home.css">
@endpush

@push('scripts')
    <script src="/js/home.js" defer></script>
@endpush

@section('content')

@php
    use App\Support\SiteContent;
    $marquee = SiteContent::text('Marquee text', 'Namaste MoMo & curry house · 6211 Evergreen Way · Steamed · Fried · Jhol momo · Open Tue–Sun 11AM–9PM ·');
    $restaurantName = $site['restaurant_name'] ?? 'Namaste MoMo & curry house';
    $heroTitleLine1 = preg_replace('/\s+house$/i', '', $restaurantName);
    $heroTitleSplit = (bool) preg_match('/\s+house$/i', $restaurantName);
    $journeyTitle = SiteContent::text('Home journey title', 'Momo, curry, tandoor — and more.');
    $journeyTitleParts = preg_split('/,\s*/', $journeyTitle, 3);
    if (count($journeyTitleParts) >= 3) {
        $journeyTitleHtml = e($journeyTitleParts[0].', '.$journeyTitleParts[1].',').'<br>'.e($journeyTitleParts[2]);
    } else {
        $journeyTitleHtml = str_replace(', ', ',<br>', e($journeyTitle));
    }
    $stat2 = SiteContent::stat('Home journey stat 2', '11–9', 'Open Tue–Sun');
    $stat3 = SiteContent::stat('Home journey stat 3', '30 min', 'Avg. pickup time');
    $storyBullets = SiteContent::lines('Home story bullets', "Hand-folded momo every day\nCurries made to order\nDine in, pickup & delivery");
    $tandoorTags = SiteContent::lines('Home tandoor tags', "Yogurt-marinated\nHigh-heat roasted\nServed with chutney");
@endphp

<div class="gem">

    {{-- Fullscreen hero --}}
    <section class="gem-hero">
        <div class="gem-hero__bg" data-parallax style="background-image:url('{{ $heroImage }}')"></div>
        <div class="gem-hero__veil"></div>
        <div class="gem-hero__body">
            <h1 class="gem-hero__title gem-reveal" data-reveal>
                @if($heroTitleSplit)
                    {{ $heroTitleLine1 }}<br>house.
                @else
                    {{ $restaurantName }}.
                @endif
            </h1>
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
                <p class="gem-eyebrow gem-reveal" data-reveal>{{ SiteContent::text('Home story eyebrow', 'Welcome to Everett') }}</p>
                <h2 class="gem-display gem-reveal" data-reveal>{{ SiteContent::text('Home story title', $content['Home story title'] ?? '') }}</h2>
                <p class="gem-lead gem-reveal gem-reveal--delay-1" data-reveal>{{ SiteContent::text('Home story text', $content['Home story text'] ?? '') }}</p>
                <div class="gem-intro__points gem-reveal gem-reveal--delay-2" data-reveal>
                    @foreach($storyBullets as $bullet)
                        <span>{{ $bullet }}</span>
                    @endforeach
                </div>
            </div>
            <div class="gem-intro__media gem-reveal gem-reveal--delay-1" data-reveal>
                @php $storyDish = \App\Support\StockImages::sectionDishName('Home story image'); @endphp
                <img src="{{ SiteContent::image('Home story image', 'momo') }}" alt="{{ $storyDish }}">
                <div class="gem-intro__stamp">
                    <strong>{{ SiteContent::text('Home story stamp title', 'Everett, WA') }}</strong>
                    <p>{{ SiteContent::text('Home story stamp text', '6211 Evergreen Way') }}</p>
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
                    <p class="gem-eyebrow">{{ SiteContent::text('Home journey eyebrow', 'What we serve') }}</p>
                    <h2 class="gem-display">{!! $journeyTitleHtml !!}</h2>
                    <p class="gem-body">{{ SiteContent::text('Hero headline', $content['Hero headline'] ?? '') }}</p>
                    <div class="gem-journey__stats">
                        <div class="gem-journey__stat">
                            <strong>{{ $stat2['value'] }}</strong>
                            <span>{{ $stat2['label'] }}</span>
                        </div>
                        <div class="gem-journey__stat">
                            <strong>{{ $stat3['value'] }}</strong>
                            <span>{{ $stat3['label'] }}</span>
                        </div>
                    </div>
                    <a href="{{ route('menu') }}" class="gem-cta gem-journey__cta">View our menu</a>
                </div>
                <div class="gem-journey__visual gem-reveal gem-reveal--delay-1" data-reveal>
                    @php
                        $journeyMain = \App\Support\StockImages::sectionDishName('Home journey image main');
                        $journeyTwo = \App\Support\StockImages::sectionDishName('Home journey image 2');
                        $journeyThree = \App\Support\StockImages::sectionDishName('Home journey image 3');
                        $journeyBadge = SiteContent::text('Home journey badge', 'Folded fresh, never frozen');
                    @endphp
                    <div class="gem-collage">
                        <div class="gem-collage__main">
                            <img src="{{ SiteContent::image('Home journey image main', 'assorted momo platter') }}" alt="{{ $journeyMain }}">
                            <span class="gem-collage__label">{{ $journeyBadge }}</span>
                        </div>
                        <div class="gem-collage__stack">
                            <div class="gem-collage__tile">
                                <img src="{{ SiteContent::image('Home journey image 2', 'samosa chaat') }}" alt="{{ $journeyTwo }}">
                                <span class="gem-collage__label">{{ $journeyTwo }}</span>
                            </div>
                            <div class="gem-collage__tile">
                                <img src="{{ SiteContent::image('Home journey image 3', 'chicken pakora') }}" alt="{{ $journeyThree }}">
                                <span class="gem-collage__label">{{ $journeyThree }}</span>
                            </div>
                        </div>
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
                    <p class="gem-eyebrow">{{ SiteContent::text('Home signatures eyebrow', 'Start here') }}</p>
                    <h2 class="gem-display">{{ SiteContent::text('Home signatures title', $content['Home signatures title'] ?? 'Dishes our guests order first') }}</h2>
                </div>
                <a href="{{ route('menu') }}" class="gem-cta">See full menu</a>
            </div>

            <div class="gem-signatures__viewport" id="gem-signatures-viewport">
                <div class="gem-signatures__fade gem-signatures__fade--right" id="gem-signatures-fade-right" aria-hidden="true"></div>
                <div class="gem-signatures__track" id="gem-signatures-track">
                @foreach($popularItems as $item)
                    @php $img = \App\Support\StockImages::resolve($item['img'] ?? $item['name'] ?? '', $item['image_path'] ?? null, $item['toast_image_url'] ?? null); @endphp
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
                            <span class="gem-sig-card__price">${{ \App\Support\MenuPrice::format($item['price']) }}</span>
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
    @php $tandoorDish = \App\Support\StockImages::sectionDishName('Home tandoor image'); @endphp
    <section class="gem-band">
        <img src="{{ SiteContent::image('Home tandoor image', 'naan') }}" alt="{{ $tandoorDish }}">
        <div class="gem-band__veil"></div>
        <div class="gem-band__inner">
            <div class="gem-band__copy gem-band__copy--hero gem-reveal" data-reveal>
                <div class="gem-band__head">
                    <p class="gem-eyebrow">{{ SiteContent::text('Home tandoor eyebrow', 'Clay oven') }}</p>
                    <h2 class="gem-display">{{ SiteContent::text('Home tandoori title', 'Fresh naan from the tandoor') }}</h2>
                </div>
                <div class="gem-band__meta">
                    @foreach($tandoorTags as $tag)
                        <span>{{ $tag }}</span>
                    @endforeach
                </div>
                <div class="gem-band__actions gem-reveal gem-reveal--delay-1" data-reveal>
                    <a href="{{ route('menu') }}" class="gem-btn">Explore naan & tandoori</a>
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
                <a href="{{ $toastPayment['tablesUrl'] ?? route('reserve') }}" class="gem-card gem-reveal" data-reveal>
                    @php $reserveDish = \App\Support\StockImages::sectionDishName('Home reserve image'); @endphp
                    <div class="gem-card__img">
                        <img src="{{ SiteContent::image('Home reserve image', 'restaurant') }}" alt="{{ $reserveDish }}">
                    </div>
                    <div class="gem-card__body">
                        <h3>{{ SiteContent::text('Home reserve card title', 'Dine with us') }}</h3>
                        <p>{{ SiteContent::text('Home reserve text', $content['Home reserve text'] ?? '') }}</p>
                        <span class="gem-card__link">Read more</span>
                    </div>
                </a>
                <a href="{{ $toastPayment['tablesUrl'] ?? route('catering') }}" class="gem-card gem-reveal gem-reveal--delay-1" data-reveal>
                    @php $cateringDish = \App\Support\StockImages::sectionDishName('Home catering image'); @endphp
                    <div class="gem-card__img">
                        <img src="{{ SiteContent::image('Home catering image', 'khaja set') }}" alt="{{ $cateringDish }}">
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
