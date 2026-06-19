@extends('layouts.customer')

@push('styles')
    <link rel="stylesheet" href="/css/gift-cards.css">
@endpush

@section('content')
@if(session('gift_sent') && $purchase)
    <div class="gc-page">
        <div class="gc-success">
            <div class="gc-success__card">
                <div class="gc-success__icon">
                    <x-icon name="check" :size="32" />
                </div>
                <h1>Gift card ready</h1>
                <p class="gc-success__text">
                    @if($purchase['delivery'] === 'email')
                        A ${{ number_format($purchase['amount'], 0) }} gift card was emailed to <strong>{{ $purchase['recipient'] }}</strong>.
                    @elseif($purchase['delivery'] === 'print')
                        Save or print the code below to hand-deliver your ${{ number_format($purchase['amount'], 0) }} gift card.
                    @else
                        Your ${{ number_format($purchase['amount'], 0) }} gift card order is confirmed. Use the code below online until the physical card arrives.
                    @endif
                </p>
                <div class="gc-code-box">
                    <div class="gc-code-box__label">Gift card code</div>
                    <div class="gc-code-box__code" id="gift-success-code">{{ $purchase['code'] }}</div>
                    <button type="button" class="gc-copy-btn" id="gift-copy-code">Copy code</button>
                </div>
                <p class="gc-success__text">Enter this code at checkout. You can also check the balance on the gift cards page.</p>
                <a href="{{ route('home') }}" class="gc-home-btn">Back to home</a>
            </div>
        </div>
    </div>
@else
@php
    $defaultOccasion = $giftOccasions[0] ?? ['id' => 'just-because', 'headline' => 'Just For You'];
    $occasion = old('occasion', $defaultOccasion['id']);
    $isCustomOccasion = $occasion === 'custom';
    if ($isCustomOccasion && old('occasion_custom')) {
        $matchedOccasion = \App\Models\GiftCardOccasion::matchText(old('occasion_custom'));
        if ($matchedOccasion) {
            $occasion = $matchedOccasion->slug;
            $isCustomOccasion = false;
        }
    }
    $selectedOccasion = $isCustomOccasion
        ? ['headline' => old('occasion_custom', 'Your occasion'), 'name' => old('occasion_custom', '')]
        : (collect($giftOccasions)->firstWhere('id', $occasion) ?? $defaultOccasion);
    $occasionInputValue = old('occasion_custom', '');
    $defaultDesign = $giftDesigns[0] ?? ['id' => 'gold', 'bg' => 'linear-gradient(125deg, #c9922a 0%, #e8c56a 48%, #f8e8b8 100%)', 'text' => '#3a2810'];
    $cardStyle = old('design', 'classic');
    $selectedDesign = collect($giftDesigns)->firstWhere('id', $cardStyle) ?? $defaultDesign;
    $isClassicCard = $cardStyle === 'classic' || $cardStyle === '';
    $amount = old('amount', 50);
@endphp

