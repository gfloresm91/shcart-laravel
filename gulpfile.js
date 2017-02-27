const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */
elixir.config.sourcemaps = false;

elixir((mix) => {
    mix.sass('app.scss')
       .webpack('app.js')
       .styles(
            [
                'bootstrap/dist/css/bootstrap.css',
                'font-awesome/css/font-awesome.css',
                'animate.css/animate.css',
                'toastr/toastr.scss',
                'bootstrap-social/bootstrap-social.css'
            ],
            'public/css/appcss.min.css',            
            './node_modules/')
        .styles(
            [
                'haifahrul/template-eshopper/css/prettyPhoto.css',
                'haifahrul/template-eshopper/css/price-range.css',
                'haifahrul/template-eshopper/css/main.css',
                'haifahrul/template-eshopper/css/responsive.css'
            ],
            'public/css/eshopper.min.css',
            './vendor/')
        .scripts(
            [
                'jquery/dist/jquery.js',
                'bootstrap-sass/assets/javascripts/bootstrap.js',
                'toastr/toastr.js'
            ],
            'public/js/appgeneral.min.js',
            './node_modules/')
        .scripts(
            [
                'haifahrul/template-eshopper/js/jquery.scrollUp.min.js',
                'haifahrul/template-eshopper/js/price-range.js',
                'haifahrul/template-eshopper/js/jquery.prettyPhoto.js',
                'haifahrul/template-eshopper/js/main.js'
            ],
            'public/js/eshopper.min.js',
            './vendor/')
        .scripts(
            [
                'custom.js'
            ],
            'public/js/custom.min.js'
            )
        .copy(
            [
                'node_modules/font-awesome/fonts/',
                'node_modules/bootstrap/fonts'
            ],
            'public/fonts/')
        .copy(
            'vendor/haifahrul/template-eshopper/images',
            'public/images/'
        );
});
