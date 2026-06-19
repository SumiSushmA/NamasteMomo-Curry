@php
    $accent = $p['accent'] ?? 'gold';
@endphp
<article class="offer-deal offer-deal--{{ $accent }} {{ !empty($featured) ? 'offer-deal--featured' : '' }}">
    <div class="offer-deal__stripe" aria-hidden="true"></div>
    <div class="offer-deal__inner">
        <header class="offer-deal__head">
            <div class="offer-deal__tags">
                <span class="offer-deal__badge">{{ $p['badge'] }}</span>
                <span class="offer-deal__type">{{ $p['offer_type_label'] }}</span>
            </div>
            @if($p['price'])
                <span class="offer-deal__price">{{ $p['price'] }}</span>
            @endif
        </header>

        <div class="offer-deal__media">
            <img src="{{ $p['image'] }}" alt="{{ $p['title'] }}" loading="lazy">
        </div>

        <div class="offer-deal__body">
            <h3 class="offer-deal__title">{{ $p['title'] }}</h3>
            <p class="offer-deal__detail">{{ $p['detail'] }}</p>

            <ul class="offer-deal__meta">
                @if($p['min_order_amount'])
                    <li>Minimum order: ${{ number_format($p['min_order_amount'], 0) }}</li>
                @endif
                @if($p['min_party_size'])
                    <li>For parties of {{ $p['min_party_size'] }} or more</li>
                @endif
                @if($p['starts_at'] || $p['ends_at'])
                    <li>
                        @if($p['starts_at'] && $p['ends_at'])
                            Valid {{ $p['starts_at'] }} – {{ $p['ends_at'] }}
                        @elseif($p['ends_at'])
                            Through {{ $p['ends_at'] }}
                        @else
                            Starts {{ $p['starts_at'] }}
                        @endif
                    </li>
                @endif
                @if($p['terms'])
                    <li class="offer-deal__terms">{{ $p['terms'] }}</li>
                @endif
            </ul>

            <div class="offer-deal__cta">
                @if($p['order_item'])
                    <form action="{{ route('promos.order', $p['id']) }}" method="POST">
                        @csrf
                        <button type="submit" class="offers-btn offers-btn--primary">{{ $p['cta_label'] }}</button>
                    </form>
                @else
                    <a href="{{ $p['cta_href'] }}" class="offers-btn offers-btn--primary">{{ $p['cta_label'] }}</a>
                @endif
            </div>
        </div>
    </div>
</article>
