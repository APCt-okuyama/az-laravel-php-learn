<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <link rel="manifest" href="/manifest.json">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    
    <h1>これは PWA のテストです。</h1>

    <h1>インストールできます。</h1>

    <h1>サーバーが停止していても動きます。</h1>

    <script>
        if('serviceWorker' in navigator) {
            navigator.serviceWorker.register('my-service-worker.js')
            .then( r => {
                console.log('register service worker success.');
            })
            .catch(error => {
                console.log('register service worker fail.');
            });
        }
    </script>
</body>

</html>