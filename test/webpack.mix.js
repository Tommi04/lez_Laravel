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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.copy('node_modules/@fortawesome/fontawesome-free/css/all.min.css', 'public/css/nm.all.min.css');
mix.copy('node_modules/bootstrap/dist/css/bootstrap.css', 'public/css/nm.bootstrap.css');
mix.copy('node_modules/@fortawesome/fontawesome-free/css/all.min.css', 'public/css/fontaw.all.min.css');
mix.copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/js/bootstrap.min.js')
mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js/jquery.min.js')
mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts')