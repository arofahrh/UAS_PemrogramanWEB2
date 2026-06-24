<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>

<div class="faq-item">
    <h4>Apa itu website ini?</h4>
    <p>Website ini adalah hasil latihan praktikum CodeIgniter 4.</p>
</div>

<div class="faq-item">
    <h4>Apa yang dipelajari pada praktikum ini?</h4>
    <p>Pada praktikum ini dipelajari View Layout dan View Cell.</p>
</div>

<div class="faq-item">
    <h4>Apakah tampilan bisa dipakai ulang?</h4>
    <p>Bisa, karena sudah memakai layout utama dan komponen sidebar dinamis.</p>
</div>
<?= $this->endSection(); ?>