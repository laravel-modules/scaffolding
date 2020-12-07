const mix = require('laravel-mix'),
  WebpackRTLPlugin = require('webpack-rtl-plugin');

require('laravel-mix-merge-manifest');
mix.mergeManifest();

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/adminlte3/adminlte3.js', 'public/js');
mix.sass('resources/sass/adminlte3/adminlte3.scss', 'public/css');

mix.js('resources/js/adminlte3/adminlte3-auth.js', 'public/js')
    .sass('resources/sass/adminlte3/adminlte3-auth.scss', 'public/css');


// Handle rtl
mix.webpackConfig({
    plugins: [
        new WebpackRTLPlugin({
            diffOnly: false,
            minify: true,
        }),
    ],
});

mix.version([
    'public/js/*',
    'public/css/*',
]);
