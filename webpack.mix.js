let mix = require('laravel-mix');

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

const assetsPath = 'resources/assets';
const jsPath = `${assetsPath}/js`;
const sassPath = `${assetsPath}/sass`;

mix.js(`${jsPath}/app.js`, 'public/js')
   .sass(`${sassPath}/app.scss`, 'public/css');

mix.js(`${jsPath}/auth.js`, 'public/js')
    .sass(`${sassPath}/auth.scss`, 'public/css');