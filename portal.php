<?php
session_start();
require_once __DIR__ . '/db/database.php';

$message = '';

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: portal.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $pdo = getDatabaseConnection();
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $hashedPassword = md5($password);

    $stmt = $pdo->prepare('SELECT id FROM users WHERE username = :username AND password = :password');
    $stmt->execute([':username' => $username, ':password' => $hashedPassword]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username;
        header('Location: portal.php');
        exit;
    } else {
        $message = 'Usuario o contraseña incorrectos.';
    }
}

$isLoggedIn = isset($_SESSION['user_id']);

if ($isLoggedIn && $_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['login'])) {
    try {
        $pdo = getDatabaseConnection();
        $settings = getSettings($pdo);
    } catch (PDOException $e) {
        $message = 'Error de conexión a la base de datos: ' . $e->getMessage();
    }

    if (empty($message)) {
        $uploadDir = __DIR__ . '/uploads';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $currentVideoSrc = $settings['video_src'] ?? 'videos/torres.mp4';
    $videoSrc = saveUploadedVideo('video_file', $currentVideoSrc, $uploadDir);
    saveSetting($pdo, 'video_src', $videoSrc);

    $currentLogo = $settings['logo_image'] ?? 'img/img/logocorpo.png';
    $logoImage = saveUploadedImage('logo_image_file', $currentLogo, $uploadDir);
    saveSetting($pdo, 'logo_image', $logoImage);

    $carouselDefaults = [
        1 => [
            'image' => 'img/img/fundasalud.jpg',
            'title' => 'First slide label',
            'description' => 'Some representative placeholder content for the first slide.',
        ],
        2 => [
            'image' => 'img/img/gabinete.jpg',
            'title' => 'Second slide label',
            'description' => 'Some representative placeholder content for the second slide.',
        ],
        3 => [
            'image' => 'img/img/resumen.jpg',
            'title' => 'Third slide label',
            'description' => 'Some representative placeholder content for the third slide.',
        ],
    ];

    for ($slide = 1; $slide <= 3; $slide++) {
        $slideTitle = trim($_POST["carousel_{$slide}_title"] ?? $carouselDefaults[$slide]['title']);
        $slideDescription = trim($_POST["carousel_{$slide}_description"] ?? $carouselDefaults[$slide]['description']);
        $currentCarouselImage = $settings["carousel_{$slide}_image"] ?? $carouselDefaults[$slide]['image'];
        $carouselImage = saveUploadedImage("carousel_image_{$slide}", $currentCarouselImage, $uploadDir);

        saveSetting($pdo, "carousel_{$slide}_title", $slideTitle);
        saveSetting($pdo, "carousel_{$slide}_description", $slideDescription);
        saveSetting($pdo, "carousel_{$slide}_image", $carouselImage);
    }

    $message = 'Contenido actualizado correctamente.';
    $settings = getSettings($pdo);
    }
}

if ($isLoggedIn) {
    try {
        $pdo = getDatabaseConnection();
        $settings = getSettings($pdo);
    } catch (PDOException $e) {
        $message = 'Error de conexión a la base de datos: ' . $e->getMessage();
        $settings = [];
    }
}

function oldValue(array $data, string $key, string $default = ''): string
{
    return htmlspecialchars($data[$key] ?? $default, ENT_QUOTES, 'UTF-8');
}

function saveUploadedImage(string $fieldName, string $currentValue, string $uploadDir): string
{
    if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
        return $currentValue;
    }

    $file = $_FILES[$fieldName];
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp',
    ];

    if (!isset($allowed[$mime])) {
        return $currentValue;
    }

    $extension = $allowed[$mime];
    $fileName = sprintf('%s_%s.%s', $fieldName, uniqid(), $extension);
    $destination = rtrim($uploadDir, '/\\') . DIRECTORY_SEPARATOR . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        return $currentValue;
    }

    return 'uploads/' . $fileName;
}

