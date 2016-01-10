<html>
    <head>
        <title>Leaderboard - Login</title>
        <?php include __DIR__ . '/../include/css.php'; ?>
    </head>
    <body>
        <?php include __DIR__ . '/../include/navbar.php'; ?>

        <div class="container">
            <div class="col-lg-offset-3 col-lg-6">
                <form class="panel panel-default" method="post" action="/login">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input name="username" type="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-default">Login</button>
                    </div>
                </form>
            </div>
        </div>

        <?php include __DIR__ . '/../include/js.php'; ?>
    </body>
</html>