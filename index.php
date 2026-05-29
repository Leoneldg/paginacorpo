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
            <a href="At_Ciudadano.php" class="nav-link">Atención al Propietario</a>
            <a href="https://corpo.capital" class="btn-suite" target="_blank" rel="noopener">Corpo Suite</a>
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
<!-- ══ REDES SOCIALES (Elfsight - widgets existentes conservados) ══ -->
<section class="section-social">
    <div class="container-cc">
        <div class="social-header">
            <p class="kicker reveal-up">Presencia Digital</p>
            <h2 class="display-title reveal-up" data-delay="80">CorpoCapital <em>en Redes</em></h2>
            <p class="social-note reveal-up" data-delay="160">Síguenos para mantenerte informado sobre nuestras actividades institucionales</p>
        </div>

        <!-- Widgets Elfsight originales conservados íntegramente -->
        <div class="widgets-row reveal-up" data-delay="120">
            <script src="https://elfsightcdn.com/platform.js" async></script>
            <div class="elfsight-app-6167f102-61f4-45eb-83af-9974b1c077d2" data-elfsight-app-lazy></div>
            <div class="elfsight-app-8e8dca9c-de70-4a0a-8920-b1e848f487e5" data-elfsight-app-lazy></div>
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
<script src="https://static.elfsight.com/platform/platform.js" async></script>
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
</script>
</body>
</html>
