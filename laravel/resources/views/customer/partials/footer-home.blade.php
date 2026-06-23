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
                <a href="{{ $toastPayment['tablesUrl'] ?? route('reserve') }}" class="nm-btn nm-btn--outline">Reserve a table</a>
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
                @foreach([['Menu', 'menu'], ['Reserve', 'reserve', $toastPayment['tablesUrl'] ?? null], ['Catering', 'catering', $toastPayment['tablesUrl'] ?? null], ['Gift cards', 'giftcards'], ['Offers', 'promos']] as $link)
                    <a href="{{ ($link[2] ?? null) ?: route($link[1]) }}">{{ $link[0] }}</a>
                @endforeach
            </div>

            <div class="nm-foot__col">
                <h4>Visit</h4>
                <p>{{ $site['address'] ?? '6211 Evergreen Way' }}</p>
                <p>{{ $site['city'] ?? 'Everett, WA 98203' }}</p>
                <p class="nm-foot__hours">{{ $site['hours'] ?? 'Tue–Sun · 11:00 AM – 9:00 PM' }}</p>
                <p class="nm-foot__hours-note">{{ $site['closed_days'] ?? 'Closed Mondays' }}</p>
                <a href="tel:{{ preg_replace('/\D/', '', $site['phone'] ?? '') }}" class="nm-foot__phone">{{ $site['phone'] ?? '(253) 420-5566' }}</a>
                <a href="mailto:{{ $site['email'] ?? 'Namastemomo6211@gmail.com' }}" class="nm-foot__phone">{{ $site['email'] ?? 'Namastemomo6211@gmail.com' }}</a>
            </div>
        </div>

        <div class="nm-wrap nm-foot__base">
            <p>© {{ date('Y') }} {{ $site['restaurant_name'] ?? 'Namaste MoMo & curry house' }}. All rights reserved.</p>
            <p class="nm-foot__credit">Developed by: <a href="https://www.linkedin.com/in/sushma-sharma-123943293/" target="_blank" rel="noopener noreferrer">Sushma Sharma</a></p>
        </div>
    </div>
</footer>
