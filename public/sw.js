const CACHE_NAME = 'namaste-momo-curry-house-v4';
const OFFLINE_URL = '/offline';
const OFFLINE_ASSETS = [
  OFFLINE_URL,
  '/css/theme.css',
  '/css/customer.css',
  '/css/customer-gem.css',
  '/css/offline.css',
  '/js/customer.js',
  '/js/confirm-dialog.js',
  '/js/dotlottie-player.js',
  '/animations/offline.lottie',
  '/logo.jpeg',
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => cache.addAll(OFFLINE_ASSETS))
  );
  self.skipWaiting();
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) =>
      Promise.all(
        keys
          .filter((key) => key !== CACHE_NAME)
          .map((key) => caches.delete(key))
      )
    )
  );
  self.clients.claim();
});

self.addEventListener('fetch', (event) => {
  if (event.request.method !== 'GET') return;

  event.respondWith(
    fetch(event.request)
      .catch(async () => {
        const cached = await caches.match(event.request);
        if (cached) return cached;

        if (event.request.mode === 'navigate') {
          const cachedOffline = await caches.match(OFFLINE_URL);
          if (cachedOffline) return cachedOffline;
        }

        return Response.error();
      })
  );
});
