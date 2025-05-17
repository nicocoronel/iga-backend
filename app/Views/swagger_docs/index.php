<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>API Docs - Swagger UI</title>
  <link rel="stylesheet" href="<?= base_url('swagger_ui/swagger-ui.css') ?>" />
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('swagger_ui/favicon-32x32.png') ?>" />
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('swagger_ui/favicon-16x16.png') ?>" />
  <style>
    html, body { margin:0; padding:0; height:100%; }
    #swagger-ui { height:100%; }
  </style>
</head>
<body>
  <div id="swagger-ui"></div>
  <script src="<?= base_url('swagger_ui/swagger-ui-bundle.js') ?>"></script>
  <script src="<?= base_url('swagger_ui/swagger-ui-standalone-preset.js') ?>"></script>
  <script>
    window.onload = function() {
      SwaggerUIBundle({
        url: "<?= base_url('swagger_ui/swagger.json') ?>",
        dom_id: '#swagger-ui',
        presets: [
          SwaggerUIBundle.presets.apis,
          SwaggerUIStandalonePreset
        ],
        layout: "StandaloneLayout"
      });
    };
  </script>
</body>
</html>