function saveUploadedVideo(string $fieldName, string $currentValue, string $uploadDir): string
{
    if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
        return $currentValue;
    }

    $file = $_FILES[$fieldName];
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    $allowed = [
        'video/mp4' => 'mp4',
        'video/webm' => 'webm',
        'video/ogg' => 'ogg',
    ];

    if (!isset($allowed[$mime])) {
        return $currentValue;
    }

    $extension = $allowed[$mime];
    $fileName = sprintf('%s_%s.%s', $fieldName, uniqid(), $extension);
    $destination = rtrim($uploadDir, '/\\') . DIRECTORY_SEPARATOR . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        return $currentValue;
    }

    return 'uploads/' . $fileName;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Administración - CorpoCapital</title>
    <link href="bootstrap-5.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 30px; background: #f5f8ff; }
        .portal-card { max-width: 1000px; margin: auto; }
        .form-section { background: #fff; border-radius: .75rem; padding: 24px; box-shadow: 0 12px 30px rgba(0,0,0,.08); }
        .notice-box { background: #e8f0ff; padding: 16px; margin-bottom: 20px; border-radius: .75rem; }
    </style>
</head>
<body>
    <div class="portal-card">
        <?php if (!$isLoggedIn): ?>
            <div class="form-section">
                <h2 class="h5">Iniciar Sesión</h2>
                <?php if ($message): ?>
                    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Iniciar Sesión</button>
                </form>
            </div>
        <?php else: ?>
            <div class="notice-box">
                <h1 class="h4">Portal de administración</h1>
                <p>Modifica el video de fondo, el logo y otros contenidos del sitio.</p>
                <p>Los cambios se guardan en la base de datos y se reflejarán en <code>index.php</code>.</p>
                <p><a href="?logout=1" class="btn btn-sm btn-outline-danger">Cerrar Sesión</a></p>
            </div>

            <?php if ($message): ?>
                <div class="alert alert-success" role="alert"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>

            <div class="form-section">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <h2 class="h5">Configuración global</h2>
                        <div class="mb-3">
                            <label for="video_file" class="form-label">Subir video inicial</label>
                            <input type="file" class="form-control" id="video_file" name="video_file" accept="video/mp4,video/webm,video/ogg">
                            <div class="form-text">Carga un archivo de video MP4, WEBM u OGG para el video de inicio.</div>
                            <?php if (!empty($settings['video_src'])): ?>
                                <div class="form-text">Actual: <code><?= htmlspecialchars($settings['video_src'], ENT_QUOTES, 'UTF-8') ?></code></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="logo_image_file" class="form-label">Subir imagen del logo</label>
                            <input type="file" class="form-control" id="logo_image_file" name="logo_image_file" accept="image/*">
                            <div class="form-text">Carga un archivo de imagen para el logo.</div>
                            <img id="logo_preview" src="" alt="Previsualización del logo" style="max-width: 200px; max-height: 200px; display: none; margin-top: 10px;">
                            <?php if (!empty($settings['logo_image'])): ?>
                                <div class="form-text">Actual: <code><?= htmlspecialchars($settings['logo_image'], ENT_QUOTES, 'UTF-8') ?></code></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h2 class="h5">Carrusel</h2>
                        <?php for ($slide = 1; $slide <= 3; $slide++): ?>
                            <div class="mb-3">
                                <label for="carousel_<?= $slide ?>_title" class="form-label">Título slide <?= $slide ?></label>
                                <input type="text" class="form-control" id="carousel_<?= $slide ?>_title" name="carousel_<?= $slide ?>_title" value="<?= oldValue($settings, "carousel_{$slide}_title", 'Slide title') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="carousel_<?= $slide ?>_description" class="form-label">Descripción slide <?= $slide ?></label>
                                <textarea class="form-control" id="carousel_<?= $slide ?>_description" name="carousel_<?= $slide ?>_description" rows="2"><?= oldValue($settings, "carousel_{$slide}_description", 'Descripción del slide.') ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="carousel_image_<?= $slide ?>" class="form-label">Subir imagen slide <?= $slide ?></label>
                                <input type="file" class="form-control" id="carousel_image_<?= $slide ?>" name="carousel_image_<?= $slide ?>" accept="image/*">
                                <div class="form-text">Carga una imagen para el slide <?= $slide ?> del carrusel.</div>
                                <img id="carousel_preview_<?= $slide ?>" src="" alt="Previsualización slide <?= $slide ?>" style="max-width: 200px; max-height: 200px; display: none; margin-top: 10px;">
                                <?php if (!empty($settings["carousel_{$slide}_image"])): ?>
                                    <div class="form-text">Actual: <code><?= htmlspecialchars($settings["carousel_{$slide}_image"], ENT_QUOTES, 'UTF-8') ?></code></div>
                                <?php endif; ?>
                            </div>
                            <hr>
                        <?php endfor; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <script src="bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            input.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.style.display = 'none';
                }
            });
        }

        // Previsualización para el logo
        previewImage('logo_image_file', 'logo_preview');

        // Previsualización para las imágenes del carrusel
        for (let i = 1; i <= 3; i++) {
            previewImage('carousel_image_' + i, 'carousel_preview_' + i);
        }
    </script>
</body>
</html>
