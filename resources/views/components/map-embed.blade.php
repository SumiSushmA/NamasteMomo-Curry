@props(['height' => 480, 'radius' => 18, 'h' => null, 'r' => null])

@php
$h = (int) ($h ?? $height);
$r = (int) ($r ?? $radius);
$street = trim($site['address'] ?? '6211 Evergreen Way');
$cityLine = trim($site['city'] ?? 'Everett, WA 98203');
$address = trim($street.', '.$cityLine);
$mapsLink = 'https://maps.google.com/?q='.urlencode($address);
$embedUrl = filled($site['map_embed_url'] ?? null)
    ? $site['map_embed_url']
    : 'https://maps.google.com/maps?q='.urlencode($address).'&hl=en&z=16&output=embed';
$wrapperStyle = collect([
    "height: {$h}px",
    "border-radius: {$r}px",
    $attributes->get('style'),
])->filter()->implode('; ');
@endphp

<div {{ $attributes->except('style')->merge(['class' => 'cust-map-embed']) }} style="{{ $wrapperStyle }}">
    <iframe
        src="{{ $embedUrl }}"
        title="Map — {{ $site['restaurant_name'] ?? 'Namaste MoMo & curry house' }}"
        loading="lazy"
        allowfullscreen
        referrerpolicy="no-referrer-when-downgrade"
    ></iframe>
    <a href="{{ $mapsLink }}" target="_blank" rel="noopener" class="cust-map-embed__link">
        Open in Google Maps <x-icon name="arrow" :size="14" />
    </a>
</div>
