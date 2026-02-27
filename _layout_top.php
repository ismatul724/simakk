<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'SIMAK — Sistem Informasi Mahasiswa' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:         #F0F4FF;
            --white:      #FFFFFF;
            --surface:    #F7F9FF;
            --border:     #E2E8F7;
            --border2:    #C9D5F0;

            --primary:    #2563EB;
            --primary-lt: #EEF3FE;
            --primary-dk: #1D4ED8;

            --accent:     #7C3AED;
            --accent-lt:  #F3EFFE;

            --success:    #059669;
            --success-lt: #ECFDF5;

            --danger:     #DC2626;
            --danger-lt:  #FEF2F2;

            --warning:    #D97706;
            --warning-lt: #FFFBEB;

            --text:       #0F172A;
            --text2:      #334155;
            --muted:      #64748B;
            --subtle:     #94A3B8;

            --sidebar-w:  256px;
            --font:       'Plus Jakarta Sans', sans-serif;
        }

        body {
            font-family: var(--font);
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--white);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            box-shadow: 4px 0 24px rgba(37,99,235,0.05);
        }

        .sidebar-logo {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--primary), #3B82F6);
            border-radius: 12px;
            display: grid; place-items: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(37,99,235,0.35);
            flex-shrink: 0;
        }

        .logo-name { font-size: 1.05rem; font-weight: 800; color: var(--text); letter-spacing: -0.03em; }
        .logo-sub  { font-size: 0.68rem; color: var(--muted); margin-top: 1px; font-weight: 500; }

        .sidebar-nav { padding: 1.25rem 0.875rem; flex: 1; }

        .nav-section-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--subtle);
            padding: 0 0.625rem;
            margin-bottom: 0.4rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.65rem 0.75rem;
            border-radius: 10px;
            text-decoration: none;
            color: var(--muted);
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.16s ease;
            margin-bottom: 2px;
        }

        .nav-link:hover { background: var(--primary-lt); color: var(--primary); }

        .nav-link.active {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 14px rgba(37,99,235,0.3);
        }

        .nav-link svg { width: 17px; height: 17px; flex-shrink: 0; }

        .sidebar-bottom {
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--border);
        }

        .user-row { display: flex; align-items: center; gap: 0.75rem; }

        .user-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            display: grid; place-items: center;
            color: #fff;
            font-size: 0.72rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .user-name { font-size: 0.82rem; font-weight: 600; color: var(--text2); }
        .user-role { font-size: 0.7rem; color: var(--subtle); }

        /* ── MAIN ── */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

        .topbar {
            height: 68px;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0; z-index: 50;
            box-shadow: 0 1px 8px rgba(0,0,0,0.04);
        }

        .page-title   { font-size: 1.05rem; font-weight: 700; color: var(--text); letter-spacing: -0.02em; }
        .breadcrumb   { font-size: 0.775rem; color: var(--subtle); margin-top: 1px; }
        .breadcrumb a { color: var(--primary); text-decoration: none; font-weight: 500; }

        .status-pill {
            display: inline-flex; align-items: center; gap: 0.4rem;
            height: 32px; padding: 0 0.9rem;
            border-radius: 100px;
            border: 1.5px solid var(--border2);
            font-size: 0.775rem; font-weight: 600;
            color: var(--muted);
        }

        .dot-green { width: 7px; height: 7px; background: var(--success); border-radius: 50%; }

        .content { padding: 2rem; flex: 1; }

        /* ── STAT CARDS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(185px, 1fr));
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            display: flex; align-items: center; gap: 1rem;
            box-shadow: 0 1px 6px rgba(0,0,0,0.04);
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .stat-card:hover { box-shadow: 0 6px 24px rgba(37,99,235,0.1); transform: translateY(-2px); }

        .stat-icon {
            width: 48px; height: 48px; border-radius: 12px;
            display: grid; place-items: center;
            font-size: 1.3rem; flex-shrink: 0;
        }

        .stat-icon.blue   { background: var(--primary-lt); }
        .stat-icon.green  { background: var(--success-lt); }
        .stat-icon.purple { background: var(--accent-lt); }

        .stat-label { font-size: 0.72rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.25rem; }
        .stat-value { font-size: 1.75rem; font-weight: 800; color: var(--text); letter-spacing: -0.04em; line-height: 1; }
        .stat-value.sm { font-size: 1.25rem; }

        /* ── CARD ── */
        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 6px rgba(0,0,0,0.04);
        }

        .card-header {
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }

        .card-title { font-size: 0.95rem; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 0.5rem; }

        .count-badge {
            background: var(--primary-lt);
            color: var(--primary);
            border-radius: 100px;
            padding: 0.15rem 0.55rem;
            font-size: 0.72rem;
            font-weight: 700;
        }

        /* ── TABLE ── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 0.875rem; }

        thead th {
            padding: 0.8rem 1.25rem;
            text-align: left;
            font-size: 0.7rem; font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
        }

        tbody tr { border-bottom: 1px solid var(--border); transition: background 0.14s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #F8FAFF; }
        tbody td { padding: 0.9rem 1.25rem; vertical-align: middle; }

        .nim-text  { font-size: 0.82rem; font-weight: 700; color: var(--primary); letter-spacing: 0.04em; }
        .name-text { font-weight: 600; color: var(--text2); }
        .no-text   { color: var(--subtle); font-size: 0.8rem; font-weight: 500; }

        .badge-prodi {
            display: inline-flex;
            padding: 0.22rem 0.7rem;
            border-radius: 100px;
            font-size: 0.72rem; font-weight: 600;
            background: var(--accent-lt);
            color: var(--accent);
        }

        .action-row { display: flex; gap: 0.4rem; }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.82rem; font-weight: 600;
            font-family: var(--font);
            text-decoration: none; border: none; cursor: pointer;
            transition: all 0.16s ease;
            white-space: nowrap;
        }

        .btn svg { width: 14px; height: 14px; }

        .btn-primary { background: var(--primary); color: #fff; box-shadow: 0 2px 8px rgba(37,99,235,0.25); }
        .btn-primary:hover { background: var(--primary-dk); box-shadow: 0 4px 16px rgba(37,99,235,0.35); transform: translateY(-1px); }

        .btn-success { background: var(--success); color: #fff; box-shadow: 0 2px 8px rgba(5,150,105,0.2); }
        .btn-success:hover { background: #047857; box-shadow: 0 4px 14px rgba(5,150,105,0.3); transform: translateY(-1px); }

        .btn-ghost { background: var(--white); color: var(--text2); border: 1.5px solid var(--border2); }
        .btn-ghost:hover { background: var(--surface); border-color: var(--primary); color: var(--primary); }

        .btn-edit {
            background: var(--warning-lt); color: var(--warning);
            border: 1px solid #FDE68A; padding: 0.35rem 0.75rem;
        }
        .btn-edit:hover { background: var(--warning); color: #fff; border-color: var(--warning); }

        .btn-del {
            background: var(--danger-lt); color: var(--danger);
            border: 1px solid #FECACA; padding: 0.35rem 0.75rem;
        }
        .btn-del:hover { background: var(--danger); color: #fff; border-color: var(--danger); }

        /* ── FORM ── */
        .form-page { max-width: 540px; }

        .form-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(37,99,235,0.07);
        }

        .form-card-header {
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, #3B82F6 100%);
            color: #fff;
        }

        .form-card-header.edit-header {
            background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%);
        }

        .fch-icon {
            width: 44px; height: 44px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: grid; place-items: center;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }

        .fch-title { font-size: 1.1rem; font-weight: 800; letter-spacing: -0.02em; }
        .fch-sub   { font-size: 0.8rem; opacity: 0.75; margin-top: 2px; }

        .form-card-body { padding: 1.75rem; }

        .form-group { margin-bottom: 1.25rem; }

        .form-label {
            display: block;
            font-size: 0.8rem; font-weight: 600;
            color: var(--text2);
            margin-bottom: 0.45rem;
        }

        .form-label span { color: var(--danger); margin-left: 2px; }

        .form-input {
            width: 100%;
            padding: 0.7rem 1rem;
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            font-family: var(--font);
            font-size: 0.9rem; font-weight: 500;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .form-input::placeholder { color: var(--subtle); font-weight: 400; }

        .form-input:focus {
            background: var(--white);
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
        }

        .form-actions { display: flex; gap: 0.75rem; padding-top: 0.25rem; }

        .alert-danger {
            display: flex; align-items: center; gap: 0.6rem;
            padding: 0.85rem 1rem;
            border-radius: 10px;
            font-size: 0.85rem; font-weight: 500;
            background: var(--danger-lt);
            border: 1px solid #FECACA;
            color: var(--danger);
            margin-bottom: 1.25rem;
        }

        /* ── EMPTY STATE ── */
        .empty-state { padding: 4rem 2rem; text-align: center; }

        .empty-icon {
            width: 72px; height: 72px;
            background: var(--primary-lt);
            border-radius: 20px;
            display: grid; place-items: center;
            font-size: 1.75rem;
            margin: 0 auto 1.25rem;
        }

        .empty-title { font-size: 1rem; font-weight: 700; color: var(--text); margin-bottom: 0.4rem; }
        .empty-sub   { font-size: 0.85rem; color: var(--muted); margin-bottom: 1.5rem; }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .fade-up   { animation: fadeUp 0.35s ease both; }
        .fade-up-2 { animation: fadeUp 0.35s 0.07s ease both; }
        .fade-up-3 { animation: fadeUp 0.35s 0.14s ease both; }

        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 3px; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">🎓</div>
        <div>
            <div class="logo-name">SIMAK</div>
            <div class="logo-sub">Sistem Informasi Mahasiswa</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu</div>

        <a href="index.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18M3 18h18M3 6h18"/>
            </svg>
            Data Mahasiswa
        </a>

        <a href="tambah.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'tambah.php' ? 'active' : '' ?>">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Mahasiswa
        </a>
    </nav>

    <div class="sidebar-bottom">
        <div class="user-row">
            <div class="user-avatar">ADM</div>
            <div>
                <div class="user-name">Administrator</div>
                <div class="user-role">Super Admin</div>
            </div>
        </div>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <div>
            <div class="page-title"><?= $pageTitle ?? 'Dashboard' ?></div>
            <div class="breadcrumb"><?= $breadcrumb ?? '' ?></div>
        </div>
        <div class="status-pill">
            <span class="dot-green"></span> Online
        </div>
    </header>

    <div class="content">