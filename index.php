<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio — Ziki Febrian</title>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg:      #0d0f14;
      --card:    #161b24;
      --accent:  #5eead4;
      --accent2: #818cf8;
      --text:    #e2e8f0;
      --muted:   #64748b;
      --border:  #1e2a3a;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'Space Grotesk', sans-serif;
      min-height: 100vh;
    }

    /* ── NAVBAR ── */
    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 18px 40px;
      border-bottom: 1px solid var(--border);
      position: sticky; top: 0;
      background: rgba(13,15,20,.9);
      backdrop-filter: blur(10px);
      z-index: 100;
    }
    .logo {
      font-family: 'Fira Code', monospace;
      color: var(--accent);
      font-size: .95rem;
    }
    nav a {
      color: var(--muted);
      text-decoration: none;
      font-size: .88rem;
      margin-left: 24px;
      transition: color .2s;
    }
    nav a:hover { color: var(--accent); }
    nav a.active { color: var(--text); }

    /* ── HERO ── */
    .hero {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 90px 20px 60px;
      position: relative;
      overflow: hidden;
    }
    .hero::before {
      content: '';
      position: absolute;
      width: 500px; height: 500px;
      background: radial-gradient(circle, rgba(94,234,212,.12) 0%, transparent 65%);
      top: -80px; left: 50%; transform: translateX(-50%);
      pointer-events: none;
    }
    .avatar {
      width: 88px; height: 88px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      display: flex; align-items: center; justify-content: center;
      font-size: 1.8rem; font-weight: 700; color: var(--bg);
      margin-bottom: 22px;
      box-shadow: 0 0 40px rgba(94,234,212,.25);
    }
    .hero h1 { font-size: clamp(2rem, 5vw, 3rem); font-weight: 700; line-height: 1.2; }
    .hero h1 span { color: var(--accent); }
    .tag {
      display: inline-block;
      background: rgba(94,234,212,.08);
      color: var(--accent);
      border: 1px solid rgba(94,234,212,.25);
      padding: 5px 16px;
      border-radius: 99px;
      font-family: 'Fira Code', monospace;
      font-size: .82rem;
      margin: 14px 0 18px;
    }
    .hero p { color: var(--muted); max-width: 460px; line-height: 1.75; font-size: .95rem; }
    .hero-btns { display: flex; gap: 12px; margin-top: 28px; flex-wrap: wrap; justify-content: center; }
    .btn {
      display: inline-block;
      padding: 10px 24px;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
      font-size: .88rem;
      transition: all .2s;
    }
    .btn-primary { background: var(--accent); color: var(--bg); }
    .btn-primary:hover { opacity: .85; transform: translateY(-1px); }
    .btn-outline {
      border: 1px solid var(--border);
      color: var(--muted);
      background: transparent;
    }
    .btn-outline:hover { border-color: var(--accent); color: var(--accent); }

    /* ── SECTION ── */
    .section { max-width: 920px; margin: 0 auto; padding: 50px 20px; }
    .section-label {
      font-family: 'Fira Code', monospace;
      font-size: .88rem;
      color: var(--accent2);
      margin-bottom: 24px;
    }
    .section-label span { color: var(--muted); }

    /* ── ABOUT GRID ── */
    .about-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 14px;
    }
    .about-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 20px;
      transition: border-color .2s;
    }
    .about-card:hover { border-color: var(--accent2); }
    .about-card strong { display: block; color: var(--accent); font-size: .8rem; margin-bottom: 6px; text-transform: uppercase; letter-spacing: .05em; }
    .about-card p { color: var(--text); font-size: .92rem; }

    /* ── SKILLS ── */
    .skills-wrap { display: flex; flex-wrap: wrap; gap: 10px; }
    .skill-badge {
      background: rgba(129,140,248,.1);
      border: 1px solid rgba(129,140,248,.25);
      color: var(--accent2);
      padding: 6px 14px;
      border-radius: 8px;
      font-family: 'Fira Code', monospace;
      font-size: .8rem;
    }

    /* ── PROJECTS ── */
    .projects-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
      gap: 18px;
    }
    .project-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 24px;
      display: flex; flex-direction: column;
      transition: border-color .2s, transform .2s;
    }
    .project-card:hover { border-color: var(--accent); transform: translateY(-4px); }
    .project-tech {
      font-family: 'Fira Code', monospace;
      font-size: .72rem;
      color: var(--accent2);
      margin-bottom: 10px;
    }
    .project-card h3 { font-size: 1rem; margin-bottom: 8px; }
    .project-card p { color: var(--muted); font-size: .87rem; line-height: 1.65; flex: 1; }
    .project-footer {
      margin-top: 16px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .project-date { font-size: .75rem; color: var(--muted); }
    .project-card a { font-size: .82rem; color: var(--accent); text-decoration: none; }
    .project-card a:hover { text-decoration: underline; }

    .empty-state {
      color: var(--muted);
      font-size: .9rem;
      padding: 30px 0;
      text-align: center;
    }
    .empty-state a { color: var(--accent); text-decoration: none; }

    /* ── DIVIDER ── */
    .divider {
      border: none;
      border-top: 1px solid var(--border);
      margin: 0;
    }

    /* ── FOOTER ── */
    footer {
      text-align: center;
      padding: 32px 20px;
      color: var(--muted);
      font-size: .82rem;
    }
    footer span { color: var(--accent); }

    @media (max-width: 600px) {
      nav { padding: 14px 20px; }
      .hero { padding: 60px 16px 40px; }
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav>
  <div class="logo">ziki.dev</div>
  <div>
    <a href="index.php" class="active">Home</a>
    <a href="#proyek">Proyek</a>
    <a href="admin.php">Admin</a>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="avatar">ZF</div>
  <h1>Halo, Saya <span>Ziki Febrian</span> 👋</h1>
  <div class="tag">// Mahasiswa Teknik Informatika · UIR · Semester 4</div>
  <p>Seorang mahasiswa yang antusias dalam pengembangan web, belajar membangun aplikasi dengan PHP, MySQL, dan terus berkembang setiap harinya.</p>
  <div class="hero-btns">
    <a href="#proyek" class="btn btn-primary">Lihat Proyek</a>
    <a href="admin.php" class="btn btn-outline">⚙ Kelola Proyek</a>
  </div>
</section>

<hr class="divider">

<!-- ABOUT -->
<div class="section">
  <p class="section-label"><span>// </span>tentang_saya</p>
  <div class="about-grid">
    <div class="about-card">
      <strong>🎓 Universitas</strong>
      <p>Universitas Islam Riau</p>
    </div>
    <div class="about-card">
      <strong>📚 Jurusan</strong>
      <p>Teknik Informatika</p>
    </div>
    <div class="about-card">
      <strong>📅 Semester</strong>
      <p>4 (Genap 2024)</p>
    </div>
    <div class="about-card">
      <strong>📍 Lokasi</strong>
      <p>Pekanbaru, Riau</p>
    </div>
  </div>
</div>

<hr class="divider">

<!-- SKILLS -->
<div class="section">
  <p class="section-label"><span>// </span>skill_teknologi</p>
  <div class="skills-wrap">
    <?php
    $skills = ['PHP', 'MySQL', 'HTML5', 'CSS3', 'JavaScript', 'Bootstrap', 'phpMyAdmin', 'XAMPP', 'Git'];
    foreach ($skills as $s):
    ?>
    <span class="skill-badge"><?= $s ?></span>
    <?php endforeach; ?>
  </div>
</div>

<hr class="divider">

<!-- PROJECTS -->
<div class="section" id="proyek">
  <p class="section-label"><span>// </span>proyek_saya</p>
  <div class="projects-grid">
    <?php
    require 'db.php';
    $result = mysqli_query($conn, "SELECT * FROM projects ORDER BY tanggal DESC");

    if (mysqli_num_rows($result) === 0):
    ?>
    <div class="empty-state">
      <p>Belum ada proyek. <a href="admin.php">Tambah proyek pertama →</a></p>
    </div>
    <?php
    else:
    while ($row = mysqli_fetch_assoc($result)):
    ?>
    <div class="project-card">
      <div class="project-tech"><?= htmlspecialchars($row['teknologi']) ?></div>
      <h3><?= htmlspecialchars($row['nama_proyek']) ?></h3>
      <p><?= htmlspecialchars($row['deskripsi']) ?></p>
      <div class="project-footer">
        <span class="project-date"><?= date('d M Y', strtotime($row['tanggal'])) ?></span>
        <?php if (!empty($row['link_github'])): ?>
        <a href="<?= htmlspecialchars($row['link_github']) ?>" target="_blank">GitHub →</a>
        <?php endif; ?>
      </div>
    </div>
    <?php
    endwhile;
    endif;
    ?>
  </div>
</div>

<!-- FOOTER -->
<footer>
  Dibuat dengan ❤️ oleh <span>Ziki Febrian</span> · Teknik Informatika UIR · 2024
</footer>

</body>
</html>
