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
                    <li role="presentation"><a href="/instance/<?php echo $instance->id; ?>">Overview</a></li>
                    <li role="presentation" class="active"><a href="#">Scores</a></li>
                </ul>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Overview
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php foreach ($scores as $score) { ?>
                                    <?php $i++; ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $score->id; ?></td>
                                        <td><?php echo $score->name; ?></td>
                                        <td><?php echo $score->score; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <?php include __DIR__ . '/include/js.php'; ?>
    </body>
</html>