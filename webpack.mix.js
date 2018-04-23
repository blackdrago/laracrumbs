let mix = require('laravel-mix');

/** 
 * Mix Asset Management for Laracrumbs.
 *
 * var basePath = 'vendor/blackdrago/hellcat/src/resources/assets';
 *
 * @package Laracrumbs
 */


mix.scripts(['src/resources/assets/js/*.js'],
            'src/public/scripts.js')
   .styles(['src/resources/assets/css/*.css'],
       'src/public/styles.css');
