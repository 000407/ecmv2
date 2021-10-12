<?php

$auth = get_authentication();

if (!$auth['is_authenticated']) {
    # The user trying to access a restricted space: Redirect to login
    header("Location: " . site_url() . "/login.php?status=WARN:UNAUTHORIZED");
}