<?php
require_once __DIR__ . '/db/database.php';

$pdo = getDatabaseConnection();
$settings = getSettings($pdo);
$newsItems = getNewsItems($pdo);
$videoSrc = htmlspecialchars($settings['video_src'] ?? 'videos/torres.mp4', ENT_QUOTES, 'UTF-8');
$logoImage = htmlspecialchars($settings['logo_image'] ?? 'img/img/logo.png', ENT_QUOTES, 'UTF-8');
$carouselSlides = [];
for ($i = 1; $i <= 3; $i++) {
    $carouselSlides[] = [
        'image' => htmlspecialchars($settings["carousel_{$i}_image"] ?? [
            'img/img/fundasalud.jpg',
            'img/img/gabinete.jpg',
            'img/img/resumen.jpg',
        ][$i - 1], ENT_QUOTES, 'UTF-8'),
        'title' => htmlspecialchars($settings["carousel_{$i}_title"] ?? [
            'Fundación Salud',
            'Gabinete Institucional',
            'Resumen de Actividades',
        ][$i - 1], ENT_QUOTES, 'UTF-8'),
        'description' => htmlspecialchars($settings["carousel_{$i}_description"] ?? [
            'Iniciativas de salud comunitaria impulsadas por CorpoCapital.',
            'Reuniones y coordinación con el gabinete institucional.',
            'Resumen de las principales actividades realizadas.',
        ][$i - 1], ENT_QUOTES, 'UTF-8'),
    ];
}

function curlFetchUrl(string $url): ?string {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_HTTPHEADER => [
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language: es-ES,es;q=0.9',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
        ],
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response ?: null;
}

