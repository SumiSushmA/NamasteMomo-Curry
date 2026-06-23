<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $site['restaurant_name'] ?? 'Namaste MoMo & curry house' }} — Admin @isset($pageTitle) · {{ $pageTitle }} @endisset</title>
    <link rel="icon" href="/images/logo.jpeg" type="image/jpeg">
    <link rel="stylesheet" href="/css/theme.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/typography.css">
    @stack('styles')
</head>
<body>
<div class="adm-app">
    @include('admin.partials.sidebar', ['active' => $active ?? 'overview', 'badges' => $badges ?? []])
    <div class="adm-main-wrap">
        @include('admin.partials.topbar')
        <main id="adm-main">
            <div class="adm-flash-stack" aria-live="polite" aria-atomic="true">
                @if(session('success'))
                    <div data-adm-flash class="adm-flash adm-flash--success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div data-adm-flash class="adm-flash adm-flash--error">{{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div data-adm-flash class="adm-flash adm-flash--error">
                        {{ $errors->first() }}
                    </div>
                @endif
            </div>
            @yield('content')
        </main>
    </div>
</div>
@stack('modals')
<script>
document.getElementById('adm-burger')?.addEventListener('click', () => {
    document.getElementById('adm-sidebar')?.classList.add('open');
    document.getElementById('adm-scrim')?.classList.add('open');
});
document.getElementById('adm-scrim')?.addEventListener('click', () => {
    document.getElementById('adm-sidebar')?.classList.remove('open');
    document.getElementById('adm-scrim')?.classList.remove('open');
});
</script>
<script src="/js/confirm-dialog.js"></script>
<script src="/js/admin.js"></script>
<script>
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
        navigator.serviceWorker.register('/sw.js').catch(function () {});
    });
}
</script>
@stack('scripts')
</body>
</html>
