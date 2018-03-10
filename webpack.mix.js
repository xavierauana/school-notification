let mix = require('laravel-mix');

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

mix.js('src/resources/assets/js/app.js', 'src/public/js')
   .sass('src/resources/assets/sass/app.scss', 'src/public/css')
   .copy('src/public/js/app.js', '../public/vendor/school/notification/js/app.js')
   .copy('src/public/css/app.css', '../public/vendor/school/notification/css/app.css')
   .copy('node_modules/font-awesome/fonts', '../public/vendor/school/notification/fonts/vendor/font-awesome')

