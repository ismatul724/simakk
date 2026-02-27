<?php
require 'connection.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim     = trim($_POST['npm'] ?? '');
    $nama    = trim($_POST['nama'] ?? '');
    $jurusan = trim($_POST['jurusan'] ?? '');

    if ($nim && $nama && $jurusan) {
        $stmt = $pdo->prepare("INSERT INTO mahasiswa (npm, nama, jurusan) VALUES (?, ?, ?)");
        if ($stmt->execute([$nim, $nama, $jurusan])) {
            header("Location: index.php");
            exit;
        }
    } else {
        $error = 'Semua field wajib diisi sebelum menyimpan data.';
    }
}

$pageTitle  = 'Tambah Mahasiswa';
$breadcrumb = '<a href="index.php">Mahasiswa</a> · Tambah Data';
require '_layout_top.php';
?>

<div class="form-page fade-up">

    <?php if ($error): ?>
    <div class="alert-danger">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
        </svg>
        <?= htmlspecialchars($error) ?>
    </div>
    <?php endif; ?>

    <div class="form-card">
        <div class="form-card-header">
            <div class="fch-icon">🎓</div>
            <div class="fch-title">Registrasi Mahasiswa Baru</div>
            <div class="fch-sub">Isi seluruh data dengan benar dan lengkap</div>
        </div>

        <div class="form-card-body">
            <form method="POST">

                <div class="form-group">
                    <label class="form-label">Nomor Induk Mahasiswa (NIM) <span>*</span></label>
                    <input type="text" name="npm" class="form-input"
                           placeholder="Contoh: 2024001001"
                           value="<?= htmlspecialchars($_POST['npm'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span>*</span></label>
                    <input type="text" name="nama" class="form-input"
                           placeholder="Masukkan nama lengkap mahasiswa"
                           value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Program Studi / Jurusan <span>*</span></label>
                    <input type="text" name="jurusan" class="form-input"
                           placeholder="Contoh: Teknik Informatika"
                           value="<?= htmlspecialchars($_POST['jurusan'] ?? '') ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Data
                    </button>
                    <a href="index.php" class="btn btn-ghost">Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require '_layout_bottom.php'; ?>