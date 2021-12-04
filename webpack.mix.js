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

mix.js('resources/js/admin/admin.js', 'public/js/admin.js')
    .sass('resources/sass/app.scss', 'public/css');

    
mix.copy('node_modules/admin-lte/dist/img/AdminLTELogo.png', 'public/admin/dist/img/AdminLTELogo.png');
mix.copy('node_modules/admin-lte/dist/img/user2-160x160.jpg', 'public/admin/dist/img/user2-160x160.jpg');