const mix = require('laravel-mix');
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

mix.js('./Resources/assets/js/media.js', './public/js');
