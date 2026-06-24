<?= $this->include('template/header'); ?>

<h2><?= $title; ?></h2>
<hr>
<p><?= $content; ?></p>
<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>
<?= $this->endSection(); ?>

<ul>
    <li>Email: arofah@website.com</li>
    <li>Telepon: 0812-3456-7890</li>
    <li>Instagram: @arofah_raudlatul</li>
</ul>

<?= $this->include('template/footer'); ?>