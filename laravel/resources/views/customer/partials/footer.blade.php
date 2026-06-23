<div class="cust-site-end">
    <div class="cust-site-end__bg" aria-hidden="true">
        <img src="{{ asset('images/Group 1171275134.svg') }}" alt="">
    </div>

    <section class="cust-prefooter">
        <div class="cust-prefooter__inner">
            <h2 class="cust-prefooter__title">Ready for Everett's best <em>momo?</em></h2>
            <p class="cust-prefooter__sub">
                {{ $content['Delivery blurb'] ?? 'Order online for pickup or delivery from 6211 Evergreen Way, Everett — hand-folded momo, tandoori, curries, and more.' }}
            </p>
            <a href="{{ route('menu') }}" class="cust-prefooter__btn">
                Order Online <x-icon name="arrow" :size="17" />
            </a>
        </div>
    </section>

    <footer id="cust-footer" class="cust-foot-shell">
        <div class="cust-foot-card">
            <div class="cust-foot-card__grid" aria-hidden="true"></div>
            <div class="cust-foot-card__inner">
                <div class="cust-foot-head">
                    <div class="cust-foot-brand">
                        <x-logo :size="34" :href="route('home')" :show-text="true" />
                        <span class="cust-foot-kicker">Momo & curry house · Everett</span>
                    </div>
                    <p class="cust-foot-lead">{{ $site['footer_tagline'] ?? $content['Footer tagline'] ?? '' }}</p>
                </div>

                <div class="cust-foot-mid">
                    <div class="cust-foot-col">
                        <h4>Restaurant</h4>
                        @foreach([['About Us', 'about'], ['Gallery', 'gallery'], ['Contact', 'contact']] as [$label, $route])
                            <a href="{{ route($route) }}">{{ $label }}</a>
                        @endforeach
                    </div>
                    <div class="cust-foot-col">
                        <h4>Order</h4>
                        @foreach([['Menu & Order', 'menu'], ['Reserve a Table', 'reserve', $toastPayment['tablesUrl'] ?? null], ['Catering', 'catering', $toastPayment['tablesUrl'] ?? null], ['Gift Cards', 'giftcards'], ['Offers', 'promos']] as $link)
                            <a href="{{ ($link[2] ?? null) ?: route($link[1]) }}">{{ $link[0] }}</a>
                        @endforeach
                    </div>
                    <div class="cust-foot-col">
                        <h4>Visit</h4>
                        <div class="cust-foot-visit">
                            <div>{{ $site['address'] ?? '6211 Evergreen Way' }}</div>
                            <div>{{ $site['city'] ?? 'Everett, WA 98203' }}</div>
                            <div class="cust-foot-visit__hours">{{ $site['hours'] ?? 'Tue–Sun · 11:00 AM – 9:00 PM' }}</div>
                            <div class="cust-foot-visit__note">{{ $site['closed_days'] ?? 'Closed Mondays' }}</div>
                            <a href="tel:{{ preg_replace('/\D/', '', $site['phone'] ?? '') }}" class="cust-foot-visit__link">{{ $site['phone'] ?? '(253) 420-5566' }}</a>
                            <a href="mailto:{{ $site['email'] ?? 'Namastemomo6211@gmail.com' }}" class="cust-foot-visit__link">{{ $site['email'] ?? 'Namastemomo6211@gmail.com' }}</a>
                        </div>
                    </div>
                </div>

                <div class="cust-foot-base">
                    <p>© {{ date('Y') }} {{ $site['restaurant_name'] ?? 'Namaste MoMo & curry house' }}. All rights reserved.</p>
                    <p class="cust-foot-credit">Developed by: <a href="https://www.linkedin.com/in/sushma-sharma-123943293/" target="_blank" rel="noopener noreferrer">Sushma Sharma</a></p>
                </div>
            </div>
        </div>
    </footer>
</div>
