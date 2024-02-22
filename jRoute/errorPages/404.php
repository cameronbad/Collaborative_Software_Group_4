<?php http_response_code(404); ?>

<!DOCTYPE html>
<html>

<head>
    <title>404 Not Found</title>
    <link href="style.css" rel="stylesheet">
</head>

<body class="routingBody">
    <div class="error-box">
        <h1>404 Not Found</h1>
        <p>The requested URL was not found on this server.</p>
        <code><?= htmlspecialchars($_GET['error_uri']) ?></code>
    </div>
</body>

</html>