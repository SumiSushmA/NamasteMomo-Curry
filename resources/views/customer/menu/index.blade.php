@extends('layouts.customer')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/menu.css">
@endpush

@push('scripts')
    <script src="/js/home.js" defer></script>
@endpush

@section('content')
<div class="menu-page gem">
    <section class="gem-hero menu-hero--compact">
        <div class="gem-hero__bg" data-parallax style="background-image:url('{{ $heroImage }}')"></div>
        <div class="gem-hero__veil"></div>
        <div class="gem-hero__body">
            <p class="gem-eyebrow gem-eyebrow--light gem-reveal" data-reveal>{{ \App\Support\SiteContent::text('Menu hero eyebrow', 'Menu & online ordering') }}</p>
            <h1 class="gem-hero__title gem-reveal" data-reveal>{{ \App\Support\SiteContent::text('Menu hero title', 'Order from our kitchen.') }}</h1>
            <p class="gem-hero__lead gem-reveal gem-reveal--delay-1" data-reveal>{{ \App\Support\SiteContent::text('Menu hero lead', '') }}</p>
        </div>
    </section>

    <div class="menu-layout menu-wrap">
        <aside class="menu-sidebar">
            <form method="GET" action="{{ route('menu') }}" class="menu-filter-panel" id="menu-filter-form">
                <input type="hidden" name="mode" value="{{ $mode }}" id="menu-mode-input">
                @if($vegOnly)<input type="hidden" name="veg" value="1">@endif

                <p class="menu-filter-label">Order type</p>
                <div class="menu-mode menu-mode--stack">
                    @foreach(['delivery', 'pickup'] as $m)
                        <button type="button" data-mode="{{ $m }}" class="menu-mode-btn {{ $mode === $m ? 'is-active' : '' }}">
                            <x-icon :name="$m === 'delivery' ? 'truck' : 'bag'" :size="16" /> {{ ucfirst($m) }}
                        </button>
                    @endforeach
                </div>

                <p class="menu-filter-label">Search</p>
                <div class="menu-search menu-search--panel">
                    <x-icon name="search" :size="18" color="var(--muted)" />
                    <input type="search" name="q" value="{{ $query }}" placeholder="Search dishes...">
                </div>

                <div class="menu-actions menu-actions--panel">
                    @if($vegOnly)
                        <a href="{{ route('menu', array_filter(['q' => $query, 'mode' => $mode])) }}" class="menu-veg is-active">
                            <x-icon name="veg" :size="14" color="var(--leaf-500)" /> Veg only
                        </a>
                    @else
                        <a href="{{ route('menu', array_filter(['q' => $query, 'mode' => $mode, 'veg' => 1])) }}" class="menu-veg">
                            <x-icon name="veg" :size="14" color="var(--leaf-500)" /> Veg only
                        </a>
                    @endif
                    <button type="submit" class="btn btn-gold btn-sm menu-filter-submit">Search</button>
                </div>

                <p class="menu-filter-label">Categories</p>
                <nav class="menu-cats menu-cats--panel" aria-label="Menu categories">
                    @foreach($categories as $cat)
                        <a href="#cat-{{ $cat['id'] }}" class="menu-cat-chip">{{ $cat['name'] }}</a>
                    @endforeach
                </nav>
            </form>
        </aside>

        <div class="menu-content" id="menu-scroll-panel">
            <section class="menu-sections">
            @foreach($categories as $cat)
                @php $catItems = array_filter($items, fn($i) => $i['cat'] === $cat['id']); @endphp
                @if(count($catItems))
                    <section id="cat-{{ $cat['id'] }}" class="menu-section">
                        <header class="menu-section-head">
                            <div>
                                <h2>{{ $cat['name'] }}</h2>
                                <p>{{ $cat['desc'] }}</p>
                            </div>
                            <span class="menu-tag">{{ $cat['tag'] }}</span>
                        </header>

                        <div class="menu-grid">
                            @foreach($catItems as $it)
                                <article class="menu-tile">
                                    <div class="menu-tile__media">
                                        <x-food-image :item="$it" :h="220" :w="420" :r="14" class="menu-tile__img" />
                                        <span class="menu-price menu-price--float">${{ $it['price'] }}</span>
                                        @if(!empty($it['popular']))
                                            <span class="menu-popular menu-popular--float">Most loved</span>
                                        @endif
                                    </div>
                                    <div class="menu-tile__body">
                                        <h3>
                                            @if($it['veg'])<x-icon name="veg" :size="12" color="var(--leaf-500)" />@endif
                                            {{ $it['name'] }}
                                            @if(($it['spice'] ?? 0) > 1)
                                                @for($s = 0; $s < $it['spice']; $s++)<x-icon name="flame" :size="11" color="var(--spice-500)" />@endfor
                                            @endif
                                        </h3>
                                        <p class="menu-desc">{{ $it['desc'] }}</p>
                                        <div class="menu-item-actions">
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="item_id" value="{{ $it['id'] }}">
                                                <button type="submit" class="btn btn-gold btn-sm"><x-icon name="plus" :size="15" /> Add to order</button>
                                            </form>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endif
            @endforeach
            </section>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
  const form = document.getElementById('menu-filter-form');
  const scrollPanel = document.getElementById('menu-scroll-panel');

  document.querySelectorAll('.menu-mode-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.getElementById('menu-mode-input').value = btn.dataset.mode;
      form.submit();
    });
  });

  document.querySelectorAll('.menu-cat-chip[href^="#"]').forEach(link => {
    link.addEventListener('click', (event) => {
      const id = link.getAttribute('href').slice(1);
      const target = document.getElementById(id);
      if (!target || !scrollPanel) return;

      event.preventDefault();
      const offset = target.getBoundingClientRect().top - scrollPanel.getBoundingClientRect().top + scrollPanel.scrollTop - 12;
      scrollPanel.scrollTo({ top: offset, behavior: 'smooth' });
    });
  });
})();
</script>
@endpush
