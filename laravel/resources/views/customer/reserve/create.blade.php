@extends('layouts.customer')

@section('content')
@if(session('reserved') && $reservation)
    <div style="min-height:80vh;display:grid;place-items:center;padding:120px 24px;text-align:center">
        <div class="fade-up" style="max-width:480px">
            <div style="width:88px;height:88px;border-radius:999px;margin:0 auto 26px;background:var(--gold-glow);border:1px solid var(--gold-600);display:grid;place-items:center;color:var(--gold-400)">
                <x-icon name="check" :size="42" />
            </div>
            <h1 style="font-size:46px">Table reserved</h1>
            <p style="color:var(--sand);font-size:17px;line-height:1.65;margin-top:16px">See you soon! A confirmation is on its way to your inbox.</p>
            <div style="display:inline-flex;flex-wrap:wrap;justify-content:center;gap:16px;margin-top:24px;background:var(--ink-700);border:1px solid var(--line);border-radius:14px;padding:16px 26px">
                <span style="display:flex;gap:8px;align-items:center"><x-icon name="users" :size="17" color="var(--gold-400)" /> {{ $reservation['party'] }} guests</span>
                <span style="display:flex;gap:8px;align-items:center"><x-icon name="cal" :size="17" color="var(--gold-400)" /> {{ $reservation['date'] }}</span>
                <span style="display:flex;gap:8px;align-items:center"><x-icon name="clock" :size="17" color="var(--gold-400)" /> {{ $reservation['time'] }}</span>
            </div>
            <div style="margin-top:30px"><a href="{{ route('home') }}" class="btn btn-gold">Back to home</a></div>
        </div>
    </div>
@else
    <div class="cust-page-head cust-pad">
        <div class="eyebrow center" style="justify-content:center;margin-bottom:16px">Reservations</div>
        <h1 style="font-size:clamp(38px,5vw,62px);line-height:1.03">{{ \App\Support\SiteContent::text('Reserve title', 'Reserve your table') }}</h1>
        <p style="color:var(--sand);font-size:17px;line-height:1.65;margin-top:18px">{{ \App\Support\SiteContent::text('Reserve lead', '') }}</p>
    </div>
    <div style="height:40px"></div>

    <form action="{{ route('reserve.store') }}" method="POST" class="cust-reserve-form">
        @csrf
        <div class="cust-reserve-grid">
            <div class="cust-card">
                <div class="cust-reserve-block">
                    <div class="cust-reserve-label">Party size</div>
                    <div class="cust-reserve-party">
                        @foreach([1,2,3,4,5,6,7,8] as $n)
                            <label class="cust-pick cust-reserve-pick cust-reserve-pick--party">
                                <input type="radio" name="party" value="{{ $n }}" class="cust-sr-input" {{ (int) old('party', request('party', 2)) === $n ? 'checked' : '' }}>{{ $n }}
                            </label>
                        @endforeach
                        <label class="cust-pick cust-reserve-pick cust-reserve-pick--party cust-reserve-pick--wide">
                            <input type="radio" name="party" value="9" class="cust-sr-input"> 9+
                        </label>
                    </div>
                </div>
                <div class="cust-reserve-block">
                    <div class="cust-reserve-label">Date</div>
                    <div class="cust-reserve-dates">
                        @foreach($dates as $d)
                            <label class="cust-pick cust-reserve-pick cust-reserve-pick--date">
                                <input type="radio" name="date" value="{{ $d['value'] }}" class="cust-sr-input" {{ old('date') === $d['value'] ? 'checked' : '' }}>
                                <div class="cust-reserve-date-day">{{ $d['weekday'] }}</div>
                                <div class="cust-reserve-date-num">{{ $d['day'] }}</div>
                                <div class="cust-reserve-date-month">{{ $d['month'] }}</div>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="cust-reserve-block cust-reserve-block--last">
                    <div class="cust-reserve-label">Time</div>
                    <div class="cust-reserve-times">
                        @foreach($times as $t)
                            <label class="cust-pick cust-reserve-pick cust-reserve-pick--time">
                                <input type="radio" name="time" value="{{ $t }}" class="cust-sr-input" {{ old('time') === $t ? 'checked' : '' }}>{{ $t }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="cust-card">
                <h3 style="font-size:24px;margin-bottom:6px">Your details</h3>
                <p style="color:var(--muted);font-size:14;margin-bottom:20px">We'll hold your table for 15 minutes.</p>
                <div style="display:grid;gap:14px">
                    <label class="cust-field"><span>Full name</span><input class="cust-inp" name="name" placeholder="Asha Gurung" required value="{{ $prefill['name'] ?? old('name') }}"></label>
                    <label class="cust-field"><span>Phone</span><input class="cust-inp" name="phone" type="tel" placeholder="{{ $site['phone'] ?? '(253) 420-5566' }}" required value="{{ $prefill['phone'] ?? old('phone') }}"></label>
                    <label class="cust-field"><span>Email</span><input class="cust-inp" name="email" type="email" placeholder="you@email.com" required value="{{ $prefill['email'] ?? old('email') }}"></label>
                    <label class="cust-field"><span>Occasion (optional)</span>
                        <select class="cust-inp" name="occasion">
                            @foreach(['—', 'Birthday', 'Anniversary', 'Date night', 'Business', 'Celebration'] as $o)
                                <option value="{{ $o === '—' ? '' : $o }}" {{ old('occasion') === $o ? 'selected' : '' }}>{{ $o }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="cust-field"><span>Special requests</span><textarea class="cust-inp" name="notes" placeholder="Window table, high chair, allergies…" style="min-height:70px;resize:vertical">{{ old('notes') }}</textarea></label>
                </div>
                <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center;margin-top:20px">Confirm reservation</button>
            </div>
        </div>
    </form>
@endif
@endsection
