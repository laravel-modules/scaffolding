
require('./webpack.adminlte.mix')
require('./webpack.vali.mix')

const mix = require('laravel-mix'),
  WebpackRTLPlugin = require('webpack-rtl-plugin');
require('laravel-mix-merge-manifest');
mix.mergeManifest();


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