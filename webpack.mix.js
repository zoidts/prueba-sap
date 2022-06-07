const mix = require('laravel-mix');

mix.webpackConfig({ module: { rules: [{ test: /\.mjs$/, resolve: { fullySpecified: false }, include: /node_modules/, type: "javascript/auto" }] }, });
const AutoImport = require('unplugin-auto-import/webpack')
const Components = require('unplugin-vue-components/webpack')
const { ElementPlusResolver } = require('unplugin-vue-components/resolvers')

module.exports = {
  // ...
  plugins: [
    AutoImport({
      resolvers: [ElementPlusResolver()],
    }),
    Components({
      resolvers: [ElementPlusResolver()],
    }),
  ],
}

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 mix.js('resources/js/app.js', 'public/js')
     .postCss('resources/css/app.css', 'public/css', [
         //
     ]);
 */

mix.js('resources/js/app.js', 'public/js').vue();

mix.combine([
    'resources/assets/css/custom.css'
], 'public/css/custom.css');

