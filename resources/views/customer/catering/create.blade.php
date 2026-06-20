@extends('layouts.customer')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/catering.css">
@endpush

@section('content')
@php
    $guestCount = max($minGuests, (int) old('guest_count', $cart['per_person']['guest_count'] ?? $minGuests));
    $oldSelections = [];
    if ($tab === 'per-person') {
        foreach ($perPerson['groups'] as $group) {
            $oldSelections[$group['id']] = old('selections.'.$group['id'], $cart['per_person']['selections'][$group['id']] ?? []);
        }
    }
    $estimatedTotal = $tab === 'per-person'
        ? \App\Data\CateringMenu::perPersonTotal($guestCount, $oldSelections)
        : $perPersonPrice * $guestCount;
    $selectionCount = $tab === 'per-person'
        ? collect($oldSelections)->flatten()->count()
        : 0;
@endphp

<div class="cater">
    {{-- Editorial masthead (not a menu-style hero) --}}
    <header class="cater-mast">
        <div class="cater-mast__copy">
            <p class="cater-kicker">{{ \App\Support\SiteContent::text('Catering hero eyebrow', 'Catering studio') }}</p>
            <h1 class="cater-title">{{ \App\Support\SiteContent::text('Catering hero title', 'Celebrate with food made to share.') }}</h1>
            <p class="cater-lead">{{ \App\Support\SiteContent::text('Catering hero lead', '') }}</p>
            <div class="cater-stats">
                <div class="cater-stat">
                    <strong>{{ $minGuests }}+</strong>
                    <span>Guest minimum</span>
                </div>
                <div class="cater-stat">
                    <strong>${{ number_format($perPersonPrice, 0) }}</strong>
                    <span>Per person</span>
                </div>
                <div class="cater-stat">
                    <strong>{{ count($trays) }}</strong>
                    <span>Tray options</span>
                </div>
            </div>
        </div>
        <div class="cater-mast__visual">
            <img src="{{ $heroImage }}" alt="Catering spread">
            <div class="cater-mast__badge">Seattle events · Family & corporate</div>
        </div>
    </header>

    @if(session('success'))
        <div class="cater-flash cater-flash--ok cater-shell">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="cater-flash cater-flash--err cater-shell">{{ session('error') }}</div>
    @endif

    {{-- Pathway picker — large visual cards, not sidebar tabs --}}
    <section class="cater-paths cater-shell">
        <a href="{{ route('catering', ['tab' => 'per-person']) }}" class="cater-path {{ $tab === 'per-person' ? 'is-active' : '' }}">
            <div class="cater-path__bg" style="background-image:url('{{ \App\Support\StockImages::forLabel('thali') }}')"></div>
            <div class="cater-path__veil"></div>
            <div class="cater-path__body">
                <span class="cater-path__tag">Custom builder</span>
                <h2>Per-person menu</h2>
                <p>Pick dishes across every category — priced at ${{ number_format($perPersonPrice, 2) }} per guest.</p>
                <span class="cater-path__cta">Build your menu →</span>
            </div>
        </a>
        <a href="{{ route('catering', ['tab' => 'trays']) }}" class="cater-path {{ $tab === 'trays' ? 'is-active' : '' }}">
            <div class="cater-path__bg" style="background-image:url('{{ \App\Support\StockImages::forLabel('catering spread') }}')"></div>
            <div class="cater-path__veil"></div>
            <div class="cater-path__body">
                <span class="cater-path__tag">Ready to serve</span>
                <h2>Tray catering</h2>
                <p>Pre-packed trays for quick ordering — samosas, momo feasts, biryani, and more.</p>
                <span class="cater-path__cta">Browse trays →</span>
            </div>
        </a>
    </section>

    @if($tab === 'per-person')
        <form action="{{ route('catering.order') }}" method="POST" id="catering-order-form">
            @csrf

            {{-- Guest stepper band --}}
            <section class="cater-guest-band">
                <div class="cater-shell cater-guest-band__inner">
                    <div>
                        <p class="cater-kicker cater-kicker--light">Step 1</p>
                        <h2 class="cater-band-title">How many guests?</h2>
                        <p class="cater-band-note">Minimum {{ $minGuests }} people required for catering orders.</p>
                    </div>
                    <div class="cater-stepper">
                        <button type="button" class="cater-stepper__btn" data-step="-1" aria-label="Fewer guests">−</button>
                        <input type="number" name="guest_count" id="catering-guest-count" class="cater-stepper__input" min="{{ $minGuests }}" value="{{ $guestCount }}" required>
                        <button type="button" class="cater-stepper__btn" data-step="1" aria-label="More guests">+</button>
                    </div>
                </div>
            </section>

            <section class="cater-builder cater-shell">
                <div class="cater-builder__intro">
                    <p class="cater-kicker">Step 2</p>
                    <h2 class="cater-section-title">Build your menu</h2>
                    <p class="cater-section-lead">Choose dishes from each category below. Your selections apply to all {{ $minGuests }}+ guests in your order.</p>
                </div>

                @if($errors->any())
                    <div class="cater-flash cater-flash--err">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="cater-split">
                    <div class="cater-split__media">
                        <img src="{{ $heroImage }}" alt="Catering spread">
                    </div>

                    <div class="cater-split__card">
                        <h3 class="cater-split__title">{{ $perPerson['title'] }}</h3>
                        <p class="cater-split__price">${{ number_format($perPersonPrice, 2) }} <span>/ person base</span></p>
                        <p class="cater-split__note">Dish prices below are per-person add-ons on top of the base rate.</p>

                        <div class="cater-groups">
                            @foreach($perPerson['groups'] as $group)
                                <details class="cater-group" open>
                                    <summary>{{ $group['label'] }}</summary>
                                    <div class="cater-group__options">
                                        @foreach($group['options'] as $option)
                                            @php
                                                $optionName = is_array($option) ? $option['name'] : $option;
                                                $optionPrice = is_array($option) ? (float) $option['price'] : 0.0;
                                                $checked = in_array($optionName, $oldSelections[$group['id']] ?? [], true);
                                            @endphp
                                            <label class="cater-dish-card {{ $checked ? 'is-selected' : '' }}">
                                                <input type="checkbox" name="selections[{{ $group['id'] }}][]" value="{{ $optionName }}" data-price="{{ number_format($optionPrice, 2, '.', '') }}" {{ $checked ? 'checked' : '' }} class="cater-option-input">
                                                <span class="cater-dish-card__mark"><x-icon name="check" :size="13" /></span>
                                                <span class="cater-dish-card__body">
                                                    <span class="cater-dish-card__name">{{ $optionName }}</span>
                                                    <span class="cater-dish-card__price">
                                                        @if($optionPrice > 0)
                                                            +${{ number_format($optionPrice, 2) }}
                                                        @else
                                                            Included
                                                        @endif
                                                    </span>
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </details>
                            @endforeach
                        </div>
                    </div>
                </div>

                <p class="cater-fine">Orders under {{ $minGuests }} guests will not be fulfilled. Need help planning? <a href="{{ route('contact') }}">Talk to our team</a>.</p>
            </section>

            <div class="cater-dock" id="cater-dock">
                <div class="cater-dock__inner cater-shell">
                    <div class="cater-dock__meta">
                        <span><strong id="catering-guest-label">{{ $guestCount }}</strong> guests</span>
                        <span><strong id="catering-pick-count">{{ $selectionCount }}</strong> dishes</span>
                        <span class="cater-dock__total">Est. <strong id="catering-total">${{ number_format($estimatedTotal, 2) }}</strong></span>
                    </div>
                    <button type="submit" class="btn btn-gold cater-dock__btn">
                        Checkout catering <x-icon name="arrow" :size="17" />
                    </button>
                </div>
            </div>
        </form>
    @else
        <section class="cater-trays cater-shell">
            <div class="cater-builder__intro">
                <p class="cater-kicker">Tray menu</p>
                <h2 class="cater-section-title">Pick your trays</h2>
                <p class="cater-section-lead">Ready-to-serve portions for offices, pujas, and celebrations. Add trays to your cart, then request a quote from our team.</p>
            </div>

            <div class="cater-tray-grid">
                @foreach($trays as $tray)
                    <article class="cater-tray-card">
                        <div class="cater-tray-card__media">
                            <img src="{{ \App\Support\StockImages::forLabel($tray['name']) }}" alt="{{ $tray['name'] }}">
                            <span class="cater-tray-card__price">${{ number_format($tray['price'], 0) }}</span>
                            <span class="cater-tray-card__serves">{{ $tray['serves'] }}</span>
                        </div>
                        <div class="cater-tray-card__body">
                            <h3>{{ $tray['name'] }}</h3>
                            <p>{{ $tray['description'] }}</p>
                            <form action="{{ route('catering.trays.add', $tray['slug']) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-gold btn-sm cater-tray-card__btn">
                                    <x-icon name="plus" :size="15" /> Add tray
                                </button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="cater-trays-cta">
                @if($toastOrderUrl = \App\Services\Toast\ToastConfiguration::onlineOrderUrl())
                    <a href="{{ route('contact') }}" class="btn btn-gold">Request catering quote <x-icon name="arrow" :size="17" /></a>
                @else
                    <a href="{{ route('checkout') }}" class="btn btn-gold">Continue to checkout <x-icon name="arrow" :size="17" /></a>
                @endif
            </div>
        </section>
    @endif
