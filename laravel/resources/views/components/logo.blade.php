@props(['size' => 38, 'href' => null, 'showText' => false])

@php
use App\Support\SiteContent;
$tag = $href ? 'a' : 'div';
$imgH = (int) round($size * 1.15);
$logoPath = \App\Services\SiteSettings::content('Logo image');
$logoSrc = $logoPath ? SiteContent::image('Logo image') : '/images/logo.jpeg';
$restaurantName = $site['restaurant_name'] ?? 'Namaste MoMo & curry house';
@endphp

<{{ $tag }} @if($href) href="{{ $href }}" @endif
    {{ $attributes->merge(['class' => 'cust-logo', 'style' => 'display:flex;align-items:center;gap:'.($showText ? ($size * 0.28) : 0).'px;text-decoration:none;color:inherit;cursor:'.($href ? 'pointer' : 'default').';']) }}>
    <img
        src="{{ $logoSrc }}"
        alt="{{ $restaurantName }}"
        width="{{ $imgH }}"
        height="{{ $imgH }}"
        style="height:{{ $imgH }}px;width:auto;object-fit:contain;flex-shrink:0;display:block"
    >
    @if($showText)
        <div style="line-height:1">
            <div style="font-family:var(--sans);font-weight:700;font-size:{{ $size * 0.38 }}px;letter-spacing:.03em;color:var(--brand-500)">{{ $restaurantName }}</div>
        </div>
    @endif
</{{ $tag }}>
