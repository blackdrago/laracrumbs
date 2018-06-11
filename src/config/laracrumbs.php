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
    'template' => 'laracrumbs::templates.laracrumbs',

    // use absolute paths for routes
    'absolute_paths' => true,

    // view-related configurations
    'separator' => '-&gt;',
    'class_wrapper' => 'laracrumbs-bar',
    'class_item' => 'laracrumbs-section',
    'class_list' => 'laracrumb-list',
    'class_list_item' => 'laracrumb-list-item',

];
