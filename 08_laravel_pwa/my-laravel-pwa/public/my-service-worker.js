console.log('start sw.js ...')

myCacheKey='myCacheKey';

self.addEventListener('install', e => {
    console.log('install start....')
    caches.open(myCacheKey)
        .then(cache => {
            console.log('caches.addAll start');
            cache.addAll([
                '/',
            ]);
        })

});

//fetch
self.addEventListener('fetch', e => {
    console.log('fetch start....')
    const url = new URL(e.request.url)
    console.log(url.host + ':' + location.host);
    
    e.respondWith(getFetchResponse(e.request));
});

async function getFetchResponse(request) {
    const url = new URL(request.url);
    const cachedResponse = await caches.match(request);
    if(cachedResponse) {
        return cachedResponse;
    }    
}