function parseInstagramPosts(string $username, int $limit = 2): array {
    $data = [];
    $json = curlFetchUrl("https://www.instagram.com/{$username}/?__a=1&__d=dis");
    if ($json) {
        $payload = json_decode($json, true);
        $edges = $payload['graphql']['user']['edge_owner_to_timeline_media']['edges'] ?? [];
        foreach ($edges as $edge) {
            if (count($data) >= $limit) {
                break;
            }
            $node = $edge['node'] ?? [];
            $data[] = [
                'link' => 'https://www.instagram.com/p/' . ($node['shortcode'] ?? '') . '/',
                'image' => $node['display_url'] ?? '',
                'caption' => trim($node['edge_media_to_caption']['edges'][0]['node']['text'] ?? ''),
                'is_video' => !empty($node['is_video']),
            ];
        }
    }
    if (empty($data)) {
        $html = curlFetchUrl("https://www.instagram.com/{$username}/");
        if ($html && preg_match('/<script type="text\/javascript">window\._sharedData = (.*?);<\/script>/s', $html, $match)) {
            $payload = json_decode($match[1], true);
            $edges = $payload['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ?? [];
            foreach ($edges as $edge) {
                if (count($data) >= $limit) break;
                $node = $edge['node'] ?? [];
                $data[] = [
                    'link' => 'https://www.instagram.com/p/' . ($node['shortcode'] ?? '') . '/',
                    'image' => $node['display_url'] ?? '',
                    'caption' => trim($node['edge_media_to_caption']['edges'][0]['node']['text'] ?? ''),
                    'is_video' => !empty($node['is_video']),
                ];
            }
        }
    }
    return $data;
}

function parseTikTokPosts(string $username, int $limit = 2): array {
    $data = [];
    $html = curlFetchUrl("https://www.tiktok.com/@{$username}");
    if (!$html) {
        return $data;
    }
    if (preg_match('/<script id="SIGI_STATE" type="application\/json">(.*?)<\/script>/s', $html, $match)) {
        $json = json_decode($match[1], true);
        $itemModule = $json['ItemModule'] ?? [];
        $lists = $json['ItemList'] ?? [];
        $postIds = [];
        foreach ($lists as $list) {
            if (!empty($list['list']) && is_array($list['list'])) {
                $postIds = $list['list'];
                break;
            }
        }
        foreach ($postIds as $id) {
            if (count($data) >= $limit) break;
            $item = $itemModule[$id] ?? null;
            if (!$item) continue;
            $video = $item['video'] ?? [];
            $data[] = [
                'link' => 'https://www.tiktok.com/@' . $username . '/video/' . ($item['id'] ?? $id),
                'image' => $video['cover'] ?? $video['originCover'] ?? '',
                'caption' => trim($item['desc'] ?? ''),
                'music' => $video['music']['title'] ?? '',
            ];
        }
    }
    return $data;
}

$instagramPosts = parseInstagramPosts('corpocapital.gdc', 2);
$tiktokPosts = parseTikTokPosts('corpocapital.gdc', 2);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CorpoCapital — Corporación de Desarrollo del Distrito Capital</title>
    <link rel="icon" href="img/img/lilcorpo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="bootstrap-5.3.6-dist/css/bootstrap.min.css" rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Cormorant+SC:wght@300;400;500;600;700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script>document.documentElement.classList.add('js');</script>
    <style>
    /* Featured video block (matches page blues and card style) */
    .feature-video-wrap { margin-top: 48px; display:flex; justify-content:center; }
    .feature-video { position:relative; width:100%; max-width:900px; aspect-ratio:1 / 1; background: linear-gradient(180deg,var(--azul) 0%, var(--azul-mid) 100%); border-radius:0; padding:18px; box-sizing:border-box; display:flex; flex-direction:column; align-items:center; }
    /* Label centered inside the blue container (above the white card) */
    .feature-video .feature-label { position:relative; margin:6px 0 12px; color: #ffffff; font-family: var(--font-sc); font-weight:600; letter-spacing:0.08em; text-transform:uppercase; font-size:1.05rem; padding:6px 12px; background: transparent; border-radius:6px; z-index:2; text-align:center; }
    .feature-video-card { margin-top:12px; background: #ffffff; border-radius:12px; overflow:hidden; box-shadow: 0 14px 40px rgba(10,36,99,0.08); display:flex; flex-direction:column; width:100%; flex:1; }
    .feature-video-card video { width:100%; height:100%; display:block; object-fit:cover; }
    .video-wrapper { height:100%; display:flex; flex-direction:column; }

    /* Custom controls */
    .video-wrapper { position:relative; background:#000; }
    .cc-controls { padding:18px 20px; background:#111; color:#fff; display:flex; flex-direction:column; gap:12px; align-items:center; }
    .cc-buttons { display:flex; gap:28px; align-items:center; justify-content:center; }
    .cc-btn { background:transparent; border:none; color:#fff; font-size:28px; display:inline-flex; align-items:center; justify-content:center; padding:8px; cursor:pointer; }
    .cc-btn:focus{ outline:2px solid rgba(255,255,255,0.12); border-radius:6px }
    .cc-btn.play i{ font-size:40px }
    .cc-progress-row { display:flex; align-items:center; gap:16px; width:100%; max-width:980px; }
    .cc-time { color:#fff; font-weight:600; min-width:48px; text-align:center; }
    .cc-progress { position:relative; flex:1; height:8px; background:rgba(255,255,255,0.15); border-radius:999px; cursor:pointer; }
    .cc-progress-filled { position:absolute; left:0; top:0; height:100%; width:0%; background:#fff; border-radius:999px; }
    .cc-thumb { position:absolute; top:50%; transform:translateY(-50%); left:50%; width:18px; height:18px; background:#fff; border-radius:50%; box-shadow:0 2px 6px rgba(0,0,0,0.4); pointer-events:none; }
    @media (max-width:600px){ .cc-buttons{ gap:14px } .cc-btn{ font-size:22px } .cc-progress-row{ gap:8px } }
    .feature-video-empty { padding: 40px 24px; color: var(--gris-80); font-family: var(--font-body); background: #f4f7ff; border-radius: 10px; text-align:center; }
    .feature-video-empty code { background: rgba(31,102,208,0.08); color: #0f3f90; padding: 2px 6px; border-radius: 4px; }
    .social-grid { display:grid; grid-template-columns: repeat(2, minmax(250px, 1fr)); gap:24px; margin-top:24px; }
    .social-card { background:#ffffff; border-radius:16px; box-shadow:0 18px 50px rgba(18,53,118,0.08); padding:24px; }
    .social-card-meta { display:flex; flex-wrap:wrap; align-items:center; gap:10px; margin-bottom:18px; }
    .social-card-meta h3 { margin:0; font-size:1.15rem; letter-spacing:0.02em; }
    .social-card-meta a { color: #0c1f4f; font-weight:700; text-decoration:none; }
    .social-post { border-radius:14px; overflow:hidden; background:#f9fbff; margin-bottom:16px; }
    .social-post img { width:100%; display:block; aspect-ratio:4 / 3; object-fit:cover; }
    .social-caption { padding:14px 12px; color:#172747; font-size:.95rem; line-height:1.5; min-height:72px; }
    .social-link { display:inline-flex; align-items:center; gap:8px; color: var(--azul); font-weight:700; text-decoration:none; }
    .social-alert { padding:18px 14px; background:#f5f7ff; border-radius:12px; color:#182c63; }
    @media (max-width:900px){ .feature-video{ padding:14px } .feature-video .feature-label{ font-size:0.95rem; padding:6px 10px } .social-grid { grid-template-columns:1fr; } }
    </style>
</head>
<body>

<!-- ══ NAVBAR ══ -->
<nav id="navbar">
    <div class="nav-inner">
        <a href="#inicio" class="nav-logo">
            <img src="<?= $logoImage ?>" alt="CorpoCapital" class="nav-logo-img">
        </a>
        <div class="nav-links" id="navLinks">
            <a href="quienes_somos.html" class="nav-link">¿Quiénes Somos?</a>
            <a href="At_Ciudadano.php" class="nav-link">Atención a la Comunidad</a>
            <a href="https://corpo.capital/suite/portal.html" class="btn-suite" target="_blank" rel="noopener">Corpo Suite</a>
        </div>
        <button class="nav-hamburger" id="navToggle" aria-label="Menú">
            <span></span><span></span>
        </button>
    </div>
</nav>

<!-- ══ HERO ══ -->
<section class="hero" id="inicio">
    <div class="hero-media">
        <video autoplay loop muted playsinline class="hero-video">
            <source src="<?= $videoSrc ?>" type="video/mp4">
        </video>
        <div class="hero-veil"></div>
    </div>
    <div class="hero-body">
        <div class="hero-eyebrow reveal-up" data-delay="0">
            <span class="eyebrow-line"></span>
            <span>Distrito Capital · Venezuela</span>
            <span class="eyebrow-line"></span>
        </div>
        <br>
        <h1 class="hero-title reveal-up" data-delay="120">
            <em>Somos</em>CorpoCapital
        </h1>
        <p class="hero-sub reveal-up" data-delay="260">
            Desarrollo integral para la ciudad que habitamos
        </p>
        <br>
        <div class="hero-cta-row reveal-up" data-delay="380">
            <a href="#mision" class="btn-primary-cc">Conocer más</a>
            <a href="At_Ciudadano.php" class="btn-ghost-cc">Enviar solicitud</a>
        </div>
    </div>
    <div class="hero-scroll">
        <div class="scroll-line"></div>
        <span>Desplazar</span>
    </div>
</section>

<!-- ══ FRANJA INSTITUCIONAL ══ -->
<div class="ticker-wrap">
    <div class="ticker-track">
        <?php $items = ['Corporación de Desarrollo', 'Distrito Capital', 'Transparencia Institucional', 'Gestión Ciudadana', 'Infraestructura Pública', 'Bienestar Colectivo']; ?>
        <?php for ($r = 0; $r < 4; $r++): foreach ($items as $t): ?>
            <span class="ticker-item"><?= $t ?></span><span class="ticker-dot">·</span>
        <?php endforeach; endfor; ?>
    </div>
</div>

<!-- ══ MISIÓN / INTRO ══ -->
<section class="section-intro" id="mision">
    <div class="container-cc">
        <div class="intro-grid">
            <div class="intro-left">
                <p class="kicker reveal-left">Nuestra Institución</p>
                <h2 class="display-title reveal-left" data-delay="80">
                    Una corporación<br>al servicio<br><em>del ciudadano</em>
                </h2>
                <a href="quienes_somos.html" class="link-arrow reveal-left" data-delay="200">
                    Descubrir nuestra historia <i class='bx bx-right-arrow-alt'></i>
                </a>
            </div>
            <div class="intro-right">
                <p class="intro-desc reveal-right" data-delay="0">
                    CorpoCapital es el ente público encargado del desarrollo integral del Distrito Capital. 
                    Gestionamos recursos, coordinamos proyectos de infraestructura y prestamos servicios 
                    institucionales con los más altos estándares de transparencia y eficiencia.
                </p>
                <div class="stat-row reveal-right" data-delay="100">
                    <div class="stat-item">
                        <span class="stat-num">+30</span>
                        <span class="stat-label">Años de servicio</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-num">100%</span>
                        <span class="stat-label">Institución pública</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-num">DC</span>
                        <span class="stat-label">Distrito Capital</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ PILARES ══ -->
<section class="section-pillars">
    <div class="container-cc">
        <div class="pillars-header">
            <p class="kicker reveal-up">Ejes de Gestión</p>
            <h2 class="display-title reveal-up" data-delay="80">Lo que nos <em>define</em></h2>
        </div>
        <div class="pillars-grid">
            <div class="pillar-card pillar-dark reveal-up" data-delay="0">
                <div class="pillar-num">01</div>
                <div class="pillar-icon"><i class='bx bx-buildings'></i></div>
                <h3>Infraestructura</h3>
                <p>Supervisamos y ejecutamos proyectos de desarrollo urbano que transforman la calidad de vida en el Distrito Capital.</p>
            </div>
            <div class="pillar-card pillar-light reveal-up" data-delay="80">
                <div class="pillar-num">02</div>
                <div class="pillar-icon"><i class='bx bx-group'></i></div>
                <h3>Atención Ciudadana</h3>
                <p>Canal directo y eficiente para que propietarios y ciudadanos gestionen sus solicitudes con respuesta oportuna.</p>
            </div>
            <div class="pillar-card pillar-light reveal-up" data-delay="160">
                <div class="pillar-num">03</div>
                <div class="pillar-icon"><i class='bx bx-check-shield'></i></div>
                <h3>Transparencia</h3>
                <p>Actuamos bajo los más altos estándares de responsabilidad pública, con rendición de cuentas permanente.</p>
            </div>
            <div class="pillar-card pillar-accent reveal-up" data-delay="240">
                <div class="pillar-num">04</div>
                <div class="pillar-icon"><i class='bx bx-line-chart'></i></div>
                <h3>Gestión Digital</h3>
                <p>Modernizamos los procesos institucionales a través de plataformas digitales accesibles para todos.</p>
            </div>
        </div>
    </div>
</section>
<!-- ══ REDES SOCIALES (integración propia Instagram/TikTok) ══ -->
<section class="section-social">
    <div class="container-cc">
        <div class="social-header">
            <p class="kicker reveal-up">Presencia Digital</p>
            <h2 class="display-title reveal-up" data-delay="80">CorpoCapital <em>en Redes</em></h2>
            <p class="social-note reveal-up" data-delay="160">Síguenos para mantenerte informado sobre nuestras actividades institucionales</p>
        </div>

        <div class="social-grid reveal-up" data-delay="120">
            <div class="social-card">
                <div class="social-card-meta">
                    <i class='bx bxl-instagram' style="font-size:1.7rem;color:#e1306c"></i>
                    <h3>Instagram</h3>
                    <a href="https://www.instagram.com/corpocapital.gdc/" target="_blank" rel="noopener">@corpocapital.gdc</a>
                </div>
                <?php if (!empty($instagramPosts)): ?>
                    <?php foreach ($instagramPosts as $post): ?>
                        <div class="social-post">
                            <a href="<?= htmlspecialchars($post['link'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">
                                <img src="<?= htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8') ?>" alt="Instagram post">
                            </a>
                            <div class="social-caption"><?= htmlspecialchars($post['caption'] ?: 'Ver publicación en Instagram', ENT_QUOTES, 'UTF-8') ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="social-alert">No fue posible cargar las últimas publicaciones de Instagram en este momento. Visita el perfil para más contenido.</div>
                <?php endif; ?>
                <a class="social-link" href="https://www.instagram.com/corpocapital.gdc/" target="_blank" rel="noopener">Ir a Instagram <i class='bx bx-right-arrow-alt'></i></a>
            </div>
            <div class="social-card">
                <div class="social-card-meta">
                    <i class='bx bxl-tiktok' style="font-size:1.7rem;color:#000"></i>
                    <h3>TikTok</h3>
                    <a href="https://www.tiktok.com/@corpocapital.gdc" target="_blank" rel="noopener">@corpocapital.gdc</a>
                </div>
                <?php if (!empty($tiktokPosts)): ?>
                    <?php foreach ($tiktokPosts as $post): ?>
                        <div class="social-post">
                            <a href="<?= htmlspecialchars($post['link'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">
                                <img src="<?= htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8') ?>" alt="TikTok post">
                            </a>
                            <div class="social-caption"><?= htmlspecialchars($post['caption'] ?: 'Ver publicación en TikTok', ENT_QUOTES, 'UTF-8') ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="social-alert">No fue posible cargar las últimas publicaciones de TikTok en este momento. Visita el perfil para más contenido.</div>
                <?php endif; ?>
                <a class="social-link" href="https://www.tiktok.com/@corpocapital.gdc" target="_blank" rel="noopener">Ir a TikTok <i class='bx bx-right-arrow-alt'></i></a>
            </div>
        </div>
        <!-- Featured video: 100 dias de gestión -->
        <div class="feature-video-wrap reveal-up" data-delay="200" id="video">
            <div class="feature-video">
                <div class="feature-label">100 días de gestión</div>
                <div class="feature-video-card">
                    <div class="video-wrapper">
                        <video id="featureVideo" playsinline preload="metadata" poster="img/img/video-poster.jpg">
                            <source src="videos/100.mp4" type="video/mp4">
                            Tu navegador no soporta la reproducción de video.
                        </video>
                        <div class="cc-controls" id="ccControls">
                            <div class="cc-buttons">
                                <button class="cc-btn" id="btnLoop" title="Alternar repetir"><i class='bx bx-repost'></i></button>
                                <button class="cc-btn" id="btnRewind" title="Retroceder 10s"><i class='bx bx-rewind'></i></button>
                                <button class="cc-btn play" id="btnPlay" title="Reproducir/Pausar"><i class='bx bx-play'></i></button>
                                <button class="cc-btn" id="btnForward" title="Adelantar 10s"><i class='bx bx-fast-forward'></i></button>
                                <button class="cc-btn" id="btnVolume" title="Silenciar/Volumen"><i class='bx bx-volume-full'></i></button>
                            </div>
                            <div class="cc-progress-row">
                                <span class="cc-time" id="currentTime">00:00</span>
                                <div class="cc-progress" id="progressBar">
                                    <div class="cc-progress-filled" id="progressFilled"></div>
                                    <div class="cc-thumb" id="progressThumb"></div>
                                </div>
                                <span class="cc-time" id="duration">00:00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ GALERÍA / CAROUSEL ══ -->
<section class="section-gallery">
    <div class="container-cc">
        <div class="gallery-header">
            <p class="kicker reveal-left">Registro Institucional</p>
            <h2 class="display-title reveal-left" data-delay="80">CorpoCapital <em>al Día</em></h2>
        </div>
    </div>
    <div class="carousel-full reveal-up" data-delay="160">
        <div id="carouselMain" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php foreach ($carouselSlides as $index => $slide): ?>
                <button type="button" data-bs-target="#carouselMain"
                        data-bs-slide-to="<?= $index ?>"
                        class="<?= $index === 0 ? 'active' : '' ?>"
                        <?= $index === 0 ? 'aria-current="true"' : '' ?>
                        aria-label="Slide <?= $index + 1 ?>"></button>
                <?php endforeach; ?>
            </div>
            <div class="carousel-inner">
                <?php foreach ($carouselSlides as $index => $slide): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <img src="<?= $slide['image'] ?>" class="d-block w-100" alt="Slide <?= $index + 1 ?>">
                    <div class="carousel-caption-cc">
                        <h5><?= $slide['title'] ?></h5>
                        <p><?= $slide['description'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselMain" data-bs-slide="prev">
                <i class='bx bx-chevron-left'></i>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselMain" data-bs-slide="next">
                <i class='bx bx-chevron-right'></i>
            </button>
        </div>
    </div>
</section>

<!-- ══ FOOTER ══ -->
<footer class="footer-cc">
    <div class="footer-top">
        <div class="container-cc">
            <div class="footer-grid">
                <div class="footer-brand">
                    <img src="<?= $logoImage ?>" alt="CorpoCapital" class="footer-logo">
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
                        <li><a href="#inicio">Inicio</a></li>
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
            <p>© <?= date('Y') ?> CorpoCapital. Todos los derechos reservados.</p>
            <p>Distrito Capital, Venezuela</p>
        </div>
    </div>
</footer>

<script src="script.js"></script>
<script src="bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
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
                // Al salir del viewport quitamos la clase para permitir que la animación
                // vuelva a reproducirse si el elemento entra de nuevo.
                e.target.classList.remove('revealed');
            }
        });
    }, { threshold: 0.12 });
  els.forEach(el => io.observe(el));
})();

// ── Parallax hero ─────────────────────────────────────────
window.addEventListener('scroll', ()=>{
  const s = window.scrollY;
  const vid = document.querySelector('.hero-video');
  if(vid) vid.style.transform = `translateY(${s * 0.28}px)`;
  const body = document.querySelector('.hero-body');
  if(body) body.style.transform = `translateY(${s * 0.14}px)`;
  body && (body.style.opacity = 1 - s/600);
});

// ── Custom video controls for feature video ───────────────
(function(){
    const video = document.getElementById('featureVideo');
    if(!video) return;
    const btnPlay = document.getElementById('btnPlay');
    const btnRewind = document.getElementById('btnRewind');
    const btnForward = document.getElementById('btnForward');
    const btnLoop = document.getElementById('btnLoop');
    const btnVolume = document.getElementById('btnVolume');
    const progressBar = document.getElementById('progressBar');
    const progressFilled = document.getElementById('progressFilled');
    const progressThumb = document.getElementById('progressThumb');
    const currentTimeEl = document.getElementById('currentTime');
    const durationEl = document.getElementById('duration');

    function fmt(t){
        if(isNaN(t)) return '00:00';
        const m = Math.floor(t/60); const s = Math.floor(t%60);
        return String(m).padStart(2,'0')+':'+String(s).padStart(2,'0');
    }

    video.addEventListener('loadedmetadata', ()=>{
        durationEl.textContent = fmt(video.duration);
    });

    video.addEventListener('timeupdate', ()=>{
        const pct = (video.currentTime / (video.duration || 1)) * 100;
        progressFilled.style.width = pct + '%';
        progressThumb.style.left = pct + '%';
        currentTimeEl.textContent = fmt(video.currentTime);
    });

    btnPlay.addEventListener('click', ()=>{
        if(video.paused){ video.play(); btnPlay.innerHTML = "<i class='bx bx-pause'></i>"; }
        else { video.pause(); btnPlay.innerHTML = "<i class='bx bx-play'></i>"; }
    });

    btnRewind.addEventListener('click', ()=>{ video.currentTime = Math.max(0, video.currentTime - 10); });
    btnForward.addEventListener('click', ()=>{ video.currentTime = Math.min(video.duration || 0, video.currentTime + 10); });

    btnLoop.addEventListener('click', ()=>{ video.loop = !video.loop; btnLoop.classList.toggle('active', video.loop); });

    btnVolume.addEventListener('click', ()=>{
        video.muted = !video.muted; btnVolume.innerHTML = video.muted ? "<i class='bx bx-volume-mute'></i>" : "<i class='bx bx-volume-full'></i>";
    });

    let seeking = false;
    function seekTo(clientX){
        const rect = progressBar.getBoundingClientRect();
        const x = Math.min(Math.max(0, clientX - rect.left), rect.width);
        const pct = x / rect.width;
        video.currentTime = pct * (video.duration || 1);
    }

    progressBar.addEventListener('click', (e)=> seekTo(e.clientX));
    progressBar.addEventListener('mousedown', (e)=>{ seeking=true; seekTo(e.clientX); });
    document.addEventListener('mousemove', (e)=>{ if(seeking) seekTo(e.clientX); });
    document.addEventListener('mouseup', ()=>{ seeking=false; });

    // set initial play button state
    btnPlay.innerHTML = video.paused ? "<i class='bx bx-play'></i>" : "<i class='bx bx-pause'></i>";
})();
</script>
</body>
</html>