<div class="gc-page">
    <div class="gc-shell">
        <header class="gc-head">
            <span class="gc-head__eyebrow">Gift cards</span>
            <h1>{{ \App\Support\SiteContent::text('Giftcards title', 'Give the gift of the feast') }}</h1>
            <p class="gc-head__sub">{{ \App\Support\SiteContent::text('Giftcards subtitle', '') }}</p>
        </header>

        <form action="{{ route('giftcards.store') }}" method="POST" id="gift-form">
            @csrf
            <div class="gc-layout">
                <aside class="gc-preview-col">
                    <div id="gift-preview" class="gc-preview{{ $isClassicCard ? '' : ' gc-preview--themed' }}"@if(!$isClassicCard) style="background:{{ $selectedDesign['bg'] }};color:{{ $selectedDesign['text'] }}"@endif>
                        <img src="/logo.jpeg" alt="" class="gc-preview__logo" aria-hidden="true">
                        <div class="gc-preview__face">
                            <div class="gc-preview__top">
                                <div>
                                    <div class="gc-preview__brand">Namaste MoMo</div>
                                    <div class="gc-preview__subbrand">&amp; curry house</div>
                                </div>
                                <svg width="28" height="28" viewBox="0 0 48 48" class="gc-preview__mark" aria-hidden="true"><path d="M24 11 L33 24 L24 37 L15 24 Z" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="24" cy="24" r="4" fill="currentColor"/></svg>
                            </div>
                            <div>
                                <div id="gift-preview-occasion" class="gc-preview__occasion">{{ $selectedOccasion['headline'] }}</div>
                                <div class="gc-preview__bottom-label">Gift card</div>
                                <div id="gift-preview-amount" class="gc-preview__amount">${{ $amount }}</div>
                            </div>
                        </div>
                    </div>
                    <p class="gc-preview__note">Preview updates as you customize your card.</p>
                </aside>

                <div class="gc-panel">
                    <section class="gc-section">
                        <h2>What's the occasion?</h2>
                        <p class="gc-section__hint">Type your occasion or pick one below — matching presets are selected automatically.</p>
                        <input type="hidden" name="occasion" id="gift-occasion-hidden" value="{{ $occasion }}">
                        <label class="gc-field gc-field--full gc-occasion-type">
                            <span>Your occasion</span>
                            <input class="gc-inp" type="text" name="occasion_custom" id="gift-custom-occasion"
                                placeholder="e.g. Birthday, Graduation, Thinking of you"
                                maxlength="80"
                                value="{{ $occasionInputValue }}"
                                autocomplete="off">
                        </label>
                        @error('occasion_custom')
                            <p class="gc-field-error">{{ $message }}</p>
                        @enderror
                        <p id="gift-occasion-match-hint" class="gc-occasion-match" hidden></p>
                        <p class="gc-occasion-or">or choose a preset</p>
                        <div class="gc-occasions">
                            @foreach($giftOccasions as $o)
                                <label class="gc-occasion">
                                    <input type="radio" class="cust-sr-input gift-occasion-pick" {{ $occasion === $o['id'] ? 'checked' : '' }}
                                        data-id="{{ $o['id'] }}"
                                        data-headline="{{ $o['headline'] }}"
                                        data-name="{{ $o['name'] }}">
                                    @if(!empty($o['emoji']))
                                        <span class="gc-occasion__emoji" aria-hidden="true">{{ $o['emoji'] }}</span>
                                    @endif
                                    <span class="gc-occasion__name">{{ $o['name'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <section class="gc-section" id="gift-card-style-section">
                        <h2>Card style</h2>
                        <p class="gc-section__hint">Keep the classic white look, or pick a custom color theme for your card.</p>
                        <div class="gc-designs">
                            <label class="gc-design">
                                <input type="radio" name="design" value="classic" class="cust-sr-input" {{ $isClassicCard ? 'checked' : '' }}
                                    data-bg=""
                                    data-color=""
                                    data-themed="0">
                                <span class="gc-design__swatch gc-design__swatch--classic"></span>
                                <span class="gc-design__name">Classic</span>
                                <span class="gc-design__sub">Clean white</span>
                            </label>
                            @foreach($giftDesigns as $d)
                                <label class="gc-design">
                                    <input type="radio" name="design" value="{{ $d['id'] }}" class="cust-sr-input" {{ $cardStyle === $d['id'] ? 'checked' : '' }}
                                        data-bg="{{ $d['bg'] }}"
                                        data-color="{{ $d['text'] }}"
                                        data-themed="1">
                                    <span class="gc-design__swatch" style="background:{{ $d['bg'] }}"></span>
                                    <span class="gc-design__name">{{ $d['name'] }}</span>
                                    <span class="gc-design__sub">{{ $d['sub'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <section class="gc-section">
                        <h2>Amount</h2>
                        <div class="gc-amounts">
                            @foreach($giftAmounts as $a)
                                <label class="gc-amount">
                                    <input type="radio" name="amount_preset" value="{{ $a }}" class="cust-sr-input gift-amount-radio" {{ (int) $amount === $a && !old('custom_amount') ? 'checked' : '' }}>
                                    ${{ $a }}
                                </label>
                            @endforeach
                        </div>
                        <input type="number" id="gift-custom-amount" min="10" max="500" placeholder="Or enter custom amount" class="gc-custom-amount" value="{{ old('custom_amount') }}">
                        <input type="hidden" name="amount" id="gift-amount-hidden" value="{{ $amount }}">
                    </section>

                    <section class="gc-section">
                        <h2>How to deliver</h2>
                        <div class="gc-delivery">
                            @foreach([['email', 'Email'], ['print', 'Print at home'], ['mail', 'Physical card']] as [$v, $label])
                                <label class="gc-delivery__opt">
                                    <input type="radio" name="delivery" value="{{ $v }}" class="cust-sr-input" {{ old('delivery', 'email') === $v ? 'checked' : '' }}>
                                    {{ $label }}
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <section class="gc-section">
                        <h2>Recipient details</h2>
                        <div class="gc-fields">
                            <input class="gc-inp" name="recipient" placeholder="Recipient email or name" required value="{{ old('recipient') }}">
                            <input class="gc-inp" name="sender" placeholder="Your name" required value="{{ old('sender') }}">
                            <textarea class="gc-inp" name="message" placeholder="Add a message (optional)" rows="3" style="resize:vertical;min-height:72px">{{ old('message') }}</textarea>
                        </div>
                    </section>

                    <section class="gc-section">
                        <h2>Payment</h2>
                        <p class="gc-pay-label">{{ $toastPayment['label'] ?? 'Secure checkout' }}</p>
                        @if($errors->has('payment'))
                            <div class="gc-error">{{ $errors->first('payment') }}</div>
                        @endif
                        <div class="gc-pay-grid">
                            <label class="gc-field gc-field--full">
                                <span>Card number</span>
                                <input class="gc-inp" name="card_number" placeholder="4242 4242 4242 4242" required value="{{ old('card_number') }}">
                            </label>
                            <label class="gc-field">
                                <span>Expiry</span>
                                <input class="gc-inp" name="card_expiry" placeholder="MM / YY" value="{{ old('card_expiry') }}">
                            </label>
                            <label class="gc-field">
                                <span>CVC</span>
                                <input class="gc-inp" name="card_cvc" placeholder="123" value="{{ old('card_cvc') }}">
                            </label>
                        </div>
                    </section>

                    <button type="submit" class="gc-submit">
                        <x-icon name="tag" :size="18" color="#fff" />
                        Buy gift card
                    </button>
                </div>
            </div>
        </form>

        <aside class="gc-redeem">
            <div>
                <h3>Have a gift card?</h3>
                <p>Your code appears after purchase and by email when you choose email delivery. Check your balance below.</p>
            </div>
            <div style="flex:1;min-width:min(100%,280px);max-width:400px">
                <div class="gc-redeem__row">
                    <input class="gc-inp" id="gift-balance-code" placeholder="Gift card code">
                    <button type="button" class="gc-redeem__btn" id="gift-check-balance">Check balance</button>
                </div>
                <p id="gift-balance-msg" class="gc-balance-msg"></p>
            </div>
        </aside>
    </div>
</div>
@endif
@endsection

@push('scripts')
@if(session('gift_sent') && $purchase)
<script>
(function () {
    const codeEl = document.getElementById('gift-success-code');
    const copyBtn = document.getElementById('gift-copy-code');
    copyBtn?.addEventListener('click', async function () {
        const code = codeEl?.textContent?.trim();
        if (!code) return;
        try {
            await navigator.clipboard.writeText(code);
            copyBtn.textContent = 'Copied!';
            setTimeout(function () { copyBtn.textContent = 'Copy code'; }, 2000);
        } catch (e) {
            copyBtn.textContent = 'Copy failed';
        }
    });
})();
</script>
@else
<script>window.__giftBalanceUrl = @json(route('giftcards.balance'));</script>
<script>window.__giftOccasions = @json($giftOccasions);</script>
<script src="/js/gift-cards.js" defer></script>
@endif
@endpush
