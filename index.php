<?php
require 'connection.php';

$stmt     = $pdo->query("SELECT * FROM mahasiswa ORDER BY id DESC");
$mahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total    = count($mahasiswa);

$jurusanStmt  = $pdo->query("SELECT COUNT(DISTINCT jurusan) as cnt FROM mahasiswa");
$totalJurusan = $jurusanStmt->fetch(PDO::FETCH_ASSOC)['cnt'] ?? 0;

$pageTitle = 'Data Mahasiswa';
$breadcrumb = '<a href="index.php">Beranda</a> · Mahasiswa';
require '_layout_top.php';
?>

<!-- STAT CARDS -->
<div class="stats-grid fade-up">
    <div class="stat-card">
        <div class="stat-icon blue">👨‍🎓</div>
        <div>
            <div class="stat-label">Total Mahasiswa</div>
            <div class="stat-value"><?= $total ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple">📚</div>
        <div>
            <div class="stat-label">Program Studi</div>
            <div class="stat-value"><?= $totalJurusan ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">🗓️</div>
        <div>
            <div class="stat-label">Tahun Akademik</div>
            <div class="stat-value sm">2024/25</div>
        </div>
    </div>
</div>

<!-- DATA TABLE -->
<div class="card fade-up-2">
    <div class="card-header">
        <div class="card-title">
            Daftar Mahasiswa
            <span class="count-badge"><?= $total ?></span>
        </div>
        <a href="tambah.php" class="btn btn-primary">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Data
        </a>
    </div>

    <?php if ($total > 0): ?>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:50px">#</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Program Studi</th>
                    <th style="width:160px; text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1; foreach ($mahasiswa as $row): ?>
                <tr>
                    <td class="no-text"><?= $no++ ?></td>
                    <td><span class="nim-text"><?= htmlspecialchars($row['npm']) ?></span></td>
                    <td class="name-text"><?= htmlspecialchars($row['nama']) ?></td>
                    <td><span class="badge-prodi"><?= htmlspecialchars($row['jurusan']) ?></span></td>
                    <td>
                        <div class="action-row" style="justify-content:center">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-edit">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-del"
                               onclick="return confirm('Hapus data <?= htmlspecialchars(addslashes($row['nama'])) ?>?')">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6M10 5a1 1 0 011-1h2a1 1 0 011 1v2H9V5z"/>
                                </svg>
                                Hapus
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="empty-state">
        <div class="empty-icon">📭</div>
        <div class="empty-title">Belum ada data mahasiswa</div>
        <div class="empty-sub">Mulai dengan menambahkan mahasiswa pertama</div>
        <a href="tambah.php" class="btn btn-primary">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Mahasiswa
        </a>
    </div>
    <?php endif; ?>
</div>

<?php require '_layout_bottom.php'; ?>