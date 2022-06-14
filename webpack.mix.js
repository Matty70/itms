const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .combine([
       'resources/js/vendor/jquery-easing/jquery.easing.js',
       'resources/js/sb-admin-2.js',
       'resources/js/vendor/chart.js/Chart.js',
       'resources/js/demo/chart-area-demo.js',
       'resources/js/demo/chart-pie-demo.js'
    ],'public/template/scripts.js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [require('tailwindcss'), require('autoprefixer')])
    .alias({
        '@': 'resources/js',
    });

if (mix.inProduction()) {
    mix.version();
}
