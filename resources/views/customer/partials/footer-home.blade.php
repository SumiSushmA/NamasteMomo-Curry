<footer class="nm-foot">
    <div class="nm-foot__cta">
        <div class="nm-wrap nm-foot__cta-inner">
            <div>
                <span class="nm-label">{{ \App\Support\SiteContent::text('Footer CTA eyebrow', 'Ready for tonight?') }}</span>
                <h2>{{ \App\Support\SiteContent::text('Footer CTA heading', 'Ready for momo tonight?') }}</h2>
                <p>{{ \App\Support\SiteContent::text('Home footer headline', $content['Home footer headline'] ?? '') }}</p>
            </div>
            <div class="nm-foot__cta-actions">
                <a href="{{ route('menu') }}" class="nm-btn nm-btn--primary">Order online <x-icon name="arrow" :size="18" /></a>
                <a href="{{ route('reserve') }}" class="nm-btn nm-btn--outline">Reserve a table</a>
            </div>
        </div>
    </div>

    <div class="nm-foot__main">
        <div class="nm-wrap nm-foot__grid">
            <div class="nm-foot__brand">
                <x-logo :size="36" :href="route('home')" :show-text="true" />
                <p>{{ $site['footer_tagline'] ?? \App\Support\SiteContent::text('Footer tagline', $content['Footer tagline'] ?? '') }}</p>
            </div>

            <div class="nm-foot__col">
                <h4>Restaurant</h4>
                @foreach([['About', 'about'], ['Gallery', 'gallery'], ['Contact', 'contact']] as [$label, $route])
                    <a href="{{ route($route) }}">{{ $label }}</a>
                @endforeach
            </div>

            <div class="nm-foot__col">
                <h4>Order</h4>
                @foreach([['Menu', 'menu'], ['Reserve', 'reserve'], ['Catering', 'catering'], ['Gift cards', 'giftcards'], ['Offers', 'promos']] as [$label, $route])
                    <a href="{{ route($route) }}">{{ $label }}</a>
                @endforeach
            </div>

            <div class="nm-foot__col">
                <h4>Visit</h4>
                <p>{{ $site['address'] ?? '6211 Evergreen Way' }}</p>
                <p>{{ $site['city'] ?? 'Everett, WA 98203' }}</p>
                <a href="tel:{{ preg_replace('/\D/', '', $site['phone'] ?? '') }}" class="nm-foot__phone">{{ $site['phone'] ?? '(206) 397-3211' }}</a>
                <div class="nm-foot__social">
                    @foreach([['fb', 'facebook_url'], ['ig', 'instagram_url'], ['wa', 'whatsapp_url']] as [$icon, $key])
                        @if(!empty($site[$key]))
                            <a href="{{ $site[$key] }}" target="_blank" rel="noopener" aria-label="{{ $icon }}">
                                <x-icon :name="$icon" :size="17" />
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="nm-wrap nm-foot__base">
            <p>© {{ date('Y') }} {{ $site['restaurant_name'] ?? 'Namaste MoMo & curry house' }}. All rights reserved.</p>
            <p class="nm-foot__credit">Developed by: <a href="https://www.linkedin.com/in/sushma-sharma-123943293/" target="_blank" rel="noopener noreferrer">Sushma Sharma</a></p>
        </div>
    </div>
</footer>
