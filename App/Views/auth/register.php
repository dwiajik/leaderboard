<html>
    <head>
        <title>Leaderboard - Register</title>
        <?php include __DIR__ . '/../include/css.php'; ?>
    </head>
    <body>
        <?php include __DIR__ . '/../include/navbar.php'; ?>

        <div class="container">
            <div class="col-lg-offset-3 col-lg-6">
                <form class="panel panel-default" method="post" action="/register">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input name="username" type="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label>Password Confirmation</label>
                            <input name="passwordConfirmation" type="password" class="form-control" placeholder="Password Confirmation">
                        </div>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input name="fullname" type="username" class="form-control" placeholder="Full Name">
                        </div>
                        <button type="submit" class="btn btn-default">Register</button>
                    </div>
                </form>
            </div>
        </div>

        <?php include __DIR__ . '/../include/js.php'; ?>
    </body>
</html>