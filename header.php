<?php
    require_once 'includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title><?= site_name() ?></title>
    <link rel="stylesheet" href="<?= site_url() ?>/assets/bootstrap/v4.3.1/bootstrap.min.css" />
    <link href="<?= site_url() ?>/assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrap">
    <div class="login">
        <a href="<?= site_url() ?>/login.php">Login</a> |
        <a href="<?= site_url() ?>/register.php">Register</a>
    </div>
    <header>
        <h1><?= site_name() ?></h1>
        <nav class="menu">
            <?= nav_menu() ?>
        </nav>
    </header>

    <article>