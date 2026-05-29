# Documentación de la Base de Datos

## Tablas

### `settings`
Clave-valor para valores de configuración de la aplicación.

- `key` VARCHAR(255) PRIMARY KEY
- `value` TEXT NOT NULL

Ejemplos de claves actuales:
- `video_src`
- `logo_image`
- `carousel_1_image`
- `carousel_1_title`
- `carousel_1_description`
- `carousel_2_image`
- `carousel_2_title`
- `carousel_2_description`
- `carousel_3_image`
- `carousel_3_title`
- `carousel_3_description`

### `news_items`
Noticias que se muestran en la página principal.

- `id` INT AUTO_INCREMENT PRIMARY KEY
- `title` TEXT NOT NULL
- `description` TEXT NOT NULL
- `image_url` TEXT NOT NULL
- `order_index` INT NOT NULL
- UNIQUE KEY `uniq_order_index` (`order_index`)

### `users`
Tabla de usuarios para el portal de administración.

- `id` INT AUTO_INCREMENT PRIMARY KEY
- `username` VARCHAR(255) NOT NULL UNIQUE
- `password` VARCHAR(255) NOT NULL

## Uso desde PHP

- `getSettings(PDO $pdo)` carga todos los valores de `settings`.
- `saveSetting(PDO $pdo, string $key, string $value)` crea o actualiza una clave de configuración.
- `getNewsItems(PDO $pdo)` devuelve los elementos de noticias ordenados por `order_index`.
- `saveNewsItem(PDO $pdo, int $order, string $title, string $description, string $imageUrl)` crea o actualiza una noticia según su posición.

## Integración con GLPI

La página `At_Ciudadano.php` envía formularios a `submit_ticket.php`, que crea tickets en GLPI vía API REST.

- Requiere configuración de `$glpi_url`, `$api_token`, `$app_token` en `submit_ticket.php`.
- Los adjuntos se suben como documentos en GLPI y se asocian al ticket.
- Ver `GLPI_INTEGRATION.md` para detalles de configuración.

## Cambios agregados

- Se agregó la edición de carrusel en `portal.php`.
- El carrusel ahora usa los siguientes valores de `settings`:
  - `carousel_1_image`, `carousel_1_title`, `carousel_1_description`
  - `carousel_2_image`, `carousel_2_title`, `carousel_2_description`
  - `carousel_3_image`, `carousel_3_title`, `carousel_3_description`
- `index.php` ya renderiza el carrusel desde la base de datos en lugar de usar valores fijos.

## Importación inicial

Para instalar la base de datos con valores por defecto, usa `db/dbcorpo_import.sql`.
Para crear el usuario manualmente, usa `db/users_import.sql`.
