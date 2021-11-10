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

 if ( ! mix.inProduction()) {
    mix.webpackConfig({
        devtool: 'inline-source-map'
    })
}

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .js('resources/js/dashboard.js', 'public/js')
    .js('resources/js/graphs.js', 'public/js')
    .js('resources/js/graphs2.js', 'public/js')


    .browserSync('127.0.0.1:8000');




