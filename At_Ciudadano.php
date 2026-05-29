<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención al Propietario — CorpoCapital</title>
    <link rel="icon" href="img/img/lilcorpo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="bootstrap-5.3.6-dist/css/bootstrap.min.css" rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Cormorant+SC:wght@300;400;500;600;700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
    /* ═══════════════════════════════════════════════════════════
       ATENCIÓN AL CIUDADANO — Estilos reforzados contra Bootstrap
       ═══════════════════════════════════════════════════════════ */

    /* ── Reset Bootstrap overrides ─────────────────────────── */
    .ac-page h1, .ac-page h2, .ac-page h3, .ac-page h4, .ac-page h5, .ac-page h6 {
        margin-top: 0;
        margin-bottom: 0;
        font-weight: inherit;
        line-height: inherit;
    }
    .ac-page p {
        margin-top: 0;
        margin-bottom: 0;
    }
    .ac-page ul {
        margin-bottom: 0;
        padding-left: 0;
    }
    .ac-page a:not(.nav-link):not(.btn-suite) {
        color: inherit;
        text-decoration: none;
    }
    .ac-page a:not(.nav-link):not(.btn-suite):hover {
        color: inherit;
    }
    .ac-page label {
        margin-bottom: 0;
    }

    /* ── Page Hero ──────────────────────────────────────────── */
    .page-hero {
        position: relative;
        height: 60vh;
        min-height: 440px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: var(--azul);
    }
    .page-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: 
            radial-gradient(ellipse at 20% 80%, rgba(21,96,189,0.3) 0%, transparent 60%),
            radial-gradient(ellipse at 80% 20%, rgba(42,117,212,0.2) 0%, transparent 50%);
        z-index: 1;
        pointer-events: none;
    }
    .page-hero .deco-grid {
        position: absolute;
        inset: 0;
        z-index: 0;
        opacity: 0.035;
        background-image: 
            linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px);
        background-size: 80px 80px;
    }
    .page-hero-body {
        position: relative;
        z-index: 2;
        text-align: center;
        padding: 0 24px;
    }
    .page-hero .hero-eyebrow {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        font-family: var(--font-sc);
        font-size: 0.65rem;
        font-weight: 400;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.45);
        margin-bottom: 24px;
    }
    .page-hero .hero-eyebrow .eyebrow-line {
        display: block;
        width: 40px;
        height: 1px;
        background: rgba(255,255,255,0.2);
    }
    .page-hero-title {
        font-family: var(--font-display) !important;
        font-weight: 300 !important;
        font-size: clamp(2.6rem, 6vw, 5.5rem) !important;
        line-height: 0.95 !important;
        letter-spacing: -0.02em;
        color: #fff;
        margin-bottom: 20px !important;
    }
    .page-hero-title em {
        font-style: italic;
        font-weight: 300;
        color: rgba(255,255,255,0.5);
    }
    .page-hero-sub {
        font-family: var(--font-body);
        font-style: italic;
        font-size: clamp(0.9rem, 1.6vw, 1.1rem);
        color: rgba(255,255,255,0.5);
        letter-spacing: 0.04em;
        max-width: 560px;
        margin: 0 auto !important;
    }

    /* ── Cómo funciona ─────────────────────────────────────── */
    .section-como {
        padding: 120px 0;
        background: var(--blanco);
    }
    .como-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 80px;
        align-items: center;
    }
    .como-left .display-title {
        margin-bottom: 24px !important;
    }
    .como-desc {
        font-family: var(--font-body) !important;
        font-size: 1rem !important;
        line-height: 1.85 !important;
        color: var(--texto-soft) !important;
        margin-bottom: 32px !important;
    }

    /* ── Pasos ──────────────────────────────────────────────── */
    .pasos-list {
        display: flex;
        flex-direction: column;
        gap: 0;
    }
    .paso-item {
        display: flex;
        align-items: flex-start;
        gap: 24px;
        padding: 32px 0;
        border-bottom: 1px solid var(--gris-20);
    }
    .paso-item:first-child {
        border-top: 1px solid var(--gris-20);
    }
    .paso-num {
        font-family: var(--font-display) !important;
        font-size: 2.8rem !important;
        font-weight: 300 !important;
        color: #000000;
        line-height: 1 !important;
        flex-shrink: 0;
        width: 56px;
        opacity: 0.5;
    }
    .paso-content h4 {
        font-family: var(--font-display) !important;
        font-weight: 500 !important;
        font-size: 1.15rem !important;
        color: var(--texto) !important;
        margin-bottom: 6px !important;
        line-height: 1.3 !important;
    }
    .paso-content p {
        font-family: var(--font-body) !important;
        font-size: 0.82rem !important;
        line-height: 1.75 !important;
        color: var(--texto-soft) !important;
    }

    /* ── Tipos de Solicitud ────────────────────────────────── */
    .section-tipos {
        padding: 100px 0;
        background: var(--gris-10);
    }
    .tipos-header {
        text-align: center;
        margin-bottom: 64px;
    }
    .tipos-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 2px;
    }
    .tipo-card {
        padding: 48px 36px;
        position: relative;
        overflow: hidden;
        transition: transform 0.4s var(--ease-out);
    }
    .tipo-card:hover {
        transform: translateY(-8px);
    }
    .tipo-card::before {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.4s;
    }
    .tipo-card:hover::before {
        opacity: 1;
    }

    /* Card light */
    .tipo-card.tipo-light {
        background: var(--blanco-puro);
        border-top: 3px solid var(--azul-pale);
    }
    .tipo-card.tipo-light::before { background: var(--azul-ghost); }
    .tipo-card.tipo-light .tipo-card-icon { color: var(--azul-mid); }
    .tipo-card.tipo-light h3 { color: var(--texto) !important; }
    .tipo-card.tipo-light p { color: var(--texto-soft) !important; }

    /* Card dark */
    .tipo-card.tipo-dark {
        background: var(--azul);
        color: #fff;
    }
    .tipo-card.tipo-dark::before { background: var(--azul-mid); }
    .tipo-card.tipo-dark .tipo-card-icon { color: rgba(255,255,255,0.7); }
    .tipo-card.tipo-dark h3 { color: #fff !important; }
    .tipo-card.tipo-dark p { color: rgba(255,255,255,0.68) !important; }

    /* Card accent */
    .tipo-card.tipo-accent {
        background: var(--azul-mid);
        color: #fff;
    }
    .tipo-card.tipo-accent::before { background: var(--azul-light); }
    .tipo-card.tipo-accent .tipo-card-icon { color: rgba(255,255,255,0.7); }
    .tipo-card.tipo-accent h3 { color: #fff !important; }
    .tipo-card.tipo-accent p { color: rgba(255,255,255,0.68) !important; }

    .tipo-card-icon {
        font-size: 28px;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }
    .tipo-card h3 {
        font-family: var(--font-display) !important;
        font-weight: 500 !important;
        font-size: 1.3rem !important;
        margin-bottom: 14px !important;
        position: relative;
        z-index: 1;
        line-height: 1.25 !important;
    }
    .tipo-card p {
        font-family: var(--font-body) !important;
        font-size: 0.82rem !important;
        line-height: 1.75 !important;
        position: relative;
        z-index: 1;
    }

    /* ── Formulario ────────────────────────────────────────── */
    .section-formulario {
        padding: 120px 0;
        background: var(--blanco);
    }
    .form-layout {
        display: grid;
        grid-template-columns: 1fr 1.4fr;
        gap: 80px;
        align-items: start;
    }
    .form-info .display-title {
        margin-bottom: 24px !important;
    }
    .form-info-desc {
        font-family: var(--font-body) !important;
        font-size: 0.95rem !important;
        line-height: 1.85 !important;
        color: var(--texto-soft) !important;
        margin-bottom: 36px !important;
    }
    .form-contact-item {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
    }
    .form-contact-item i {
        font-size: 20px;
        color: var(--azul-mid);
        width: 24px;
        text-align: center;
    }
    .form-contact-item span {
        font-family: var(--font-body) !important;
        font-size: 0.85rem !important;
        color: var(--texto-soft) !important;
    }

    /* ── Form Card ─────────────────────────────────────────── */
    .form-card {
        background: var(--blanco-puro);
        border: 1px solid var(--gris-20);
        padding: 48px 44px;
        position: relative;
    }
    .form-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--azul), var(--azul-mid));
    }
    .form-card h3 {
        font-family: var(--font-display) !important;
        font-weight: 500 !important;
        font-size: 1.4rem !important;
        color: var(--texto) !important;
        margin-bottom: 8px !important;
    }
    .form-card-sub {
        font-family: var(--font-body) !important;
        font-style: italic;
        font-size: 0.82rem !important;
        color: var(--gris-60) !important;
        margin-bottom: 32px !important;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .form-group.full {
        grid-column: 1 / -1;
    }
    .form-group label {
        font-family: var(--font-sc) !important;
        font-size: 0.62rem !important;
        font-weight: 500 !important;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--gris-60) !important;
    }
    .form-group input,
    .form-group select,
    .form-group textarea {
        font-family: var(--font-body) !important;
        font-size: 0.88rem !important;
        color: var(--texto) !important;
        background: var(--gris-10) !important;
        border: 1px solid var(--gris-20) !important;
        border-radius: 2px !important;
        padding: 12px 16px !important;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        width: 100%;
    }
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: var(--azul-mid) !important;
        box-shadow: 0 0 0 3px rgba(21,96,189,0.08) !important;
    }
    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }
    .form-group select {
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='7' viewBox='0 0 12 7'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%238596B0' stroke-width='1.5' fill='none'/%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: right 16px center !important;
        padding-right: 40px !important;
    }
    .btn-submit {
        font-family: var(--font-sc) !important;
        font-size: 0.7rem !important;
        font-weight: 500 !important;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #fff !important;
        background: var(--azul) !important;
        border: none !important;
        padding: 14px 40px !important;
        border-radius: 2px !important;
        cursor: pointer;
        width: 100%;
        margin-top: 8px;
        transition: background 0.25s, box-shadow 0.28s var(--ease-out), transform 0.28s var(--ease-out);
    }
    .btn-submit:hover {
        background: var(--azul-mid) !important;
        box-shadow: 0 12px 36px rgba(10,36,99,0.22);
        transform: translateY(-3px);
    }

    /* ── Horarios ───────────────────────────────────────────── */
    .section-horarios {
        padding: 100px 0;
        background: var(--azul);
    }
    .horarios-header {
        margin-bottom: 56px;
    }
    .horarios-header .kicker { color: rgba(255,255,255,0.45); }
    .horarios-header .display-title { color: #fff; }
    .horarios-header .display-title em { color: rgba(255,255,255,0.45); }

    .horarios-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 24px;
    }
    .horario-card {
        padding: 40px 32px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 2px;
        transition: background 0.3s, border-color 0.3s, transform 0.4s var(--ease-out);
    }
    .horario-card:hover {
        background: rgba(255,255,255,0.08);
        border-color: rgba(255,255,255,0.15);
        transform: translateY(-6px);
    }
    .horario-card > i {
        font-size: 28px;
        color: rgba(255,255,255,0.4);
        margin-bottom: 20px;
        display: block;
    }
    .horario-card h4 {
        font-family: var(--font-display) !important;
        font-weight: 500 !important;
        font-size: 1.15rem !important;
        color: #fff !important;
        margin-bottom: 10px !important;
    }
    .horario-card p {
        font-family: var(--font-body) !important;
        font-size: 0.82rem !important;
        line-height: 1.75 !important;
        color: rgba(255,255,255,0.5) !important;
    }

    /* ── FAQ ────────────────────────────────────────────────── */
    .section-faq {
        padding: 100px 0;
        background: var(--gris-10);
    }
    .faq-header {
        text-align: center;
        margin-bottom: 64px;
    }
    .faq-list {
        max-width: 800px;
        margin: 0 auto;
    }
    .faq-item {
        border-bottom: 1px solid var(--gris-20);
    }
    .faq-item:first-child {
        border-top: 1px solid var(--gris-20);
    }
    .faq-question {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 24px 0;
        background: none !important;
        border: none !important;
        cursor: pointer;
        text-align: left;
        font-family: var(--font-display) !important;
        font-weight: 500 !important;
        font-size: 1.1rem !important;
        color: var(--texto) !important;
        line-height: 1.4 !important;
        transition: color 0.2s;
        border-radius: 0 !important;
    }
    .faq-question:hover {
        color: var(--azul-mid) !important;
    }
    .faq-question:focus {
        box-shadow: none !important;
        outline: none !important;
    }
    .faq-question i {
        font-size: 20px;
        color: var(--gris-60);
        transition: transform 0.3s var(--ease-out);
        flex-shrink: 0;
        margin-left: 16px;
    }
    .faq-item.active .faq-question i {
        transform: rotate(180deg);
    }
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s var(--ease-out), padding 0.4s;
        padding: 0;
    }
    .faq-item.active .faq-answer {
        max-height: 200px;
        padding-bottom: 24px;
    }
    .faq-answer p {
        font-family: var(--font-body) !important;
        font-size: 0.88rem !important;
        line-height: 1.8 !important;
        color: var(--texto-soft) !important;
    }

    /* ── Footer overrides ──────────────────────────────────── */
    .footer-cc .footer-col ul {
        list-style: none !important;
        padding-left: 0 !important;
        margin-bottom: 0 !important;
    }
    .footer-cc .footer-col ul li a {
        color: rgba(255,255,255,0.55) !important;
        text-decoration: none !important;
    }
    .footer-cc .footer-col ul li a:hover {
        color: #fff !important;
    }

    /* ── Responsive ─────────────────────────────────────────── */
    @media (max-width: 1024px) {
        .como-grid { grid-template-columns: 1fr; gap: 56px; }
        .tipos-grid { grid-template-columns: 1fr 1fr; }
        .form-layout { grid-template-columns: 1fr; gap: 56px; }
        .horarios-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
        .page-hero { height: 50vh; min-height: 360px; }
        .page-hero-title { font-size: 2.4rem !important; }
        .form-row { grid-template-columns: 1fr; }
        .form-card { padding: 32px 24px; }
        .tipos-grid { grid-template-columns: 1fr; }
    }
    </style>
