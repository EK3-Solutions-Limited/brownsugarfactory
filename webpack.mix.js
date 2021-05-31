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

mix.js('resources/js/components/customer/app.js', 'public/js/customer.js')
    .sass('resources/sass/app.scss', 'public/css/customer')
    .version();

mix.js('resources/js/components/admin/app.js', 'public/js/admin.js')
    .version();
