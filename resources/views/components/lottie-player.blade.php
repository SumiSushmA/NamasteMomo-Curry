@props([
    'src',
    'class' => 'lottie-stage',
])

<dotlottie-player
    class="{{ $class }}"
    src="{{ $src }}"
    background="transparent"
    autoplay
    loop
    mode="normal"
></dotlottie-player>

@once
    @push('scripts')
        <script src="/js/dotlottie-player.js"></script>
    @endpush
@endonce
