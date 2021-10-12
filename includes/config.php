<?php

/**
 * Used to store website configuration information.
 *
 * @var string or null
 */
function config($key = '')
{
    $site_url = '/ecmv2';

    $config = [
        'name' => 'eCommerce Web Application',
        'site_url' => $site_url,
        'nav_menu' => [
            '' => 'Home',
            "$site_url/products_view.php" => 'Products',
            "$site_url/blog_all.php" => 'Blog'
        ],
        'version' => 'v1.0',
        'db' => [
            'host' => 'localhost',
            'port' => '3306',
            'db_name' => 'db_ecm',
            'db_user' => 'root',
            'db_pass' => ''
        ]
    ];

    return $config[$key] ?? null;
}

require_once 'functions.php';