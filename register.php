<?php require_once __DIR__ . '/app/core/init.php' ?>
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
    <title>Register</title>
</head>

<body>
    <div class="container w-100" style="max-width: 600px;">

        <form id="register" class="text-center border border-light p-5 w-100" action="#" method="POST">
            <p class="h4 mb-4">Register</p>
            <div class="form-group">
                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="form-group">
                <input type="text" name="surname" id="surname" class="form-control" placeholder="Surname" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="text" name="username" id="username" minlength="3" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" minlength="8" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" id="confirm_password" minlength="8" class="form-control" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <p class="login-lost">Actually a member? <a href="login.php">Login now</a></p>
        </form>

    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/alertify.min.js"></script>
    <script src="assets/js/alertify.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>