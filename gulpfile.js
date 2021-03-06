var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass([
        "main.scss"
    ], "public/css/main.css");

    mix.styles([
        "jquery.growl.css"
    ], "public/css/diff.css");

    mix.coffee([
        "timer.coffee"
    ], "public/js/timer.js");

    /*mix.scripts([
        "jquery.growl.js"
    ], "public/js/main.js");*/
});