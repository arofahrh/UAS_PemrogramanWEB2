<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<h1><?= $title; ?></h1>
<hr>

<p>Halaman artikel berhasil dibuka.</p>

<ul>
    <?php foreach ($artikel as $row): ?>
        <li><?= $row['judul']; ?></li>
    <?php endforeach; ?>
</ul>

<?= $this->endSection(); ?>