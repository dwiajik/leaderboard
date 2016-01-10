<html>
    <head>
        <title>Dashboard - Leaderboard</title>
        <?php include __DIR__ . '/include/css.php'; ?>
    </head>
    <body>
    <?php include __DIR__ . '/include/navbar.php'; ?>

        <div class="container">
            <?php include __DIR__ . "/include/alert.php"; ?>
            <h2>Home</h2>
            <ol class="breadcrumb">
                <li class="active">Home</li>
            </ol>
            <div class="col-lg-12 no-padding">
                <a href="/instance/new" class="btn btn-primary btn-new-instance">New Instance</a>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <strong>Instances</strong>
                        </h3>
                    </div>
                    <div class="panel-body instance-list">
                        <?php foreach ($instances as $instance) {?>
                        <div>
                            <h4 class="instance-name">
                                <a href="/instance/<?php echo $instance->id; ?>">
                                    <strong><?php echo $instance->name; ?></strong>
                                </a>
                            </h4>
                            <div><?php echo $instance->description; ?></div>
                            <hr>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    <?php include __DIR__ . '/include/js.php'; ?>
    </body>
</html>