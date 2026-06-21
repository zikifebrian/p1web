<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin — Kelola Proyek</title>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Fira+Code:wght@400&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: #0d0f14; --card: #161b24; --accent: #5eead4;
      --accent2: #818cf8; --text: #e2e8f0; --muted: #64748b;
      --border: #1e2a3a; --danger: #f87171; --success: #4ade80;
    }
    * { margin:0; padding:0; box-sizing:border-box; }
    body { background:var(--bg); color:var(--text); font-family:'Space Grotesk',sans-serif; }

    /* NAV */
    nav {
      display:flex; justify-content:space-between; align-items:center;
      padding:16px 36px; border-bottom:1px solid var(--border);
      background:rgba(13,15,20,.95); backdrop-filter:blur(10px);
      position:sticky; top:0; z-index:100;
    }
    .logo { font-family:'Fira Code',monospace; color:var(--accent); font-size:.9rem; }
    nav a { color:var(--muted); text-decoration:none; font-size:.87rem; transition:color .2s; }
    nav a:hover { color:var(--accent); }

    /* WRAPPER */
    .wrap { max-width:960px; margin:0 auto; padding:36px 20px; }

    .page-title { font-size:1.5rem; font-weight:700; margin-bottom:4px; }
    .page-title span { color:var(--accent); }
    .page-sub { color:var(--muted); font-size:.87rem; margin-bottom:30px; }

    /* ALERT */
    .alert {
      padding:12px 18px; border-radius:10px; margin-bottom:22px;
      font-size:.88rem; display:flex; align-items:center; gap:10px;
    }
    .alert-ok  { background:rgba(74,222,128,.1); border:1px solid rgba(74,222,128,.3); color:var(--success); }
    .alert-err { background:rgba(248,113,113,.1); border:1px solid rgba(248,113,113,.3); color:var(--danger); }

    /* FORM */
    .form-box {
      background:var(--card); border:1px solid var(--border);
      border-radius:14px; padding:28px; margin-bottom:36px;
    }
    .form-box h3 {
      font-family:'Fira Code',monospace; font-size:.9rem;
      color:var(--accent2); margin-bottom:22px;
    }
    .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
    .form-full { grid-column: 1 / -1; }

    label { display:block; font-size:.8rem; color:var(--muted); margin-bottom:5px; }
    input, textarea {
      width:100%; padding:10px 14px;
      background:#0a0c11; border:1px solid var(--border);
      border-radius:8px; color:var(--text);
      font-family:'Space Grotesk',sans-serif; font-size:.9rem;
      outline:none; transition:border-color .2s;
    }
    input:focus, textarea:focus { border-color:var(--accent); }
    textarea { resize:vertical; min-height:90px; }

    .form-actions { margin-top:20px; display:flex; gap:10px; }
    .btn { padding:10px 22px; border:none; border-radius:8px; cursor:pointer; font-weight:600; font-size:.87rem; transition:all .2s; }
    .btn:hover { opacity:.85; }
    .btn-save  { background:var(--accent); color:#0d0f14; }
    .btn-cancel { background:transparent; border:1px solid var(--border); color:var(--muted); text-decoration:none; display:inline-flex; align-items:center; }
    .btn-cancel:hover { border-color:var(--muted); }

    /* TABLE */
    .table-box { background:var(--card); border:1px solid var(--border); border-radius:14px; overflow:hidden; }
    .table-head { padding:18px 24px; border-bottom:1px solid var(--border); }
    .table-head h3 { font-family:'Fira Code',monospace; font-size:.88rem; color:var(--accent2); }

    .tbl-wrap { overflow-x:auto; }
    table { width:100%; border-collapse:collapse; font-size:.87rem; }
    th {
      text-align:left; padding:12px 20px;
      color:var(--muted); font-size:.75rem; text-transform:uppercase;
      letter-spacing:.06em; border-bottom:1px solid var(--border);
    }
    td { padding:14px 20px; border-bottom:1px solid var(--border); vertical-align:middle; }
    tr:last-child td { border-bottom:none; }
    tr:hover td { background:rgba(255,255,255,.02); }

    .badge {
      display:inline-block; padding:4px 10px; border-radius:6px;
      background:rgba(129,140,248,.1); color:var(--accent2);
      font-size:.73rem; font-family:'Fira Code',monospace;
    }
    .no-data { text-align:center; padding:40px; color:var(--muted); font-size:.9rem; }

    .act-btns { display:flex; gap:8px; }
    .act-btns a {
      font-size:.8rem; padding:5px 12px; border-radius:6px;
      text-decoration:none; font-weight:600; transition:all .2s;
    }
    .btn-edit { background:rgba(94,234,212,.1); color:var(--accent); border:1px solid rgba(94,234,212,.2); }
    .btn-edit:hover { background:rgba(94,234,212,.2); }
    .btn-del { background:rgba(248,113,113,.1); color:var(--danger); border:1px solid rgba(248,113,113,.2); }
    .btn-del:hover { background:rgba(248,113,113,.2); }

    @media(max-width:600px) {
      .form-grid { grid-template-columns:1fr; }
      nav { padding:14px 16px; }
      .wrap { padding:24px 14px; }
    }
  </style>
</head>
<body>

<nav>
  <div class="logo">ziki.dev / admin</div>
  <a href="index.php">← Kembali ke Portfolio</a>
</nav>

<?php
require 'db.php';

$edit_data = null;
$msg = '';
$msg_type = '';

/* ── HAPUS ── */
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    if (mysqli_query($conn, "DELETE FROM projects WHERE id=$id")) {
        $msg = "✅ Proyek berhasil dihapus.";
        $msg_type = 'ok';
    } else {
        $msg = "❌ Gagal menghapus proyek.";
        $msg_type = 'err';
    }
}

