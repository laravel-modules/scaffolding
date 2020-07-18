const mix = require('laravel-mix');

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

mix.js('Modules/Dashboard/Resources/assets/js/vali/vali.js', 'public/js')
  .sass('Modules/Dashboard/Resources/assets/sass/vali/vali.scss', 'public/css');