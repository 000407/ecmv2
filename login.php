<?php require_once 'header.php'?>

<?php
if (isset($_POST['login'])) {
    authenticate($_POST['username'], $_POST['password']);
}
?>

<form method="post" action="<?= site_url() ?>/login.php">
    <div class="form-group">
        <label for="username">Email Address</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Email" />
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
    </div>
    <div>
        <button type="submit" name="login" value="login" class="btn btn-primary">Login</button>
    </div>
    <div>
        <p>No account? <a href="<?= site_url() ?>/register.php">Register now...</a></p>
    </div>
</form>


<?php require_once 'footer.php'?>