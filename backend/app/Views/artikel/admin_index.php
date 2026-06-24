<?= $this->include('template/admin_header'); ?>

<div class="admin-page">
    <div class="admin-topbar">
        <h2><?= $title; ?></h2>
        <a class="btn btn-add" href="<?= base_url('/admin/artikel/add'); ?>">+ Tambah Artikel</a>
    </div>

    <div class="card-table">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($artikel): ?>
                    <?php foreach ($artikel as $row): ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td>
                                <div class="article-title"><?= $row['judul']; ?></div>
                                <div class="article-snippet"><?= substr($row['isi'], 0, 80); ?>...</div>
                            </td>
                            <td>
                                <span class="badge-status">
                                    <?= $row['status']; ?>
                                </span>
                            </td>
                            <td>
                                <a class="btn btn-edit" href="<?= base_url('/admin/artikel/edit/' . $row['id']); ?>">Ubah</a>
                                <a class="btn btn-delete"
                                   href="<?= base_url('/admin/artikel/delete/' . $row['id']); ?>"
                                   onclick="return confirm('Yakin hapus data?');">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="empty-state">Belum ada data artikel.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->include('template/admin_footer'); ?>