</head>
<body class="ac-page">

<!-- ══ NAVBAR ══ -->
<nav id="navbar" class="scrolled">
    <div class="nav-inner">
        <a href="index.php" class="nav-logo">
            <img src="img/img/logo.png" alt="CorpoCapital" class="nav-logo-img">
        </a>
        <div class="nav-links" id="navLinks">
            <a href="quienes_somos.html" class="nav-link">¿Quiénes Somos?</a>
            <a href="At_Ciudadano.php" class="nav-link">Atención al Propietario</a>
            <a href="https://corpo.capital" class="btn-suite" target="_blank" rel="noopener">Corpo Suite</a>
        </div>
        <button type="button" class="nav-hamburger" id="navToggle" aria-label="Menú">
            <span></span><span></span>
        </button>
    </div>
</nav>

<!-- ══ PAGE HERO ══ -->
<section class="page-hero">
    <div class="deco-grid"></div>
    <div class="page-hero-body">
        <div class="hero-eyebrow reveal-up" data-delay="0">
            <span class="eyebrow-line"></span>
            <span>Canal de Servicio</span>
            <span class="eyebrow-line"></span>
        </div>
        <h1 class="page-hero-title reveal-up" data-delay="120">
            Atención al <em>Propietario</em>
        </h1>
        <p class="page-hero-sub reveal-up" data-delay="260">
            Tu canal directo para solicitudes, consultas y gestiones con CorpoCapital
        </p>
    </div>
    <div class="hero-scroll">
        <div class="scroll-line"></div>
        <span>Desplazar</span>
    </div>
