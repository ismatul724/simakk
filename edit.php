<?php
require 'connection.php';

$id   = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) { header("Location: index.php"); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $npm     = trim($_POST['npm'] ?? '');
    $nama    = trim($_POST['nama'] ?? '');
    $jurusan = trim($_POST['jurusan'] ?? '');

    if ($npm && $nama && $jurusan) {
        $stmt = $pdo->prepare("UPDATE mahasiswa SET npm=?, nama=?, jurusan=? WHERE id=?");
        if ($stmt->execute([$npm, $nama, $jurusan, $id])) {
            header("Location: index.php");
            exit;
        }
    } else {
        $error = 'Semua field wajib diisi sebelum menyimpan perubahan.';
    }
}

$pageTitle  = 'Edit Mahasiswa';
$breadcrumb = '<a href="index.php">Mahasiswa</a> · Edit Data';
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
        <div class="form-card-header edit-header">
            <div class="fch-icon">✏️</div>
            <div class="fch-title">Edit Data Mahasiswa</div>
            <div class="fch-sub">ID: #<?= $id ?> · Perbarui informasi di bawah ini</div>
        </div>

        <div class="form-card-body">
            <form method="POST">

                <div class="form-group">
                    <label class="form-label">Nomor Induk Mahasiswa (NIM) <span>*</span></label>
                    <input type="text" name="npm" class="form-input"
                           value="<?= htmlspecialchars($_POST['npm'] ?? $data['npm']) ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span>*</span></label>
                    <input type="text" name="nama" class="form-input"
                           value="<?= htmlspecialchars($_POST['nama'] ?? $data['nama']) ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Program Studi / Jurusan <span>*</span></label>
                    <input type="text" name="jurusan" class="form-input"
                           value="<?= htmlspecialchars($_POST['jurusan'] ?? $data['jurusan']) ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                    <a href="index.php" class="btn btn-ghost">Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require '_layout_bottom.php'; ?>