/* ── AMBIL DATA EDIT ── */
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $res = mysqli_query($conn, "SELECT * FROM projects WHERE id=$id");
    $edit_data = mysqli_fetch_assoc($res);
}

/* ── SIMPAN / UPDATE ── */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = mysqli_real_escape_string($conn, trim($_POST['nama_proyek']));
    $desk  = mysqli_real_escape_string($conn, trim($_POST['deskripsi']));
    $tek   = mysqli_real_escape_string($conn, trim($_POST['teknologi']));
    $link  = mysqli_real_escape_string($conn, trim($_POST['link_github']));
    $tgl   = mysqli_real_escape_string($conn, $_POST['tanggal']);

    if (empty($nama)) {
        $msg = "❌ Nama proyek tidak boleh kosong.";
        $msg_type = 'err';
    } elseif (!empty($_POST['id'])) {
        $id = (int)$_POST['id'];
        mysqli_query($conn, "UPDATE projects SET nama_proyek='$nama', deskripsi='$desk', teknologi='$tek', link_github='$link', tanggal='$tgl' WHERE id=$id");
        $msg = "✅ Proyek berhasil diperbarui.";
        $msg_type = 'ok';
        $edit_data = null;
    } else {
        mysqli_query($conn, "INSERT INTO projects (nama_proyek,deskripsi,teknologi,link_github,tanggal) VALUES ('$nama','$desk','$tek','$link','$tgl')");
        $msg = "✅ Proyek baru berhasil ditambahkan.";
        $msg_type = 'ok';
    }
}
?>

<div class="wrap">
  <h2 class="page-title">Admin <span>Panel</span></h2>
  <p class="page-sub">Tambah, edit, dan hapus proyek portfolio kamu.</p>

  <?php if ($msg): ?>
  <div class="alert alert-<?= $msg_type ?>"><?= $msg ?></div>
  <?php endif; ?>

  <!-- FORM -->
  <div class="form-box">
    <h3><?= $edit_data ? '// edit_proyek · id #' . $edit_data['id'] : '// tambah_proyek_baru' ?></h3>
    <form method="POST">
      <?php if ($edit_data): ?>
        <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
      <?php endif; ?>

      <div class="form-grid">
        <div>
          <label>Nama Proyek *</label>
          <input type="text" name="nama_proyek" required placeholder="Contoh: Sistem Perpustakaan"
                 value="<?= htmlspecialchars($edit_data['nama_proyek'] ?? '') ?>">
        </div>
        <div>
          <label>Teknologi</label>
          <input type="text" name="teknologi" placeholder="PHP, MySQL, Bootstrap"
                 value="<?= htmlspecialchars($edit_data['teknologi'] ?? '') ?>">
        </div>
        <div class="form-full">
          <label>Deskripsi</label>
          <textarea name="deskripsi" placeholder="Jelaskan proyekmu secara singkat..."><?= htmlspecialchars($edit_data['deskripsi'] ?? '') ?></textarea>
        </div>
        <div>
          <label>Link GitHub</label>
          <input type="url" name="link_github" placeholder="https://github.com/username/repo"
                 value="<?= htmlspecialchars($edit_data['link_github'] ?? '') ?>">
        </div>
        <div>
          <label>Tanggal</label>
          <input type="date" name="tanggal" value="<?= $edit_data['tanggal'] ?? date('Y-m-d') ?>">
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-save"><?= $edit_data ? '💾 Perbarui Proyek' : '➕ Simpan Proyek' ?></button>
        <?php if ($edit_data): ?>
        <a href="admin.php" class="btn btn-cancel">Batal</a>
        <?php endif; ?>
      </div>
    </form>
  </div>

  <!-- TABEL -->
  <div class="table-box">
    <div class="table-head">
      <h3>// daftar_proyek</h3>
    </div>
    <div class="tbl-wrap">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Proyek</th>
            <th>Teknologi</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM projects ORDER BY tanggal DESC");
        if (mysqli_num_rows($result) === 0):
        ?>
        <tr><td colspan="5" class="no-data">Belum ada proyek. Tambah proyek pertama di atas!</td></tr>
        <?php
        else:
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)):
        ?>
        <tr>
          <td style="color:var(--muted)"><?= $no++ ?></td>
          <td><strong><?= htmlspecialchars($row['nama_proyek']) ?></strong></td>
          <td><span class="badge"><?= htmlspecialchars($row['teknologi']) ?></span></td>
          <td style="color:var(--muted)"><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
          <td>
            <div class="act-btns">
              <a href="admin.php?edit=<?= $row['id'] ?>" class="btn-edit">Edit</a>
              <a href="admin.php?hapus=<?= $row['id'] ?>" class="btn-del"
                 onclick="return confirm('Yakin ingin menghapus proyek ini?')">Hapus</a>
            </div>
          </td>
        </tr>
        <?php endwhile; endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
