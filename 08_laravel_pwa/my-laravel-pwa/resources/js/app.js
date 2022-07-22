require('./bootstrap');

window.addEventListener('load', () => {
    console.log('load start...');
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('/sw.js').
        then(() => {
          console.log('ServiceWorker registered')
        }).
        catch((error) => {
          console.warn('ServiceWorker error', error)
        })
    }
  })