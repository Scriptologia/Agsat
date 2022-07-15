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

mix.js('resources/js/adminka/main.js', 'public/admin/js/app.js')
     .js('resources/js/public/chat.js', 'public/js/chat.js')
    .vue( {"globalStyles": "resources/sass/app.scss"})
    .sass('resources/sass/app.scss', 'public/admin/css')
    .sourceMaps()
    .version();
mix.js('resources/js/public/main.js', 'public/js/app.js')
    // .vue( {"globalStyles": "resources/sass/app.scss"})
    // .sass('resources/sass/app.scss', 'public/admin/css')
    .sourceMaps()
    .version();

// mix.sass('resources/css/style.scss', 'public/css');
    // .sourceMaps();
// .version();
