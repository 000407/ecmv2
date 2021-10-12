<?php
session_start();

function authenticate($username, $password)
{
    extract(config('db'), EXTR_OVERWRITE);

    $mysqli = get_db_instance();

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $location = perform_authentication($username, $password, $mysqli);

    $mysqli->close();

    header("Location: $location");
}

function get_authentication()
{
    $auth = [
        'is_authenticated' => false,
        'role' => Role::VISITOR
    ];

    if (isset($_SESSION['user'])) {
        $auth = [
            'is_authenticated' => true,
            'user_id' => $_SESSION['user']['user_id'],
            'username' => $_SESSION['user']['username'],
            'first_name' => $_SESSION['user']['first_name'],
            'last_name' => $_SESSION['user']['last_name'],
            'role' => $_SESSION['user']['role']
        ];
    }

    return $auth;
}

function register($user)
{
    extract(config('db'), EXTR_OVERWRITE);

    $mysqli = get_db_instance();

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $sha1 = 'sha1';
    $sql = <<<SQL
        INSERT INTO users(first_name, last_name, email, password)
        VALUES ('{$user['first_name']}', '{$user['last_name']}', '{$user['email']}', '{$sha1($user['password'])}');
SQL;

    $location = resolve_path('register?status=ERROR:INTERNAL_ERROR');

    if ($mysqli->query($sql)) {
        $location = resolve_path('login?status=SUCCESS:REGISTRATION');
    }
    else {
        $location = "$location&message=" . $mysqli->error;
    }

    $mysqli->close();

    header("Location: $location");
}

function logout()
{
    $_SESSION = array();
    session_destroy();

    $location = resolve_path('home');

    header("Location: $location");
}

/**
 * @param $username
 * @param $password
 * @param mysqli $mysqli
 * @param $callback
 * @return mixed|string
 */
function perform_authentication($username, $password, mysqli $mysqli)
{
    $sha1 = 'sha1';
    $sql = "SELECT * FROM users WHERE email='$username' AND password='{$sha1($password)}';";

    $location = site_url() . "/login.php?status=ERROR:INVALID_CREDENTIALS";

    if ($res = $mysqli->query($sql)) {
        $rec = $res->fetch_assoc(); // Fetch a single record; because username (here email) is unique

        $fetched_username = $rec['email'];

        if ($fetched_username === $username) {
            $_SESSION['user'] = [
                'user_id' => $rec['id'],
                'username' => $username,
                'first_name' => $rec['first_name'],
                'last_name' => $rec['last_name'],
                'role' => Role::get($rec['role'])
            ];

            $location = site_url() . "/home.php?status=SUCCESS:WELCOME";
        }
    }
    else {
        print_r($mysqli->error_list);
    }
    return $location;
}
