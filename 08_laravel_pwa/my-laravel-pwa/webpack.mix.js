const mix = require('laravel-mix');

require('laravel-mix-workbox');
//const workboxPlugin = require('workbox-webpack-plugin');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.webpackConfig({
    plugins: [
        new workboxPlugin.InjectManifest({
            swSrc: 'public/sw-offline.js',
            swDest: 'sw.js',
            importsDirectory: 'service-worker'
        })
    ]
});