</section>

<!-- ══ FRANJA INSTITUCIONAL ══ -->
<div class="ticker-wrap">
    <div class="ticker-track">
        <span class="ticker-item">Atención al Propietario</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Solicitudes</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Gestión Ciudadana</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Respuesta Oportuna</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Servicio Público</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Transparencia</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Atención al Propietario</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Solicitudes</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Gestión Ciudadana</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Respuesta Oportuna</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Servicio Público</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Transparencia</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Atención al Propietario</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Solicitudes</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Gestión Ciudadana</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Respuesta Oportuna</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Servicio Público</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Transparencia</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Atención al Propietario</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Solicitudes</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Gestión Ciudadana</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Respuesta Oportuna</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Servicio Público</span><span class="ticker-dot">·</span>
        <span class="ticker-item">Transparencia</span><span class="ticker-dot">·</span>
    </div>
</div>

<!-- ══ CÓMO FUNCIONA ══ -->
<section class="section-como">
    <div class="container-cc">
        <div class="como-grid">
            <div class="como-left">
                <p class="kicker reveal-left">Proceso de Atención</p>
                <h2 class="display-title reveal-left" data-delay="80">
                    ¿Cómo realizar<br>tu <em>solicitud?</em>
                </h2>
                <p class="como-desc reveal-left" data-delay="160">
                    CorpoCapital pone a tu disposición un canal directo y eficiente para gestionar solicitudes, consultas y trámites relacionados con el Distrito Capital.
                </p>
                <a href="#formulario" class="link-arrow reveal-left" data-delay="240">
                    Ir al formulario <i class='bx bx-right-arrow-alt'></i>
                </a>
            </div>
            <div class="como-right">
                <div class="pasos-list">
                    <div class="paso-item reveal-right" data-delay="0">
                        <span class="paso-num">01</span>
                        <div class="paso-content">
                            <h4>Identifícate</h4>
                            <p>Ingresa tus datos personales: nombre completo, cédula de identidad y datos de contacto.</p>
                        </div>
                    </div>
                    <div class="paso-item reveal-right" data-delay="80">
                        <span class="paso-num">02</span>
                        <div class="paso-content">
                            <h4>Selecciona el tipo de solicitud</h4>
                            <p>Elige la categoría que mejor se ajuste a tu necesidad: consulta, reclamo, solicitud de servicio u otro.</p>
                        </div>
                    </div>
                    <div class="paso-item reveal-right" data-delay="160">
                        <span class="paso-num">03</span>
                        <div class="paso-content">
                            <h4>Describe tu caso</h4>
                            <p>Proporciona los detalles de tu solicitud con la mayor claridad posible para agilizar la respuesta.</p>
                        </div>
                    </div>
                    <div class="paso-item reveal-right" data-delay="240">
                        <span class="paso-num">04</span>
                        <div class="paso-content">
                            <h4>Recibe respuesta</h4>
                            <p>Nuestro equipo procesará tu solicitud y te contactará a través del medio que hayas indicado.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ TIPOS DE SOLICITUD ══ -->
