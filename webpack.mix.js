const mix = require("laravel-mix");
require("laravel-mix-purgecss");

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
// mix.extract();

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/frontend/frontend.js", "public/js/frontend.js")
    .sass("resources/sass/app.scss", "public/css/app.css")
    .postCss("resources/css/frontend/frontend.css", "public/css/frontend.css")
    .postCss("resources/css/frontend/style-rtl.css", "public/css/style-rtl.css")
    .postCss("resources/css/frontend/dashboard.css", "public/css/dashboard.css")
    .copy("resources/images/img", "public/images")
    .purgeCss()
    .version();
