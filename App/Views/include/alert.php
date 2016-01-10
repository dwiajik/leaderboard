<div class="col-lg-12 no-padding">
<?php if (isset($_SESSION['success'])) foreach ($_SESSION['success'] as $s) { ?>
    <div class="alert alert-success" role="alert"><?php echo $s; ?></div>
    <?php unset($_SESSION['success']); ?>
<?php } ?>

<?php if (isset($_SESSION['info'])) foreach ($_SESSION['info'] as $i) { ?>
    <div class="alert alert-info" role="alert"><?php echo $i; ?></div>
    <?php unset($_SESSION['info']); ?>
<?php } ?>

<?php if (isset($_SESSION['warning'])) foreach ($_SESSION['warning'] as $w) { ?>
    <div class="alert alert-warning" role="alert"><?php echo $w; ?></div>
    <?php unset($_SESSION['warning']); ?>
<?php } ?>

<?php if (isset($_SESSION['error'])) foreach ($_SESSION['error'] as $e) { ?>
    <div class="alert alert-danger" role="alert"><?php echo $e; ?></div>
    <?php unset($_SESSION['error']); ?>
<?php } ?>
</div>
