<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <link rel="manifest" href="/manifest.json">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    
    <h1>これは PWA のテストです。</h1>

    <h1>アプリのようにインストールできます。</h1>

    <h1>オフラインでも動きます。</h1>

    <div class="col-md-4 text-right mb-3">
        <button class="btn btn-primary" type="button" onclick="installClick()">(test) install as pwa</button>
    </div>

    <script>
        //
        var promptEvent = null;
        window.addEventListener('beforeinstallprompt', e => {
            console.log('start beforeinstallprompt...');
            e.preventDefault();
            promptEvent = e;
        });

        //serviceWorkerの登録
        if('serviceWorker' in navigator) {
            navigator.serviceWorker.register('my-service-worker.js')
            .then( r => {
                console.log('register service worker success.');
            })
            .catch(error => {
                console.log('register service worker fail.');
            });
        }

        //pwaインストール
        function installClick(){
            console.log("installClick");
            promptEvent.prompt();
        }

    </script>
</body>

</html>