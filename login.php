<?php require_once __DIR__ . '/app/core/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/styles/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/styles/alertify.min.css">
    <link rel="stylesheet" href="assets/styles/alertify_default.min.css">
    <link rel="stylesheet" href="assets/styles/app.css">
    <title>Login</title>
</head>

<body>
    <div class="container w-100" style="max-width: 600px;">

        <form id="login" class="text-center border border-light p-5 w-100 needs-validation" novalidate>
            <p class="h4 mb-4">Login</p>
            <div class="form-group">
                <input type="text" name="username" id="username" class="form-control" placeholder="Email or Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <p class="login-lost">Not a member? <a href="register.php">Register now</a></p>
        </form>

    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/alertify.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>