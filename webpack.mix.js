const mix = require('laravel-mix');
const WebpackRTLPlugin = require('webpack-rtl-plugin');

// Adminlte3 Template
mix.js([
  'resources/js/adminlte3/adminlte3.js',
  'resources/js/adminlte3/adminlte3-auth.js'
], 'public/js').vue();
mix.sass('resources/sass/adminlte3/adminlte3.scss', 'public/css');
mix.sass('resources/sass/adminlte3/adminlte3-auth.scss', 'public/css');

// Vali Template
mix.js('resources/js/vali/vali.js', 'public/js').vue();
mix.sass('resources/sass/vali/vali.scss', 'public/css');

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
