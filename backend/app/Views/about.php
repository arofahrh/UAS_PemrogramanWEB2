<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
</head>
<body>
    <h1><?= $title; ?></h1>
    <p><?= $content; ?></p>
    <?= $this->include('template/header'); ?>

<h2><?= $title; ?></h2>
<hr>
<p><?= $content; ?></p>

<?= $this->include('template/footer'); ?>
<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>
<?= $this->endSection(); ?>
</body>
</html>