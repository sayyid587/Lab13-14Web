<?php
$db = new Database();
$form = new Form("", "Update Artikel");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$artikel = $db->get('artikel', "id={$id}");

if (!$artikel) {
    echo "<div style='color:red;padding:8px;'>Artikel tidak ditemukan.</div>";
    return;
}

if ($_POST) {
    $data = [
        'judul' => $_POST['judul'] ?? '',
        'isi' => $_POST['isi'] ?? ''
    ];
    $update = $db->update('artikel', $data, "id={$id}");
    if ($update) {
        echo "<div style='color:green;padding:8px;'>Artikel berhasil diupdate.</div>";
        // Refresh data
        $artikel = $db->get('artikel', "id={$id}");
    } else {
        echo "<div style='color:red;padding:8px;'>Gagal update artikel.</div>";
    }
}

// Tampilkan form dengan nilai existing (bypass Form class untuk prefilling)
?>
<form method="POST">
    <table>
        <tr><td>Judul</td><td><input type="text" name="judul" value="<?=htmlspecialchars($artikel['judul'])?>"></td></tr>
        <tr><td>Isi</td><td><textarea name="isi" cols="50" rows="8"><?=htmlspecialchars($artikel['isi'])?></textarea></td></tr>
        <tr><td></td><td><input type="submit" value="Update Artikel"></td></tr>
    </table>
</form>
