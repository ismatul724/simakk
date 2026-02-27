<?php
require 'connection.php';
$id   = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE id = ?");
$stmt->execute([$id]);
header("Location: index.php");
exit;