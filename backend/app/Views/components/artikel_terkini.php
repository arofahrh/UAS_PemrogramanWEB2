<div class="widget-box">
    <h3 class="title">Artikel Terkini</h3>

    <?php if (!empty($artikel)): ?>
        <ul>
            <?php foreach ($artikel as $row): ?>
                <li>
                    <a href="<?= base_url('/artikel/' . $row['slug']); ?>">
                        <?= $row['judul']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p style="padding: 14px 18px;">Belum ada artikel terbaru.</p>
    <?php endif; ?>
</div>