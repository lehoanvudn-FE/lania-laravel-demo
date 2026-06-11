<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Lania Demo Laravel')</title>
    <style>
        :root {
            --brand: #0f766e;
            --brand-dark: #115e59;
            --ink: #17202a;
            --muted: #667085;
            --line: #e4e7ec;
            --bg: #f7fafc;
            --panel: #ffffff;
            --danger: #b42318;
            --success: #067647;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.5;
        }

        a { color: inherit; text-decoration: none; }
        img { display: block; max-width: 100%; }
        .container { width: min(1180px, calc(100% - 32px)); margin: 0 auto; }

        .topbar {
            background: #ffffff;
            border-bottom: 1px solid var(--line);
        }
        .topbar-inner {
            min-height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 22px;
        }
        .logo {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--brand), #14b8a6);
            display: grid;
            place-items: center;
            color: #ffffff;
            letter-spacing: .04em;
        }
        .auth-links { display: flex; align-items: center; gap: 10px; }
        .button, button {
            border: 0;
            border-radius: 8px;
            background: var(--brand);
            color: #ffffff;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font: inherit;
            font-weight: 700;
            min-height: 40px;
            padding: 9px 14px;
        }
        .button.secondary {
            background: #eef6f5;
            color: var(--brand-dark);
        }
        .button.danger { background: var(--danger); }
        .button.ghost {
            background: transparent;
            color: var(--brand-dark);
            border: 1px solid var(--line);
        }

        .hero {
            overflow: hidden;
            background: #0b3b38;
            color: #ffffff;
        }
        .slides {
            display: flex;
            width: 300%;
            animation: slide 12s infinite;
        }
        .slide {
            min-height: 300px;
            width: 33.333%;
            display: flex;
            align-items: center;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .slide::before {
            content: "";
            inset: 0;
            position: absolute;
            background: linear-gradient(90deg, rgba(3, 25, 23, .82), rgba(3, 25, 23, .25));
        }
        .slide-content { position: relative; width: min(640px, calc(100% - 32px)); margin-left: max(16px, calc((100vw - 1180px) / 2)); }
        .slide h1 { margin: 0 0 12px; font-size: clamp(32px, 5vw, 52px); line-height: 1.08; }
        .slide p { margin: 0; max-width: 620px; color: #d7fbf6; font-size: 18px; }
        @keyframes slide {
            0%, 27% { transform: translateX(0); }
            33%, 60% { transform: translateX(-33.333%); }
            66%, 93% { transform: translateX(-66.666%); }
            100% { transform: translateX(0); }
        }

        .nav-wrap { background: var(--brand); color: #ffffff; }
        .nav-toggle { display: none; }
        .nav-label { display: none; padding: 12px 0; font-weight: 700; }
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 4px;
            min-height: 52px;
        }
        .nav-menu a {
            border-radius: 8px;
            display: block;
            font-weight: 700;
            padding: 10px 14px;
        }
        .nav-menu a:hover { background: rgba(255,255,255,.14); }

        main { padding: 32px 0 48px; }
        .section-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
        }
        h1, h2, h3 { line-height: 1.2; }
        h2 { font-size: 28px; margin: 0; }
        .muted { color: var(--muted); }
        .grid { display: grid; gap: 18px; }
        .grid-3 { grid-template-columns: repeat(3, 1fr); }
        .grid-4 { grid-template-columns: repeat(4, 1fr); }
        .panel, .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 8px;
        }
        .panel { padding: 20px; }
        .card { overflow: hidden; }
        .card-body { padding: 16px; }
        .card h3 { margin: 0 0 8px; font-size: 19px; }
        .card-meta { color: var(--muted); font-size: 14px; margin-bottom: 8px; }
        .thumb {
            aspect-ratio: 16 / 9;
            background: #dbe7e5;
            object-fit: cover;
            width: 100%;
        }
        .stat {
            padding: 18px;
        }
        .stat strong { display: block; font-size: 30px; color: var(--brand-dark); }
        .flash {
            background: #ecfdf3;
            border: 1px solid #abefc6;
            border-radius: 8px;
            color: var(--success);
            margin-bottom: 18px;
            padding: 12px 14px;
        }
        .errors {
            background: #fef3f2;
            border: 1px solid #fecdca;
            border-radius: 8px;
            color: var(--danger);
            margin-bottom: 18px;
            padding: 12px 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
        }
        th, td {
            border-bottom: 1px solid var(--line);
            padding: 11px 12px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #eef6f5;
            color: var(--brand-dark);
            font-size: 14px;
        }
        .table-wrap {
            border: 1px solid var(--line);
            border-radius: 8px;
            overflow-x: auto;
            background: #ffffff;
        }
        .actions { display: flex; gap: 8px; flex-wrap: wrap; }
        .inline-form { display: inline; }
        .badge {
            border-radius: 999px;
            display: inline-flex;
            font-size: 13px;
            font-weight: 700;
            padding: 4px 9px;
        }
        .badge.green { background: #dcfae6; color: #067647; }
        .badge.gray { background: #f2f4f7; color: #475467; }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        .form-grid .full { grid-column: 1 / -1; }
        label { display: block; font-weight: 700; margin-bottom: 6px; }
        input, select, textarea {
            width: 100%;
            border: 1px solid #cfd6df;
            border-radius: 8px;
            font: inherit;
            padding: 10px 12px;
        }
        textarea { min-height: 120px; resize: vertical; }
        .form-actions { display: flex; gap: 10px; margin-top: 18px; flex-wrap: wrap; }
        .pagination {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            margin-top: 16px;
        }
        .article {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: 8px;
            overflow: hidden;
        }
        .article-body { padding: 24px; }
        .article-body h1 { margin-top: 0; font-size: 34px; }
        footer {
            background: #0b3b38;
            color: #cff8f2;
            padding: 24px 0;
        }

        @media (max-width: 820px) {
            .topbar-inner { align-items: flex-start; flex-direction: column; padding: 14px 0; }
            .auth-links { width: 100%; }
            .auth-links .button { flex: 1; }
            .nav-label { display: block; }
            .nav-menu { display: none; flex-direction: column; align-items: stretch; padding-bottom: 12px; }
            .nav-toggle:checked + .nav-label + .nav-menu { display: flex; }
            .grid-3, .grid-4 { grid-template-columns: 1fr; }
            .form-grid { grid-template-columns: 1fr; }
            .slide { min-height: 250px; }
            .slide h1 { font-size: 32px; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="container topbar-inner">
            <a class="brand" href="{{ route('home') }}">
                <span class="logo">LA</span>
                <span>Lania Company</span>
            </a>
            <div class="auth-links">
                <a class="button secondary" href="#">Đăng ký</a>
                <a class="button" href="#">Đăng nhập</a>
            </div>
        </div>
    </header>

    <section class="hero" aria-label="Banner có slide chuyển động">
        <div class="slides">
            <article class="slide" style="background-image:url('https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1600&q=80')">
                <div class="slide-content">
                    <h1>Demo Laravel theo file yêu cầu</h1>
                    <p>Đầy đủ header, banner slide, menu responsive, form, bảng dữ liệu, báo cáo và CRUD.</p>
                </div>
            </article>
            <article class="slide" style="background-image:url('https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=1600&q=80')">
                <div class="slide-content">
                    <h1>Quản lý tin tức thực tế</h1>
                    <p>Thêm, sửa, xóa, tìm kiếm, phân trang và kiểm tra dữ liệu hợp lệ bằng Laravel.</p>
                </div>
            </article>
            <article class="slide" style="background-image:url('https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1600&q=80')">
                <div class="slide-content">
                    <h1>Báo cáo nhanh cho khách hàng</h1>
                    <p>Hiển thị tối đa 10 chỉ số cùng thống kê theo danh mục để minh họa trang báo cáo.</p>
                </div>
            </article>
        </div>
    </section>

    <nav class="nav-wrap" aria-label="Menu chính">
        <div class="container">
            <input class="nav-toggle" id="nav-toggle" type="checkbox">
            <label class="nav-label" for="nav-toggle">Menu</label>
            <div class="nav-menu">
                <a href="{{ route('home') }}">Trang chủ</a>
                <a href="{{ route('tin-tuc.index') }}">Bảng dữ liệu</a>
                <a href="{{ route('tin-tuc.create') }}">Form nhập</a>
                <a href="{{ route('report') }}">Báo cáo</a>
            </div>
        </div>
    </nav>

    <main>
        <div class="container">
            @if (session('success'))
                <div class="flash">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="errors">
                    <strong>Vui lòng kiểm tra lại thông tin:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container">Laravel demo cho bảng estimate HTML/PHP.</div>
    </footer>
</body>
</html>
