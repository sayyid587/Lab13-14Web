<?php
$db = new Database();
$form = new Form("", "Simpan Artikel");

if ($_POST) {
    $data = [
        'judul' => $_POST['judul'] ?? '',
        'isi' => $_POST['isi'] ?? ''
    ];
    $simpan = $db->insert('artikel', $data);
    if ($simpan) {
        echo "<div style='color:green;padding:8px;'>Artikel berhasil disimpan.</div>";
    } else {
        echo "<div style='color:red;padding:8px;'>Gagal menyimpan artikel.</div>";
    }
}

$form->addField("judul", "Judul");
$form->addField("isi", "Isi", "textarea");
$form->displayForm();
