<?php

function get_blog_entries($offset = -1, $limit = -1): array
{
    $mysqli = get_db_instance();

    $os = $offset ? "OFFSET $offset" : "";
    $lim = $limit ? "LIMIT $limit" : "";

    $sql = "SELECT id, title FROM posts $lim $os;";

    $res = $mysqli->query($sql);

    $rows = array();

    while($rec = $res->fetch_assoc()) {
        $rows[] = $rec;
    }

    $mysqli->close();

    return $rows;
}

function save_blog_entry($title, $body): array
{
    $mysqli = get_db_instance();

    $user_id = get_authentication()['user_id'];

    $sql = "INSERT INTO posts(user_id, title, body) VALUES($user_id, '$title', '$body');";

    $res = $mysqli->query($sql);

    $response = array('status=ERROR:SAVE_POST', null);

    if ($res) {
        $id = $mysqli->insert_id;
        $response = array('status=SUCCESS:SAVE_POST', $id);

        $site_url = 'site_url';
        header("Location: {$site_url()}/blog/view_post?id=$id");
    }

    $mysqli->close();

    return $response;
}

function get_blog_entry($id)
{
    $mysqli = get_db_instance();

    $sql = "SELECT posts.*, users.first_name, users.last_name 
FROM posts INNER JOIN users ON posts.user_id=users.id WHERE posts.id=$id;";

    $res = $mysqli->query($sql);

    $rows = array();

    while($rec = $res->fetch_assoc()) {
        $rows[] = $rec;
    }

    $mysqli->close();

    return $rows[0] ?? null;
}
