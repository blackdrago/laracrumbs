let mix = require('laravel-mix');

/** 
 * Mix Asset Management for Laracrumbs.
 *
 * var basePath = 'vendor/blackdrago/hellcat/src/resources/assets';
 *
 * @package Laracrumbs
 */


mix.scripts(['src/resources/assets/js/*.js'], 'src/public/js/scripts.js')
   .copy('node_modules/font-awesome/fonts/*', 'src/resources/assets/fonts/')
   .copy('node_modules/font-awesome/css/font-awesome.css', 'src/resources/assets/css/')
   .copy('src/resources/assets/fonts/*', 'src/public/fonts/')
   .styles(['src/resources/assets/css/*.css'], 'src/public/css/styles.css');
