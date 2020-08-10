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

mix.browserSync({
  proxy: {
    target: "http://127.0.0.1:8000"
  },
  devServer: {
    proxy: 'http://192.168.0.13:3000'
  }
}).js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css');
