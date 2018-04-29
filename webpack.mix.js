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

// Main app
mix.js(`${jsPath}/app.js`, 'public/js')
   .sass(`${sassPath}/app.scss`, 'public/css');

// Auth page
mix.js(`${jsPath}/auth.js`, 'public/js')
    .sass(`${sassPath}/auth.scss`, 'public/css');

// Core js plugins
mix.scripts([
    `${jsPath}/plugins/switchery.js`,
    `${jsPath}/plugins/waves.js`,
    `${jsPath}/plugins/iziToast.min.js`
], 'public/js/plugins/core.js');

// Core js custom
mix.js([
    `${jsPath}/core.js`
], 'public/js/core.js');

// Admin page
mix.js(`${jsPath}/admin.js`, 'public/js/admin/manage.js')
    .sass(`${sassPath}/admin.scss`, 'public/css/admin/core.css');