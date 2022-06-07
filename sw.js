// on install - the application shell cached
self.addEventListener('install', function(event){
    event.waitUntil(
        caches.open('sw-cache').then(function(cache){
            //static files that make up the application shell are cached
            return cache.add('index.php');
        })
    );
});

//with request network
self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request).then(function(response){
            return response || fetch(event.request);
        })
    );
});