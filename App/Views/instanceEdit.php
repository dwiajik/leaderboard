<html>
    <head>
        <title>
            <?php if ($selectedInstance->id == null) { ?>
                New Instance - Leaderboard
            <?php } else { ?>
                Edit Instance - Leaderboard
            <?php } ?>
        </title>
        <?php include __DIR__ . '/include/css.php'; ?>
    </head>
    <body>
    <?php include __DIR__ . '/include/navbar.php'; ?>

        <div class="container">
            <?php include __DIR__ . "/include/alert.php"; ?>
            <h2>
                <?php if ($selectedInstance->id == null) { ?>
                    New Instance
                <?php } else { ?>
                    Edit Instance
                <?php } ?>
            </h2>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">
                    <?php if ($selectedInstance->id == null) { ?>
                        New Instance
                    <?php } else { ?>
                        Edit Instance
                    <?php } ?>
                </li>
            </ol>
            <div class="col-lg-12 no-padding">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <?php if ($selectedInstance->id == null) { ?>
                                <strong>New Instance</strong>
                            <?php } else { ?>
                                <strong>Edit Instance</strong>
                            <?php } ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form action="/instance/new" method="post" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" name="id" value="<?php echo $selectedInstance->id; ?>">
                            <div class="form-group">
                                <label>Instance Name</label>
                                <input type="text" class="form-control" placeholder="Instance Name" name="name" value="<?php echo $selectedInstance->name; ?>">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name="description"><?php echo $selectedInstance->description; ?></textarea>
                            </div>
                            <?php if ($selectedInstance->id == null) { ?>
                                <input type="submit" value="Create New Instance" class="btn btn-primary">
                            <?php } else { ?>
                                <input type="submit" value="Edit" class="btn btn-primary">
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php include __DIR__ . '/include/js.php'; ?>
    </body>
</html>