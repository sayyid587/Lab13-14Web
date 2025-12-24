<?php
$db = new Database();

/* ===============================
   HAPUS DATA (DELETE)
================================ */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $db->delete('artikel', "id={$id}");
     echo "<script>
        alert('Artikel berhasil dihapus');
        window.location.href = '/lab11_php_oop/index.php/artikel/index';
    </script>";
    exit;
}

/* ===============================
   SEARCH & PAGINATION
================================ */
$limit = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = ($page < 1) ? 1 : $page;
$start = ($page - 1) * $limit;

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : "";

/* Hitung total data */
if ($keyword != "") {
    $totalData = $db->query("
        SELECT COUNT(*) AS total 
        FROM artikel 
        WHERE judul LIKE '%$keyword%' 
           OR isi LIKE '%$keyword%'
    ")->fetch_assoc();

    $data = $db->query("
        SELECT * FROM artikel 
        WHERE judul LIKE '%$keyword%' 
           OR isi LIKE '%$keyword%'
        ORDER BY id DESC 
        LIMIT $start, $limit
    ");
} else {
    $totalData = $db->query("SELECT COUNT(*) AS total FROM artikel")->fetch_assoc();

    $data = $db->query("
        SELECT * FROM artikel 
        ORDER BY id DESC 
        LIMIT $start, $limit
    ");
}

$totalPage = ceil($totalData['total'] / $limit);
?>

<h3>Daftar Artikel</h3>

<a href="/lab11_php_oop/index.php/artikel/tambah" class="btn-primary">
    ➕ Tambah Artikel
</a>

<!-- FORM SEARCH -->
<form method="get" style="margin:15px 0;">
    <input type="text" name="keyword"
           placeholder="Cari judul atau isi artikel..."
           value="<?= htmlspecialchars($keyword) ?>">
    <button type="submit">Cari</button>
</form>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
<tr>
    <th style="width:50px;">No</th>
    <th>Judul</th>
    <th>Isi Artikel</th>
    <th style="width:160px;">Aksi</th>
</tr>

<?php
$no = $start + 1;
if ($data->num_rows > 0):
while ($r = $data->fetch_assoc()):
?>
<tr>
    <td><?= $no++ ?></td>
    <td><strong><?= htmlspecialchars($r['judul']) ?></strong></td>
    <td><?= htmlspecialchars(substr($r['isi'], 0, 120)) ?>...</td>
    <td>
        <a class="edit" href="/lab11_php_oop/index.php/artikel/ubah?id=<?= $r['id'] ?>">✏️ Ubah</a>
        |
        <a class="delete"
           href="/lab11_php_oop/index.php/artikel/index?delete=<?= $r['id'] ?>"
           onclick="return confirm('Hapus artikel?')">
           🗑 Hapus
        </a>
    </td>
</tr>
<?php endwhile; else: ?>
<tr>
    <td colspan="4" align="center">Data tidak ditemukan.</td>
</tr>
<?php endif; ?>
</table>

<!-- PAGINATION -->
<div style="margin-top:15px;">
<?php for ($i = 1; $i <= $totalPage; $i++): ?>
    <a href="?page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>"
       style="padding:6px 10px;
              border:1px solid #333;
              margin-right:4px;
              text-decoration:none;
              <?= ($page == $i) ? 'background:#333;color:#fff;' : '' ?>">
       <?= $i ?>
    </a>
<?php endfor; ?>
</div>