<section class="section-tipos">
    <div class="container-cc">
        <div class="tipos-header">
            <p class="kicker reveal-up">Categorías</p>
            <h2 class="display-title reveal-up" data-delay="80">Tipos de <em>Solicitud</em></h2>
        </div>
        <div class="tipos-grid">
            <div class="tipo-card tipo-light reveal-up" data-delay="0">
                <div class="tipo-card-icon"><i class='bx bx-help-circle'></i></div>
                <h3>Consulta General</h3>
                <p>Solicita información sobre los servicios, programas y actividades de CorpoCapital.</p>
            </div>
            <div class="tipo-card tipo-dark reveal-up" data-delay="80">
                <div class="tipo-card-icon"><i class='bx bx-error-circle'></i></div>
                <h3>Reclamo</h3>
                <p>Reporta inconformidades o situaciones que requieran atención por parte de la corporación.</p>
            </div>
            <div class="tipo-card tipo-light reveal-up" data-delay="160">
                <div class="tipo-card-icon"><i class='bx bx-wrench'></i></div>
                <h3>Solicitud de Servicio</h3>
                <p>Gestiona trámites, certificaciones u otros servicios que ofrece la institución.</p>
            </div>
            <div class="tipo-card tipo-accent reveal-up" data-delay="240">
                <div class="tipo-card-icon"><i class='bx bx-message-dots'></i></div>
                <h3>Sugerencia</h3>
                <p>Comparte tus ideas y propuestas para mejorar los servicios institucionales.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══ FORMULARIO ══ -->