</div>
@endsection

@push('scripts')
<script>
(function () {
  const guestInput = document.getElementById('catering-guest-count');
  const guestLabel = document.getElementById('catering-guest-label');
  const totalEl = document.getElementById('catering-total');
  const pickCountEl = document.getElementById('catering-pick-count');
  const basePrice = {{ json_encode($perPersonPrice) }};
  const minGuests = {{ json_encode($minGuests) }};

  function selectedAddonTotal() {
    let addons = 0;
    document.querySelectorAll('.cater-option-input:checked').forEach((input) => {
      addons += parseFloat(input.dataset.price || '0');
    });
    return addons;
  }

  function updateTotal() {
    if (!guestInput) return;
    const guests = Math.max(minGuests, parseInt(guestInput.value || minGuests, 10));
    const perGuest = basePrice + selectedAddonTotal();
    if (guestLabel) guestLabel.textContent = guests;
    if (totalEl) totalEl.textContent = '$' + (guests * perGuest).toFixed(2);
  }

  function updatePickCount() {
    if (!pickCountEl) return;
    pickCountEl.textContent = document.querySelectorAll('.cater-option-input:checked').length;
  }

  document.querySelectorAll('.cater-stepper__btn').forEach((btn) => {
    btn.addEventListener('click', () => {
      if (!guestInput) return;
      const step = parseInt(btn.dataset.step, 10);
      const next = Math.max(minGuests, parseInt(guestInput.value || minGuests, 10) + step);
      guestInput.value = next;
      updateTotal();
    });
  });

  guestInput?.addEventListener('input', updateTotal);
  updateTotal();

  document.querySelectorAll('.cater-option-input').forEach((input) => {
    input.addEventListener('change', () => {
      input.closest('.cater-dish-card')?.classList.toggle('is-selected', input.checked);
      updatePickCount();
      updateTotal();
    });
  });
  updatePickCount();
})();
</script>
@endpush
