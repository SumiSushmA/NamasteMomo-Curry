@props(['value' => 5, 'size' => 14])

@php
$starPath = 'M12 3.5l2.6 5.3 5.9.9-4.3 4.1 1 5.8-5.2-2.8L7.5 19.6l1-5.8L4.2 9.7l5.9-.9L12 3.5Z';
@endphp

<div style="display:inline-flex;gap:2px" aria-hidden="true">
    @for ($i = 0; $i < 5; $i++)
        @php $filled = $i < (int) $value; @endphp
        <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" style="flex-shrink:0">
            <path
                d="{{ $starPath }}"
                fill="{{ $filled ? 'var(--gold-500)' : 'none' }}"
                stroke="var(--gold-500)"
                stroke-width="1.5"
                stroke-linejoin="round"
                opacity="{{ $filled ? 1 : 0.28 }}"
            />
        </svg>
    @endfor
</div>