<section class="section-formulario" id="formulario">
    <div class="container-cc">
        <div class="form-layout">
            <div class="form-info">
                <p class="kicker reveal-left">Envía tu Solicitud</p>
                <h2 class="display-title reveal-left" data-delay="80">
                    Comunícate<br><em>con nosotros</em>
                </h2>
                <p class="form-info-desc reveal-left" data-delay="160">
                    Completa el formulario con tus datos y el detalle de tu solicitud. Nuestro equipo se pondrá en contacto contigo en el menor tiempo posible.
                </p>
                <div class="reveal-left" data-delay="240">
                    <div class="form-contact-item">
                        <i class='bx bx-phone'></i>
                        <span>Número de Contacto</span>
                    </div>
                    <div class="form-contact-item">
                        <i class='bx bx-envelope'></i>
                        <span>Correo Institucional</span>
                    </div>
                    <div class="form-contact-item">
                        <i class='bx bx-map'></i>
                        <span>Sede Principal, Distrito Capital</span>
                    </div>
                    <div class="form-contact-item">
                        <i class='bx bx-time'></i>
                        <span>Lunes a Viernes, 8:00 AM – 4:00 PM</span>
                    </div>
                </div>
            </div>
            <div class="form-card reveal-right" data-delay="0">
                <h3>Formulario de Solicitud</h3>
                <p class="form-card-sub">Todos los campos marcados con * son obligatorios</p>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre">Nombre Completo *</label>
                            <input type="text" id="nombre" name="nombre" placeholder="Ej: Juan Pérez" required>
                        </div>
                        <div class="form-group">
                            <label for="cedula">Cédula de Identidad *</label>
                            <input type="text" id="cedula" name="cedula" placeholder="Ej: V-12345678" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Correo Electrónico *</label>
                            <input type="email" id="email" name="email" placeholder="correo@ejemplo.com" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="tel" id="telefono" name="telefono" placeholder="Ej: 0412-1234567">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full">
                            <label for="tipo">Tipo de Solicitud *</label>
                            <select id="tipo" name="tipo" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <option value="consulta">Consulta General</option>
                                <option value="reclamo">Reclamo</option>
                                <option value="servicio">Solicitud de Servicio</option>
                                <option value="sugerencia">Sugerencia</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full">
                            <label for="asunto">Asunto *</label>
                            <input type="text" id="asunto" name="asunto" placeholder="Breve descripción de tu solicitud" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full">
                            <label for="mensaje">Mensaje *</label>
                            <textarea id="mensaje" name="mensaje" placeholder="Describe tu solicitud con el mayor detalle posible..." required></textarea>
                        </div>
                    </div>
                    <button type="button" class="btn-submit" onclick="alert('Solicitud enviada correctamente. Nos comunicaremos contigo pronto.')">Enviar Solicitud</button>
            </div>
        </div>
    </div>
