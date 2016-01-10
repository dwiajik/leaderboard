<html>
    <head>
        <title><?php echo $instance->name; ?> - Leaderboard</title>
        <?php include __DIR__ . '/include/css.php'; ?>
    </head>
    <body>
    <?php include __DIR__ . '/include/navbar.php'; ?>

        <div class="container">
            <?php include __DIR__ . "/include/alert.php"; ?>
            <h2><?php echo $instance->name; ?></h2>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active"><?php echo $instance->name; ?></li>
            </ol>
            <div class="col-lg-12 no-padding">
                <ul class="nav nav-tabs nav-instance">
                    <li role="presentation" class="active"><a href="#">Overview</a></li>
                    <li role="presentation"><a href="/score/<?php echo $instance->id; ?>">Scores</a></li>
                </ul>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Overview
                    </div>
                    <div class="panel-body">
                        <div>
                            <strong>Description</strong>
                            <p><?php echo $instance->description; ?></p>
                        </div>
                        <div>
                            <strong>Instance API ID</strong>
                            <p><?php echo $instance->id; ?></p>
                        </div>
                        <div>
                            <strong>Instance API Password</strong>
                            <p><?php echo $instance->password; ?></p>
                        </div>
                        <a href="/instance/edit?id=<?php echo $instance->id; ?>" class="btn btn-primary btn-new-instance">Edit Instance</a>
                    </div>
                </div>
            </div>
        </div>

    <?php include __DIR__ . '/include/js.php'; ?>
    </body>
</html>