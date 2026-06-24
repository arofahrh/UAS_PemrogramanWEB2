<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
</head>
<body>
    <header><h1>Portal Berita CI4</h1></header>
    <nav>
        <a href="<?= base_url('/'); ?>">Home</a> | 
        <a href="<?= base_url('/artikel'); ?>">Artikel</a>
    </nav>
    <main>
        <?= $this->renderSection('content'); ?>
    </main>
    <aside>
    </aside>
    <footer><p>&copy; 2026 - Praktikum Web 2</p></footer>
</body>
</html>