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
    .copy("resources/js/backend/toastr.js", "public/js/toastr.js")
    .copy("resources/js/flickity.js", "public/js")
    .copy("resources/js/jquery.min.js", "public/js")
    .copy("resources/js/popper.min.js", "public/js")
    .copy("resources/js/bootstrap.min.js", "public/js")
    .copy("resources/js/bootstrap-select.js", "public/js/bootstrap-select.js")
    .sass("resources/sass/app.scss", "public/css/app.css")
    .postCss("resources/css/frontend/frontend.css", "public/css/frontend.css")
    .postCss("resources/css/bootstrap-select.css", "public/css/bootstrap-select.css")
    .postCss("resources/css/backend/toastr.css", "public/css/toastr.css")
    .postCss("resources/css/frontend/style-rtl.css", "public/css/style-rtl.css")
    .postCss("resources/css/frontend/dashboard.css", "public/css/dashboard.css")
    .copy("resources/images/img", "public/images")
    .purgeCss()
    .version();
