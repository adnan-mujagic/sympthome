

<!-- HTML for static distribution bundle build -->
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>SymptHome API</title>
    <link rel="stylesheet" type="text/css" href="/api/docs/swagger-ui.css">
    <link rel="stylesheet" type="text/css" href="/api/docs/custom-swagger.css">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32" />
    <style>
        html {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        body {
            margin: 0;
            background: #fafafa;
        }
    </style>
</head>

<body>
    <div id="swagger-ui"></div>

    <script src="/api/docs/swagger-ui-bundle.js"> </script>
    <script src="/api/docs/swagger-ui-standalone-preset.js"> </script>
    <script>
        window.onload = function () {
            // Begin Swagger UI call region
            const ui = SwaggerUIBundle({
                url: "//<?=$_SERVER["HTTP_HOST"].str_replace("docs","documentation",$_SERVER["REQUEST_URI"]) ?>",
                dom_id: '#swagger-ui',
                deepLinking: true,
                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],
                plugins: [
                    SwaggerUIBundle.plugins.DownloadUrl
                ],
                layout: "StandaloneLayout"
            })
            // End Swagger UI call region
            console.log(ui.url);
            console.log(ui);

            window.ui = ui
        }
    </script>
</body>

</html>
