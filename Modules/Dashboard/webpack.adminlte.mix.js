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

mix.copyDirectory('node_modules/admin-lte/dist/img', 'public/images');

mix.js('Modules/Dashboard/Resources/assets/js/adminlte/adminlte.js', 'public/js')
   .sass('Modules/Dashboard/Resources/assets/sass/adminlte/adminlte.scss', 'public/css');

mix.js('Modules/Dashboard/Resources/assets/js/adminlte/adminlte-auth.js', 'public/js')
   .sass('Modules/Dashboard/Resources/assets/sass/adminlte/adminlte-auth.scss', 'public/css');