</section>

<!-- ══ HORARIOS ══ -->
<section class="section-horarios">
    <div class="container-cc">
        <div class="horarios-header">
            <p class="kicker reveal-left">Información de Servicio</p>
            <h2 class="display-title reveal-left" data-delay="80">Horarios y <em>Ubicación</em></h2>
        </div>
        <div class="horarios-grid">
            <div class="horario-card reveal-up" data-delay="0">
                <i class='bx bx-time-five'></i>
                <h4>Horario de Atención</h4>
                <p>Lunes a Viernes de 8:00 AM a 4:00 PM. Atención presencial y telefónica en horario de oficina.</p>
            </div>
            <div class="horario-card reveal-up" data-delay="100">
                <i class='bx bx-map-pin'></i>
                <h4>Sede Principal</h4>
                <p>Distrito Capital, Caracas, Venezuela. Visítanos para atención personalizada.</p>
            </div>
            <div class="horario-card reveal-up" data-delay="200">
                <i class='bx bx-laptop'></i>
                <h4>Atención Digital</h4>
                <p>También puedes contactarnos a través de nuestras redes sociales y correo electrónico institucional.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══ FAQ ══ -->
<section class="section-faq">
    <div class="container-cc">
        <div class="faq-header">
            <p class="kicker reveal-up">Dudas Frecuentes</p>
            <h2 class="display-title reveal-up" data-delay="80">Preguntas <em>Frecuentes</em></h2>
        </div>
        <div class="faq-list">
            <div class="faq-item reveal-up" data-delay="0">
                <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                    ¿Cuánto tiempo tarda la respuesta a mi solicitud?
                    <i class='bx bx-chevron-down'></i>
                </button>
                <div class="faq-answer">
                    <p>El tiempo de respuesta varía según el tipo de solicitud. Las consultas generales se atienden en un plazo de 3 a 5 días hábiles, mientras que las solicitudes de servicio pueden requerir un tiempo mayor dependiendo de la complejidad del caso.</p>
                </div>
            </div>
            <div class="faq-item reveal-up" data-delay="60">
                <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                    ¿Qué documentos necesito para realizar un trámite?
                    <i class='bx bx-chevron-down'></i>
                </button>
                <div class="faq-answer">
                    <p>Los requisitos varían según el tipo de trámite. En general, necesitarás tu cédula de identidad vigente, y cualquier documento adicional que sustente tu solicitud. Puedes consultarnos previamente para conocer los requisitos específicos.</p>
                </div>
            </div>
            <div class="faq-item reveal-up" data-delay="120">
                <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                    ¿Puedo dar seguimiento a mi solicitud?
                    <i class='bx bx-chevron-down'></i>
                </button>
                <div class="faq-answer">
                    <p>Sí, una vez enviada tu solicitud recibirás un número de referencia. Puedes contactarnos con ese número para conocer el estado de tu caso a través de cualquiera de nuestros canales de atención.</p>
                </div>
            </div>
            <div class="faq-item reveal-up" data-delay="180">
                <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                    ¿Atienden los fines de semana?
                    <i class='bx bx-chevron-down'></i>
                </button>
                <div class="faq-answer">
                    <p>Nuestro horario de atención es de lunes a viernes de 8:00 AM a 4:00 PM. Sin embargo, puedes enviar tu solicitud a través del formulario web en cualquier momento y será procesada en el siguiente día hábil.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ FOOTER ══ -->
