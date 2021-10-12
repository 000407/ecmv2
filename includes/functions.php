<?php

abstract class Role
{
    const ADMIN = 3;
    const EMPLOYEE = 2;
    const CUSTOMER = 1;
    const VISITOR = 0;

    public static function get(string $role) : int
    {
        return constant('self::'. $role);
    }
}

/**
 * Displays site name.
 */
function site_name()
{
    return config('name');
}

/**
 * Displays site url provided in config.
 */
function site_url()
{
    return config('site_url');
}

/**
 * Displays site version.
 */
function site_version()
{
    return config('version');
}

/**
 * Website navigation.
 */
function nav_menu($sep = ' | '): string
{
    $nav_menu = [];
    $nav_items = config('nav_menu');
    
    foreach ($nav_items as $url => $name) {
        // Add nav item to list.
        $nav_menu[] = "<a href='$url' title='$name' class='item'>$name</a>";
    }

    return implode($sep, $nav_menu);
}

require_once 'functions/auth.php';
require_once 'functions/blog.php';
require_once 'functions/db.php';
require_once 'functions/products.php';

?>