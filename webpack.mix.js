const mix = require("laravel-mix");
require("laravel-mix-purgecss");

mix.postCss("resources/css/app.css", "public/css", [
    require("tailwindcss"),
]).purgeCss();

mix.browserSync("laravel-movies.test");
mix.browserSync("127.0.0.1:8000");