<footer class="footer-cc">
    <div class="footer-top">
        <div class="container-cc">
            <div class="footer-grid">
                <div class="footer-brand">
                    <img src="img/img/logo.png" alt="CorpoCapital" class="footer-logo">
                    <p class="footer-tagline">Comprometidos con el desarrollo<br>y bienestar del Distrito Capital.</p>
                    <div class="footer-social">
                        <a href="https://www.facebook.com/CorpoCapital1gdc/?locale=es_LA" class="fsoc-link" aria-label="Facebook">
                            <i class='bx bxl-facebook'></i>
                        </a>
                        <a href="https://www.tiktok.com/@corpocapital.gdc" class="fsoc-link" aria-label="TikTok">
                            <i class='bx bxl-tiktok'></i>
                        </a>
                        <a href="https://www.instagram.com/corpocapital.gdc/" class="fsoc-link" aria-label="Instagram">
                            <i class='bx bxl-instagram'></i>
                        </a>
                    </div>
                </div>
                <div class="footer-col">
                    <h6 class="footer-col-title">Navegación</h6>
                    <ul>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="quienes_somos.html">¿Quiénes Somos?</a></li>
                        <li><a href="At_Ciudadano.php">Atención al Propietario</a></li>
                        <li><a href="https://corpo.capital" target="_blank" rel="noopener">Corpo Suite</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h6 class="footer-col-title">Contacto</h6>
                    <ul>
                        <li><a href="#">Número de Contacto</a></li>
                        <li><a href="#">Correo Institucional</a></li>
                        <li><a href="#">Sede Principal</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-cc">
        <div class="container-cc footer-bottom-inner">
            <p>© 2025 CorpoCapital. Todos los derechos reservados.</p>
            <p>Distrito Capital, Venezuela</p>
        </div>
    </div>
</footer>

<script src="script.js"></script>
<script>
// ── Scroll reveal ──────────────────────────────────────────
(function(){
  const els = document.querySelectorAll('.reveal-up, .reveal-left, .reveal-right');
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            const delay = parseInt(e.target.dataset.delay || 0);
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('revealed'), delay);
            } else {
                e.target.classList.remove('revealed');
            }
        });
    }, { threshold: 0.12 });
  els.forEach(el => io.observe(el));
})();
</script>
</body>
</html>
