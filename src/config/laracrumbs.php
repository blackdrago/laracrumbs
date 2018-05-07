<?php
/**
 * Configuration settings for Laracrumbs package.
 *
 * @package Laracrumbs
 */

return [
    // the laracrumb registration files
    'files' => [
        base_path('routes/laracrumbs.php')
    ],

    // language pack key (e.g., 'laracrumbs')
    'translation_key' => '',

    // breadcrumb template name
    'template' => 'laracrumbs::breadcrumbs.laracrumbs',

    // use absolute paths for routes
    'absolute_paths' => true,

];
