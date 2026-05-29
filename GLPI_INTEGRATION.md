# Configuración de GLPI API

Para integrar con GLPI, necesitas configurar los siguientes valores en `submit_ticket.php`:

```php
$glpi_url = 'http://localhost/glpi/apirest.php'; // URL de tu instalación de GLPI
$api_token = 'TU_API_TOKEN_AQUI'; // Token de API generado en GLPI
$app_token = 'TU_APP_TOKEN_AQUI'; // App Token si lo usas
```

## Pasos para obtener tokens en GLPI:

1. Ve a Configuración > General > API en GLPI.
2. Habilita la API REST si no está habilitada.
3. Crea un usuario API o usa un usuario existente.
4. Genera un API Token para ese usuario.
5. Si usas App Token, configúralo en la configuración general.

## Permisos necesarios:

- El usuario API debe tener permisos para crear tickets y subir documentos.
- Asegúrate de que el usuario pueda acceder a la entidad donde se crearán los tickets.

## Notas:

- Los tickets se crean con status "Nuevo" y tipo "Solicitud".
- Los adjuntos se suben como documentos en GLPI y se asocian al ticket.
- Si hay errores, revisa los logs de GLPI y PHP.