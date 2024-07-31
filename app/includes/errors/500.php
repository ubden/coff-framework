<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>500 Internal Server Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
        }
        .bg-custom {
            background-color: #f8f9fa;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-container {
            text-align: center;
        }
        .error-title {
            font-size: 10rem;
        }
        .error-message {
            font-size: 1.5rem;
        }
    </style>
</head>
<body class="bg-custom">
    <div class="container">
        <div class="error-container">
            <h1 class="error-title text-danger">500</h1>
            <p class="error-message text-secondary">Üzgünüz, sunucuda bir hata oluştu.</p>
            <a href="/" class="btn btn-primary">Ana Sayfaya Dön</a>
        </div>
    </div>
</body>
</html>
