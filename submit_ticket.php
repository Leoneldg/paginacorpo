<?php
// Configuración de GLPI API
$glpi_url = 'http://localhost/glpi/apirest.php/'; // URL de la instalación de GLPI
$api_token = 'JpntS0vZcb3aC70dArrgSq6whHXRNEsPqrYl86Y5'; // Token de API de GLPI
$app_token = 'qOxi7Q53U1YA3FXL8DgxVg7RywEwbssfKuy2UPFz'; // App token de GLPI

function initSession() {
    global $glpi_url, $api_token, $app_token;

    $url = $glpi_url . 'initSession';

    $headers = [
        'Content-Type: application/json',
        'Authorization: user_token ' . $api_token,
    ];

    if ($app_token) {
        $headers[] = 'App-Token: ' . $app_token;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([])); // Remover, enviar POST vacío

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if ($http_code == 200 && isset($data['session_token'])) {
        return $data['session_token'];
    } else {
        return ['error' => $data ?: $response, 'http_code' => $http_code, 'curl_error' => $curl_error];
    }
}

function killSession($session_token) {
    global $glpi_url, $app_token;

    $url = $glpi_url . 'killSession';

    $headers = [
        'Content-Type: application/json',
        'Session-Token: ' . $session_token,
    ];

    if ($app_token) {
        $headers[] = 'App-Token: ' . $app_token;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);

    curl_exec($ch);
    curl_close($ch);
}

function callGlpiApi($endpoint, $method = 'GET', $data = null, $files = null, $session_token = null) {
    global $glpi_url, $app_token;

    $url = $glpi_url . $endpoint;

    $headers = [
        'Content-Type: application/json',
    ];

    if ($session_token) {
        $headers[] = 'Session-Token: ' . $session_token;
    }

    if ($app_token) {
        $headers[] = 'App-Token: ' . $app_token;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        if ($files) {
            // Para archivos, usar multipart/form-data
            curl_setopt($ch, CURLOPT_POSTFIELDS, $files);
            $headers = array_diff($headers, ['Content-Type: application/json']);
            $headers[] = 'Content-Type: multipart/form-data';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        } elseif ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    }

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ['response' => json_decode($response, true), 'http_code' => $http_code];
}

function uploadDocument($file_path, $file_name, $session_token) {
    $files = [
        'uploadManifest' => json_encode([
            'input' => [
                'name' => $file_name,
                '_filename' => [$file_name],
            ]
        ]),
        'filename' => new CURLFile($file_path, mime_content_type($file_path), $file_name),
    ];

    $result = callGlpiApi('/Document', 'POST', null, $files, $session_token);
    return $result['response']['id'] ?? null;
}

function createTicket($title, $content, $requester_name, $document_ids = [], $session_token) {
    $data = [
        'input' => [
            'name' => $title,
            'content' => $content,
            'status' => 1, // Nuevo
            'requesttypes_id' => 1, // Solicitud
            '_users_id_requester' => 0, // Usuario anónimo o especificar
            'users_id_recipient' => 1, // Administrador o quien reciba
        ]
    ];

    if ($requester_name) {
        $data['input']['_users_id_requester'] = 0; // Para anónimo, o buscar usuario
        $data['input']['name'] .= ' - ' . $requester_name;
    }

    if ($document_ids) {
        $data['input']['_documents_id'] = $document_ids;
    }

    $result = callGlpiApi('/Ticket', 'POST', $data, null, $session_token);
    return $result;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requester_name = trim($_POST['nombre_completo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');

    if (empty($descripcion) || empty($requester_name)) {
        $message = 'Todos los campos son obligatorios.';
    } else {
        // Iniciar sesión en GLPI
        $session_result = initSession();
        if (is_array($session_result)) {
            $message = 'Error al conectar con GLPI: ' . json_encode($session_result);
        } else {
            $session_token = $session_result;
            $document_ids = [];

            if (isset($_FILES['fotos'])) {
                $files = $_FILES['fotos'];
                for ($i = 0; $i < count($files['name']); $i++) {
                    if ($files['error'][$i] === UPLOAD_ERR_OK) {
                        $temp_path = $files['tmp_name'][$i];
                        $file_name = $files['name'][$i];
                        $doc_id = uploadDocument($temp_path, $file_name, $session_token);
                        if ($doc_id) {
                            $document_ids[] = $doc_id;
                        }
                    }
                }
            }

            $title = 'Caso de Atención al Propietario - ' . $requester_name;
            $result = createTicket($title, $descripcion, $requester_name, $document_ids, $session_token);

            if ($result['http_code'] === 201) {
                $message = 'Caso enviado exitosamente. ID del ticket: ' . ($result['response']['id'] ?? 'Desconocido');
            } else {
                $message = 'Error al enviar el caso: ' . json_encode($result['response']);
            }

            // Cerrar sesión en GLPI
            killSession($session_token);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención al Ciudadano - CorpoCapital</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header_plaza.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="bootstrap-5.3.6-dist/css/bootstrap.min.css" rel='stylesheet'>
</head>
<body>

    <header class="header" id="Inicio">
        <nav class="navbar navbar-expand-lg bg-body-transparent fixed-top " id="navbar">
            <div class="logo">
                <img src="img/img/logo.png" alt="">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                <h4>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="quienes_somos.html">¿Quienes Somos?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#portafolio">Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="At_Ciudadano.php">Atención al Ciudadano</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Inmobiliaria.html">Inmobiliaria</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Más
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">INTRANET</a></li>
                            </ul>
                        </li>
                    </ul>
                </h4>
            </div>
        </nav>
    </header>

    <main>
        <section class="contenedor" id="inf">
            <h2 class="subtitulo">Atención al Ciudadano</h2>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <?php if ($message): ?>
                            <div class="alert alert-info" role="alert">
                                <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre *</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido *</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción del Caso *</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="5" required placeholder="Describe tu caso aquí..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="fotos" class="form-label">Subir Fotos (opcional)</label>
                                <input type="file" class="form-control" id="fotos" name="fotos[]" accept="image/*" multiple>
                                <div class="form-text">Puedes subir múltiples fotos relacionadas con tu caso.</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar Caso</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="Contacto">
        <div class="contenedor footer-content">
            <div class="Contactanos">
                <h2 class="brad">Contactanos</h2>
                <p>Nro de Contacto</p>
                <p>Correo</p>
            </div>
            <div class="social-media">
                <a href="https://www.facebook.com/CorpoCapital1gdc/?locale=es_LA" class="social-media-icon">
                    <i class='bx bxl-facebook-circle'></i>
                </a>
                <a href="https://www.tiktok.com/@corpocapital.gdc" class="social-media-icon">
                    <i class='bx bxl-tiktok'></i>
                </a>
                <a href="https://www.instagram.com/corpocapital.gdc/" class="social-media-icon">
                    <i class='bx bxl-instagram-alt'></i>
                </a>
            </div>
        </div>
        <div class="line">
            <p><br>Derechos de Autor</p>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://static.elfsight.com/platform/platform.js" async></script>
    <script src="bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>