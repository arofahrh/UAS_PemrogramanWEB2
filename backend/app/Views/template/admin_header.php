<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
</head>
<body>
<div id="container">
    <header class="admin-header">
        <h1>Admin Artikel</h1>
        <p class="admin-subtitle">Brown Aesthetic Elegant Dashboard</p>
    </header>

    <nav class="admin-nav">
        <a href="<?= base_url('/admin/artikel'); ?>">Dashboard</a>
        <a href="<?= base_url('/admin/artikel/add'); ?>">Tambah Artikel</a>
        <a href="<?= base_url('/artikel'); ?>">Lihat Website</a>
        <a href="<?= base_url('/'); ?>">Home</a>
    </nav>

    <section id="wrapper">
        <section id="main"></section>